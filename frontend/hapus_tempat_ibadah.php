<?php
include '../backend/function.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Hapus data berdasarkan ID
    $query = "DELETE FROM tempat_ibadah_dashboard WHERE id = $id";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil dihapus.'); window.location.href = 'tempat_ibadah_dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data.'); window.location.href = 'tempat_ibadah_dashboard.php';</script>";
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
