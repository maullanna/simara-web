
<?php
include '../backend/function.php';

$sql = "SELECT * FROM madrasah";
$result = $koneksi->query($sql);
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

.modal-content {
  background-color: #fefefe;
  margin: 15% auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

.close-modal {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 24px;
  font-weight: bold;
  cursor: pointer;
}
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
                <h1>Pendataan Madrasah di Kecamatan Karawang Barat</h1>
            </div>
            <input type="search" placeholder="Cari nama atau lokasi " class="search-input "><img src="img/search.png" style="position: absolute; width: 20px; margin-top: 3rem; left: 4.5%;">
            <div class="table">
                <div class="header-tabel">
                    <h1 style="font-size: 20PX; margin-top: 10px; color: #3B3E51; opacity: 60%; font-family: 'poppins', sans-serif; ">Menampilkan Data Semua Madrasah</h1>
                    <button id="btn-tambah"><ion-icon name="add-circle-outline" style="cursor: pointer;"></ion-icon>Tambah</button>
                </div>
                <!-- Modal Structure -->
                <div id="modal-popup" class="modal">
                    <div class="modal-content">
                        <div class="header-modal">
                            <span class="close-modal">&times;</span>
                            <h2 style="color: #3B3E51; font-family: 'poppins',sans-serif;">Tambah Data Madrasah</h2>
                        </div>
                        <form method="POST" action="proses_madrasah.php" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nama">Nama Madrasah:</label>
            <input type="text" id="nama" name="nama" required>
        </div>

        <div class="form-group">
            <label for="logo">Logo Madrasah:</label>
            <input type="file" id="logo" name="file_path" accept="image/*">
            <p class="help-text">Maksimal 1MB, format JPG, JPEG, PNG, atau GIF</p>
        </div>

        <div class="form-group">
            <label for="jenis">Jenis Madrasah:</label>
            <select name="jenis" id="jenis">
                <option value="RA">RA</option>
                <option value="MI">MI</option>
                <option value="MTs">MTs</option>
                <option value="MA">MA</option>
                </select>
        </div>
        <div class="form-group">
            <label for="deskripsi">Deskripsi Madrasah:</label>
            <textarea name="deskripsi" id="deskripsi" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="lokasi">Lokasi Madrasah:</label>
            <textarea name="lokasi" id="lokasi" rows="4"></textarea>
        </div>

        <div class="form-group">
            <label for="embed_map">Embed Map:</label>
            <textarea name="embed_map" id="embed_map" rows="4"></textarea>
        </div>


        <button type="submit" name="simpan">Simpan</button>
    </form>
                    </div>
                </div>
                <!-- Modal Konfirmasi Hapus -->
                <div id="modal-konfirmasi" class="modal-hapus">
                    <div class="modal-content-hapus">
                        <dotlottie-player src="https://lottie.host/bc8a120e-5ed4-4bca-a3c2-f257898c0810/sUEQGb5RuL.json" background="transparent" speed="1" style="width: 200px; height: 200px; margin-left: 6rem;" loop autoplay></dotlottie-player>
                        <h2>Yakin Hapus Data ?</h2>
                        <p>Pastikan Kembali Sebelum Hapus Data</p>
                        <div class="modal-buttons-hapus">
                            <button id="btn-hapus">Hapus</button>
                            <button id="btn-batal-hapus">Batal</button>
                        </div>
                    </div>
                </div>
                <table border="1">
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>File path</th>
      <th>Tingkat</th>
      <th>Lokasi</th>
      <th>Embed Map</th> 
      <th>Deskripsi Singkat</th>
      <th>Aksi</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
      $no = 1;
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . $row["nama"] . "</td>";
        echo "<td><img src='" . $row["file_path"] . "' width='100' height='50'></td>";
        echo "<td>" . $row["jenis"] . "</td>";
        echo "<td>" . $row["deskripsi"] . "</td>";
        echo "<td>" . $row["lokasi"] . "</td>";
        echo "<td>" . $row["embed_map"] . "</td>";
        echo "<td>
          <a href='edit_madrasah.php?id=" . $row["id"] . "'>Edit</a> | 
          <a href='delete_madrasah.php?id=" . $row["id"] . "'>Delete</a>
        </td>";
        echo "</tr>";
      }
    } else {
      echo "Tidak ada data madrasah";
    }
    ?>
  </table>
            </div>
        </div>
        <script>// Get the modal
document.addEventListener("DOMContentLoaded", function() {
  const modal = document.getElementById("modal-popup");
  const btn = document.getElementById("btn-tambah");
  const span = document.getElementsByClassName("close-modal")[0];

  btn.onclick = function() {
    modal.style.display = "block";
  }

  span.onclick = function() {
    modal.style.display = "none";
  }

  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  }
});
</script>
        <script src="js/uji.php"></script>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="https://code.iconify.design/3/3.1.0/iconify.min.js"></script>
        <script src="https://unpkg.com/@dotlottie/player-component@latest/dist/dotlottie-player.mjs" type="module"></script>

</body>

</html>
