<?php 
include_once '../backend/function.php';

$currentPeriod = date('Y-m'); 

// Query to get the most recent pernikahan and isbat_nikah counts for the current period
$query = "SELECT pernikahan, isbat_nikah FROM pernikahan WHERE periode = '$currentPeriod' ORDER BY id DESC LIMIT 1"; 
$result = mysqli_query($koneksi, $query);

$data = mysqli_fetch_assoc($result);

// Set default values if data is not available
$totalPernikahan = $data['pernikahan'] ?? 0; 
$totalIsbat = $data['isbat_nikah'] ?? 0; 

// Prepare response array to send as JSON
$response = [
    'totalPernikahan' => $totalPernikahan,
    'totalIsbat' => $totalIsbat,
];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="style.css">
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
            <a href="#" id="li">Beranda</a>
            <a href="#" id="li">Profil</a>
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
                    <a href="#" id="link">Suscatin</a>
                    <a href="#" id="link">Wakaf</a>
                    <a href="tempat_ibadah.php" id="link">Tempat Ibadah</a>
                    <a href="#" id="link">Madrasah</a>
                </div>
            </div>
            <a href="#" id="li">Program</a>

        </div>
        <div class="login_staff">
            <a href="login.php">Masuk</a>
        </div>
    </div>
    <div class="banner">
        <div class="text_KUA" style="width:35rem;">
            <h1>Kantor Urusan Agama Kecamatan Karawang Barat</h1><br>
            <p>Senin - Jumat 07.30 s/d 16.00</p>
        </div>
        <div class="kunjungi"  style="cursor: pointer;" onclick="window.open('https://maps.app.goo.gl/T1r7P6KLZvJ2NZLx7', '_blank')">
    <a>
        Kunjungi
        <img src="img/kunjungi icon.svg" width="17px" height="17px" alt="Icon">
    </a>
