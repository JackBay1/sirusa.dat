<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kesehatan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Berita</title>
    <link rel="stylesheet" href="berita.css">
</head>
<body>
    <header class="navbar">
        <div class="logo-container">
            <img src="\sirusa.dat\img\logo.png" alt="Logo" class="logo-img">
            <div class="logo-text">
                <span class="si">SIRUSA</span><span class="rusa">Informasi Berita</span>
            </div>
        </div>
        <nav>
            <a href="/sirusa.dat/index.php">Home</a>
            <a href="berita.php">Berita</a>
        </nav>
    </header>
    
    <div class="hero-section">
        <div class="hero-content">
            <h1>Selamat Datang di Portal Berita SIRUSA</h1>
            <p>Tempat Anda mendapatkan informasi terkini</p>
            <div class="search-box">
                <input type="text" placeholder="Cari berita...">
                <button>Cari</button>
            </div>
        </div>
    </div>

    <main>
        <h1>Berita Terkini</h1>
        <div class="news-container">
            <?php
            $sql = "SELECT id, title, description, image FROM news ORDER BY created_at DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="news-card">';
                    echo '    <img src="' . $row['image'] . '" alt="' . $row['title'] . '">';
                    echo '    <h3>' . $row['title'] . '</h3>';
                    echo '    <p>' . $row['description'] . '</p>';
                    echo '    <a href="berita_detail.php?id=' . $row['id'] . '" class="read-more">Baca Selanjutnya</a>';
                    echo '</div>';
                }
            } else {
                echo "<p>Belum ada berita.</p>";
            }
            ?>
        </div>
    </main>

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
