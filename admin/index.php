<?php
session_start();
if ($_SESSION['loggedin'] == false) {
    header('Location: ../index.php');
    exit();
}
require '../db.php';
require '../vendor/autoload.php';

$db = getDB();
$searchQuery = isset($_GET['category']) ? $_GET['category'] : 'Semua';
if ($searchQuery != 'Semua') {
$news = $db->news->find([
    'category' => $searchQuery ? $searchQuery : ''
]);
}
else{
    $news = $db->news->find();
}

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
        <select name="category" required>
            <option value="">Pilih Kategori</option>
            <?php
            $categories = ['Berita', 'Sosial', 'Edukasi', 'Kampus','Semua'];
            foreach ($categories as $category) {
                echo "<option value='$category'>$category</option>";
            }
           ?>
        </select>
        <button type="submit">Search</button>
    </form>
    <a href="create.php">Buat Postingan Baru</a>
    <hr>
    <?php foreach($news as $news): ?>
        <div class="news">
            <h2><a href="read.php?id=<?=$news['_id']?>"><?= htmlspecialchars($news['title']) ?></a></h2>
            <p>
                <?= nl2br(htmlspecialchars($news['summary'])) ?>
            </p>
            <p>Created at: <?= $news['created_at']->toDateTime()->format('F j, Y g:i A') ?></p>
        </div>
        <a href="edit.php?id=<?= $news['_id'] ?>">Edit</a>
        <a href="delete.php?id=<?= $news['_id'] ?>">Delete</a>
        <hr>
    <?php endforeach; ?>
    <a href="logout.php">logout</a>
</body>
</html>