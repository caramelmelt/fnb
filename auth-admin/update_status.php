<?php
session_start();
require_once('../config.php');
    if(isset($_GET['id']) && isset($_GET['status'])) {
        $id = $_GET['id'];
        $status = $_GET['status'];

        $query = "UPDATE pemesanan SET status = '$status' WHERE id = $id";
        $result = mysqli_query($conn, $query);

        if ($result) {
            header('Location: index.php');
            exit;
        } else {
            echo "Terjadi kesalahan. Status gagal diubah.";
        }
    }
?>
