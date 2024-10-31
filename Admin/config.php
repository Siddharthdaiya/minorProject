<?php
$host = 'localhost'; // Usually localhost
$user = 'root'; // XAMPP default is 'root'
$pass = ''; // No password in XAMPP by default
$db = 'realestate';

$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
