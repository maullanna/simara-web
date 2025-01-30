<?php
include_once '../backend/function.php';

$currentPeriod = date('Y-m');
$query = "SELECT pernikahan, isbat_nikah FROM pernikahan WHERE periode = '$currentPeriod' ORDER BY id DESC LIMIT 1";
$result = mysqli_query($koneksi, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $data = mysqli_fetch_assoc($result);
    echo json_encode([
        'totalPernikahan' => $data['pernikahan'],
        'totalIsbat' => $data['isbat_nikah']
    ]);
} else {
    echo json_encode([
        'totalPernikahan' => 0,
        'totalIsbat' => 0
    ]);
}

mysqli_close($koneksi);
?>