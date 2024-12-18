<?php
session_start();
require 'db.php';
require 'vendor/autoload.php';
$db = getDB();
$collection = $db->news;
$commentsCollection = $db->comments;
$likesCollection = $db->likes;

$id = null;

if ($_SERVER['REQUEST_METHOD'] === "GET") {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $idString = $_GET['id'];
        if (preg_match('/^[a-f0-9]{24}$/', $idString)) {
            $id = new MongoDB\BSON\ObjectId($idString);
            $post = $collection->findOne(['_id' => $id]);

            if (!$post) {
                echo "Post not found.";
                exit();
            }

            $collection->updateOne(
                ['_id' => $id],
                ['$inc' => ['views' => 1]]
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['comment'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        $comment = $_POST['comment'];
        $username = $_SESSION['username'];
        $idString = $_POST['id'];

        $commentsCollection->insertOne([
            'news_id' => new MongoDB\BSON\ObjectId($idString),
            'username' => $username,
            'comment' => $comment,
            'created_at' => new MongoDB\BSON\UTCDateTime(),
        ]);

        header("Location: read.php?id=" . $idString);
        exit();
    } else {
        echo "You must be logged in to comment.";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
        $action = $_POST['action'];
        $username = $_SESSION['username'];
        $idString = $_POST['id'];

        $existingLike = $likesCollection->findOne(['news_id' => new MongoDB\BSON\ObjectId($idString), 'username' => $username]);

        if ($existingLike) {
            $likesCollection->updateOne(
                ['_id' => $existingLike['_id']],
                ['$set' => ['type' => $action]]
            );
        } else {
            $likesCollection->insertOne([
                'news_id' => new MongoDB\BSON\ObjectId($idString),
                'username' => $username,
                'type' => $action,
            ]);
        }

        header("Location: read.php?id=" . $idString);
        exit();
    } else {
        echo "You must be logged in to like/dislike.";
    }
}

$likeCount = $likesCollection->countDocuments(['news_id' => $id, 'type' => 'like']);
$dislikeCount = $likesCollection->countDocuments(['news_id' => $id, 'type' => 'dislike']);
$comments = $commentsCollection->find(['news_id' => $id])->toArray();
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

        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            background-color: #f4f7f6;
            color: #333;
        }

        .like-dislike-section {
            margin: 20px 0;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .like-dislike-section button {
            margin-right: 10px;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            background-color: #357abd;
            color: white;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(31, 58, 147, 0.2);
        }

        .like-dislike-section button:hover {
            background-color: #2c50c1;
            transform: translateY(-2px);
            box-shadow: 0 6px 8px rgba(31, 58, 147, 0.3);
        }

        .comments-section {
            max-width: 800px;
            margin: 30px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .comments-list {
            margin-top: 20px;
            border-top: 2px solid #1f3a93;
            padding-top: 15px;
        }

        .comment {
            border-bottom: 1px solid #e0e0e0;
            padding: 15px 0;
            transition: background-color 0.3s ease;
        }

        .comment:hover {
            background-color: #f9f9f9;
        }

        .comment strong {
            display: block;
            color: #1f3a93;
            font-size: 1.1em;
            margin-bottom: 5px;
        }

        .comment small {
            color: #666;
            font-style: italic;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            transition: background-color 0.3s ease;
        }

        th {
            background-color: #357abd;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e6e6e6;
        }

        .comments-section {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .comments-section h3 {
            color: #333;
            font-size: 1.5rem;
            margin-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 10px;
            text-align: center;
        }

        .comments-section form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .comments-section textarea {
            width: calc(100% - 20px);
            min-height: 80px;
            max-height: 150px;
            padding: 12px;
            margin-right: 20px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            resize: vertical;
            transition: border-color 0.3s ease;
        }

        .comments-section textarea:focus {
            outline: none;
            border-color: #4a90e2;
            box-shadow: 0 0 5px rgba(74, 144, 226, 0.3);
        }

        .comments-section textarea::placeholder {
            color: #999;
        }

        .comments-section button {
            align-self: flex-end;
            padding: 10px 20px;
            background-color: #1f3a93;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

        .comments-section button:hover {
            background-color: #357abd;
            transform: translateY(-2px);
        }

        .comments-section button:active {
            transform: translateY(1px);
        }


        @media screen and (max-width: 600px) {
            .comments-section {
                margin: 15px;
                padding: 15px;
            }

            .like-dislike-section {
                flex-direction: column;
                align-items: center;
            }

            .like-dislike-section button {
                width: 100%;
                margin-bottom: 10px;
            }

            table,
            thead,
            tbody,
            th,
            td,
            tr {
                display: block;
            }

            thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                border: none;
                position: relative;
                padding-left: 50%;
            }

            td:before {
                position: absolute;
                top: 6px;
                left: 6px;
                width: 45%;
                padding-right: 10px;
                white-space: nowrap;
                content: attr(data-column);
                color: #1f3a93;
                font-weight: bold;
            }
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
                                <td><?= $comment['created_at']->toDateTime()->setTimezone(new DateTimeZone('Asia/Jakarta'))->format('F j, Y H:i') ?> WIB</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>