// create.php
<?php
include '../backend/function.php';

if (isset($_POST['simpan'])) {
    

    // Ambil data dari form dan sanitasi
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $file_path = mysqli_real_escape_string($koneksi, $_POST['file_path']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $embed_map = mysqli_real_escape_string($koneksi, $_POST['embed_map']);

 // if (!filter_var($lokasi_masjid, FILTER_VALIDATE_URL)) {
   // echo "URL peta tidak valid.";
  //  exit;
//}

// Validasii URL map



// Proses upload file
if (isset($_FILES['file_path']) && $_FILES['file_path']['error'] === UPLOAD_ERR_OK) {
    $file_tmp = $_FILES['file_path']['tmp_name'];
    $file_name = $_FILES['file_path']['name'];
    $file_size = $_FILES['file_path']['size'];

    // Validasion ukuran file (maks 1MB)
    if ($file_size > 1048576) {
        echo "Ukuran file terlalu besar (maks 1MB).";
        exit;
    }

    // Validasi jenis file
    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($file_extension, $allowed_extensions)) {
        echo "Hanya file dengan format JPG, JPEG, PNG, atau GIF yang diizinkan.";
        exit;
    }

    // Proses penamaan file unik dan upload
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $file_path = $upload_dir . uniqid() . '_' . basename($file_name);

    if (move_uploaded_file($file_tmp, $file_path)) {
        
        $sql = "INSERT INTO madrasah (nama, file_path, jenis, deskripsi, lokasi, embed_map ) 
        VALUES ('$nama', '$file_path', '$jenis', '$deskripsi', '$lokasi', '$embed_map' )";

        if (mysqli_query($koneksi, $sql)) {
            header('Location: madrasah_dashboard.php?success');
        } else {
            error_log("Database Error: " . mysqli_error($koneksi), 3, 'error.log');
            header('Location: tmp.php?error');
        }
    } else {
        echo "Gagal mengunggah file.";
    }
} else {
    echo "File tidak ditemukan atau ada kesalahan.";
}
}
?>
