<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - SIRUSA</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap');

body {
  margin: 0;
  font-family: 'Open Sans', sans-serif;
  background-color: #f9f9f9;
}

.hero-section {
  text-align: center;
  padding: 70px;
  background: linear-gradient(135deg, #a8e063 0%, #56ab2f 100%);
  color: white;
  position: relative;
}

.navbar {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 1000;
  background-color: #333;
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

.hero-content h1 {
  font-size: 48px;
  margin-bottom: 20px;
}

.hero-content p {
  font-size: 18px;
  margin-bottom: 10px;
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

.section-title {
  text-align: center;
  font-size: 32px;
  font-weight: bold;
  color: #333;
  margin-top: 50px;
  margin-bottom: 20px;
}

.cards-container {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 25px;
  padding: 20px;
}

.card {
  background: #fff;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  width: 300px;
  text-align: center;
  transition: transform 0.3s, box-shadow 0.3s;
}

.card:hover {
  transform: translateY(-10px);
  box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
}

.card-icon {
  width: 80px;
  height: 80px;
  margin: 0 auto 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
  background-color: #eafaf5;
}

.card-icon img {
  width: 50px;
  height: auto;
}

.card-title {
  font-size: 22px;
  color: #333;
  margin-bottom: 15px;
}

.card-description {
  font-size: 16px;
  color: #777;
  line-height: 1.6;
}

.footer {
  display: flex;
  justify-content: space-between;
  padding: 20px 50px;
  background-color: #333;
  color: white;
}

.left-content {
  text-align: left;
}

.right-content {
  text-align: right;
}

.footer a img {
  margin: 0 10px;
  vertical-align: middle;
  transition: transform 0.3s;
}

.footer a img:hover {
  transform: scale(1.1);
}

.whatsapp-float {
  position: fixed;
  bottom: 20px;
  right: 20px;
  width: 60px;
  height: 60px;
  z-index: 1000;
}

.whatsapp-float img {
  width: 100%;
  height: auto;
  border-radius: 50%;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease;
}

.whatsapp-float img:hover {
  transform: scale(1.1);
}

</style>
<body>
    <header class="hero-section">
        <nav class="navbar">
            <div class="logo-container">
                <img src="\sirusa.dat\img\logo.png" alt="Logo" class="logo-img">
                <div class="logo-text"><span class="si">SI</span><span class="rusa">RUSA</span></div>
            </div>
            <div class="nav-links">
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="#">Services</a>
                <a href="#">Contact</a>
            </div>
        </nav>
        <div class="hero-content">
            <h1>Welcome to SIRUSA!</h1>
            <p>Learn more about us and our mission.</p>
            <div class="search-box">
                <input type="text" placeholder="Search...">
                <button>Go</button>
            </div>
        </div>
    </header>
    <main class="section">
        <section>
            <h2 class="section-title">About Us</h2>
            <p>kosong</p>
        </section>
        <section>
            <h2 class="section-title">Our Mission</h2>
            <p>kosong</p>
        </section>
        <section>
            <h2 class="section-title">Contact Us</h2>
            <p>Email: info@ourwebsite.com</p>
            <p>Phone: (123) 456-7890</p>
        </section>
    </main>
    <footer class="footer">
        <div class="left-content">
            <p><strong>sirusa.dat</strong></p>
            <p>Email: sirusainfo@ourwebsite.com</p>
            <p>Phone: (123) 456-7890</p>
        </div>
        <div class="right-content">
            <p>Follow us:</p>
            <a href="#"><img src="\sirusa.dat\img\facebook.png" alt="Facebook"></a>
            <a href="#"><img src="\sirusa.dat\img\twitter.png" alt="Twitter"></a>
            <a href="#"><img src="\sirusa.dat\img\instagram.png" alt="Instagram"></a>
        </div>
    </footer>
    <a href="#" class="whatsapp-float" target="_blank">
        <img src="\sirusa.dat\img\whatsapp.png" alt="WhatsApp">
    </a>
</body>
</html>
