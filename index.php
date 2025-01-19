<?php
session_start();

require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIRUSA - Medical Information Center</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header class="hero-section">
    <nav class="navbar">
      <div class="logo-container">
        <a href="index.php"><img src="/sirusa.dat/img/logo.png" alt="logo" class="logo-img"></a>
        <div class="logo-text">
          <span class="si">SI</span><span class="rusa">RUSA</span>
        </div>
      </div>
      <div class="nav-links">
        <a href="#">Beranda</a>
        <a href="/sirusa.dat/berita/berita.php">Berita</a>
        <a href="\sirusa.dat\tentangkami\about.php">Tentang kami</a>
        <?php if (isset($_SESSION['username'])): ?>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="\sirusa.dat\login\login.php">Masuk</a>
          <a href="register.php">Daftar</a>
        <?php endif; ?>
      </div>
    </nav>
    <div class="hero-content">
      <h1>PUSAT INFORMASI DAN LAYANAN ONLINE RUMAH SAKIT</h1>
      <p>Temukan Dokter Spesialis di Rumah Sakit</p>
      <p>Kartu Perawatan Medis Berkualitas & Penuh Empati</p>
      <p>Kunjungi Rumah Sakit Terdekat untuk Perawatan</p>
      <div class="search-box">
        <input type="text" id="searchInput" placeholder="Cari Disini">
        <button onclick="search()">CARI</button>
        <div class="action-buttons">
          <a href="login/login.php"><button class="btn-daftar">Daftar</button></a>
        </div>
      </div>
    </div>
  </header>

  <section class="section">
    <h2 class="section-title">Layanan Kami</h2>
    <div class="cards-container">
      <div class="card">
        <div class="card-icon">
          <img src="https://img.icons8.com/color/96/ambulance.png" alt="Emergency Call Icon">
        </div>
        <h3 class="card-title">Emergency Call</h3>
        <p class="card-description">
          Instalasi Gawat Darurat melayani Anda 24 jam dengan tenaga kesehatan yang handal. Terintegrasi dengan layanan farmasi.
          <br><strong>(031) 3971818</strong>
        </p>
      </div>

      <div class="card">
        <div class="card-icon">
          <img src="https://img.icons8.com/color/96/classroom.png" alt="Learning Center Icon">
        </div>
        <h3 class="card-title">Learning Center</h3>
        <p class="card-description">
          Kami menyediakan berbagai jenis pelatihan kesehatan untuk tenaga kesehatan, profesional, karyawan, mahasiswa, dan umum.
        </p>
      </div>

      <div class="card">
        <div class="card-icon">
          <img src="https://img.icons8.com/color/96/stethoscope.png" alt="Konsultasi Kesehatan Kerja Icon">
        </div>
        <h3 class="card-title">Konsultasi Kesehatan Kerja</h3>
        <p class="card-description">
          Layanan konsultasi di bidang kesehatan kerja untuk melindungi tenaga kerja dari gangguan kesehatan yang timbul di tempat kerja.
        </p>
      </div>
    </div>
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
  <a href="https://wa.me/081515378472" class="whatsapp-float" >
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
