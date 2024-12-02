<?php
require '../db.php';    
require '../vendor/autoload.php';
if ($_SESSION['loggedin'] == false) {
    header('Location: ../index.php');
    exit();
}
$db = getDB();
$collection = $db->news;

if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['id'])){
    $id = new MongoDB\BSON\ObjectId($_GET['id']);
    $post = $collection->findOne(['_id' => $id]);
}
if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['id'])){
    $id = new MongoDB\BSON\ObjectId($_POST['id']);
    $collection->updateOne(['_id' => $id],
    ['$set' => [
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'summary' => $_POST['summary'],
        'author' => $_POST['author'],
        'category' => $_POST['category'],
        'updated_at' => new MongoDB\BSON\UTCDateTime()
    ]]);
    header('location: index.php');
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
    <form method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($post['_id']); ?>">
        <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" >
        <textarea name="content" required><?php echo htmlspecialchars($post['content']); ?></textarea>
        <input type="text" name="summary" value="<?php echo htmlspecialchars($post['summary']);?>">
        <input type="text" name="author" value="<?php echo htmlspecialchars($post['author']);?>" >
        <select name="category" required>
            <option value="">Pilih Kategori</option>
            <?php
            $categories = ['Berita', 'Sosial', 'Edukasi', 'Kampus'];
            foreach ($categories as $category) {
                $selected = ($category === htmlspecialchars($post['category'])) ? 'selected' : '';
                echo "<option value='$category' $selected>$category</option>";
            }
            ?>
        </select>
        <button type="submit">Perbarui</button>
    </form>
    <a href="index.php">Kembali ke Daftar Postingan</a>
</body>
</html>