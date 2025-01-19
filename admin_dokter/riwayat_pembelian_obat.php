<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION['username'];

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "kesehatan");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dokter dan poli untuk pilihan di formulir
$dokterQuery = "SELECT id, dokter_id FROM dokter";  // Query untuk mendapatkan id dokter
$dokterResult = $conn->query($dokterQuery);

$poliQuery = "SELECT id, poli_id FROM poli";  // Query untuk mendapatkan id poli
$poliResult = $conn->query($poliQuery);

// Tambahkan jadwal dokter
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $dokterId = $_POST['dokter_id'];
    $poliId = $_POST['poli_id'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];

    // Validasi input
    if (!empty($dokterId) && !empty($poliId) && !empty($hari) && !empty($jam)) {
        $insertQuery = "INSERT INTO jadwal_dokter (dokter_id, poli_id, hari, jam) VALUES ('$dokterId', '$poliId', '$hari', '$jam')";
        if ($conn->query($insertQuery)) {
            $message = "Jadwal dokter berhasil ditambahkan.";
        } else {
            $message = "Gagal menambahkan jadwal: " . $conn->error;
        }
    } else {
        $message = "Harap isi semua bidang.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Dokter</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Tambah Jadwal Dokter</h1>
    </header>
    <main>
        <?php if (isset($message)) echo "<p>$message</p>"; ?>
        <form method="POST" action="">
            <label for="dokter_id">Pilih Dokter:</label>
            <select name="dokter_id" id="dokter_id" required>
                <option value="">Pilih Dokter</option>
                <?php while ($dokter = $dokterResult->fetch_assoc()): ?>
                    <option value="<?php echo $dokter['id']; ?>"><?php echo "Dokter ID: " . $dokter['dokter_id']; ?></option>
                <?php endwhile; ?>
            </select>
            
            <label for="poli_id">Pilih Poli:</label>
            <select name="poli_id" id="poli_id" required>
                <option value="">Pilih Poli</option>
                <?php while ($poli = $poliResult->fetch_assoc()): ?>
                    <option value="<?php echo $poli['id']; ?>"><?php echo "Poli ID: " . $poli['poli_id']; ?></option>
                <?php endwhile; ?>
            </select>
            
            <label for="hari">Hari:</label>
            <input type="text" name="hari" id="hari" value="<?php echo date('l'); ?>" readonly>

            <label for="jam">Jam:</label>
            <input type="text" name="jam" id="jam" placeholder="Contoh: 08:00 - 12:00" required>
            
            <button type="submit">Tambahkan Jadwal</button>
        </form>

        <h2>Jadwal Dokter Hari Ini</h2>
        <table>
            <thead>
                <tr>
                    <th>Dokter ID</th>
                    <th>Poli ID</th>
                    <th>Hari</th>
                    <th>Jam</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $today = date('l');
                // Query untuk mengambil data jadwal dokter, menggunakan JOIN dengan dokter_id dan poli_id
                $jadwalQuery = "
                SELECT jd.dokter_id, jd.poli_id, jd.hari, jd.jam 
                FROM jadwal_dokter jd
                WHERE jd.hari = '$today'"; // Menampilkan id dokter dan poli
                
                $jadwalResult = $conn->query($jadwalQuery);
                
                if ($jadwalResult && $jadwalResult->num_rows > 0) {
                    while ($row = $jadwalResult->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['dokter_id']}</td>
                                <td>{$row['poli_id']}</td>
                                <td>{$row['hari']}</td>
                                <td>{$row['jam']}</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada jadwal untuk hari ini.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
