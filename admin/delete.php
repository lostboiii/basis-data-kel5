<?php
session_start(); 
require '../db.php';
if ($_SESSION['loggedin'] == false) {
    header('Location: ../index.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
 $db = getDB();
 $collection = $db->news;
 $id = new MongoDB\BSON\ObjectId($_GET['id']);
 $deleteResult = $collection->deleteOne(['_id' => $id]);
 header("Location: index.php");
 exit();
}
?>
