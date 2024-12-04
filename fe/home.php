<?php
class home
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
            "title" => "KPK Sebut 52 Pejabat Kabinet Merah Putih Belum Laporkan LHKPN",
            "description" => "KPK ungkap 52 pejabat Kabinet Merah Putih belum laporkan LHKPN. Apresiasi bagi yang.",
            "date" => "04/12/2024, 16:12 WIB"
        ],
        [
            "image" => "./../fe/img/kpk.png",
            "title" => "KPK Sebut 52 Pejabat Kabinet Merah Putih Belum Laporkan LHKPN",
            "description" => "KPK ungkap 52 pejabat Kabinet Merah Putih belum laporkan LHKPN. Apresiasi bagi yang.",
            "date" => "04/12/2024, 16:12 WIB"
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
            <title>News</title>
            <style>
                .body {
                    background-color: #f2f2f2;
                    width: 100%;
                    height: 100%;
                }
                
                .header {
                    background-color: #fff;
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    width: 100%;
                    height: 50px;
                    margin: 0;
                    padding: 0 20px;
                    position: fixed;
                    top: 0;
                    left: 0;
                    right: 0;
                    z-index: 1000;
                }

                .header select {
                    margin-right: 20px; 
                    padding: 8px 12px; 
                    border-radius: 5px;
                    border: 1px solid #ccc;
                    outline: none;
                }
                
                .header h1 {
                    font-size: 2rem;
                    font-weight: bold;
                    margin-left: 20px;
                    margin-top:30px;
                }

                .header2 {
                    background-color: #fdfdfd;
                    padding: 40px 40px; 
                    text-align: center;
                    margin-bottom: 15px;
                    margin-top: 80px; 
                    margin-left: 40px; 
                    margin-right: 40px;
                }


                .header2 p {
                    font-size: 24px;
                    margin-bottom: 20px;
                }
                
                .news-grid {
                    display: grid;
                    grid-template-columns: repeat(3, 1fr);
                    gap: 1.5rem;
                    justify-content: center;
                    margin: 0 auto;
                    padding: 20px;
                    max-width: 1200px; 
                }
                
                .news-card {
                    background-color: #fff;
                    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
                    border-radius: 0.5rem;
                    overflow: hidden;
                }
                
                .news-card img {
                    width: 100%;
                    height: 12rem;
                    object-fit: cover;
                }
                
                .news-card .content {
                    padding: 1rem;
                }
                
                .news-card h2 {
                    font-size: 1.25rem;
                    font-weight: bold;
                    margin-bottom: 0.5rem;
                }
                
                .news-card p {
                    color: #6b7280;
                    margin-bottom: 1rem;
                }
                
                .news-card .actions {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    color: #6b7280;
                }
                
                .news-card .actions button {
                    padding: 0.5rem 1rem;
                    border-radius: 0.25rem;
                    font-size: 0.875rem;
                    transition: background-color 0.3s ease;
                }
                
                .news-card .actions .edit {
                    background-color: #10b981;
                    color: #fff;
                }
                
                .news-card .actions .edit:hover {
                    background-color: #059669;
                }
                
                .news-card .actions .delete {
                    background-color: #ef4444;
                    color: #fff;
                }
                
                .news-card .actions .delete:hover {
                    background-color: #dc2626;
                }
            </style>
        </head>
        <body class="body">
            <div class="container">
                <header class="header">
                    <h1>
                        <img src = "./../fe/img/newsTing.png" alt="" width="200">
                    </h1>
                    <select class="px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option>Kategori</option>
                        <option>Kategori 1</option>
                        <option>Kategori 2</option>
                        <option>Kategori 3</option>
                    </select>
                </header>

                <nav class="header2">
                    <h2>
                        <img src = "./../fe/img/newsTing.png" alt="" width="400">
                        <p>informasi terkini, Cepat, dan Pasti terpecaya.<p>
                    </h2>

            </nav>
                <div class="news-grid">
                    <?php foreach ($this->news_data as $news): ?>
                    <div class="news-card">
                        <img src="<?= $news['image'] ?>" alt="<?= $news['title'] ?>">
                        <div class="content">
                            <h2><?= $news['title'] ?></h2>
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
            </div>
        </body>
        </html>
        <?php
    }
}

// Penggunaan
$newsPage = new home();
$newsPage->render();