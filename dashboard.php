<?php
session_start();
include "koneksi.php";

if(!isset($_SESSION['login'])){
    header("Location: login.php");
}

/* Statistik */
$total_produk = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM produk"))['total'];

$total_stok = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(stok_produk) as total FROM produk"))['total'];

$total_transaksi = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as total FROM transaksi"))['total'];

$total_penjualan = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM(total_harga) as total FROM transaksi"))['total'];

/* Transaksi terbaru */
$transaksi = mysqli_query($conn,"
SELECT transaksi.*, produk.nama_produk 
FROM transaksi 
JOIN produk ON transaksi.id_produk = produk.id_produk
ORDER BY id_transaksi DESC
LIMIT 5
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link rel="stylesheet" href="style.css">

<style>

/* Grid Dashboard */
.dashboard-grid{
display:grid;
grid-template-columns: repeat(auto-fit, minmax(200px,1fr));
gap:20px;
margin-bottom:30px;
}

/* Card Statistik */
.card{
padding:20px;
border-radius:12px;
color:white;
box-shadow:0 8px 20px rgba(0,0,0,0.1);
}

.card h3{
font-size:28px;
margin-top:10px;
}

/* Warna Card */
.card1{background:linear-gradient(45deg,#ff7b54,#ff5722);}
.card2{background:linear-gradient(45deg,#4CAF50,#2e7d32);}
.card3{background:linear-gradient(45deg,#2196F3,#1565c0);}
.card4{background:linear-gradient(45deg,#9c27b0,#6a1b9a);}

</style>
</head>

<body>

<div class="container">

<h2>Dashboard Toko Roti</h2>

<div class="nav">
<a href="produk.php">Kelola Produk</a>
<a href="transaksi.php">Transaksi</a>
<a href="logout.php">Logout</a>
</div>

<!-- Statistik -->
<div class="dashboard-grid">

<div class="card card1">
Total Produk
<h3><?php echo $total_produk; ?></h3>
</div>

<div class="card card2">
Total Stok
<h3><?php echo $total_stok; ?></h3>
</div>

<div class="card card3">
Total Transaksi
<h3><?php echo $total_transaksi; ?></h3>
</div>

<div class="card card4">
Total Penjualan
<h3>Rp <?php echo number_format($total_penjualan); ?></h3>
</div>

</div>

<!-- Transaksi Terbaru -->
<h2>Transaksi Terbaru</h2>

<table>
<tr>
<th>Tanggal</th>
<th>Produk</th>
<th>Jumlah</th>
<th>Total</th>
</tr>

<?php while($t = mysqli_fetch_assoc($transaksi)){ ?>

<tr>
<td><?php echo $t['tanggal']; ?></td>
<td><?php echo $t['nama_produk']; ?></td>
<td><?php echo $t['jumlah']; ?></td>
<td>Rp <?php echo number_format($t['total_harga']); ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>