<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Berita</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            background-image: url('./../fe/img/temaAtas.png'), url('./../fe/img/temaBawah.png');
            background-position: top right, bottom left;
            background-repeat: no-repeat, no-repeat;
            background-size: 40%, 40%;
        }

        @media (max-width: 768px) {
            body {
                background-size: 80%, 80%;
                background-position: top center, bottom under;
            }
        }

        .tambah-berita-container {
            max-width: 700px;
            margin: 50px auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .tambah-berita-container h1 {
            text-align: center;
            margin-bottom: 1.5rem;
            font-size: 2rem;
            color: #333;
        }

        .tambah-berita-form .form-group {
            margin-bottom: 1.2rem;
        }

        .tambah-berita-form label {
            font-weight: 500;
            display: block;
            margin-bottom: 0.5rem;
            color: #555;
        }

        .tambah-berita-form .form-control {
            display: block;
            width: 100%;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            background-color: #f9f9f9;
            transition: all 0.3s ease;
        }

        .tambah-berita-form .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.2);
        }

        .tambah-berita-form textarea.form-control {
            resize: none;
        }

        .tambah-berita-form .btn-primary {
            display: inline-block;
            width: 100%;
            padding: 0.8rem 1rem;
            font-size: 1rem;
            font-weight: 500;
            color: #fff;
            background: #295F98;
            border: none;
            border-radius: 6px;
            text-align: center;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .tambah-berita-form .btn-primary:hover {
            background: #007bff;
        }

        .tambah-berita-form .btn-primary:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="tambah-berita-container">
        <h1>Tambah Berita</h1>
        <form class="tambah-berita-form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="judul">Judul</label>
                <input type="text" class="form-control" id="judul" placeholder="Masukkan judul berita">
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control" id="foto" accept="image/*">
            </div>
            <div class="form-group">
                <label for="konten">Konten</label>
                <textarea class="form-control" id="konten" rows="4" placeholder="Masukkan konten berita"></textarea>
            </div>
            <div class="form-group">
                <label for="ringkasan">Ringkasan</label>
                <input type="text" class="form-control" id="ringkasan" placeholder="Masukkan ringkasan berita">
            </div>
            <div class="form-group">
                <label for="penulis">Penulis</label>
                <input type="text" class="form-control" id="penulis" placeholder="Masukkan nama penulis">
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select class="form-control" id="kategori">
                    <option>Pilih kategori berita</option>
                    <option>Olahraga</option>
                    <option>Teknologi</option>
                    <option>Gaya Hidup</option>
                    <option>Lainnya</option>
                </select>
            </div>
            <button type="submit" class="btn-primary">Tambah Berita</button>
        </form>
    </div>
</body>
</html>
