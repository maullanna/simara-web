<?php
$mysqli = new mysqli("localhost", "root", "", "projek_kua");

$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

$sql = "SELECT * FROM tempat_ibadah_dashboard";
if ($filter) {
    $sql .= " WHERE logo = '$filter'";
}

$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tempat Ibadah</title>
    <link rel="stylesheet" href="css/style_ibadah.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="img/simara.png" type="image/x-icon">

    <style>

        /* Container Utama */
/* Container Utama */
.tempat-ibadah-container {
    display: grid;
    grid-template-columns: repeat(4, 1fr); /* 4 kolom per baris */
    gap: 1.5rem; /* Jarak antar box */
    justify-items: center; /* Menjaga item tetap terpusat */
    margin: 2rem auto;
}

/* Responsif untuk layar kecil */
@media (max-width: 1200px) {
    .tempat-ibadah-container {
        grid-template-columns: repeat(3, 1fr); /* 3 kolom per baris untuk layar sedang */
    }
}

@media (max-width: 900px) {
    .tempat-ibadah-container {
        grid-template-columns: repeat(2, 1fr); /* 2 kolom per baris untuk layar kecil */
    }
}

@media (max-width: 600px) {
    .tempat-ibadah-container {
        grid-template-columns: 1fr; /* 1 kolom per baris untuk layar sangat kecil */
    }
}

/* Box Tempat Ibadah */
.tempat-ibadah-box {
    width: 100%; /* Biarkan box menyesuaikan dengan grid */
    background-color: #fff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Efek shadow */
    overflow: hidden;
    position: relative;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    padding: 0;
    margin: 0;
}

