<?php 

include_once '../backend/function.php';


if(isset($_GET['id'])) {
    $id = $_GET['id'];
}


$result = mysqli_query($koneksi, "SELECT * FROM pernikahan WHERE id = '$id'") or die (mysqli_error($koneksi));
$nikah = mysqli_fetch_assoc($result);


if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tahun = $_POST['periode'];
    $pernikahan = $_POST['pernikahan'];
    $isbat_nikah = $_POST['isbat_nikah'];

    $queryUpdate = "UPDATE pernikahan SET periode = '$periode', pernikahan = '$pernikahan', isbat_nikah = '$isbat_nikah' where id = '$id'";
if(mysqli_query($koneksi, $queryUpdate)){
    header('Location: pernikahan_dashboard.php');
        exit();
    
}else {
    
}

}


?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pernikahan</title>
</head>
<body>
    <form action="" method="post">

    
     <label for="">Periode</label>
     <input type="number" name="periode" id="periode" value="<?php echo $nikah['periode']; ?>">
     <label for="">Penikahan</label>
     <input type="number" name="pernikahan" id="pernikahan" value="<?php echo $nikah['pernikahan']; ?>">
     <label for="">Isbat Pernikahan</label>
     <input type="number" name="isbat_nikah" id="isbat_nikah" value="<?php echo $nikah['isbat_nikah']; ?>">
     <button type="submit">Edit</button>
    </form>
</body>
</html>