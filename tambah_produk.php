<?php
require "koneksi.php";

if(isset($_POST['simpan'])){

$nama  = trim($_POST['nama_produk']);
$stok  = (int)$_POST['stok_produk'];
$harga = (int)$_POST['harga_produk'];

/* VALIDASI NAMA */
if(!preg_match("/^[a-zA-Z\s]+$/",$nama)){
    die("Nama produk tidak boleh mengandung angka");
}

/* VALIDASI STOK */
if($stok < 0){
    die("Stok tidak boleh negatif");
}

/* VALIDASI HARGA */
if($harga <= 0){
    die("Harga harus lebih dari 0");
}

/* UPLOAD FOTO */
$foto = $_FILES['foto']['name'];
$tmp  = $_FILES['foto']['tmp_name'];

$allowed = ['jpg','jpeg','png'];
$ext = strtolower(pathinfo($foto, PATHINFO_EXTENSION));

if(!in_array($ext,$allowed)){
    die("Format gambar hanya jpg jpeg png");
}

move_uploaded_file($tmp,"upload/".$foto);

/* INSERT DATA */
$stmt = $pdo->prepare("
INSERT INTO produk
(nama_produk,harga_produk,stok_produk,foto)
VALUES(:nama,:harga,:stok,:foto)
");

$stmt->execute([
'nama'=>$nama,
'harga'=>$harga,
'stok'=>$stok,
'foto'=>$foto
]);

header("Location: produk.php");
exit;

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Tambah Produk</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>Tambah Produk</h2>

<form method="POST" enctype="multipart/form-data">

<label>Nama Produk</label>
<input type="text" name="nama_produk" required>

<label>Stok</label>
<input type="number" name="stok_produk" required>

<label>Harga</label>
<input type="number" name="harga_produk" required>

<label>Foto Produk</label>
<input type="file" name="foto" required>

<button type="submit" name="simpan">Simpan</button>

</form>

<a href="produk.php">Kembali</a>

</div>

</body>
</html>