<?php
include '../backend/function.php';

// Ambil data berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM tempat_ibadah_dashboard WHERE id = $id";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
}

if (isset($_POST['update'])) {
    $nama = $_POST['nama_masjid'];
    $lokasi = $_POST['lokasi_masjid'];
    $desk = $_POST['desk_masjid'];
    $kegiatan = $_POST['kegiatan_masjid'];

    $query = "UPDATE tempat_ibadah_dashboard 
              SET nama_masjid='$nama', lokasi_masjid='$lokasi', desk_masjid='$desk', kegiatan_masjid='$kegiatan'
              WHERE id = $id";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Data berhasil diperbarui.'); window.location.href = 'tempat_ibadah_dashboard.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data.');</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Tempat Ibadah</title>
</head>
<body>
    <h2>Edit Data Tempat Ibadah</h2>
    <form method="POST">
        <label>Nama Masjid:</label>
        <input type="text" name="nama_masjid" value="<?= $data['nama_masjid']; ?>" required><br>

        <label>Lokasi:</label>
        <input type="text" name="lokasi_masjid" value="<?= $data['lokasi_masjid']; ?>" required><br>

        <label>Deskripsi:</label>
        <textarea name="desk_masjid" required><?= $data['desk_masjid']; ?></textarea><br>

        <label>Kegiatan Rutin:</label>
        <textarea name="kegiatan_masjid" required><?= $data['kegiatan_masjid']; ?></textarea><br>

        <button type="submit" name="update">Update</button>
    </form>
</body>
</html>
