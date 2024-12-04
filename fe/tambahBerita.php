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
                    background-image: url('./../fe/img/temaAtas.png'), url('./../fe/img/temaBawah.png');
        background-position: top right, bottom left;
        background-repeat: no-repeat, no-repeat;
        background-size: 50%, 50%;
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
                    padding: 0.5rem 0.75rem;
                    font-size: 1rem;
                    line-height: 1.5;
                    color: #495057;
                    background-color: #fff;
                    background-clip: padding-box;
                    border: 1px solid #ced4da;
                    border-radius: 0.25rem;
                    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }

                .tambah-berita-form .btn-primary {
                    color: #fff;
                    background-color: #007bff;
                    border-color: #007bff;
                    display: block;
                    width: 100%;
                    padding: 0.5rem 1rem;
                    font-size: 1rem;
                    border-radius: 0.25rem;
                    transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
                }

                .tambah-berita-form .btn-primary:hover {
                    color: #fff;
                    background-color: #0069d9;
                    border-color: #0062cc;
                }
            </style>
        </head>
        <body>
        <div class="tambah-berita-container">
        <h1>Tambah Berita</h1>
        <form class="tambah-berita-form">
            <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" placeholder="Masukkan judul berita">
            </div>
            <div class="form-group">
            <label for="foto">Foto</label>
            <input type="text" class="form-control" id="foto" placeholder="Unggah foto berita">
            </div>
            <div class="form-group">
            <label for="konten">Konten</label>
            <textarea class="form-control" id="konten" rows="3" placeholder="Masukkan konten berita"></textarea>
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
    <button type="submit" class="btn btn-primary">Tambah Berita</button>
  </form>
</div>
        </body>
        </html>
        <?php
    }
}


$newsDetailPage = new NewsDetailPage();
$newsDetailPage->render();
