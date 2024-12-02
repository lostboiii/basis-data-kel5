<?php
require '../db.php';    
require '../vendor/autoload.php';
$db = getDB();
$collection = $db->news;

if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id'])){
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $post = $collection->findOne(['_id' => $id]);
}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= htmlspecialchars($post['title']) ?></title>
</head>
<body>
    <h1><?= htmlspecialchars($post['title']) ?></h1>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <p>Author: <?= htmlspecialchars($post['author']) ?></p>
    <p>Category: <?= htmlspecialchars($post['category']) ?></p>
    <p>Created at: <?= $post['created_at']->toDateTime()->format('F j, Y g:i A') ?></p>
    <a href="index.php">Back to News</a>
</body>
</html>