<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kesehatan";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];
$sql = "SELECT title, full_content, image FROM news WHERE id = $id";
$result = $conn->query($sql);
$news = $result->fetch_assoc();

$conn->close();
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
        <a href="berita.php">Kembali</a>
    </header>

    <main>
        <h1><?php echo $news['title']; ?></h1>
        <img src="<?php echo $news['image']; ?>" alt="<?php echo $news['title']; ?>">
        <p><?php echo nl2br($news['full_content']); ?></p>
    </main>

    <div class="footer">
    <div class="left-content">
      <p><strong>SISTEM INFORMASI RUMAH SAKIT (SIRUSA)</strong></p>
      <p><strong>sirusainfo@gmail.com</strong></p>
      <p><strong>(081)515378472</strong></p> 
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
