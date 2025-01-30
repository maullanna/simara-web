<?php
include '../backend/function.php';

// Cek apakah parameter 'id' ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id']; // Ambil ID dari URL

// Query untuk mengambil data kegiatan berdasarkan ID
$sql = "SELECT * FROM kegiatan WHERE id_kegiatan = $id";
$result = mysqli_query($koneksi, $sql);

// Cek apakah data ditemukan
if (!$result || mysqli_num_rows($result) == 0) {
    die("Data tidak ditemukan.");
}

$row = mysqli_fetch_assoc($result); // Ambil data dari hasil query

// Proses update data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul_kegiatan = mysqli_real_escape_string($koneksi, $_POST['judul_kegiatan']);
    $tanggal_pelaksanaan = mysqli_real_escape_string($koneksi, $_POST['tanggal_pelaksanaan']);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Handle file upload (jika ada file baru diupload)
    $uploaded_files = [];
    if (!empty($_FILES['upload_file']['name'][0])) {
        foreach ($_FILES['upload_file']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['upload_file']['name'][$key];
            $file_tmp = $_FILES['upload_file']['tmp_name'][$key];
            $target_file = "../uploads/" . basename($file_name);
            move_uploaded_file($file_tmp, $target_file);
            $uploaded_files[] = $file_name;
        }
        $upload_file = implode(',', $uploaded_files);
    } else {
        $upload_file = $row['upload_file']; // Gunakan file yang sudah ada
    }

    // Update query
    $sql = "UPDATE kegiatan SET 
            upload_file = '$upload_file', 
            judul_kegiatan = '$judul_kegiatan', 
            tanggal_pelaksanaan = '$tanggal_pelaksanaan', 
            lokasi = '$lokasi', 
            deskripsi = '$deskripsi' 
            WHERE id = $id";

    if (mysqli_query($koneksi, $sql)) {
        echo "<script>alert('Data berhasil diupdate'); window.location.href='program_dashboard.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Program</title>
    <link rel="stylesheet" href="css/program_dashboard.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Edit Program/Kegiatan</h1>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="form-group">
                <label for="upload_file">Upload Foto (Max 5 Gambar):</label>
                <input type="file" name="upload_file[]" id="upload_file" accept="image/*" multiple>
                <div class="preview">
                    <?php
                    $images = explode(',', $row['upload_file']);
                    foreach ($images as $image) {
                        echo "<img src='../uploads/$image' alt='Foto' width='100' style='margin-right: 5px;'>";
                    }
                    ?>
                </div>
                <small style="color: red;">Pilih maksimal 5 gambar.</small>
            </div>

            <div class="form-group">
                <label for="judul_kegiatan">Judul Kegiatan:</label>
                <input type="text" id="judul_kegiatan" name="judul_kegiatan" value="<?php echo $row['judul_kegiatan']; ?>" required>
            </div>

            <div class="form-group">
                <label for="tanggal_pelaksanaan">Tanggal Pelaksanaan:</label>
                <input type="date" id="tanggal_pelaksanaan" name="tanggal_pelaksanaan" value="<?php echo $row['tanggal_pelaksanaan']; ?>" required>
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi:</label>
                <textarea id="lokasi" name="lokasi" required><?php echo $row['lokasi']; ?></textarea>
            </div>

            <div class="form-group">
                <label for="deskripsi">Deskripsi:</label>
                <textarea id="deskripsi" name="deskripsi" required><?php echo $row['deskripsi']; ?></textarea>
            </div>

            <button type="submit" name="simpan">Simpan Perubahan</button>
        </form>
    </div>

    <script>
        // Batasi file upload maksimal 5
        document.getElementById('upload_file').addEventListener('change', function () {
            if (this.files.length > 5) {
                alert('Anda hanya dapat mengunggah maksimal 5 gambar.');
                this.value = ''; // Reset input
            }
        });
    </script>
</body>
</html>