<?php
include "../../config/koneksi.php";
$menu = mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Daftar Menu</title>
    <link rel="stylesheet" href="../../assets/css/menu.css">
</head>
<body>

<h2>Daftar Menu</h2>

<div class="top-menu">
    <a href="../index.php" class="back-btn">← Kembali ke Dashboard</a>
    <a href="tambah.php" class="add-btn">+ Tambah Menu</a>
</div>

<table>
    <tr>
        <th>No</th>
        <th>Foto</th>
        <th>Nama Menu</th>
        <th>Harga</th>
        <th>Aksi</th>
    </tr>

    <?php 
    $no = 1;
    while($row = mysqli_fetch_assoc($menu)) { 
    ?>
    <tr>
        <td><?= $no++; ?></td>

        <td>
            <?php if (!empty($row['foto'])) { ?>
                <img src="../../assets/img/<?= $row['foto']; ?>" width="80">
            <?php } else { ?>
                <i>Tidak ada foto</i>
            <?php } ?>
        </td>

        <td><?= $row['nama']; ?></td>
        <td><?= number_format($row['harga']); ?></td>

        <td>
            <a href="edit.php?id=<?= $row['id']; ?>" class="edit">Edit</a>
            <a href="hapus.php?id=<?= $row['id']; ?>" class="delete" onclick="return confirm('Yakin mau hapus menu ini?')">Hapus</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