/* Hover Effect */
.tempat-ibadah-box:hover {
    transform: translateY(-8px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

/* Gambar Utama */
.image-container {
    margin: 0;
    padding: 0;
    width: 100%;
}

.image-container img {
    display: block;
    height: auto;
}

/* Gambar Utama */
.image-container .foto-utama {
    height: 150px;
    object-fit: cover;
    border-radius: 0; /* Opsional, untuk estetika */
    width: 100%;
}

/* Informasi Tempat */
.info-container {
    padding: 1rem;
    text-align: left;
}

.nama-tempat {
    font-size: 1.1rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 0.5rem;  
}

.lokasi-jalan {
    font-size: 0.8rem;
    color: #777;
    margin: 0;
}

/* Icon Logo Agama */
.icon-container {
    position: absolute;
    top: 10px;
    right: 10px;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.icon-logo {
    width: 50px;
    height: 50px;
    margin-top:15rem;
    margin-right: 2rem;
}


    </style>
   
</head>

<body>
<div class="header">
      <img src="img/simara.svg" width="45px" height="45px" />
      <h3>KUA PUSAKA KARAWANG BARAT</h3>
      <p>Sistem Manajemen Data Religi dan Agama</p>
      <div class="navbar">
        <a href="beranda.html" id="li">Beranda</a>
        <a href="profil.html" id="li">Profil</a>
        <div class="dropdown">
          <a href="#" class="dropdown-btn" id="li">Edukasi</a>
          <div class="dropdown-content">
            <a href="edukasi_pranikah.html" id="link">Pranikah</a>
            <a href="edukasi_pernikahan.html" id="link">Pernikahan</a>
            <a href="edukasi_wakaf.html" id="link">Wakaf</a>
          </div>
        </div>
        <div class="dropdown">
          <a href="#" class="dropdown-btn" id="li">Layanan</a>
          <div class="dropdown-content">
            <a href="suscatin.html" id="link">Suscatin</a>
            <a href="edukasi_wakaf.html" id="link">Wakaf</a>
            <a href="beranda_ibadah.html" id="link">Tempat Ibadah</a>
            <a href="sekolah.html" id="link">Madrasah</a>
          </div>
        </div>
        <a href="program.html" id="li">Program</a>
      </div>
      <div class="login_staff">
        <a href="login.html">Masuk</a>
      </div>
    </div>

    <div class="banner">
    <img src="img/dotted.svg" style="width: 500px; margin-top: -5.5rem" /><img src=" img/ibadah banner.svg " style="float: right; width: 570px" />

        <div class="text_KUA" style="width: 35rem; ">
            <h1>Tempat Ibadah Antar Umat Beragama di Karawang Barat</h1>
            <br />
        </div>
        <input style="margin-top: 9rem;" type="search" placeholder="Masukan nama tempat atau lokasi" class="search-input" />
        <img src="img/search.png" style="position: absolute; width: 20px; margin-top: 10rem; left: 11%" />

        <div class="filter">
    <button onclick="filterData('Semua')">Semua</button>
    <button onclick="filterData('Masjid')">Islam</button>
    <button onclick="filterData('Gereja')">Gereja</button>
    <button onclick="filterData('Klenteng')">Klenteng</button>
    <button onclick="filterData('Vihara')">Vihara</button>
</div>
<div id="tempat-ibadah" class="tempat-ibadah-container">
    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <div class="tempat-ibadah-box" data-jenis="<?= $row['jenis']; ?>">
        <div class="image-container">
            <img class="foto-utama" src="<?= $row['file_path']; ?>"  alt="Foto Tempat Ibadah">
        </div>
        <div class="info-container">
            <p class="lokasi-jalan"><?= $row['jenis']; ?></p>
            <h3 class="nama-tempat"><?= $row['nama_masjid']; ?></h3>
            <p class="lokasi-jalan"><?= $row['lokasi_masjid']; ?></p>
        </div>
        <div class="icon-container">
            <img src="<?= $row['logo']; ?>" alt="Logo Tempat Ibadah" class="icon-logo">
        </div>
    </div>
    <?php endwhile; ?>
</div>
    </div>



<footer>
        <img src="img/whatsapp 2.svg" style="position: absolute; margin-top: -45px; right: 11%;">
        <div class="footer_kanan">
            <img src="img/logo simara.png" width="180px" style="position: absolute; right: 81%; margin-top: -35px;"><img src="img/logo kua.svg" width="90px" style="margin-left: 120px;">
            <h2 style="font-family: 'Varela Round', sans-serif; padding-top: 20px;">Kantor Urusan Agama Kecamatan Karawang Barat</h2>
            <p>Jl. Panatayuda 1, Nagasari, Karawang Barat, Nagasari, Karawang, Jawa Barat 41312</p>
            <p>Jam Pelayanan : <br>Senin - Jumat 07:30 s/d 16:00</p>
        </div>
        <div class="footer_kiri">
            <div class="beranda">
                <h3>Beranda</h3>
                <ul>Kategori</ul>
                <ul>Alur Nikah</ul>
                <ul>Pusat Informasi</ul>
            </div>
            <div class="layanan">
                <h3>Layanan</h3>
                <ul>Pranikah</ul>
                <ul>Pernikahan</ul>
                <ul>Wakaf</ul>
            </div>
            <div class="bantuan">
                <h3>Bantuan</h3>
                <ul>Syarat & Ketentuan</ul>
                <ul>Kebijakan Privasi</ul>
                <ul>Panduan</ul>
                <ul>FAQ</ul>
            </div>
            <div class="hubungi_kami">
                <h3>Hubungi Kami</h3>
                <ul>Kontak Kami</ul>
                <img src="img/pesan.svg" style="padding-top: 10px; padding-right: 20px;"><img src="img/call.svg" alt="">
            </div>
        </div>
    </footer>

    <script>
       function filterData(jenis) {
    const allBoxes = document.querySelectorAll('.tempat-ibadah-box');
    
    // Loop through all boxes
    allBoxes.forEach(box => {
        const boxJenis = box.getAttribute('data-jenis');
        
        // Show all if 'Semua' is selected, or show only matching jenis
        if (jenis === 'Semua' || boxJenis === jenis) {
            box.style.display = 'block'; // Show the box
        } else {
            box.style.display = 'none'; // Hide the box
        }
    });
}
    </script>

    <!-- Tambahkan Ionicons di header -->
<script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>

<?php $mysqli->close(); ?>
