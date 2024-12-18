<?php
session_start();
require 'db.php';
require 'vendor/autoload.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = getDB();
    $collection = $db->users;

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password

    $insertResult = $collection->insertOne([
        'username' => $username,
        'password' => $password,
    ]);

    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
    </form>
</body>
</html>
