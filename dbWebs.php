<?php
session_start();
if(!isset($_SESSION["isUserLoggedIn"])){
    $_SESSION["isUserLoggedIn"] = false;
}

if(!isset($_SESSION["ShoppingCart"])){
    $_SESSION["ShoppingCart"] = [];
}


$servername = "localhost";
$username = "root";
$password = "";
$dbName = "assignment";

$connection = mysqli_connect($servername, $username, $password, $dbName);

if(!$connection){
    die("Connection failed: " . mysqli_connect_error());
}
?>