<?php
include '../backend/function.php';

// Ambil ID kegiatan dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data
    $sql = "DELETE FROM kegiatan WHERE id_kegiatan = $id";
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil dihapus'); window.location.href='program_dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
} else {
    echo "ID tidak ditemukan.";
    exit;
}
?>