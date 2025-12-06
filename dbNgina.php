<?php
$host = "localhost:4306";
$user = "root";
$pass = "";
$dbname = "jakescoffee";

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
