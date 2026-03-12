<?php
session_start();
require "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
    exit;
}

/* Ambil data produk */
$stmt = $pdo->query("SELECT * FROM produk ORDER BY id_produk DESC");
$produk = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
<title>Data Produk</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<h2>Data Produk</h2>

<a href="tambah_produk.php">Tambah Produk</a>

<table border="1" cellpadding="10">

<tr>
<th>No</th>
<th>Foto</th>
<th>Nama Produk</th>
<th>Stok</th>
<th>Harga</th>
<th>Aksi</th>
</tr>

<?php 
$no = 1;
foreach($produk as $row){
?>

<tr>
<td><?php echo $no++; ?></td>
<td>
<img src="upload/<?php echo $row['foto']; ?>" width="70"></td>
<td><?php echo $row['nama_produk']; ?></td>
<td><?php echo $row['stok_produk']; ?></td>
<td>Rp <?php echo number_format($row['harga_produk']); ?></td>

<td>
<a href="edit_produk.php?id=<?php echo $row['id_produk']; ?>">Edit</a> |
<a href="hapus_produk.php?id=<?php echo $row['id_produk']; ?>"
onclick="return confirm('Yakin ingin hapus?')">Hapus</a>
</td>

</tr>

<?php } ?>

</table>

<br>
<a href="dashboard.php">Kembali ke Dashboard</a>

</div>

</body>
</html>