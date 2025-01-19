<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $message = htmlspecialchars($_POST['message']);

    $phoneNumber = '628123456789'; // Ganti dengan nomor tujuan
    $fullMessage = "Halo, nama saya $name. Keperluan saya adalah: $message";

    $url = "https://wa.me/$phoneNumber?text=" . urlencode($fullMessage);

    header("Location: $url");
    exit;
}
?>
