<?php
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Dapatkan username dari session
$username = $_SESSION['username'];

// Koneksi ke database
$servername = "localhost";
$dbusername = "root";
$password = "";
$dbname = "kesehatan";

$conn = new mysqli($servername, $dbusername, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mendapatkan data pasien berdasarkan username
$sqlPasien = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = 'pasien'");
$sqlPasien->bind_param("s", $username);
$sqlPasien->execute();
$resultPasien = $sqlPasien->get_result();

if ($resultPasien->num_rows == 0) {
    echo "Data pasien tidak ditemukan.";
    exit();
}
$pasien = $resultPasien->fetch_assoc();
$email = $pasien['email'];
$no_Telepon = $pasien['no_telepon'];

// Query untuk mendapatkan jadwal dokter
$sqlJadwal = "
    SELECT 
        jd.id, 
        d.nama AS nama_dokter, 
        p.nama_poli, 
        jd.hari, 
        jd.jam
    FROM 
        jadwal_dokter jd
    JOIN 
        dokter d ON jd.dokter_id = d.id
    JOIN 
        poli p ON jd.poli_id = p.id
";

$resultJadwal = $conn->query($sqlJadwal);

if (!$resultJadwal) {
    die("Error pada query jadwal dokter: " . $conn->error . "\nQuery: " . $sqlJadwal);
}
// Query untuk nomor antrian pasien hari ini
$tanggalHariIni = date('Y-m-d');
$sqlAntrian = "
    SELECT * FROM antrian
    WHERE id_user = ? AND tanggal = ?";
$stmtAntrian = $conn->prepare($sqlAntrian);
$stmtAntrian->bind_param("is", $pasien['id'], $tanggalHariIni);
$stmtAntrian->execute();
$resultAntrian = $stmtAntrian->get_result();
$antrian = $resultAntrian->fetch_assoc();

// Query untuk riwayat pendaftaran
$sqlPendaftaran = "
    SELECT p.id, d.nama AS nama_dokter, pl.nama_poli, p.tanggal, p.keluhan, p.status
    FROM pendaftaran p
    JOIN dokter d ON p.dokter_id = d.id
    JOIN poli pl ON p.poli_id = pl.id
    WHERE p.id_user = ?
    ORDER BY p.tanggal DESC";
$stmtPendaftaran = $conn->prepare($sqlPendaftaran);
$stmtPendaftaran->bind_param("i", $pasien['id']);
$stmtPendaftaran->execute();
$resultPendaftaran = $stmtPendaftaran->get_result();

// Handle registration for treatment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Pastikan nilai dokter_id dan poli_id dikirim
    if (!empty($_POST['dokter_id']) && !empty($_POST['poli_id'])) {
        $dokter_id = $_POST['dokter_id'];
        $poli_id = $_POST['poli_id'];

        // Query to get the maximum queue number for today and generate the next number
        $sqlMaxQueue = "SELECT MAX(no_antrian) AS max_no_antrian FROM antrian WHERE tanggal = ? AND poli_id = ?";
        $stmtMaxQueue = $conn->prepare($sqlMaxQueue);
        $stmtMaxQueue->bind_param("si", $tanggalHariIni, $poli_id);
        $stmtMaxQueue->execute();
        $resultMaxQueue = $stmtMaxQueue->get_result();
        $maxQueue = $resultMaxQueue->fetch_assoc();
        $nextQueueNumber = ($maxQueue['max_no_antrian'] ?? 0) + 1;

        // Insert the new queue number for the patient
        $sqlInsertAntrian = "
            INSERT INTO antrian (id_user, dokter_id, poli_id, tanggal, no_antrian)
            VALUES (?, ?, ?, ?, ?)";
        $stmtInsertAntrian = $conn->prepare($sqlInsertAntrian);
        $stmtInsertAntrian->bind_param("iiisi", $pasien['id'], $dokter_id, $poli_id, $tanggalHariIni, $nextQueueNumber);
        $stmtInsertAntrian->execute();

        // Redirect to the dashboard
        header("Location: pasien_dashboard.php");
        exit();
    } else {
        echo "Mohon pilih dokter dan poli terlebih dahulu.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pasien</title>
    <link rel="stylesheet" href="pasien.css">
</head>
<body>
    <header>
        <h1>Dashboard Pasien</h1>
        <p>Selamat datang, <?php echo htmlspecialchars($pasien['nama']); ?>!</p>
        <a href="../dashboard_pasien/logout.php">Logout</a>
    </header>

    <section>
    <h2>Data Pasien</h2>
        <p><strong>Nama:</strong> <?php echo htmlspecialchars($pasien['nama']); ?></p>
        <p><strong>Email:</strong> <?php echo $email; ?></p>
        <p><strong>No. Telepon:</strong> <?php echo $no_Telepon; ?></p>
</section>

    </section>

    <section>
        <h2>Nomor Antrian Hari Ini</h2>
        <?php if ($antrian): ?>
            <p>Nomor Antrian Anda: <?php echo $antrian['no_antrian']; ?></p>
            <p>Tanggal: <?php echo $antrian['tanggal']; ?></p>
            <p>Keluhan: <?php echo htmlspecialchars($antrian['keluhan']); ?></p>
        <?php else: ?>
            <p>Anda belum memiliki nomor antrian untuk hari ini.</p>
        <?php endif; ?>
    </section>

    <section>
        <h2>Jadwal Dokter</h2>
        <table>
            <thead>
                <tr>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Hari</th>
                    <th>Jam</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultJadwal->num_rows > 0): ?>
                    <?php while ($row = $resultJadwal->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama_dokter']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_poli']); ?></td>
                            <td><?php echo $row['hari']; ?></td>
                            <td><?php echo $row['jam']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Tidak ada jadwal dokter tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Riwayat Pendaftaran</h2>
        <table>
            <thead>
                <tr>
                    <th>Dokter</th>
                    <th>Poli</th>
                    <th>Tanggal</th>
                    <th>Keluhan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultPendaftaran->num_rows > 0): ?>
                    <?php while ($row = $resultPendaftaran->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nama_dokter']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_poli']); ?></td>
                            <td><?php echo $row['tanggal']; ?></td>
                            <td><?php echo htmlspecialchars($row['keluhan']); ?></td>
                            <td><?php echo $row['status']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Tidak ada data pendaftaran.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Daftar Berobat</h2>
        <form method="POST">
            <label for="dokter_id">Dokter:</label>
            <select name="dokter_id" id="dokter_id">
                <?php
                $sqlDokter = "SELECT * FROM dokter";
                $resultDokter = $conn->query($sqlDokter);
                while ($dokter = $resultDokter->fetch_assoc()) {
                    echo "<option value='{$dokter['id']}'>{$dokter['nama']}</option>";
                }
                ?>
            </select>

            <label for="poli_id">Poli:</label>
            <select name="poli_id" id="poli_id">
                <?php
                $sqlPoli = "SELECT * FROM poli";
                $resultPoli = $conn->query($sqlPoli);
                while ($poli = $resultPoli->fetch_assoc()) {
                    echo "<option value='{$poli['id']}'>{$poli['nama_poli']}</option>";
                }
                ?>
            </select>

            <button type="submit">Daftar</button>
        </form>
    </section>

</body>
</html>