</div>

    </div>
    <div class="angka_pernikahan">
        <div class="pernikahan">
            <img src="img/nikah icon.svg" width="60px" height="60px">
            <h2>Pernikahan</h2>
            <p>
            <span class="jumlah" id="total-pernikahan"><?php echo str_pad($totalPernikahan, 2, '0', STR_PAD_LEFT); ?></span>
            / Bulan ini</p>      
          </div>
        <div class="isbat">
            <img src="img/isbat icon.svg" width="60px" height="60px">
            <h2>Isbat Nikah</h2>
            <p>
            <span class="jumlah" id="total-isbat"><?php echo str_pad($totalIsbat, 2, '0', STR_PAD_LEFT); ?></span>
            / Bulan ini</p>
            </div>
    </div>
    <div class="kategori">
        <div class="suscatin">
            <div class="suscatin_desk">
                <img src="img/suscatin.svg" style="position: absolute; top: -22%; left: 70%;">
                <span style="color: #3B3E51; opacity: 60%; font-size: 13px;">KUA PUSAKA</span>
                <h3>Suscatin</h3>
                <p>Kursus singkat yang diselenggarakan oleh Kantor Urusan Agama (KUA) untuk calon pengantin</p>
            </div>
        </div>
        <div class="tempat_ibadah">
            <div class="tempat_ibadah_desk">
                <img src="img/tempat ibadah icon.svg" style="position: absolute; top: -22%; left: 70%; ">
                <span style="color: #3B3E51; opacity: 60%; font-size: 13px; ">KUA PUSAKA</span>
              <h3 >Tempat Ibadah</h3>
                <p>List data tempat atau fasilitas Keagamaan antar umat beragama di Kecamatan Karawang Barat</p>
            </div>
        </div>
        <div class="wakaf">
            <div class="wakaf_desk ">
                <img src="img/wakaf icon.svg" style="position: absolute; top: -22%; left: 70%; ">
                <span style="color: #3B3E51; opacity: 60%; font-size: 13px; ">KUA PUSAKA</span>
                <h3>Wakaf</h3>
                <p>Konsep dalam Islam di mana seseorang menyerahkan harta benda untuk tujuan amal secara permanen</p>
            </div>
        </div>
        <div class="madrasah">
            <div class="madrasah_desk ">
                <img src="img/madrasah icon.svg" style="position: absolute; top: -22%; left: 70%; ">
                <span style="color: #3B3E51; opacity: 60%; font-size: 13px; ">KUA PUSAKA</span>
                <h3>Madrasah</h3>
                <p>List data sekolah agama islam dari berbagai tingkatan di Kecamatan Karawang Barat</p>
            </div>
        </div>
    </div>
    </div>
    <div class="pembatas ">
        <p>Alur Pendaftaran Pernikahan</p>
        <a href=""><ion-icon name="chevron-forward-outline"></ion-icon></a>
    </div>
    <div class="alur_pernikahan_row1">
        <div class="langkah_1">
            <img src="img/Filled Circle.svg" id="circle">
            <p><span>1</span> Siapkan Berkas Persyaratan</p>
            <img src="img/langkah 1.svg " id="berkas">
            <ol>
                <li>Foto Copy KTP</li>
                <li>Foto Copy KTP Orang Tua</li>
                <li>Foto Copy KTP Wali Nikah</li>
                <li>Foto Copy KTP Saksi Nikah</li>
                <li>Foto Copy Ijazah</li>
                <li>Foto Copy Kartu Keluarga</li>
                <li>Foto Copy Akta Kelahiran</li>
                <li>Pas Photo 2x3 (4 Lembar) & 4x6 (1 Lembar)</li>
                <li>Akta Cerai (Bagi Duda/Janda Cerai)</li>
                <li>N6 (Bagi Duda/Janda Mati)</li>
                <li>Surat Izin Kawin dari Komandan (Bagi Anggota TNI POLRI)</li>
            </ol>
        </div>
        <div class="langkah_2">
            <img src="img/Filled Circle.svg " id="circle">
            <p><span>2</span>Datang ke Kelurahan/Desa</p>
            <img src="img/gedung.svg " id="gedung">
            <ol>
                <li>Meminta Formulir N1,N2,N3,N4,N5,N6 & SKW</li>
                <li>Mengisi Formulir dan ditandatangani oleh Lurah/Kepala Desa</li>
            </ol>
        </div>
        <div class="langkah_3">
            <img src="img/Filled Circle.svg " id="circle">
            <p><span>3</span>Membawa Persyaratan ke KUA</p>
            <img src="img/persyaratan.svg " id="persyaratan">
            <ol>
                <li>Membawa Semua Persyaratan dari Kelurahan/Desa</li>
                <li>Meminta Billing Pembayaran untuk ke Kantor POS</li>
            </ol>
        </div>
    </div>
    <div class="alur_pernikahan_row2">
        <div class="langkah_4 ">
            <img src="img/Filled Circle.svg" id="circle">
            <p><span>4</span>Membayar Billing Pembayaran</p>
            <img src="img/bayar.svg" id="bayar">
            <ol>
                <li>Menyerahkan Billing Pembayaran dari KUA</li>
                <li>Menyetorkan biaya Nikah</li>
                <li> Meminta Slip Setoran</li>
            </ol>
        </div>
        <div class="langkah_5 ">
            <img src="img/Filled Circle.svg" id="circle">
            <p><span>5</span>Menyerahkan Slip Pembayaran</p>
            <img src="img/slip bayar.svg" id="slip_bayar">
            <ol>
                <li>Menyerahkan Slip Setoran dari Kantor POS (Asli & 4 Rangkap Foto Copy)</li>
                <li>Menerima Surat untuk Penataran Calon Pengantin</li>
            </ol>
        </div>
        <div class="langkah_6">
            <img src="img/Filled Circle.svg" id="circle">
            <p><span>6</span>Penataran (Suscatin)</p>
            <img src="img/suscatin_2.svg" id="suscatin">
            <ol>
                <li>Menerima Materi Bimbingan Kursus Calon Pengantin (Suscatin) dan Praktek Ijab Qobul.</li>
            </ol>
        </div>
    </div>
    <div class="alur_pernikahan_row3">
        <div class="langkah_7">
            <img src="img/Filled Circle.svg " id="circle">
            <p><span>7</span>Prosesi Akad Nikah</p>
            <img src="img/nikah.svg" id="nikah">
            <ol>
                <li>Menunggu dan Menghubungi Petugas KUA (Penghulu) pada saat pelaksanaan Akad Nikah.</li>
            </ol>
        </div>
        <div class="langkah_8 ">
            <img src="img/Filled Circle.svg " id="circle">
            <p><span>8</span>Penyerahan Buku Nikah</p>
            <img src="img/buku nikah.svg " id="buku_nikah">
            <ol>
                <li>Penyerahan Buku Nikah kepada pengantin sebagai tanda bukti bahwa perkawinan yang telah dilaksanakan sah secara hukum negara.</li>
            </ol>
        </div>
    </div>
    <div class="pembatas_2 ">
        <p>Program Kami</p>

        <a href=""><ion-icon name="chevron-forward-outline"></ion-icon></a>

        <a href=""><a href=""><ion-icon name="chevron-forward-outline"></ion-icon></a></a>

    </div>
    <div class="program_kami ">
        <div class="program_1 ">
        <div class="konten_1 ">
                <h4>Bimbingan Remaja Usia Sekolah di SMKN 1 Karawang</h4>
                <span style="font-size: 13px; margin-top: 3px; color: #31502C; font-weight: 600; ">28 Agustus 2024</span>
                <p>Sebanyak 50 siswa-siswi SMKN 1 Karawang mengikuti kegiatan Bimbingan Remaja Usia Sekolah (BRUS) yang digelar</p>
                <a href="detail_edukasi.php" style="font-size: 13px; margin-top: 6px; color: #31502C; font-weight: 600; float: right; text-decoration: none;">Baca selengkapnya</a>
            </div>
        </div>
        <div class="program_2 ">
            <div class="konten_2 ">
                <h4>Edukasi Pernikahan Dini di SMP Negeri 5 Karawang</h4>
                <span style="font-size: 13px; margin-top: 3px; color: #31502C; font-weight: 600; ">21 Mei 2024</span>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus ullam illo iusto totam dolorem, vero incidunt </p>
                <span style="font-size: 13px; margin-top: 6px; color: #31502C; font-weight: 600; float: right; ">Baca selengkapnya</span>
            </div>
        </div>
        <div class="program_3 ">
            <div class="konten_3 ">
                <h4>Edukasi Pernikahan Dini di SMP Negeri 5 Karawang</h4>
                <span style="font-size: 13px; margin-top: 3px; color: #31502C; font-weight: 600; ">21 Mei 2024</span>
                <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus ullam illo iusto totam dolorem, vero incidunt</p>
                <span style="font-size: 13px; margin-top: 6px; color: #31502C; font-weight: 600; float: right; ">Baca selengkapnya</span>
            </div>
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
    <button id="scrollTopBtn" onclick="scrollToTop()"><img src="img/icons8-arrow-up-30.png" alt=""></button>
    <script>
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


     
$(document).ready(function() {
    $('#form-pernikahan').on('submit', function(e) {
        e.preventDefault(); // Mencegah form untuk submit secara biasa

        var formData = $(this).serialize(); // Serialize data dari form

        $.ajax({
            url: 'beranda.php', // Kirim ke pernikahan_dashboard.php
            method: 'POST',
            data: formData,
            success: function(response) {
                // Setelah berhasil, panggil fetchData() untuk mengambil data terbaru
                fetchData();
            },
            error: function() {
                alert('Terjadi kesalahan saat menyimpan data');
            }
        });
    });
});

