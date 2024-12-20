<?php
include '../backend/function.php';

// Ambil data dari database
$sql = "SELECT * FROM tempat_ibadah_dashboard";
$result = mysqli_query($koneksi, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempat Ibadah</title>
    <link rel="stylesheet" href="css/style_ibadah_dashboard.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
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
    display: flex; /* Tampilkan modal dengan flexbox */
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
        <form action="proses.php" method="POST" enctype="multipart/form-data">
            <label>Upload Foto:</label>
            <input type="file" name="file_path" accept="image/*" required>
            <br>
            <label>Logo Ibadah</label>
            <select name="logo" id="logo_id">
                <option value="uploads/Logo-islam.svg">Logo Islam</option>
                <option value="uploads/Logo-kristen.svg">Logo Kristen</option>
                <option value="uploads/Logo-Klenteng.svg">Logo Kelenteng</option>
                <option value="uploads/Logo-vihara.svg">Logo Vihara</option>
            </select>

            <label>Nama Tempat Ibadah:</label>
            <input type="text" name="nama_masjid" required>
            <br>
            <label>Lokasi:</label>
            <input type="text" name="lokasi_masjid" required>
            <br>
            <label>Deskripsi:</label>
            <textarea name="desk_masjid" required></textarea>
            <br>
            <label>Kegiatan Rutin:</label>
            <textarea name="kegiatan_masjid" required></textarea>
            <br>
            <label>Embed Map:</label>
            <textarea name="map_masjid" required></textarea>
            <br>
            <button type="submit" name="simpan">Simpan</button>
        </form>
    </div>
</div>


    <h2>Data yang Tersimpan</h2>
    <table border="1">
        <thead>
        <tr>
            <th>No</th>
            <th>File Path</th>
            <th>Logo Ibadah</th>
            <th>Nama</th>
            <th>Lokasi</th>
            <th>Deskripsi Kegiatan</th>
            <th>Kegiatan Rutin</th>
            <th>Map Ibadah</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) : ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><img src="<?= $row['file_path']; ?>" alt="Foto" width="100"></td>
            <td><img src="<?= $row['logo']; ?>" alt="Foto" width="100"></td>
            <td><?= $row['nama_masjid']; ?></td>
            <td><?= $row['lokasi_masjid']; ?></td>
            <td><?= $row['desk_masjid']; ?></td>
            <td><?= $row['kegiatan_masjid']; ?></td>
            <td><?= $row['map_masjid']; ?></td>
            <td>
                          <a href=""></a>  <ion-icon name="trash-outline" class="icon-delete" style="cursor: pointer; "></ion-icon>
                           <a href=""></a> <ion-icon name="create-outline" class="icon-edit"></ion-icon>
                        </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <script src="js/uji.js"></script>
<script>

 

</script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>
</body>
</html>
