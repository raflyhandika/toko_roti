<?php
include "koneksi.php";

if(isset($_POST['simpan'])){

    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];

    $folder = "upload/";

    move_uploaded_file($tmp,"upload/".$foto);


    mysqli_query($conn,"INSERT INTO produk 
    VALUES('', '$nama','$harga','$stok','$foto')");

    echo "<script>
            alert('Produk berhasil ditambahkan');
            window.location='produk.php';
          </script>";
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

<h2>Tambah Produk Roti</h2>

<form method="POST" enctype="multipart/form-data">

<label>Nama Produk</label>
<input type="text" name="nama" placeholder="Contoh: Roti Coklat" required>

<label>Harga Jual</label>
<input type="number" name="harga" placeholder="Contoh: 12000" required>

<label>Stok Produk</label>
<input type="number" name="stok" placeholder="Contoh: 50" required>

<label>Foto Produk</label>
<input type="file" name="foto" required>

<button type="submit" name="simpan">Simpan Produk</button>

</form>

<br>

<a href="produk.php">← Kembali ke Data Produk</a>

</div>

</body>
</html>