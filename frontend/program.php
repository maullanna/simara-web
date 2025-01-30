<?php
$mysqli = new mysqli("localhost", "root", "", "projek_kua");


$sql = "SELECT * FROM kegiatan";

$result = $mysqli->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tempat Ibadah</title>
    <link rel="stylesheet" href="css/program.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;500;600;700&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="img/simara.png" type="image/x-icon">

    <style>


    </style>
   
</head>

<body>
<div class="header">
      <img src="img/simara.svg" width="45px" height="45px" />
      <h3>KUA PUSAKA KARAWANG BARAT</h3>
      <p>Sistem Manajemen Data Religi dan Agama</p>
      <div class="navbar">
        <a href="beranda.php" id="li">Beranda</a>
        <a href="profil.php" id="li">Profil</a>
        <div class="dropdown">
          <a href="#" class="dropdown-btn" id="li">Edukasi</a>
          <div class="dropdown-content">
            <a href="edukasi_pranikah.php" id="link">Pranikah</a>
            <a href="edukasi_pernikahan.php" id="link">Pernikahan</a>
            <a href="edukasi_wakaf.php" id="link">Wakaf</a>
          </div>
        </div>
        <div class="dropdown">
          <a href="#" class="dropdown-btn" id="li">Layanan</a>
          <div class="dropdown-content">
            <a href="suscatin.php" id="link">Suscatin</a>
            <a href="edukasi_wakaf.php" id="link">Wakaf</a>
            <a href="beranda_ibadah.php" id="link">Tempat Ibadah</a>
            <a href="sekolah.php" id="link">Madrasah</a>
          </div>
        </div>
        <a href="program.php" id="li">Program</a>
      </div>
      <div class="login_staff">
        <a href="login.php">Masuk</a>
      </div>
    </div>
    <div class="banner">
      <img src="img/banner edukasi.svg" width="100%" />
    </div>
    <div class="text_banner">
      <h1>Program Edukasi Pernikahan Dini</h1>
    </div>
        
        
    <div class="paragraf">
      <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Program edukasi pernikahan dini adalah inisiatif yang dirancang untuk memberikan informasi dan pemahaman kepada masyarakat, terutama remaja, tentang dampak, risiko, dan pentingnya
        mempertimbangkan kematangan fisik, mental, emosional, sosial, serta ekonomi sebelum memutuskan untuk menikah pada usia dini.
      </p>
      <br />
      <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Program ini bertujuan untuk mengurangi angka pernikahan dini dan memitigasi dampak negatifnya, seperti kesehatan ibu dan anak, pendidikan, serta kehidupan sosial-ekonomi. Berikut rekap hasil
        edukasi pernikahan dini :
      </p>
    </div>

    </div>
    <div id="tempat-ibadah" class="tempat-ibadah-container">
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="tempat-ibadah-box" data-tanggal-pelaksanaan="<?= $row['tanggal_pelaksanaan'];?>" onclick="redirectToDetail(<?= $row['id_kegiatan'];?>)" style="cursor: pointer;">
            <div class="image-container">
                <?php 
                $images = explode(',', $row['upload_file']);
                if (!empty ($images[0])) {
                    echo "<img src='uploads/{$images[0]}' alt='Foto Tempat Ibadah' class='foto-utama'>";
                } else {
                    echo "<img src='img/ibadah banner.svg' alt='Foto Tempat Ibadah'>";
                }
                ?>
            </div>
                <div class="info-container">
                    <p class="lokasi-jalan"><?= $row['tanggal_pelaksanaan']; ?></p>
                    <h3 class="nama-tempat"><?= $row['judul_kegiatan']; ?></h3>
                    <p class="lokasi-jalan"><?= $row['deskripsi']; ?></p>
                </div>
            </div>
        <?php endwhile; ?>
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
       function filterData(tanggal_pelaksanaan) {
    const allBoxes = document.querySelectorAll('.tempat-ibadah-box');
    
    // Loop through all boxes
    allBoxes.forEach(box => {
        const boxtanggal_pelaksanaan = box.getAttribute('data-tanggal_pelaksanaan');
        
        // Show all if 'Semua' is selected, or show only matching jenis
        if (tanggal_pelaksanaan === 'Semua' || boxtanggal_pelaksanaan === tanggal_pelaksanaan) {
            box.style.display = 'block'; // Show the box
        } else {
            box.style.display = 'none'; // Hide the box
        }
    });

}


function redirectToDetail(id) {
    window.location.href = `detail.php?id=${id}`;  // Menggunakan template literal dengan backticks
}

    </script>

    <!-- Tambahkan Ionicons di header -->
<script type="module" src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://cdn.jsdelivr.net/npm/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>
</html>

<?php $mysqli->close(); ?>
