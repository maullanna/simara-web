<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="nama">Nama Tempat Ibadah:</label>
    <input type="text" name="nama" id="nama" required>

    <label for="alamat">Alamat:</label>
    <input type="text" name="alamat" id="alamat" required>

    <label for="jenis">Jenis:</label>
    <select name="jenis" id="jenis" required>
        <option value="Masjid">Masjid</option>
        <option value="Gereja">Gereja</option>
        <option value="Klenteng">Klenteng</option>
        <option value="Vihara">Vihara</option>
    </select>

    <label for="foto">Upload Foto:</label>
    <input type="file" name="foto" id="foto" required>

    <input type="submit" value="Tambah Tempat Ibadah">
</form>
</body>
</html>
