<?php
// Konfigurasi koneksi
$host = 'localhost'; // Host database
$user = 'root'; // Username database (ganti jika perlu)
$pass = ''; // Password database (ganti jika perlu)
$db = 'sirusa_data'; // Nama database

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $db);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
echo "Koneksi berhasil!";
?>