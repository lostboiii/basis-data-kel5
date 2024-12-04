<?php
class NewsDetailPage
{
    public function render()
    {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>News Detail</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f4f4f4;
                    margin: 0;
                    padding: 0;
                    color: #333;
                }

                .container {
                    max-width: 1200px;
                    margin: 10px auto;
                    padding: 20px;
                    background-color: #fff;
                    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
                }

                .header {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    margin-bottom: 10px;
                    padding-bottom: 3px;
                    border-bottom: 1px solid #ddd;
                }

                .header a {
                    text-decoration: none;
                    color: #333;
                    font-weight: bold;
                    font-size: 1rem;
                    display: flex;
                    align-items: center;
                }

                .header a:hover {
                    text-decoration: underline;
                }

                .header h1 {
                    font-size: 2rem; 
                    font-weight: bold;
                    margin-left: 10px;
                }

                .news-title {
                    text-align: center;
                    margin-bottom: 20px;
                }

                .news-title h2 {
                    font-size: 2.2rem; 
                    font-weight: bold;
                    color: #000;
                    margin-bottom: 10px;
                }

                .news-title h3 {
                    font-size: 1.3rem;
                    color: #555;
                }

                .news-image {
                    text-align: center;
                    margin: 20px 0;
                }

                .news-image img {
                    max-width: 50%;
                    height: auto;
                    border-radius: 8px;
                }

                .news-meta {
                    display: flex;
                    justify-content: space-between;
                    font-size: 0.9rem;
                    color: #555;
                    margin-bottom: 20px;
                }

                .news-meta .category {
                    font-weight: bold;
                }

                .news-meta .date {
                    font-style: italic;
                }

                .news-content {
                    line-height: 1.8; 
                    font-size: 1.1rem; 
                    color: #333;
                    margin-bottom: 20px;
                }

                .news-content h4 {
                    font-weight: bold;
                    margin-top: 20px;
                    font-size: 1.3rem;
                }

                .back-button {
                    display: flex;
                    align-items: center;
                }

                .back-button img {
                    width: 20px; 
                    margin-right: 8px;
                }

                .back-button:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <header class="header">
                    <a href="./../fe/home.php" class="back-button">
                        <img src="https://img.icons8.com/ios-glyphs/30/000000/back.png" alt="Back">
                        Back
                    </a>
                    <h1>
                        <img src ="./../fe/img/newsTing.png" alt="" width="200">
                    </h1>
                </header>

                <div class="news-title">
                    <h2>KPK Sebut 52 Pejabat Kabinet Merah Putih Belum Lapor LHKPN</h2>
                    <h3>Tingting</h3>
                </div>

                <div class="news-image">
                    <img src="./../fe/img/kpk.png" alt="KPK Sebut 52 Pejabat Kabinet">
                </div>

                <div class="news-meta">
                    <span class="category">Hukum</span>
                    <span class="date">Created at: 04/12/2024, 16:12 WIB</span>
                </div>

                <div class="news-content">
                    <p>JAKARTA, KOMPAS.com - Komisi Pemberantasan Korupsi (KPK) mengungkapkan bahwa sebanyak 52 dari 124 pejabat di Kabinet Merah Putih belum melaporkan Laporan Hasil Kekayaan Penyelenggaraan Negara (LHKPN).</p>
                    <p>Dengan demikian, sebanyak 72 pejabat Kabinet Merah Putih telah memenuhi kewajiban tersebut.</p>

                    <blockquote>
                        "Secara keseluruhan, dari total 124 wajib lapor di Kabinet Merah Putih, 72 sudah melaporkan LHKPN-nya, dan 52 belum. Artinya, 58 persen Kabinet Merah Putih sudah melaporkan LHKPN-nya," ujar Juru Bicara KPK Budi Prasetyo dalam keterangan tertulisnya, Rabu (4/12/2024).
                    </blockquote>

                    <p>Budi menjelaskan bahwa data tersebut mencakup wajib lapor yang telah melaporkan LHKPN secara periodik untuk 2024.</p>

                    <h4>Kesimpulan</h4>
                    <p>KPK menyebut 52 dari 124 pejabat Kabinet Merah Putih belum melaporkan LHKPN 2024, sementara 72 lainnya sudah (58%). Rinciannya, 36 dari 52 menteri dan kepala lembaga telah melapor, sedangkan 16 belum. Dari 57 wakil menteri, 30 telah melapor, dan 27 belum. KPK mengapresiasi kepatuhan dan mengimbau yang belum melapor untuk segera memenuhi kewajiban dalam tiga bulan setelah pelantikan.</p>
                </div>
            </div>
        </body>
        </html>
        <?php
    }
}

$newsDetailPage = new NewsDetailPage();
$newsDetailPage->render();
