<?php
require_once '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "DELETE FROM katalog WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        echo "Produk berhasil dihapus.";
        header('Location: katalog.php'); 
    } else {
        echo "Gagal menghapus produk: " . mysqli_error($conn);
    }
} else {
    echo "ID produk tidak ditemukan.";
}
?>
