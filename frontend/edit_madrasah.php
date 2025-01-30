<?php
include '../backend/function.php';

// Ambil ID madrasah dari parameter URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM madrasah WHERE id = $id";
    $result = $koneksi->query($sql);
    $row = $result->fetch_assoc();
} else {
    echo "ID tidak ditemukan.";
    exit;
}

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis'];
    $deskripsi = $_POST['deskripsi'];
    $lokasi = $_POST['lokasi'];
    $embed_map = $_POST['embed_map'];

    // Handle file upload
    if ($_FILES['file_path']['name']) {
        $target_dir = "../uploads/";
        $target_file = $target_dir . basename($_FILES["file_path"]["name"]);
        move_uploaded_file($_FILES["file_path"]["tmp_name"], $target_file);
        $file_path = $target_file;
    } else {
        $file_path = $row['file_path'];
    }

    // Update query
    $sql = "UPDATE madrasah SET 
            nama = '$nama', 
            file_path = '$file_path', 
            jenis = '$jenis', 
            deskripsi = '$deskripsi', 
            lokasi = '$lokasi', 
            embed_map = '$embed_map' 
            WHERE id = $id";

    if ($koneksi->query($sql) === TRUE) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='madrasah_dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Madrasah</title>
    <link rel="stylesheet" href="css/style_ibadah_dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Edit Madrasah</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nama">Nama Madrasah:</label>
                <input type="text" id="nama" name="nama" value="<?php echo $row['nama']; ?>" required>
            </div>

            <div class="form-group">
                <label for="logo">Logo Madrasah:</label>
                <input type="file" id="logo" name="file_path" accept="image/*">
                <p class="help-text">Maksimal 1MB, format JPG, JPEG, PNG, atau GIF</p>
                <img src="<?php echo $row['file_path']; ?>" width="100" height="50">
            </div>

            <div class="form-group">
                <label for="jenis">Jenis Madrasah:</label>
                <select name="jenis" id="jenis">
                    <option value="RA" <?php if ($row['jenis'] == 'RA') echo 'selected'; ?>>RA</option>
                    <option value="MI" <?php if ($row['jenis'] == 'MI') echo 'selected'; ?>>MI</option>
                    <option value="MTs" <?php if ($row['jenis'] == 'MTs') echo 'selected'; ?>>MTs</option>
                    <option value="MA" <?php if ($row['jenis'] == 'MA') echo 'selected'; ?>>MA</option>
                </select>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi Madrasah:</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"><?php echo $row['deskripsi']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi Madrasah:</label>
                <textarea name="lokasi" id="lokasi" rows="4"><?php echo $row['lokasi']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="embed_map">Embed Map:</label>
                <textarea name="embed_map" id="embed_map" rows="4"><?php echo $row['embed_map']; ?></textarea>
            </div>

            <button type="submit" name="simpan">Simpan Perubahan</button>
        </form>
    </div>
</body>