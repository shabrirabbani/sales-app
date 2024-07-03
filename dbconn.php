<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "db_sales";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
