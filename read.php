<?php
session_start();
require 'db.php';    
require 'vendor/autoload.php';
$db = getDB();
$collection = $db->news;
$commentsCollection = $db->comments;
$likesCollection = $db->likes;

$id = null; // Initialize the ID variable

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        // Validate the ObjectId format
        $idString = $_GET['id'];
        if (preg_match('/^[a-f0-9]{24}$/', $idString)) {
            $id = new MongoDB\BSON\ObjectId($idString);
            $post = $collection->findOne(['_id' => $id]);

            // Check if the post was found
            if (!$post) {
                echo "Post not found.";
                exit();
            }

            // Increment the view count
            $collection->updateOne(
                ['_id' => $id],
                ['$inc' => ['views' => 1]] // Increment the views field by 1
            );
        } else {
            echo "Invalid ID format.";
            exit();
        }
    } else {
        echo "No ID provided.";
        exit();
    }
}

// Handle comment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        $comment = $_POST['comment'];
        $username = $_SESSION['username'];
        $idString = $_POST['id']; // Get the ID from the POST data

        // Insert comment into the database
        $commentsCollection->insertOne([
            'news_id' => new MongoDB\BSON\ObjectId($idString), // Use the ID from POST
            'username' => $username,
            'comment' => $comment,
            'created_at' => new MongoDB\BSON\UTCDateTime(),
        ]);

        // Redirect to the same page
        header("Location: read.php?id=" . $idString);
        exit();
    } else {
        echo "You must be logged in to comment.";
    }
}

// Handle like/dislike submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        $action = $_POST['action'];
        $username = $_SESSION['username'];
        $idString = $_POST['id']; // Get the ID from the POST data

        $existingLike = $likesCollection->findOne(['news_id' => new MongoDB\BSON\ObjectId($idString), 'username' => $username]);

        if ($existingLike) {
            $likesCollection->updateOne(
                ['_id' => $existingLike['_id']],
                ['$set' => ['type' => $action]]
            );
        } else {
            $likesCollection->insertOne([
                'news_id' => new MongoDB\BSON\ObjectId($idString), // Use the ID from POST
                'username' => $username,
                'type' => $action,
            ]);
        }

        // Redirect to the same page
        header("Location: read.php?id=" . $idString);
        exit();
    } else {
        echo "You must be logged in to like/dislike.";
    }
}

// Fetch updated counts and comments after form submission
$likeCount = $likesCollection->countDocuments(['news_id' => $id, 'type' => 'like']);
$dislikeCount = $likesCollection->countDocuments(['news_id' => $id, 'type' => 'dislike']);
$comments = $commentsCollection->find(['news_id' => $id])->toArray(); // Fetch updated comments
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($post['title'] ?? 'No Title') ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #eef2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 960px;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .header a {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-size: 1rem;
            font-weight: 500;
            padding: 10px 20px;
            background: #295F98;
            color: #fff;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .header a img {
            width: 20px;
            margin-right: 10px;
        }

        .news-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .news-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
        }

        .news-title h3 {
            font-size: 1.2rem;
            color: #555;
            margin-top: 5px;
        }

        .news-image {
            text-align: center;
            margin: 30px 0;
        }

        .news-image img {
            max-width: 90%; 
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .news-meta {
            display: flex;
            justify-content: space-between;
            font-size: 1rem;
            color: #666;
            margin-bottom: 20px;
        }

        .news-meta .category {
            font-weight: bold;
            color: #1f3a93;
            background: #dbeafe;
            padding: 5px 10px;
            border-radius: 5px;
            text-transform: uppercase;
        }

        .news-meta .date {
            font-style: italic;
        }

        .news-meta .views {
            font-weight: bold;
            color: #333;
        }

        .news-content {
            line-height: 1.8;
            font-size: 1.2rem;
            color: #333;
        }

        .like-dislike-section {
            margin: 20px 0;
            display: flex;
            justify-content: center;
        }

        .like-dislike-section button {
            margin-right: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .like-dislike-section button:hover {
            background-color: #f0f0f0;
        }

        .comments-section {
            margin-top: 30px;
        }

        .comments-list {
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }

        .comment {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .comment strong {
            display: block;
            color: #1f3a93;
        }

        .comment small {
            color: #999;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <a href="index.php">
                <img src="https://img.icons8.com/ios-glyphs/30/ffffff/back.png" alt="Back">
                Back
            </a>
            <h1>
                <img src="fe/img/newsTing.png" alt="News Tingting">
            </h1>
        </header>

        <div class="news-title">
            <h2><?= htmlspecialchars($post['title'] ?? 'No Title') ?></h2>
            <h3>by <?= htmlspecialchars($post['author'] ?? 'Unknown Author') ?></h3>
        </div>

        <div class="news-image">
            <img src="admin/<?= htmlspecialchars($post['image_path'] ?? 'default.jpg') ?>" alt="Gambar tidak ditemukan" />
        </div>

        <div class="news-meta">
            <span class="category"><?= htmlspecialchars($post['category'] ?? 'Uncategorized') ?></span>
            <span class="date"><?= $post['created_at'] ? $post['created_at']->toDateTime()->format('F j, Y g:i A') : 'Unknown Date' ?></span>
            <span class="views">Views: <?= htmlspecialchars($post['views'] ?? 0) ?></span> <!-- Display views -->
        </div>

        <div class="news-content">
            <p><?= nl2br(htmlspecialchars($post['content'] ?? 'No content available.')) ?></p>
            <h4>Kesimpulan</h4>
            <p><?= htmlspecialchars($post['summary'] ?? 'No summary available.') ?></p>
        </div>

        <div class="like-dislike-section">
            <form method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($idString) ?>">
                <button type="submit" name="action" value="like">Like (<?= $likeCount ?>)</button>
                <button type="submit" name="action" value="dislike">Dislike (<?= $dislikeCount ?>)</button>
            </form>
        </div>

        <div class="comments-section">
            <h3>Comments</h3>
            <form method="post">
                <input type="hidden" name="id" value="<?= htmlspecialchars($idString) ?>">
                <textarea name="comment" placeholder="Add a comment..." required></textarea>
                <button type="submit">Submit</button>
            </form>

            <div class="comments-list">
                <table>
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Comment</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($comments as $comment): ?>
                            <tr>
                                <td><?= htmlspecialchars($comment['username']) ?></td>
                                <td><?= htmlspecialchars($comment['comment']) ?></td>
                                <td><?= $comment['created_at']->toDateTime()->format('F j, Y g:i A') ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
