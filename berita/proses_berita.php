<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kesehatan";

$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $judul = $conn->real_escape_string($_POST['judul']);
    $deskripsi = $conn->real_escape_string($_POST['deskripsi']);
    $tanggal = $conn->real_escape_string($_POST['tanggal']);
    $lokasi = $conn->real_escape_string($_POST['lokasi']);
    
    // Proses upload gambar
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
        $gambar = $conn->real_escape_string($target_file);

        // Simpan data ke database
        $sql = "INSERT INTO berita (judul, deskripsi, tanggal, lokasi, gambar) 
                VALUES ('$judul', '$deskripsi', '$tanggal', '$lokasi', '$gambar')";

        if ($conn->query($sql) === TRUE) {
            header("Location: berita.php"); // Redirect ke halaman berita
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Maaf, terjadi kesalahan saat mengupload gambar.";
    }
}

$conn->close();
?>
