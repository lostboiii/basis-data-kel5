<?php
session_start();
require '../db.php';
require '../vendor/autoload.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] == false) {
    header('Location: ../index.php');
    exit();
}

$db = getDB();
$collection = $db->news;

if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id'])) {
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $post = $collection->findOne(['_id' => $id]);
    if (!$post) {
        echo "Postingan tidak ditemukan.";
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['id'])) {
    $id = new MongoDB\BSON\ObjectId($_POST['id']);
    $uploadDir = __DIR__ . '/uploads/';
    $imagePath = $post['image_path']; 

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

        $uploadFile = $uploadDir . basename($_FILES['image']['name']);
        $imageType = mime_content_type($_FILES['image']['tmp_name']);

        if (in_array($imageType, ['image/jpeg', 'image/png', 'image/gif'])) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
                $imagePath = 'uploads/' . basename($_FILES['image']['name']);
            } else {
                echo "Upload gagal.";
                exit();
            }
        } else {
            echo "File harus berupa gambar (JPEG, PNG, GIF).";
            exit();
        }
    }
    $collection->updateOne(['_id' => $id], [
        '$set' => [
            'title' => $_POST['title'],
            'content' => $_POST['content'],
            'summary' => $_POST['summary'],
            'author' => $_POST['author'],
            'category' => $_POST['category'],
            'image_path' => $imagePath,
            'updated_at' => new MongoDB\BSON\UTCDateTime()
        ]
    ]);

    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Postingan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Edit Postingan</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars((string)$post['_id']); ?>">
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title'] ?? ''); ?>" required>
        <textarea name="content" required><?php echo htmlspecialchars($post['content'] ?? ''); ?></textarea>
        <input type="text" name="summary" value="<?php echo htmlspecialchars($post['summary'] ?? ''); ?>" required>
        <input type="text" name="author" value="<?php echo htmlspecialchars($post['author'] ?? ''); ?>" required>
        <select name="category" required>
            <option value="">Pilih Kategori</option>
            <?php
            $categories = ['Berita', 'Sosial', 'Edukasi', 'Kampus'];
            foreach ($categories as $category) {
                $selected = ($category === ($post['category'] ?? '')) ? 'selected' : '';
                echo "<option value='$category' $selected>$category</option>";
            }
            ?>
        </select>
        <input type="file" name="image" accept="image/*">
        <button type="submit">Perbarui</button>
    </form>
    <a href="index.php">Kembali ke Daftar Postingan</a>
</body>
</html>
