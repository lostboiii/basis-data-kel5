<?php
require 'db.php';
require 'vendor/autoload.php';

$db = getDB();


$searchQuery1 = isset($_GET['search']) ? $_GET['search'] : '';
$searchQuery = isset($_GET['category']) ? $_GET['category'] : 'Semua';


$filter = [];


if (!empty($searchQuery1)) {
    $filter['title'] = new MongoDB\BSON\Regex($searchQuery1, 'i');
}


if ($searchQuery != 'Semua') {
    $filter['category'] = $searchQuery;
}


$news = $db->news->find($filter);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Portal</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fb;
            color: #333;
        }

        .header {
            background: #fffff;
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 600;
            margin: 0;
            color: #ffffff;
            cursor: pointer;
            transition: color 0.3s;
        }

        .header h1:hover {
            color: #004085;
        }

        .category-dropdown {
            padding: 12px 20px;
            font-size: 1rem;
            background-color: #ffffff;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s;
        }

        .category-dropdown:hover {
            background-color: #e6f1ff;
        }

        .header2 {
            text-align: center;
            background-color: #ffffff;
            margin-top: 90px;
            padding: 40px 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .header2 h2 {
            font-size: 3rem;
            color: #333;
            font-weight: 600;
            margin: 0;
            transition: color 0.3s ease;
        }

        .header2 p {
            font-size: 1.2rem;
            color: #555;
            margin-top: 10px;
        }

        .news-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 30px;
            padding: 60px 30px;
            margin-top: 40px;
        }

        .news-card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
            cursor: pointer;
        }

        .news-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .news-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .news-card img:hover {
            transform: scale(1.1);
        }

        .news-card .content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            height: 200px;
        }

        .news-card h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #007bff;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .news-card h3:hover {
            color: #004085;
        }

        .news-card p {
            font-size: 1rem;
            color: #555;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .news-card .actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 0.9rem;
            color: #777;
        }

        .news-card .actions button {
            padding: 8px 15px;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            border: none;
        }

        .news-card .actions .edit {
            background-color: #007bff;
            color: white;
        }

        .news-card .actions .edit:hover {
            background-color: #004085;
        }

        .news-card .actions .delete {
            background-color: #dc3545;
            color: white;
        }

        .news-card .actions .delete:hover {
            background-color: #c82333;
        }

        .link-articel {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .link-articel:hover {
            color: #004085;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .search-container {
            position: relative;
            display: inline-block;
            width: 100%;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 10px 40px 10px 15px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            margin-top: 15px;
        }

        .search-input:focus {
            outline: none;
            border-color: #007bff;
        }

        .search-icon {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);
            width: 40px;
            height: 40px;
            cursor: pointer;
            opacity: 0.8;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .search-icon:hover {
            opacity: 1;
            transform: translateY(-50%) scale(1.2);
        }

        .header-actions {
            display: flex;
            gap: 15px;
        }

        .search-button {
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <header class="header">
        <img src="fe/img/newsTing.png" alt="News Tingting" style="width:300px">
        <div class="header-actions">
            <form method="GET" action="">
                <select class="category-dropdown" name="category" onchange="this.form.submit()">
                    <option value="Semua" <?= $searchQuery == 'Semua' ? 'selected' : '' ?>>Semua</option>
                    <?php
                    $categories = ['Berita', 'Sosial', 'Edukasi', 'Kampus'];
                    foreach ($categories as $category) {
                        $selected = $searchQuery == $category ? 'selected' : '';
                        echo "<option value='$category' $selected>$category</option>";
                    }
                    ?>
                </select>

            </form>
            <form method="GET" action="">
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Cari berita..." name="search" value="<?= htmlspecialchars($searchQuery1) ?>">
                    <button type="submit" class="search-button">
                        <img src="fe/img/search.png" alt="Search" class="search-icon">
                    </button>
                </div>
            </form>
        </div>
    </header>

    <div class="header2">
        <img src="fe/img/newsTing.png" alt="News Tingting">
        <h2>Informasi Terkini, Cepat, dan Pasti Bikin Heboh!!!!</h2>
        <p>Berita terbaru yang selalu up-to-date dan penuh informasi terpercaya.</p>
    </div>


    <div class="news-grid">
        <?php foreach ($news as $news): ?>
            <div class="news-card">
                <img src="admin/<?= $news['image_path'] ?>" alt="<?= $news['title'] ?>">
                <div class="content">
                    <a href="read.php?id=<?= $news['_id'] ?>" class="link-articel"><?= $news['title'] ?></a>
                    <p><?= $news['summary'] ?></p>
                    <div class="actions">
                        <span><?= $news['author'] ?> | <?= $news['created_at']->toDateTime()->format('F j, Y g:i A') ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>