<?php
include '../backend/function.php';

// Ambil ID madrasah dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM madrasah WHERE id = $id";
    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='madrasah_dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>