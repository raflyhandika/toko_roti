<?php
include "koneksi.php";

if(isset($_POST['proses'])){
    $id_produk = $_POST['produk'];
    $jumlah = $_POST['jumlah'];

    $query = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk='$id_produk'");
    $data = mysqli_fetch_assoc($query);

    if($jumlah <= $data['stok_produk']){
        $total = $jumlah * $data['harga_jual'];

        mysqli_query($conn,"INSERT INTO transaksi 
        VALUES('','".date('Y-m-d')."','$id_produk','$jumlah','$total')");

        mysqli_query($conn,"UPDATE produk 
        SET stok_produk = stok_produk - $jumlah 
        WHERE id_produk='$id_produk'");

        echo "Transaksi berhasil!";
    }else{
        echo "Stok tidak cukup!";
    }
}

$produk = mysqli_query($conn,"SELECT * FROM produk");
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Transaksi Penjualan</h2>

<form method="POST">
Produk :
<select name="produk">
<?php while($p = mysqli_fetch_assoc($produk)){ ?>
<option value="<?= $p['id_produk']; ?>">
<?= $p['nama_produk']; ?> (Stok: <?= $p['stok_produk']; ?>)
</option>
<?php } ?>
</select><br>

Jumlah : <input type="number" name="jumlah"><br>
<button name="proses">Proses</button>
</form>

<br>
<a href="dashboard.php">Kembali</a>
</div>