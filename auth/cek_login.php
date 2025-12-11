<?php
session_start();
include "../config/koneksi.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Hash MD5 agar cocok dengan DB

    // Ambil user berdasarkan username
    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' LIMIT 1");

    if (mysqli_num_rows($q) == 1) {
        $user = mysqli_fetch_assoc($q);

        // Cocokkan password
        if ($user['password'] === $password) {

            // Set session
            $_SESSION['user_id']  = $user['id'];
            $_SESSION['nama']     = $user['nama_lengkap'];
            $_SESSION['role']     = $user['role'];

            header("Location: ../admin/index.php");
            exit;

        } else {
            // Password salah
            $_SESSION['error'] = "Password salah!";
            header("Location: login.php");
            exit;
        }

    } else {
        // Tidak ada user
        $_SESSION['error'] = "Username tidak ditemukan!";
        header("Location: login.php");
        exit;
    }
}
?>
