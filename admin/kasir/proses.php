<?php
session_start();
if(!isset($_SESSION['user_id'])) header('Location: ../../auth/login.php');
include "../../config/koneksi.php";

if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['save'])){
    $total = (int)$_POST['total'];
    $kasir_id = $_SESSION['user_id'];

    mysqli_query($conn, "INSERT INTO transaksi (total, kasir_id) VALUES ($total, $kasir_id)");
    $trans_id = mysqli_insert_id($conn);

    foreach($_SESSION['cart'] as $it){
        $menu_id = (int)$it['menu_id'];
        $qty = (int)$it['qty'];
        $mie = $it['mie'] ? "'".$it['mie']."'" : "NULL";
        $sayur = $it['sayur'] ? "'".$it['sayur']."'" : "NULL";
        $harga = (int)$it['harga'];

        mysqli_query($conn, "INSERT INTO detail_transaksi (transaksi_id, menu_id, qty, mie, sayur, harga)
            VALUES ($trans_id, $menu_id, $qty, $mie, $sayur, $harga)");
    }

    // simpan id di session untuk cetak
    $_SESSION['last_trans'] = $trans_id;
    header('Location: ../transaksi/cetak.php?id='.$trans_id);
    exit;
}
?>
