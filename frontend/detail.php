<?php 
include '../backend/function.php';

$id = isset($_GET['id']) ? $_GET['id'] : null;

if ($id) {
    $sql = "SELECT * FROM kegiatan WHERE id_kegiatan = $id";
    $result = mysqli_query($koneksi, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
    } else {
        echo "Data tidak ditemukan!";
        exit;
    }
} else {
    echo "ID tidak ditemukan!";
    exit;
}

mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Program</title>
    <link rel="stylesheet" href="css/detail_edukasi.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="img/simara.png" type="image/x-icon">
</head>

<body>
    <div class="header">
        <img src="img/simara.svg" width="45px" height="45px">
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
                    <a href="madrasah.php" id="link">Madrasah</a>
                </div>
            </div>
            <a href="program.php" id="li">Program</a>
        </div>
        <div class="login_staff">
            <a href="login.php">Masuk</a>
        </div>
    </div>

    <div class="banner">
    <div class="slideshow-container">
        <?php 
        $images = !empty($data['upload_file']) ? explode(',', $data['upload_file']) : [];
        foreach ($images as $index => $image) {
            echo '
            <div class="slide fade">
                <img src="uploads/' . htmlspecialchars($image) . '" alt="Foto Kegiatan">
            </div>';
        }
        
        // Tambahkan tombol navigasi jika ada lebih dari 1 gambar
        if (count($images) > 1) {
            echo '
            <a class="prev" onclick="changeSlide(-1)">❮</a>
            <a class="next" onclick="changeSlide(1)">❯</a>';
        }
        ?>
    </div>
</div>

    <div class="judul">
        <h1><?= htmlspecialchars($data['judul_kegiatan']); ?></h1>
        <h4><?= htmlspecialchars($data['tanggal_pelaksanaan']); ?></h4>
        <ion-icon name="location"></ion-icon>
        <h3><?= htmlspecialchars($data['lokasi']); ?></h3>
    </div>

    <div class="konten">
        <p><?= htmlspecialchars($data['deskripsi']); ?></p>
    </div>

    <footer>
        <img src="img/whatsapp 2.svg" style="position: absolute; margin-top: -45px; right: 11%;">
        <div class="footer_kanan">
            <img src="img/logo simara.png" width="180px" style="position: absolute; right: 81%; margin-top: -35px;">
            <img src="img/logo kua.svg" width="90px" style="margin-left: 120px;">
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
                <img src="img/pesan.svg" style="padding-top: 10px; padding-right: 20px;">
                <img src="img/call.svg" alt="">
            </div>
        </div>
    </footer>

    <button id="scrollTopBtn" onclick="scrollToTop()"><img src="img/icons8-arrow-up-30.png" alt=""></button>

    <script>
let slideIndex = 0;
let autoSlideInterval;

// Fungsi untuk menampilkan slide
function showSlide(index) {
    const slides = document.getElementsByClassName("slide");
    
    if (index >= slides.length) slideIndex = 0;
    if (index < 0) slideIndex = slides.length - 1;
    
    for (let i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    
    if (slides[slideIndex]) {
        slides[slideIndex].style.display = "block";
    }
}

// Fungsi untuk pindah slide
function changeSlide(n) {
    // Hentikan slideshow otomatis saat tombol diklik
    clearInterval(autoSlideInterval);
    slideIndex += n;
    showSlide(slideIndex);
}

// Fungsi untuk slideshow otomatis
function autoSlide() {
    slideIndex++;
    showSlide(slideIndex);
}

// Mulai slideshow otomatis saat halaman dimuat
document.addEventListener("DOMContentLoaded", function() {
    showSlide(slideIndex);
    if (document.getElementsByClassName("slide").length > 1) {
        autoSlideInterval = setInterval(autoSlide, 5000); // Ganti slide setiap 5 detik
    }
});


        const scrollTopBtn = document.getElementById("scrollTopBtn");

        window.onscroll = function() {
            toggleScrollButton();
        };

        function toggleScrollButton() {
            if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                scrollTopBtn.style.display = "block";
            } else {
                scrollTopBtn.style.display = "none";
            }
        }

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>