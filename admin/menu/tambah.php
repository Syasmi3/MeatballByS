<?php
session_start();
if(!isset($_SESSION['user_id'])) header('Location: ../../auth/login.php');
include "../../config/koneksi.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nama = mysqli_real_escape_string($conn, $_POST['nama']);
    $kategori = $_POST['kategori'];
    $harga = (int)$_POST['harga'];
    $status = $_POST['status'];
    $foto = null;

    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
        $namaFile = time() . "_" . basename($_FILES['foto']['name']);
        $tmp = $_FILES['foto']['tmp_name'];
        move_uploaded_file($tmp, "../../assets/img/".$namaFile);
        $foto = $namaFile;
    }

    mysqli_query($conn, "INSERT INTO menu (nama,kategori,harga,status,foto) 
        VALUES ('$nama','$kategori',$harga,'$status','$foto')");
    header('Location: index.php');
    exit;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tambah Menu</title>
    <link rel="stylesheet" href="../../assets/css/tambah_menu.css">
</head>
<body>

<div class="container">
    <h2>Tambah Menu</h2>

    <form method="post" enctype="multipart/form-data" class="form-box">

        <label>Nama Menu</label>
        <input name="nama" required>

        <label>Kategori</label>
        <select name="kategori">
            <option value="makanan">Makanan</option>
            <option value="minuman">Minuman</option>
        </select>

        <label>Harga</label>
        <input name="harga" type="number" required>

        <label>Status</label>
        <select name="status">
            <option value="active">Active</option>
            <option value="coming_soon">Coming Soon</option>
        </select>

        <label>Foto</label>
        <input type="file" name="foto">

        <button type="submit" class="btn">Simpan</button>

        <a href="index.php" class="back">Kembali</a>
    </form>
</div>

</body>
</html>
