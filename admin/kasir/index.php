<?php
session_start();
if(!isset($_SESSION['user_id'])) header('Location: ../../auth/login.php');
include "../../config/koneksi.php";
include "../../config/helper.php";

// Tambah item ke keranjang
if(isset($_POST['add'])){
    $menu_id = (int)$_POST['menu_id'];
    $qty = (int)$_POST['qty'];
    $mie = $_POST['mie'] ?? null;
    $sayur = $_POST['sayur'] ?? null;

    $m = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM menu WHERE id=$menu_id"));
    $_SESSION['cart'][] = [
        'menu_id'=>$menu_id,
        'nama'=>$m['nama'],
        'harga'=>$m['harga'],
        'qty'=>$qty,
        'mie'=>$mie,
        'sayur'=>$sayur
    ];
    header('Location: index.php'); exit;
}

// Hapus cart
if(isset($_GET['clear'])){ unset($_SESSION['cart']); header('Location: index.php'); exit; }

// Hitung total
$total = 0;
if(isset($_SESSION['cart'])) foreach($_SESSION['cart'] as $it) $total += $it['harga'] * $it['qty'];

$menus = mysqli_query($conn, "SELECT * FROM menu WHERE status='active' ORDER BY id ASC");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Kasir</title>
<link rel="stylesheet" href="../../assets/css/kasir.css">
</head>
<body>

<div class="header">🍡 Kasir MeatballByS - <?= $_SESSION['nama'] ?> 🍡</div>

<div class="top-menu">
    <a href="../../admin/index.php" class="button">← Dashboard</a>
</div>

<h3>Tambah Pesanan</h3>
<form method="post">
  <label>Menu:</label>
  <select name="menu_id">
    <?php while($row = mysqli_fetch_assoc($menus)): ?>
      <option value="<?= $row['id'] ?>"><?= $row['nama'] ?> - Rp <?= rupiah($row['harga']) ?></option>
    <?php endwhile; ?>
  </select>

  <label>Qty:</label>
  <input type="number" name="qty" value="1" min="1">

  <label>Mie:</label>
  <select name="mie">
    <option value="">--pilih--</option>
    <option value="Mie Kuning">Mie Kuning</option>
    <option value="Bihun">Bihun</option>
  </select>

  <label>Sayur:</label>
  <select name="sayur">
    <option value="">--pilih--</option>
    <option value="Dengan Sayur">Dengan Sayur</option>
    <option value="Tanpa Sayur">Tanpa Sayur</option>
  </select>

  <button type="submit" name="add">Tambah ke Keranjang</button>
</form>

<h3>Keranjang</h3>
<?php if(!empty($_SESSION['cart'])): ?>
<table>
<tr><th>Nama</th><th>Var</th><th>Qty</th><th>Harga</th><th>Subtotal</th></tr>
<?php foreach($_SESSION['cart'] as $it): ?>
<tr>
  <td><?= $it['nama'] ?></td>
  <td><?= ($it['mie']??'-').' / '.($it['sayur']??'-') ?></td>
  <td><?= $it['qty'] ?></td>
  <td>Rp <?= rupiah($it['harga']) ?></td>
  <td>Rp <?= rupiah($it['harga']*$it['qty']) ?></td>
</tr>
<?php endforeach; ?>
<tr class="total-row"><td colspan="4">Total</td><td>Rp <?= rupiah($total) ?></td></tr>
</table>
<form action="proses.php" method="post" style="text-align:center;">
  <input type="hidden" name="total" value="<?= $total ?>">
  <button type="submit" name="save">Simpan Transaksi & Cetak</button>
</form>
<div class="top-menu">
    <a href="index.php?clear=1" class="button">Kosongkan Keranjang</a>
</div>
<?php else: ?>
<p>Keranjang kosong</p>
<?php endif; ?>

</body>
</html>
