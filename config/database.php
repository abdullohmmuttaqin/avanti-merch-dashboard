<?php
// koneksi ke database mysql lokal xampp
$host = "localhost";
$user = "root";
$pass = "";
$db   = "avanti_merch_db";

// membuat koneksi mysqli
$conn = mysqli_connect($host, $user, $pass, $db);

// cek apakah koneksi gagal
if (!$conn) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
