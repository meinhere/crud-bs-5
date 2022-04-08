<?php
session_start();

session_unset();
$_SESSION['berhasil'] = "Anda telah logout, sampai jumpa lagi Administrator";
header("Location: ../index.php");
exit();
