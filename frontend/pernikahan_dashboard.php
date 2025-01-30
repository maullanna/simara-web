<?php
session_start();
include_once '../backend/function.php';

if(!isset($_SESSION['username'])){
    header('Location:login.php');
    exit();
}



if (isset($_POST['simpan'])) {
    $periode = mysqli_real_escape_string($koneksi, $_POST['periode']);
    $pernikahan = mysqli_real_escape_string($koneksi, $_POST['pernikahan']);
    $isbat_nikah = mysqli_real_escape_string($koneksi, $_POST['isbat_nikah']);

    // Insert query
    $query = "INSERT INTO pernikahan (periode, pernikahan, isbat_nikah) 
              VALUES ('$periode', '$pernikahan', '$isbat_nikah')";
    
    // Execute query and check for success
    if (mysqli_query($koneksi, $query)) {
        // Redirect to the same page to prevent duplicate submissions on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<script>alert('Error: " . mysqli_error($koneksi) . "');</script>";
    }
}

// Select query to retrieve data for display
$query = "SELECT * FROM pernikahan";
$result = mysqli_query($koneksi, $query);



mysqli_close($koneksi);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatitble" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pernikahan</title>
    <!-- Stylesheet -->
    <link rel="stylesheet" href="css/style_pernikahan.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
    </style>

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
            <div class="cardBox">
                <h1>Pendataan pernikahan & isbat-nikah di kecamatan karawang barat</h1>
            </div>
            <div class="details">
                <div class="chart1">
                    <canvas id="barChart"></canvas>
                </div>
                <div class="chart2">
                    <canvas id="lineChart"></canvas>
                </div>
            </div>
            <div class="table" >
                <div class="header-tabel"  >
                    <h1 style="font-size: 20PX; margin-top: 10px; color: #3B3E51; opacity: 60%; font-family: 'poppins', sans-serif; cursor:pointer ">Menampilkan Data Pernikahan & Isbat-nikah</h1>
                    <button id="openModalBtn"><ion-icon name="add-circle-outline" style="cursor: pointer;"></ion-icon>Tambah</button>
                </div>
                <!-- Modal Structure -->
                <div id="modal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Tambah Data Pernikahan</h2>
        <form method="POST" action="">
        <label for="periode">Periode:</label>
          <input type="date" id="periode" name="periode" placeholder="YYYYMM" required />

          <label for="pernikahan">Pernikahan:</label>
          <input type="number" id="pernikahan" name="pernikahan" required />

          <label for="isbat_nikah">Isbat Nikah:</label>
          <input type="number" id="isbat_nikah" name="isbat_nikah" required />

          <div class="modal-buttons">
            <button type="button" id="btn-batal" onclick="closeModal()">Batal</button>
            <button type="submit" name="simpan" id="btn-simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
<!-- Modal Konfirmasi Hapus -->

<!-- Modal Konfirmasi Hapus -->
<div id="modal-konfirmasi" class="modal-hapus">
                    <div class="modal-content-hapus">
                        <dotlottie-player src="https://lottie.host/bc8a120e-5ed4-4bca-a3c2-f257898c0810/sUEQGb5RuL.json" background="transparent" speed="1" style="width: 200px; height: 200px; margin-left: 6rem;" loop autoplay></dotlottie-player>
                        <h2>Yakin Hapus Data ?</h2>
                        <p>Pastikan Kembali Sebelum Hapus Data</p>
                        <div class="modal-buttons-hapus" style="margin-top: 100px;">
                            <button id="btn-hapus">Hapus</button>
                            <button id="btn-batal-hapus">Batal</button>
                        </div>
                    </div>
                </div>

                <table>
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Pernikahan</th>
                        <th>Isbat Nikah</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php 
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)) :
                    ?>
                    <tr>
                        <td><?php echo  $no ?></td>
                        <td><?php echo $row['periode']; ?></td>
                        <td><?php echo $row['pernikahan']; ?></td>
                        <td><?php echo $row['isbat_nikah']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id'];?>"><ion-icon name="create-outline" class="icon-edit"></ion-icon></a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>"><ion-icon name="trash-outline" class="icon-delete" style="cursor: pointer;"></ion-icon></a>
                        </td>
                    </tr>
                    <?php $no++; endwhile;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

     
    <script>

// Timer logout (Set ke 10 detik dulu yaa)




      document.getElementById("openModalBtn").onclick = function () {
        document.getElementById("modal").style.display = "block";
      };

      function closeModal() {
        document.getElementById("modal").style.display = "none";
      }

      window.onclick = function (event) {
        if (event.target === document.getElementById("modal")) {
          closeModal();
        }
      };



    // hapus 
    document.addEventListener("DOMContentLoaded", () => {
    const modal = document.getElementById("modal-konfirmasi");
    const btnHapus = document.getElementById("btn-hapus");
    const btnBatal = document.getElementById("btn-batal-hapus");
    const deleteIcons = document.querySelectorAll(".icon-delete");

    let deleteUrl = ""; // Variable to store the delete link

    // Show the modal when delete icon is clicked
    deleteIcons.forEach(icon => {
        icon.addEventListener("click", (e) => {
            e.preventDefault();
            deleteUrl = icon.parentElement.href; // Get the delete link
            modal.style.display = "block"; // Show the modal
        });
    });

    // Close the modal on cancel
    btnBatal.addEventListener("click", () => {
        modal.style.display = "none"; // Hide the modal
        deleteUrl = ""; // Reset the delete link
    });

    // Proceed with deletion
    btnHapus.addEventListener("click", () => {
        if (deleteUrl) {
            window.location.href = deleteUrl; // Redirect to delete link
        }
    });

    // Close modal when clicking outside of it
    window.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.style.display = "none"; // Hide the modal
            deleteUrl = ""; // Reset the delete link
        }
    });
});


         // JQuery Ajaz yang menghandle submission 
         $(document).ready(function() {
    $('#form-pernikahan').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        var formData = $(this).serialize(); // Serialize the form data

        $.ajax({
            url: 'pernikahan_dashboard.php', // The same page, but handling via AJAX
            method: 'POST',
            data: formData,
            success: function(response) {
                // After submission, reload data for display
                fetchData();
            },
            error: function() {
                alert('Error saving data');
            }
        });
    });
});



const logoutTimeout = 30 * 60 * 1000; 


let logoutTimer = setTimeout(function() {
    console.log("User logged out due to inactivity.");
    window.location.href = "logout.php"; 
}, logoutTimeout);

// Fungsi untuk reset timer jika ada aktivitas selama ada aktivitas tidak di keluarkan ke login..
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



<script src="js/pernikahan.js"></script>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
    <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

</body>

</html>

<?php $mysqli->close(); ?>
