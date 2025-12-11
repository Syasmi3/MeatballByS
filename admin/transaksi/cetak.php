<?php
session_start();
include "../../config/koneksi.php";
include "../../config/helper.php";
if(!isset($_SESSION['user_id'])) header('Location: ../../auth/login.php');

$id = (int)($_GET['id'] ?? $_SESSION['last_trans'] ?? 0);
$trans = mysqli_fetch_assoc(mysqli_query($conn, "SELECT t.*, u.nama_lengkap FROM transaksi t LEFT JOIN users u ON t.kasir_id=u.id WHERE t.id=$id"));
$details = mysqli_query($conn, "SELECT d.*, m.nama FROM detail_transaksi d JOIN menu m ON d.menu_id = m.id WHERE d.transaksi_id=$id");
?>
<!doctype html>
<html><head>
<meta charset="utf-8">
<title>Struk #<?= $id ?></title>
<style>
  body{font-family:monospace; width:300px;}
  .center{text-align:center;}
</style>
</head><body>
<div class="center">
  <h3>Meatball By S</h3>
  <p>Kasir: <?= $trans['nama_lengkap'] ?></p>
  <p><?= $trans['tanggal'] ?></p>
  <hr>
</div>
<?php while($d = mysqli_fetch_assoc($details)): ?>
  <p><?= $d['nama'] ?> <?php if($d['mie']) echo "+ ".str_replace('_',' ',$d['mie']); ?> (<?= $d['qty'] ?>) - Rp <?= rupiah($d['harga']*$d['qty']) ?></p>
<?php endwhile; ?>
<hr>
<p>Total: Rp <?= rupiah($trans['total']) ?></p>
<hr>
<p class="center">Terima kasih! 🍜</p>

<button onclick="window.print()">Cetak Struk</button>
</body></html>
