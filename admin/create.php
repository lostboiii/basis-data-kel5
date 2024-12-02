<?php
require '../db.php';
require '../vendor/autoload.php';
if ($_SESSION['loggedin'] == false) {
    header('Location: ../index.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getDB();
    $collection = $db->news;
    $insertResult = $collection->insertOne([
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'summary' => $_POST['summary'],
        'author' => $_POST['author'],
        'category' => $_POST['category'],
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Buat Postingan Baru</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Buat Postingan Baru</h1>
    <form method="post">
        <input type="text" name="title" placeholder="Judul" required>
        <textarea name="content" placeholder="Konten" required></textarea>
        <input type="text" name="summary" placeholder="Ringkasan" required>
        <input type="text" name="author" placeholder="Penulis" required>
        <select name="category" required>
            <option value="">Pilih Kategori</option>
            <?php
            $categories = ['Berita', 'Sosial', 'Edukasi', 'Kampus'];
            foreach ($categories as $category) {
                echo "<option value='$category'>$category</option>";
            }
           ?>
        </select>
        <br><br>
        <input type="reset" value="Reset"> 
        <button type="submit">Buat</button>
    </form>
    <a href="index.php">Kembali ke Daftar Postingan</a>
</body>
</html>