<?php
session_start();
require 'db.php';
require 'vendor/autoload.php';

$validUsername = 'admin';
$validPassword = 'admin';

$message = '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getDB();
    $collection = $db->users;

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    if (empty($_POST["username"])) {
        $usernameError = "Kolom ini harus diisi";
    }
    if (empty($_POST["password"])) {
        $passwordError = "Kolom ini harus diisi";
    }
    $user = $collection->findOne(['username' => $username]);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php");
        exit();
    } else {
        echo "Invalid username or password.";
    }
    if ($username === $validUsername && $password === $validPassword) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header('Location: admin/index.php');
        exit;
    } else {
        $message = 'username or password invalid';
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Ting Ting - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #FFFAFA;
            background-image: url('fe/img/temaAtas.png'), url('fe/img/temaBawah.png');
            background-position: top right, bottom left;
            background-repeat: no-repeat, no-repeat;
            background-size: 50%, 50%;
        }

        .card {
            background: #FFFFFF;
            border-radius: 15px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            font-weight: bold;
        }

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

        .footer {
            background-color: #E4B69A;
            color: #5A3E36;
            padding: 1rem 0;
            font-size: 0.9rem;
        }

        .table {
            background-color: #FFE5CC;
            border-radius: 8px;
        }

        .forgot-password-link {
            color: #295F98;
            text-decoration: underline;
            font-size: 0.9rem;
        }

        .forgot-password-link:hover {
            color: #5A3E36;
        }
    </style>

</head>

<body class="d-flex flex-column min-vh-100">
    <div class="container d-flex flex-column align-items-center justify-content-center flex-grow-1">
        <div class="col-sm-10 col-md-8 col-lg-5">
            <div class="card shadow-sm p-4 border-0">
                <h5 class="text-center mb-4" style="color: #5A3E36;">
                    <img src="fe/img/newsTing.png" alt="" width="200">
                </h5>
                <form id="loginForm" method="POST" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control <?php echo !empty($usernameError) ? 'is-invalid' : ''; ?>" id="username" name="username" placeholder="Masukkan username" value="" required>
                        <div class="invalid-feedback"><?php echo $usernameError; ?></div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Kata Sandi</label>
                        <input type="password" class="form-control <?php echo !empty($passwordError) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Masukkan kata sandi" required>
                        <div class="invalid-feedback"><?php echo $passwordError; ?></div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">LOGIN</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>