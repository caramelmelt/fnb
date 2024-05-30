<?php
session_start();

// Fungsi untuk logout
function logout() {
    // Menghapus semua data sesi
    session_unset();
    // Menghancurkan sesi
    session_destroy();
    // Redirect ke halaman login atau halaman lainnya
    header("Location: index.html");
    exit; // Penting: pastikan untuk keluar setelah melakukan redirect
}

// Panggil fungsi logout jika tombol logout ditekan
if (isset($_POST['logout'])) {
    logout();
}
?>
