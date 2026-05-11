<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "tugas_db"; // Sesuai dengan nama database di atas

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
