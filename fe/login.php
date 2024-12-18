<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login<title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    /* Background halaman */
    body {
        background-color: #FFFAFA;
        background-image: url('./../fe/img/temaAtas.png'), url('./../fe/img/temaBawah.png');
        background-position: top right, bottom left;
        background-repeat: no-repeat, no-repeat;
        background-size: 50%, 50%;
    }

    /* Kartu form login */
    .card {
        background: #FFFFFF;
        border-radius: 15px;
        box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
        font-weight: bold;
    }
    
    /* Tombol login */
    .btn-primary {
        background-color: #295F98; 
        border: none;
        color: #FFFFFF;
        font-weight: bold;
        border-radius: 20px;
    }
    .btn-primary:hover {
        background-color: #4169E1;
    }

    /* Footer */
    .footer {
        background-color: #E4B69A; 
        color: #5A3E36; 
        padding: 1rem 0;
        font-size: 0.9rem;
    }

    /* Tabel */
    .table {
        background-color: #FFE5CC; 
        border-radius: 8px;
    }
    
</style>

</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Bagian Form Login -->
    <div class="container d-flex flex-column align-items-center justify-content-center flex-grow-1">
        <div class="col-sm-10 col-md-8 col-lg-5">
            <div class="card shadow-sm p-4 border-0">
                <h5 class="text-center mb-4" style="color: #5A3E36;">
                    <img src = "./../fe/img/newsTing.png" alt="" width="200">
                </h5>
                
                <?php
                    session_start();
                    $usernameError = $passwordError = "";
                    $username = $password = "";

                    $adminUsername = 'admin';
                    $adminPassword = 'admin123';

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        if (empty($_POST["username"])) {
                            $usernameError = "Kolom ini harus diisi";
                        } else {
                            $username = $_POST["username"];
                        }

                        if (empty($_POST["password"])) {
                            $passwordError = "Kolom ini harus diisi";
                        } else {
                            $password = $_POST["password"];
                            if (strlen($password) < 5) {
                                $passwordError = "Kata sandi harus minimal 5 karakter";
                            } elseif (!preg_match('/\d/', $password)) {
                                $passwordError = "Kata sandi harus mengandung huruf dan angka";
                            }
                        }

                        if (empty($usernameError) && empty($passwordError)) {
                            if ($username === $adminUsername && $password === $adminPassword) {
                                $_SESSION['loggedin'] = true;
                                header("Location: Home.php");
                                exit();
                            } else {
                                echo "<div class='alert alert-danger'>Username atau kata sandi salah.</div>";
                            }
                        }
                    }
                ?>

                <form id="loginForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?php echo !empty($usernameError) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Masukkan username" value="<?php echo htmlspecialchars($username); ?>" required>
                        <div class="invalid-feedback"><?php echo $usernameError; ?></div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control <?php echo !empty($passwordError) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Masukkan kata sandi" required>
                        <div class="invalid-feedback"><?php echo $passwordError; ?></div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary w-100">LOGIN</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>