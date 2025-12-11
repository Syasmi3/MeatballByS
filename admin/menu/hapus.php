<?php
include "../../config/koneksi.php";

// Pastikan ada id
if(!isset($_GET['id'])){
    die("ID menu tidak ditemukan.");
}

$id = $_GET['id'];

// Ambil data menu dulu untuk cek foto
$query = "SELECT * FROM menu WHERE id = '$id'";
$result = mysqli_query($conn, $query);

if(!$result){
    die("Query gagal: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result);
if(!$row){
    die("Menu dengan ID $id tidak ditemukan.");
}

// Hapus foto lama jika ada
$target_dir = "../../assets/img/";
if(!empty($row['foto']) && file_exists($target_dir . $row['foto'])){
    unlink($target_dir . $row['foto']);
}

// Hapus data dari database
$hapus = "DELETE FROM menu WHERE id = '$id'";
if(mysqli_query($conn, $hapus)){
    header("Location: index.php");
    exit;
} else {
    die("Gagal menghapus menu: " . mysqli_error($conn));
}
?>
