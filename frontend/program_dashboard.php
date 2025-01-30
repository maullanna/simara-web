<?php
include '../backend/function.php';

$sql = "SELECT * FROM kegiatan";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Ibadah</title>
    <link rel="stylesheet" href="css/program_dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>

       
        .table-container {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch; 
    margin-bottom: 20px; 
}

table {
    border-collapse: collapse;
    width: 100%;
    min-width: 1000px; /* Atur minimal lebar tabel */
}

th, td {
    padding: 10px;
    text-align: left;
    border: 1px solid #ddd;
    word-wrap: break-word;
}



   
td {
    word-wrap: break-word; /* Agar teks tidak meluber */
    max-width: 200px; /* Atur lebar kolom maksimal */
    overflow: hidden; /* Menyembunyikan konten yang melebihi batas */
    text-overflow: ellipsis; /* Menambahkan "..." jika teks terlalu panjang */
    padding: 10px;
    vertical-align: top; /* Menjaga teks tidak tertekuk ke bawah */
}

/* Menambahkan gaya untuk kolom tertentu */
td.lokasi, td.deskripsi, td.kegiatan {
    max-width: 250px; 
    overflow: auto; 
}

/* Menangani iframe agar responsif */
td iframe {
    width: 100%;
    height: 100px;
}

/* Tabel header */
th {
    background-color: #f2f2f2;
    text-align: left;
    padding: 5px;
}


        .modal {
    display: none; /* Default modal tidak terlihat */
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5); /* Transparan hitam */
    justify-content: center;
    align-items: center;
}


.modal.active {
    display: flex; 
}



/* Desain tombol kustom */
.custom-file-label {
    display: inline-block;
    padding: 10px 20px;
    background-color: #2e7031;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    border-radius: 5px;
    cursor: pointer;
    text-align: center;
    transition: background-color 0.3s ease;
}

/* Efek hover */
.custom-file-label:hover {
    background-color: #2e7030;
}

/* Tampilkan nama file yang dipilih */
.file-name {
    margin-top: 10px;
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: #333;
}


/* Tabel */
table {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed; /* Agar lebar tabel tetap, tidak berubah sesuai konten */
}

/* Gaya untuk header tabel */
th {
    background-color: #f2f2f2;
    text-align: left;
    padding: 10px;
}

/* Gaya untuk cell tabel */
td {
    padding: 10px;
    word-wrap: break-word;  /* Agar teks panjang dipecah ke baris baru */
    overflow: hidden;  /* Menyembunyikan konten yang meluap */
    text-overflow: ellipsis;  /* Menampilkan "..." jika teks terlalu panjang */
}

/* Gaya khusus untuk kolom yang memiliki data panjang */
.long-text {
    max-width: 250px;  /* Setel lebar kolom yang ingin dibatasi */
    overflow: hidden;
    text-overflow: ellipsis;
}

.scrollable {
    max-height: 80px;  /* Batasi tinggi kolom agar scrollable */
    overflow-y: auto;
}

.preview img {
      max-width: 100px;
      margin: 5px;
    }
    </style>
</head>

<body>
<div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span><img src="img/logo simara no title.png" width="35px" style="margin-top: 10px; margin-left: 15px;"></span>
                        <h1 class="header">SiMaRa</h1>
                    </a>
                </li>
                <li>
                    <a href="dashboard.php">
                        <span class="icon"><ion-icon name="home-outline"></ion-icon></span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="pernikahan_dashboard.php">
                        <span class="icon"><ion-icon name="people-outline"></ion-icon></span>
                        <span class="title">Pernikahan</span>
                    </a>
                </li>
                <li>
                    <a href="tempat_ibadah_dashboard.php">
                        <span class="icon"><ion-icon name="moon-outline"></ion-icon></span>
                        <span class="title">Tempat Ibadah</span>
                    </a>
                </li>
                <li>
                    <a href="madrasah_dashboard.php">
                        <span class="icon"><ion-icon name="school-outline"></ion-icon></span>
                        <span class="title">Madrasah</span>
                    </a>
                </li>
                <li>
                    <a href="program|_dashboard.php">
                        <span class="icon"><ion-icon name="grid-outline"></ion-icon></span>
                        <span class="title">Program</span>
                    </a>
                </li>
                <li>
                    <a href="login.php">
                        <span class="icon"><ion-icon name="log-out-outline"></ion-icon></span>
                        <span class="title">Keluar</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="menu-outline"></ion-icon>
                </div>
                <div class="judul">
                    <img src="img/logo kua.svg">
                    <h1>Kantor Urusan Agama PUSAKA Kecamatan Karawang Barat</h1>
                </div>
            </div>
            <div class="cardBox">
                <h1>Pendataan Masjid di kecamatan karawang barat</h1>
            </div>
            <input type="search" placeholder="Cari nama atau lokasi " class="search-input "><img src="img/search.png" style="position: absolute; width: 20px; margin-top: 3rem; left: 4.5%;">
            <div class="table">
                <div class="header-tabel">
                    <h1 style="font-size: 20PX; margin-top: 10px; color: #3B3E51; opacity: 60%; font-family: 'poppins', sans-serif; ">Menampilkan Data Semua Masjid</h1>
                    <button id="btn-tambah"><ion-icon name="add-circle-outline" style="cursor: pointer;"></ion-icon>Tambah</button>
                </div>
               <!-- Modal Structure -->
               <div id="modal-popup" class="modal">
    <div class="modal-content">
        <div class="header-modal">
            <span class="close-modal">&times;</span>
            <h2 style="color: #3B3E51; font-family: 'poppins', sans-serif;">Tambah Data Masjid</h2>
        </div>
        <form action="proses_progam.php" method="POST" enctype="multipart/form-data">
    <label>Upload Foto (Max 5 Gambar):</label>
    <input type="file" name="upload_file[]" id="upload_file"  accept="image/*" multiple required>
    <div class="preview" id="preview"></div>
    <br>
    <small style="color: red;">Pilih maksimal 5 gambar.</small>
    <br>
    <label>Judul Kegiatan</label>
    <input type="text" name="judul_kegiatan" required>
    <br>
    <label>Tanggal Pelaksanaan</label>
    <input type="date" name="tanggal_pelaksanaan" required>
    <br>
    <label>Lokasi</label>
    <textarea name="lokasi" required></textarea>
    <br>
    <label>Deskripsi</label>
    <textarea name="deskripsi" required></textarea>
    <button type="submit" name="simpan">Simpan</button>
