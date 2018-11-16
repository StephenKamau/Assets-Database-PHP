<?php
//used to connect to the database
$host = "localhost";
$dbname = "assets";
$username = "root";
$password = "";

try {
    $con = new PDO("mysql:host={$host};dbname={$dbname}", $username, $password);
} catch (PDOException $exception) {
    //show errors  
    echo "connection error:" . $exception->getMessage();
}