<?php
session_start();
if(!isset($_SESSION['user_id'])) header('Location: ../auth/login.php');
include "../config/koneksi.php";
include "../config/helper.php";
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard</title>
<link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>

<!-- NAVBAR -->
<div class="navbar">
    <a href="menu/index.php">Menu</a>
    <a href="kasir/index.php">Kasir</a>
    <a href="transaksi/riwayat.php">Riwayat Transaksi</a>
    <a href="../auth/logout.php">Logout</a>
</div>

<h1>🍡 Meatball By S 🍡</h1>
<div class="ribbon"></div>
<p class="halo">Halo, <?= $_SESSION['nama'] ?> 💗</p>

<!-- GALERI MAKANAN -->
<div class="gallery">

    <div class="item">
        <img src="../assets/img/1765414827_bakso kecil.jpg" alt="">
        <p>Bakso Kecil</p>
    </div>

    <div class="item">
        <img src="../assets/img/1765414951_bakso urat.jpg" alt="">
        <p>Bakso Urat</p>
    </div>

    <div class="item">
        <img src="../assets/img/1765415873_bakso telur.jpg" alt="">
        <p>Bakso Telur</p>
    </div>

    <div class="item">
        <img src="../assets/img/1765414752_bakso mercon.jpg" alt="">
        <p>Bakso Mercon</p>
    </div>

    <div class="item">
        <img src="../assets/img/1765414712_bakso keju.jpg" alt="">
        <p>Bakso Keju</p>
    </div>

    <div class="item">
        <img src="../assets/img/1765414986_es_teh.jpg" alt="">
        <p>Es Teh Manis</p>
    </div>

    <div class="item">
        <img src="../assets/img/1765415281_teh_manis.jpg" alt="">
        <p>Teh Manis Hangat</p>
    </div>

    <div class="item">
        <img src="../assets/img/1765415716_es_tawar.jpg" alt="">
        <p>Es Teh Tawar</p>
    </div>

    <div class="item">
        <img src="../assets/img/1765415513_teh_tawar.jpg" alt="">
        <p>Teh Tawar</p>
    </div>

    <div class="item">
        <img src="../assets/img/1765415019_es_jeruk.jpg" alt="">
        <p>Es Jeruk</p>
    </div>

    <div class="item coming-soon">
        <img src="../assets/img/1765415068_es_teler.jpg" alt="">
        <p>Es Teler Creamy <span class="tag">COMING SOON</span></p>
    </div>

</div>

</body>
</html>
