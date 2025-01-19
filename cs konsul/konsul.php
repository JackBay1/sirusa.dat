<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Service - SIRUSA</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="hero-section">
        <nav class="navbar">
            <div class="logo-container">
                <img src="logo.png" alt="Logo" class="logo-img">
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
            <p>Our customer service is here to assist you.</p>
        </div>
    </header>
    <main class="section">
        <section>
            <h2 class="section-title">Contact Customer Service</h2>
            <form id="customer-service-form" action="https://wa.me/yourwhatsappnumber" method="get" target="_blank">
                <input type="text" id="name" name="name" placeholder="Your Name" required>
                <input type="text" id="rekamMedis" name="rekamMedis" placeholder="Medical Record Number" required>
                <button type="submit" onclick="submitForm()">Contact via WhatsApp</button>
            </form>
        </section>
    </main>
    <footer class="footer">
        <div class="left-content">
            <p><strong>SIRUSA</strong></p>
            <p>Email: info@ourwebsite.com</p>
            <p>Phone: (123) 456-7890</p>
        </div>
        <div class="right-content">
            <p>Follow us:</p>
            <a href="#"><img src="facebook.png" alt="Facebook"></a>
            <a href="#"><img src="twitter.png" alt="Twitter"></a>
            <a href="#"><img src="instagram.png" alt="Instagram"></a>
        </div>
    </footer>

    <script>
        function submitForm() {
            var name = document.getElementById("name").value;
            var rekamMedis = document.getElementById("rekamMedis").value;
            var whatsappUrl = "https://wa.me/yourwhatsappnumber?text=" + encodeURIComponent("Name: " + name + "\nMedical Record Number: " + rekamMedis);
            document.getElementById("customer-service-form").action = whatsappUrl;
        }
    </script>
</body>
</html>
