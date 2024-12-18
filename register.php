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

<style>
    /* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    line-height: 1.6;
}

/* Registration Container */
form {
    background-color: white;
    width: 100%;
    max-width: 400px;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    text-align: center;
}

h1 {
    color: #333;
    margin-bottom: 30px;
    margin-right : 30px;
    font-size: 2rem;
    position: relative;
}

h1::after {
    content: '';
    position: absolute;
    width: 70px;
    height: 4px;
    background-color: #4a90e2;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
}

/* Input Styles */
input {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 2px solid #e0e0e0;
    border-radius: 6px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

input:focus {
    outline: none;
    border-color: #4a90e2;
    box-shadow: 0 0 8px rgba(74, 144, 226, 0.2);
}

input::placeholder {
    color: #999;
}

/* Button Styles */
button {
    width: 100%;
    padding: 12px;
    background-color: #4a90e2;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
}

button:hover {
    background-color: #357abd;
    transform: translateY(-2px);
}

button:active {
    transform: translateY(1px);
}

/* Responsive Adjustments */
@media screen and (max-width: 480px) {
    form {
        width: 90%;
        padding: 30px 20px;
    }

    h1 {
        font-size: 1.7rem;
    }
}

/* Accessibility Focus Styles */
input:focus,
button:focus {
    outline: 2px solid #4a90e2;
    outline-offset: 2px;
}
</style>
</html>
