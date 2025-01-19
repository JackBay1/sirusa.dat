<?php
session_start();

$host = "localhost"; // Ganti dengan host database Anda
$user = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "kesehatan";

// Koneksi ke database
$conn = new mysqli($host, $user, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query untuk mengambil data pengguna berdasarkan username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Arahkan ke halaman sesuai role
            if ($row['role'] == 'pasien') {
                header("Location: /sirusa.dat/dashboard_pasien/pasien_dashboard.php");
            } elseif ($row['role'] == 'dokter') {
                header("Location: /sirusa.dat/admin_dokter/admin_dokter.php");
            }
            exit();
        } else {
            echo "Password salah!";
        }
    } else {
        echo "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
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
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" required>
            </div>
            <input type="submit" value="Login" class="btn">
        </form>
        <div class="register-link">
            <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>