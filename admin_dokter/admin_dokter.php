<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];
$role = $_SESSION['role'];

$servername = "localhost";
$dbusername = "root";
$password = "";
$dbname = "kesehatan";

$conn = new mysqli($servername, $dbusername, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query untuk data pasien
$sqlPatients = "SELECT * FROM pasien";
$resultPatients = $conn->query($sqlPatients);

// Query untuk jumlah pasien
$sqlPatientCount = "SELECT COUNT(*) AS total_pasien FROM pasien";
$totalPatients = $conn->query($sqlPatientCount)->fetch_assoc()['total_pasien'];

// Query untuk jumlah obat
$sqlMedicineCount = "SELECT COUNT(*) AS total_obat FROM obat";
$totalMedicines = $conn->query($sqlMedicineCount)->fetch_assoc()['total_obat'];

// Dummy Data untuk Total Pasien dan Obat
$totalPatients = 56;
$totalMedicines = 56;

// Dummy Data Pasien
$patients = [
    ['no' => 1, 'nama' => 'Shaufiq', 'umur' => 21, 'jenkel' => 'Pria', 'kondisi' => 'Dirawat'],
    ['no' => 2, 'nama' => 'Esty', 'umur' => 21, 'jenkel' => 'Wanita', 'kondisi' => 'Sembuh'],
    ['no' => 3, 'nama' => 'Fieq', 'umur' => 7, 'jenkel' => 'Wanita', 'kondisi' => 'Operasi'],
    ['no' => 4, 'nama' => 'Entah', 'umur' => 22, 'jenkel' => 'Pria', 'kondisi' => 'Kritis']
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dokter - SIRUSA</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="hero-section">
    <nav class="navbar">
      <div class="logo-container">
        <a href="admin_dokter.php"><img src="/sirusa.dat/img/logo.png" alt="logo" class="logo-img"></a>
        <div class="logo-text">
          <span class="si">SI</span><span class="rusa">RUSA</span>
        </div>
      </div>
      <div class="nav-links">
        <a href="admin_dokter.php">Dashboard</a>
        <a href="logout.php">Logout</a>
      </div>
    </nav>
    <div class="hero-content">
      <h1>Dashboard Admin Dokter</h1>
      <p>Selamat datang, <?php echo $_SESSION['username']; ?>!</p>
    </div>
  </header>

  <section class="section">
    <h2 class="section-title">Kontrol Kegiatan</h2>
    <div class="cards-container">
      <div class="card">
        <h3 class="card-title">Pengecekan Data Pasien</h3>
        <p>Jumlah Pasien: <strong><?php echo $totalPatients; ?></strong></p>
        <p>Jumlah Obat: <strong><?php echo $totalMedicines; ?></strong></p>
        <div class="action-buttons">
          <a href="#data-pasien"><button class="btn-data">lihat data</button></a>
        </div>
      </div>
      <div class="card">
        <h3 class="card-title">Pembelian Obat</h3>
        <p>Kelola data pembelian obat untuk pasien.</p>
        <div class="action-buttons">
          <a href="riwayat_pembelian_obat.php"><button class="btn-obat">kelola obat</button></a>
        </div>
      </div>
      <div class="card">
        <h3 class="card-title">Pembuatan Berita</h3>
        <p>Tambahkan berita terbaru ke portal kesehatan.</p>
        <div class="action-buttons">
          <a href="/sirusa.dat/berita/buat_berita.php"><button class="btn-berita">Tambah Berita</button></a>
        </div>
      </div>
    </div>
  </section>

  <!-- Data Pasien -->
  <section class="section" id="data-pasien">
    <h2 class="section-title">Data Pasien</h2>
    <table class="data-table">
        <thead>
            <tr>
                <th>No. Rekam Medis</th>
                <th>Nama</th>
                <th>Umur</th>
                <th>Jenis Kelamin</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($resultPatients->num_rows > 0): ?>
                <?php while ($row = $resultPatients->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['no_rekam_medis']; ?></td>
                        <td><?php echo $row['nama']; ?></td>
                        <td><?php echo $row['umur']; ?></td>
                        <td><?php echo $row['jenis_kelamin']; ?></td>
                        <td><?php echo $row['kondisi']; ?></td>
                        <td>
                            <a href="edit_pasien.php?id=<?php echo $row['no_rekam_medis']; ?>" class="button-edit">Edit</a>
                            <a href="hapus_pasien.php?id=<?php echo $row['no_rekam_medis']; ?>" class="button-delete" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data pasien.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>

  <div class="footer">
    <div class="left-content">
      <p><strong>SISTEM INFORMASI RUMAH SAKIT (SIRUSA)</strong></p>
      <p><strong>sirusainfo@gmail.com</strong></p>
      <p><strong>(081)678543987</strong></p> 
      <p><strong>Kesehatan pasien adalah tujuan kami</strong></p>
      <p>&copy; 2023 SIRUSA. All rights reserved.</p>
    </div>
    <div class="right-content">
      <p>Follow kami</p>
      <a href="#"><img src="/sirusa.dat/img/ig.png" alt="Instagram" style="width: 24px;"></a>
      <a href="#"><img src="/sirusa.dat/img/fb.png" alt="Facebook" style="width: 24px;"></a>
      <a href="#"><img src="/sirusa.dat/img/yt.png" alt="YouTube" style="width: 24px;"></a>
    </div>
  </div>

  <!-- WhatsApp Icon -->
  <a href="/sirusa.dat/cs konsul/konsul.php" class="whatsapp-float" target="_blank">
    <img src="/sirusa.dat/img/cs.png" alt="customer-service">
  </a>
  <script>
    function search() {
      let input = document.getElementById('searchInput').value.toLowerCase();
      let content = document.querySelector('body');
      let paragraphs = content.getElementsByTagName('p');

      for (let i = 0; i < paragraphs.length; i++) {
        if (paragraphs[i].innerText.toLowerCase().includes(input)) {
          paragraphs[i].style.backgroundColor = "yellow";  
        } else {
          paragraphs[i].style.backgroundColor = "transparent";
        }
      }
    }
  </script>
</body>
</html>
