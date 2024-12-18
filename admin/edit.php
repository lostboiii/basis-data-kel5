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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Detail</title>
    <style>
        body {
            background-image: url('./../fe/img/temaAtas.png'), url('./../fe/img/temaBawah.png');
            background-position: top right, bottom left;
            background-repeat: no-repeat, no-repeat;
            background-size: 40%, 40%;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .tambah-berita-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 2rem;
            background-color: #f5f5f5;
            border-radius: 5px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
            position: relative;
            z-index: 10;
        }

        .tambah-berita-container h1 {
            text-align: center;
            margin-bottom: 2rem;
        }

        .tambah-berita-form .form-group {
            margin-bottom: 1.5rem;
        }

        .tambah-berita-form .form-control {
            display: block;
            width: 100%;
            padding: 0.8rem 1.5rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .tambah-berita-form .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        .tambah-berita-form .form-group input,
        .tambah-berita-form .form-group textarea {
            margin-right: 10px;
        }

        .tambah-berita-form .btn-primary {
            color: #fff;
            background-color: #295F98;
            border-color: #007bff;
            display: block;
            width: 100%;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            border-radius: 0.10rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            cursor: pointer;
            margin-top: 1rem;
        }

        .tambah-berita-form .btn-primary:hover {
            color: #fff;
            background-color: #0069d9;
            border-color: #0062cc;
        }

        @media (max-width: 768px) {
            .tambah-berita-container {
                margin: 20px;
                padding: 1.5rem;
            }

            .tambah-berita-form .form-control {
                padding-right: 1rem;
            }

            .tambah-berita-form .form-group input,
            .tambah-berita-form .form-group textarea {
                margin-right: 0;
            }
        }
    </style>
</head>

<body>
    <div class="tambah-berita-container">
        <h1>Edit Berita</h1>
        <form class="tambah-berita-form" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars((string)$post['_id']); ?>">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" name="title" placeholder="Masukkan judul berita" value="<?= htmlspecialchars($post['title']) ?>">
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control" name="image" accept="image/*">
            </div>
            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea class="form-control" name="content" rows="3" placeholder="Masukkan konten berita"><?= nl2br(htmlspecialchars($post['content'])) ?></textarea>
            </div>
            <div class="form-group">
                <label for="ringkasan">Ringkasan</label>
                <input type="text" class="form-control" name="summary" placeholder="Masukkan ringkasan berita" value="<?= htmlspecialchars($post['summary']) ?>">
            </div>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" class="form-control" name="author" placeholder="Masukkan nama penulis" value="<?= htmlspecialchars($post['author']) ?>">
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select class="form-control" name="category">
                    <option value="">Pilih Kategori</option>
                    <?php
                    $categories = ['Berita', 'Sosial', 'Edukasi', 'Kampus', 'Semua'];
                    foreach ($categories as $category) {
                        echo "<option value='$category'>$category</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn-primary">Edit Berita</button>
        </form>
    </div>
</body>

</html>