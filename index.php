<?php
require 'db.php';
require 'vendor/autoload.php';

$db = getDB();
$news = $db->news->find();
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';
$news = $db->news->find([
    'title' => new MongoDB\BSON\Regex($searchQuery, 'i')
]);
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Postingan Blog</title>
</head>
<body>

    <h1>Daftar Postingan Blog</h1>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by title" value="<?= htmlspecialchars($searchQuery) ?>">
        <button type="submit">Search</button>
    </form>

    <hr>
    <?php foreach($news as $news): ?>
        <div class="news">
            <h2><a href="read.php?id=<?=$news['_id']?>"><?= htmlspecialchars($news['title']) ?></a></h2>
            <p>
                <?= nl2br(htmlspecialchars($news['summary'])) ?>
            </p>
            <p>Created at: <?= $news['created_at']->toDateTime()->format('F j, Y g:i A') ?></p>
        </div>
        <hr>
    <?php endforeach; ?>
    <a href="login.php">lomgin banh
        
    </a>
</body>
</html>