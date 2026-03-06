<?php
include "koneksi.php";
$data = mysqli_query($conn,"SELECT * FROM produk");
?>

<link rel="stylesheet" href="style.css">

<div class="container">

<h2>Data Produk</h2>

<a href="tambah_produk.php" class="button">+ Tambah Produk</a>

<table>
<tr>
<th>Foto</th>
<th>Nama</th>
<th>Harga</th>
<th>Stok</th>
<th>Aksi</th>
</tr>

<?php while($row = mysqli_fetch_assoc($data)){ ?>

<tr>

<td>
<img src="upload/<?php echo $row['foto']; ?>" width="70">
<td><?php echo $row['nama_produk']; ?></td>
<td>Rp <?php echo number_format($row['harga_jual']); ?></td>
<td><?php echo $row['stok_produk']; ?></td>
</td>

<td>
<a href="edit_produk.php?id=<?php echo $row['id_produk']; ?>" class="action edit">Edit</a>
<a href="hapus_produk.php?id=<?php echo $row['id_produk']; ?>" class="action delete">Hapus</a>
</td>

</tr>

<?php } ?>

</table>

</div>