// Fungsi untuk mengambil data terbaru
function fetchData() {
    $.ajax({
        url: 'pernikahan_dashboard.php', // File PHP untuk mengambil data terbaru
        method: 'GET',
        success: function(response) {
            // Anggap response berisi JSON yang memiliki data terbaru, seperti total pernikahan dan isbat
            var data = JSON.parse(response);

            // Update angka pada halaman dengan data terbaru
            $('#total-pernikahan').text(data.totalPernikahan);
            $('#total-isbat').text(data.totalIsbat);

            // Jalankan animasi transisi angka jika diperlukan
            animateNumber('total-pernikahan', 0, data.totalPernikahan, 2000);
            animateNumber('total-isbat', 0, data.totalIsbat, 2000);
        },
        error: function() {
            alert('Error fetching data');
        }
    });
}

// Fungsi animasi untuk transisi angka
function animateNumber(id, startValue, endValue, duration) {
    const element = document.getElementById(id);
    let currentValue = startValue;
    const increment = (endValue - startValue) / (duration / 50000); // Pembagian untuk interval
    const interval = setInterval(() => {
        currentValue += increment;
        if (currentValue >= endValue) {
            clearInterval(interval); // Hentikan interval jika sudah mencapai angka akhir
            currentValue = endValue; // Pastikan nilai akhir tercapai
        }
        element.textContent = Math.round(currentValue).toString().padStart(2, '0'); // Update nilai
    }, 100); // Interval setiap 50ms
}

    </script>


    <script src="js/script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
