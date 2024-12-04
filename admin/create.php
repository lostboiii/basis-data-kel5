<?php
session_start(); 
require '../db.php';
require '../vendor/autoload.php';
if ($_SESSION['loggedin'] == false) {
    header('Location: ../index.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getDB();
    $collection = $db->news;

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        $imageType = mime_content_type($_FILES['image']['tmp_name']);

        if (in_array($imageType, ['image/jpeg', 'image/png', 'image/gif'])) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
     
                $insertResult = $collection->insertOne([
                    'title' => $_POST['title'],
                    'content' => $_POST['content'],
                    'summary' => $_POST['summary'],
                    'author' => $_POST['author'],
                    'category' => $_POST['category'],
                    'image_path' => $uploadFile,
                    'created_at' => new MongoDB\BSON\UTCDateTime(),
                ]);
                header("Location: index.php");
                exit();
            } else {
                echo "Upload Gagal.";
            }
        } else {
            echo "File harus berupa gambar.";
        }
    } 
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
    <form method="post" enctype="multipart/form-data">
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
        <input type="file" name="image" accept="image/*" required>
        <input type="reset" value="Reset"> 
        <button type="submit">Buat</button>
    </form>
    <a href="index.php">Kembali ke Daftar Postingan</a>
</body>
</html>