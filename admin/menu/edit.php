<?php
include "../../config/koneksi.php";

// Pastikan ada id
if(!isset($_GET['id'])){
    die("ID menu tidak ditemukan.");
}

$id = $_GET['id'];

// Ambil data menu
$query = "SELECT * FROM menu WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if(!$result){
    die("Query gagal: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
if(!$row){
    die("Menu dengan ID $id tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Edit Menu</title>
    <link rel="stylesheet" href="../../assets/css/menu.css">
</head>
<body>

<h2>Edit Menu</h2>

<div class="edit-form-container">
    <form action="update.php" method="post" enctype="multipart/form-data">
        <!-- ID tersembunyi -->
        <input type="hidden" name="id" value="<?= $row['id']; ?>">

        <label>Nama Menu:</label><br>
        <input type="text" name="nama" value="<?= $row['nama']; ?>" required><br><br>

        <label>Harga:</label><br>
        <input type="number" name="harga" value="<?= $row['harga']; ?>" required><br><br>

        <label>Foto:</label><br>
        <?php if(!empty($row['foto'])){ ?>
            <img src="../../assets/img/<?= $row['foto']; ?>" width="120" class="preview-img"><br>
            <small>Kosongkan jika tidak ingin mengganti foto</small><br>
        <?php } ?>
        <input type="file" name="foto"><br><br>

        <input type="submit" value="Update Menu" class="update-btn">
        <a href="index.php" class="back-btn">⬅ Kembali</a>
    </form>
</div>

</body>
</html>
