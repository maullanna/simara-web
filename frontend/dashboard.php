<?php 
session_start();
include_once '../backend/function.php';


if(!isset($_SESSION['username'])){
    header('Location:login.php');
    exit();
}

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

$queryTempatIbadah = "SELECT COUNT(*) AS totalTempatIbadah FROM tempat_ibadah_dashboard"; 
$resultTempatIbadah = mysqli_query($koneksi, $queryTempatIbadah);


if($resultTempatIbadah) {
    $dataTempatIbadah = mysqli_fetch_assoc($resultTempatIbadah);
    $totalTempatIbadah = $dataTempatIbadah['totalTempatIbadah'] ?? 0;
} else {
    die("Gagal Bro: = " . mysqli_error($koneksi));
}
$queryMadrasah = "SELECT COUNT(*) AS totalMadrasah FROM madrasah"; 
$resultMadrasah = mysqli_query($koneksi, $queryMadrasah);


if($resultTempatIbadah) {
    $dataMadrasah = mysqli_fetch_assoc($resultMadrasah);
    $totalMadrasah = $dataMadrasah['totalMadrasah'] ?? 0;
} else {
    die("Gagal Bro: = " . mysqli_error($koneksi));
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatitble" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard Saya</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/admin.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <!-- navigation -->
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
                    <a href="?page=dashboard">
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
                    <a href="program_dashboard.php">
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
            <!-- ======= card ===== -->
            <div class="cardBox">
                <div class="card">
                    <div>
                    <span class="number" id="total-pernikahan"><?php echo str_pad($totalPernikahan, 2, '0', STR_PAD_LEFT); ?></span>
                    <div class="cardName">Pernikahan</div>
                    </div>

                    <div class="iconBox">
                        <img src="img/nikah icon card.svg">
                    </div>
                </div>
                <div class="card">
                    <div>
                    <span class="number" id="total-isbat"><?php echo str_pad($totalIsbat, 2, '0', STR_PAD_LEFT); ?></span>
                    <div class="cardName">Isbat Nikah</div>
                    </div>

                    <div class="iconBox">
                        <img src="img/isbat icon card.svg" alt="">
                    </div>

                </div>
                <div class="card">
                    <div>
                        <div class="number"><?php echo $totalTempatIbadah; ?></div>
                        <div class="cardName">Tempat Ibadah</div>
                    </div>
                    <div class="iconBox">
                        <img src="img/ibadah-icon-card.svg" alt="">
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="number"><?php echo $totalMadrasah; ?></div>
                        <div class="cardName">Madrasah</div>
                    </div>

                    <div class="iconBox">
                        <img src="img/madrasah-icon-card copy.svg" alt="">
                    </div>
                </div>

            </div>
            <div class="details">
                <div class="chart1">
                    <canvas id="barChart"></canvas>
                </div>
                <div class="chart2">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
            <script src="main.js"></script>
        </div>
    </div>

                        <!--membuat timer di dashboard ini -->
     

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



function resetTimers() {
    console.log("Activity detected, resetting timers.");
    clearTimeout(logoutTimer);

    // Reset timer logout (30 menit)
    logoutTimer = setTimeout(function() {
        console.log("User logged out due to inactivity.");
        window.location.href = "logout.php";
    }, logoutTimeout);
}

window.addEventListener('mousemove', resetTimers);
window.addEventListener('click', resetTimers);
window.addEventListener('keypress', resetTimers);
    </script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php $mysqli->close(); ?>
