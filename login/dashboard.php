<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>berhasil login</title>
</head>
<body>
    <div class="container-logout">
        <form action="logout.php" method="post" class="login-email">
            <h1>Selamat Datang, <?php echo htmlspecialchars($_SESSION['user_email']); ?>!</h1>
            <div class="input-group">
                <button type="submit" class ="btn">logout</button>
        </div>
        </form>
    </div>
</body>
</html>
