// Tambahkan ini ke file terpisah, misalnya add_user.php
$hashed_password = password_hash("password123", PASSWORD_DEFAULT); // Ganti dengan password yang diinginkan

// Menambahkan dokter
$sql = "INSERT INTO dokter (username, password, nama) VALUES ('dokter1', '$hashed_password', 'Dokter Satu')";
$conn->query($sql);

// Menambahkan pasien
$sql = "INSERT INTO pasien (username, password, nama) VALUES ('pasien1', '$hashed_password', 'Pasien Satu')";
$conn->query($sql); 