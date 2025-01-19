<?php
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Mengakhiri sesi

header("Location: ../login.php"); // Arahkan ke halaman login
exit();
