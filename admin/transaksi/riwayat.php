<?php
include "../../config/koneksi.php";
include "../../config/helper.php";

// Ambil semua transaksi
$query = "SELECT * FROM transaksi ORDER BY id DESC";
$result = mysqli_query($conn, $query);
if(!$result) die("Query gagal: " . mysqli_error($conn));
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Riwayat Transaksi</title>
<link rel="stylesheet" href="../../assets/css/riwayat.css">
</head>
<body>

<h2>Riwayat Transaksi</h2>

<div class="top-menu">
    <a href="../index.php" class="button">← Kembali ke Kasir</a>
</div>

<table>
<tr>
    <th>No</th>
    <th>ID Transaksi</th>
    <th>Tanggal</th>
    <th>Total</th>
    <th>Aksi</th>
</tr>

<?php 
$no = 1;
while($row = mysqli_fetch_assoc($result)) { ?>
<tr>
    <td><?= $no++ ?></td>
    <td><?= $row['id'] ?></td>
    <td><?= $row['tanggal'] ?></td>
    <td>Rp <?= rupiah($row['total']) ?></td>
    <td><a href="cetak.php?id=<?= $row['id'] ?>" class="button">Cetak Struk</a></td>
</tr>
<?php } ?>
</table>

</body>
</html>
