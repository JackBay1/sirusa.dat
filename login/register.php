<?php
$host = "localhost"; // Ganti dengan host database Anda
$user = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "kesehatan";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];
    $usia = $_POST['usia'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $nik = $_POST['nik'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $sql = "INSERT INTO users (nama, alamat, usia, jenis_kelamin, nik, username, password, role) 
            VALUES (?, ?, ?, ?, ?, ?, ?, 'pasien')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissss", $nama, $alamat, $usia, $jenis_kelamin, $nik, $username, $password);

    if ($stmt->execute()) {
        echo "Registrasi berhasil!";
        header("Location: login.php");
        exit();
    } else {
        echo "Registrasi gagal: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap');

        body {
        margin: 0;
        font-family: 'Open Sans', sans-serif;
        background: url('/sirusa.dat/img/resepsionis.jpg') no-repeat center center fixed;
        background-size: cover;
        background-color: rgba(0, 0, 0, 0.594); /* Memberikan efek transparansi */
        }

        .hero-section {
        text-align: center;
        padding: 70px;
        background: rgba(255, 255, 255, 0.8); /* Transparansi untuk hero section */
        color: white;
        position: relative;
        }

        .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 1000;
        background-color: rgba(51, 51, 51, 0.9); /* Transparansi untuk navbar */
        color: white;
        padding: 15px 50px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .logo-container {
        display: flex;
        align-items: center;
        gap: 15px;
        }

        .logo-img {
        width: 50px;
        height: auto;
        }

        .logo-text {
        font-size: 26px;
        font-weight: bold;
        }

        .logo-text .si {
        color: #f9f9f9;
        }

        .logo-text .rusa {
        color: #a8e063;
        }

        .nav-links {
        display: flex;
        gap: 20px; /* Atur jarak antar link */
        }

        .nav-links a {
        text-decoration: none;
        color: white;
        font-size: 16px;
        transition: color 0.3s;
        }

        .nav-links a:hover {
        color: #a8e063;
        }

        .login-container {
        background: rgba(255, 255, 255, 0.9);
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        text-align: center;
        max-width: 400px;
        width: 100%;
        margin: 100px auto;
        }

        .login-container h1 {
        margin-bottom: 30px;
        font-size: 24px;
        color: #333;
        }

        .form-group {
        margin-bottom: 20px;
        text-align: left;
        }

        .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
        color: #333;
        }

        .form-group input {
        width: calc(100% - 22px);
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        outline: none;
        transition: border-color 0.3s;
        }

        .form-group input:focus {
        border-color: #56ab2f;
        }

        .btn {
        width: 100%;
        padding: 10px;
        background: #56ab2f;
        border: none;
        border-radius: 5px;
        color: white;
        font-size: 16px;
        cursor: pointer;
        transition: background 0.3s;
        }

        .btn:hover {
        background: #449d1f;
        }

        .register-link {
        margin-top: 20px;
        color: #333;
        }

        .register-link a {
        color: #56ab2f;
        text-decoration: none;
        }

        .register-link a:hover {
        text-decoration: underline;
        }

        .search-box {
        margin-top: 30px;
        display: inline-block;
        border-radius: 5px;
        overflow: hidden;
        }

        .search-box input {
        padding: 15px;
        border: none;
        border-radius: 5px 0 0 5px;
        width: 250px;
        outline: none;
        transition: width 0.3s;
        }

        .search-box input:focus {
        width: 300px;
        }

        .search-box button {
        padding: 15px 20px;
        background: #333;
        color: #fff;
        border: none;
        cursor: pointer;
        transition: background 0.3s;
        }

        .search-box button:hover {
        background: #a8e063;
        }

        .action-buttons {
        margin-top: 40px;
        }

        .action-buttons button {
        padding: 15px 30px;
        margin: 5px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background 0.3s, transform 0.3s;
        }

        .btn-daftar {
        background-color: #56ab2f;
        color: white;
        }

        .action-buttons button:hover {
        background-color: #a8e063;
        transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Register</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <input type="text" name="alamat" required>
            </div>
            <div class="form-group">
                <label for="usia">Usia:</label>
                <input type="number" name="usia" required>
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Jenis Kelamin:</label>
                <select name="jenis_kelamin" required>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">EMAIL:</label>
                <input type="text" name="nik" required>
            </div>
            <div class="form-group">
                <label for="TELP">NO.TELEPON:</label>
                <input type="text" name="nik" required>
            </div>
            <div class="form-group">
                <label for="nik">NIK:</label>
                <input type="text" name="nik" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmasi Password:</label>
                <input type="password" name="confirm_password" required>
            </div>
            <input type="submit" value="Register" class="btn">
        </form>
        <div class="register-link">
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>
</body>
</html>
