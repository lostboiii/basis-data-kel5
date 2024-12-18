<?php
require 'vendor/autoload.php';

function getDB() {
    $client = new MongoDB\Client("mongodb://localhost:27017/?readPreference=primary&directConnection=true&serverSelectionTimeoutMS=2000&appName=MongoDB_Jakarta_Region");
    return $client->basdat;
}
?>