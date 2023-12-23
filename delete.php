<?php
include 'koneksi.php';

$id_barang = $_GET['id_barang'];

$delete = mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$id_barang'");

if (!$delete) {
    echo "Error: " . mysqli_error($koneksi);
} else {
    header("Location: tables.php");
}
?>