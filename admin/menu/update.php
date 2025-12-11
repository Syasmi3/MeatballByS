<?php
include "../../config/koneksi.php";

// Pastikan data dikirim
if(!isset($_POST['id'])){
    die("ID menu tidak ditemukan.");
}

$id = $_POST['id'];
$nama = $_POST['nama'];
$harga = $_POST['harga'];

// Ambil data lama dulu untuk cek foto
$query = "SELECT * FROM menu WHERE id = '$id'";
$result = mysqli_query($conn, $query);
if(!$result){
    die("Query gagal: " . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result);

// Path folder foto
$target_dir = "../../assets/img/";

// Cek apakah ada file foto baru
if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0){
    $file_name = $_FILES['foto']['name'];
    $file_tmp = $_FILES['foto']['tmp_name'];
    $file_type = $_FILES['foto']['type'];

    $allowed = ['image/jpeg','image/png','image/jpg'];
    if(!in_array($file_type, $allowed)){
        die("Format file tidak diizinkan.");
    }

    // Buat nama unik supaya tidak ketimpa
    $new_name = time() . "_" . $file_name;
    $target_file = $target_dir . $new_name;

    if(move_uploaded_file($file_tmp, $target_file)){
        // Hapus foto lama jika ada
        if(!empty($row['foto']) && file_exists($target_dir . $row['foto'])){
            unlink($target_dir . $row['foto']);
        }
        $foto_to_save = $new_name;
    } else {
        die("Gagal upload foto baru.");
    }
} else {
    // Kalau tidak upload baru, tetap pakai foto lama
    $foto_to_save = $row['foto'];
}

// Update data menu
$update = "UPDATE menu SET 
    nama = '$nama',
    harga = '$harga',
    foto = '$foto_to_save'
    WHERE id = '$id'";

if(mysqli_query($conn, $update)){
    // Redirect ke halaman daftar menu
    header("Location: index.php");
    exit;
} else {
    die("Gagal update menu: " . mysqli_error($conn));
}
?>
