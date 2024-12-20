<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Detail</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #eef2f5;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 960px;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }

        .header a {
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            font-size: 1rem;
            font-weight: 500;
            padding: 10px 20px;
            background: #295F98;
            color: #fff;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .header a img {
            width: 20px;
            margin-right: 10px;
        }

        .header h1 img {
            max-width: 100%;
            width: 200px;
            height: auto;
        }

        @media (max-width: 768px) {
            .header h1 img {
                width: 150px;
            }
        }

        .news-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .news-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: #333;
        }

        .news-title h3 {
            font-size: 1.2rem;
            color: #555;
            margin-top: 5px;
        }

        .news-image {
            text-align: center;
            margin: 30px 0;
        }

        .news-image img {
            max-width: 90%;
            height: auto;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .news-meta {
            display: flex;
            justify-content: space-between;
            font-size: 1rem;
            color: #666;
            margin-bottom: 20px;
        }

        .news-meta .category {
            font-weight: bold;
            color: #1f3a93;
            background: #dbeafe;
            padding: 5px 10px;
            border-radius: 5px;
            text-transform: uppercase;
        }

        .news-meta .date {
            font-style: italic;
        }

        .news-content {
            line-height: 1.8;
            font-size: 1.2rem;
            color: #333;
        }

        .news-content h4 {
            font-weight: 700;
            margin-top: 30px;
            font-size: 1.5rem;
            color: #444;
        }

        blockquote {
            margin: 20px 0;
            padding: 20px;
            background-color: #f9f9f9;
            border-left: 5px solid #007bff;
            font-style: italic;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="header">
            <a href="./../fe/home.php">
                <img src="https://img.icons8.com/ios-glyphs/30/ffffff/back.png" alt="Back">
                Back
            </a>
            <h1>
                <img src="./../fe/img/newsTing.png" alt="News Tingting">
            </h1>
        </header>

        <div class="news-title">
            <h2>KPK Sebut 52 Pejabat Kabinet Merah Putih Belum Lapor LHKPN</h2>
            <h3>by Tingting</h3>
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