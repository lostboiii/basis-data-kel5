<?php
class Home
{
    private $news_data = [
        [
            "image" => "./../fe/img/kpk.png",
            "title" => "KPK Sebut 52 Pejabat Kabinet Merah Putih Belum Laporkan LHKPN",
            "description" => "KPK ungkap 52 pejabat Kabinet Merah Putih belum laporkan LHKPN. Apresiasi bagi yang.",
            "date" => "04/12/2024, 16:12 WIB"
        ],
        [
            "image" => "./../fe/img/kpk.png",
            "title" => "Pemerintah Memperkenalkan Kebijakan Baru di Sektor Kesehatan",
            "description" => "Pemerintah baru saja meluncurkan kebijakan baru yang diharapkan akan meningkatkan kualitas layanan kesehatan di Indonesia.",
            "date" => "03/12/2024, 14:30 WIB"
        ],
        [
            "image" => "./../fe/img/kpk.png",
            "title" => "Satu Juta Vaksin COVID-19 Tiba di Indonesia",
            "description" => "Vaksin COVID-19 terbaru tiba di Indonesia. Ini menjadi langkah besar dalam memerangi pandemi global.",
            "date" => "02/12/2024, 09:45 WIB"
        ],
        [
            "image" => "./../fe/img/kpk.png",
            "title" => "Pemilu 2024: Inilah Kandidat Calon Presiden dari Berbagai Partai",
            "description" => "Pemilu 2024 semakin dekat, dan berbagai partai sudah mengajukan kandidat mereka untuk calon presiden.",
            "date" => "01/12/2024, 11:00 WIB"
        ],
        [
            "image" => "./../fe/img/kpk.png",
            "title" => "Perkembangan Teknologi di Dunia Pendidikan: Mengapa Digitalisasi Penting?",
            "description" => "Transformasi digital di dunia pendidikan membawa banyak perubahan signifikan. Bagaimana dampaknya terhadap pembelajaran?",
            "date" => "30/11/2024, 18:00 WIB"
        ],
        [
            "image" => "./../fe/img/kpk.png",
            "title" => "Industri Teknologi di Indonesia: Apa yang Harus Diketahui Para Investor?",
            "description" => "Industri teknologi Indonesia sedang berkembang pesat. Investor yang cerdas dapat meraih banyak keuntungan.",
            "date" => "29/11/2024, 10:15 WIB"
        ]
    ];

    public function render()
    {
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

                /* Header Section */
                .header {
                    background: #295F98;
                    /* Blue */
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
                    /* Darker blue */
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

                /* Hero Section (Header2) */
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

                /* News Grid Section */
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
                    /* Blue */
                    font-weight: 600;
                    transition: color 0.3s ease;
                }

                .news-card h3:hover {
                    color: #004085;
                    /* Darker blue */
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
                    /* Blue */
                    color: white;
                }

                .news-card .actions .edit:hover {
                    background-color: #004085;
                    /* Darker blue */
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
            </style>
        </head>

        <body>
            <!-- Header -->
            <<!-- Header -->
                <header class="header">
                    <h1>News Portal</h1>
                    <div class="header-actions">
                        <select class="category-dropdown">
                            <option value="kategori">Kategori</option>
                            <option value="kategori1">Kategori 1</option>
                            <option value="kategori2">Kategori 2</option>
                            <option value="kategori3">Kategori 3</option>
                        </select>
                        <div class="search-container">
                            <input type="text" class="search-input" placeholder="Cari berita...">
                            <img src="./../fe/img/search.png" alt="Search" class="search-icon">
                        </div>
                    </div>
                </header>


                <!-- Hero Section -->
                <div class="header2">
                    <img src="./../fe/img/newsTing.png" alt="News Tingting">
                    <h2>Informasi Terkini, Cepat, dan Terpercaya</h2>
                    <p>Berita terbaru yang selalu up-to-date dan penuh informasi terpercaya.</p>
                </div>

                <!-- News Grid Section -->
                <div class="news-grid">
                    <?php foreach ($this->news_data as $news): ?>
                        <div class="news-card">
                            <img src="<?= $news['image'] ?>" alt="<?= $news['title'] ?>">
                            <div class="content">
                                <a href="baca.php" class="link-articel"><?= $news['title'] ?></a>
                                <p><?= $news['description'] ?></p>
                                <div class="actions">
                                    <span><?= $news['date'] ?></span>
                                    <div>
                                        <button class="edit">Edit</button>
                                        <button class="delete">Hapus</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
        </body>

        </html>
<?php
    }
}

$newsPage = new Home();
$newsPage->render();
?>