</form>

<script>

    document.getElementById('upload_file').addEventListener('change', function () {
        if (this.files.length > 5) {
            alert('Anda hanya dapat mengunggah maksimal 5 gambar.');
            this.value = ''; // Reset input
        }
    });
</script>

    </div>
</div>

<div class="table-container">

    <h2>Data yang Tersimpan</h2>
    <table border="1">
        <thead>
        <tr>
        <th>No</th>
                        <th>Foto</th>
                        <th>Judul</th>
                        <th>Tanggal Pelaksanaan</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
            <tr>
            <td><?= $no++; ?></td>
            <td>
    <?php 
    $images = explode(',', $row['upload_file']);
    foreach ($images as $image) {
        echo "<img src='uploads/$image' alt='Foto' width='40' style='margin-right: 5px;'>";
    }
    ?>
</td>            <td><?= $row['judul_kegiatan']; ?></td>
            <td><?= $row['tanggal_pelaksanaan']; ?></td>
            <td><?= $row['lokasi']; ?></td>
            <td><?= $row['deskripsi']; ?></td>
            <td>
            <a href="edit_program.php?id=<?= $row['id_kegiatan']; ?>">
    <ion-icon name="create-outline" class="icon-edit" style="cursor: pointer;"></ion-icon>
</a>
<a href="delete_program.php?id=<?= $row['id_kegiatan']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
    <ion-icon name="trash-outline" class="icon-delete" style="cursor: pointer;"></ion-icon>
</a>
                        </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>
    <script src="js/uji.js"></script>


<script>
     const uploadFile = document.getElementById('upload_file');
    const preview = document.getElementById('preview');
    const uploadedFiles = [];

    // Event listener saat user memilih file
    uploadFile.addEventListener('change', (event) => {
      const files = Array.from(event.target.files);

      files.forEach(file => {
        // Cek apakah file sudah pernah dipilih
        if (uploadedFiles.find(f => f.name === file.name)) {
          alert(`File ${file.name} sudah dipilih sebelumnya!`);
          return;
        }

        // Tambahkan file ke array
        if (uploadedFiles.length < 5) {
          uploadedFiles.push(file);

          // Tampilkan preview gambar
          const reader = new FileReader();
          reader.onload = (e) => {
            const img = document.createElement('img');
            img.src = e.target.result;
            preview.appendChild(img);
          };
          reader.readAsDataURL(file);
        } else {
          alert('Maksimal hanya dapat mengunggah 5 file!');
        }
      });

      // Kosongkan input file, tapi file yang sudah dipilih tetap ada
      uploadFile.value = '';
    });

    // Event listener saat form di-submit
    document.getElementById('uploadForm').addEventListener('submit', (event) => {
      event.preventDefault();

      if (uploadedFiles.length === 0) {
        alert('Tidak ada file yang dipilih.');
        return;
      }

      // Kirim file ke backend menggunakan FormData
      const formData = new FormData();
      uploadedFiles.forEach((file, index) => {
        formData.append(`file${index + 1}`, file);
      });

      fetch('/upload', {
        method: 'POST',
        body: formData,
      })
        .then(response => response.json())
        .then(data => {
          alert('File berhasil diunggah!');
          console.log(data);
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });
  </script>

        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</body>
</html>
