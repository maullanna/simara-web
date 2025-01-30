<?php
include_once '../backend/function.php';

if (isset($_POST['simpan'])) {
    // Ambil data dari form
    $judul_kegiatan = mysqli_real_escape_string($koneksi, $_POST['judul_kegiatan']);
    $tanggal_pelaksanaan = mysqli_real_escape_string($koneksi, $_POST['tanggal_pelaksanaan']);
    $lokasi = mysqli_real_escape_string($koneksi, $_POST['lokasi']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    // Direktori upload
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $uploaded_files = []; // Menyimpan file yang berhasil diunggah
    $errors = []; // Menyimpan error jika ada

    // Proses file upload
    if (isset($_FILES['upload_file'])) {
        $total_files = count($_FILES['upload_file']['name']);

        // Batasi maksimal 5 file
        if ($total_files > 5) {
            echo "Maksimal hanya dapat mengunggah 5 file.";
            exit;
        }

        for ($i = 0; $i < $total_files; $i++) {
            $file_tmp = $_FILES['upload_file']['tmp_name'][$i];
            $file_name = $_FILES['upload_file']['name'][$i];
            $file_size = $_FILES['upload_file']['size'][$i];

            // Validasi ukuran file (maks 1MB per file)
            if ($file_size > 5048576) { // 1MB
                $errors[] = "$file_name: Ukuran file terlalu besar (maks 1MB).";
                continue;
            }

            // Validasi jenis file
            $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($file_extension, $allowed_extensions)) {
                $errors[] = "$file_name: Format file tidak diperbolehkan.";
                continue;
            }

            // Penamaan file unik
            $new_file_name = uniqid() . '_' . basename($file_name);
            $upload_path = $upload_dir . $new_file_name;

            // Proses upload file
            if (move_uploaded_file($file_tmp, $upload_path)) {
                $uploaded_files[] = $new_file_name; // Simpan nama file yang berhasil diunggah
            } else {
                $errors[] = "$file_name: Gagal diunggah.";
            }
        }

        // Simpan ke database jika ada file berhasil diunggah
        if (!empty($uploaded_files)) {
            $file_string = implode(',', $uploaded_files); // Gabungkan file dengan koma
            $sql = "INSERT INTO kegiatan (upload_file, judul_kegiatan, tanggal_pelaksanaan, lokasi, deskripsi) 
                    VALUES ('$file_string', '$judul_kegiatan', '$tanggal_pelaksanaan', '$lokasi', '$deskripsi')";

            if (mysqli_query($koneksi, $sql)) {
                header('Location: uji.php?success');
                exit;
            } else {
                error_log("Database Error: " . mysqli_error($koneksi), 3, 'error.log');
                echo "Error: Gagal menyimpan ke database.";
            }
        } else {
            echo "Tidak ada file yang berhasil diunggah.";
        }
    } else {
        echo "Tidak ada file yang diunggah.";
    }

    // Tampilkan error jika ada
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
    }
}
?>
