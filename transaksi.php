<?php
require "koneksi.php";

if(isset($_POST['proses'])){

    $id_produk = $_POST['produk'];
    $jumlah = $_POST['jumlah'];

    /* Ambil data produk */
    $stmt = $pdo->prepare("SELECT * FROM produk WHERE id_produk = :id");
    $stmt->execute(['id' => $id_produk]);
    $data = $stmt->fetch();

    if($jumlah <= $data['stok_produk']){

        $total = $jumlah * $data['harga_produk'];

        /* Simpan transaksi */
        $stmt = $pdo->prepare("INSERT INTO transaksi 
        (tanggal,id_produk,jumlah,total_harga)
        VALUES (:tanggal,:produk,:jumlah,:total)");

        $stmt->execute([
            'tanggal' => date('Y-m-d'),
            'produk' => $id_produk,
            'jumlah' => $jumlah,
            'total' => $total
        ]);

        /* Update stok */
        $stmt = $pdo->prepare("UPDATE produk 
        SET stok_produk = stok_produk - :jumlah
        WHERE id_produk = :id");

        $stmt->execute([
            'jumlah' => $jumlah,
            'id' => $id_produk
        ]);

        echo "Transaksi berhasil!";

    }else{
        echo "Stok tidak cukup!";
    }
}

/* Ambil produk */
$stmt = $pdo->query("SELECT * FROM produk");
$produk = $stmt->fetchAll();

/* jika tidak ada session */
if(!isset($_SESSION['login']))

    /* cek cookie */
    if(isset($_COOKIE['login']) && $_COOKIE['login'] == "true"){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $_COOKIE['username'];
    }else{
        header("Location: login.php");
    }
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Transaksi Penjualan</h2>

<form method="POST">

Produk :
<select name="produk">

<?php foreach($produk as $p){ ?>

<option value="<?= $p['id_produk']; ?>">
<?= $p['nama_produk']; ?> (Stok: <?= $p['stok_produk']; ?>)
</option>

<?php } ?>

</select><br>

Jumlah :
<input type="number" name="jumlah" required><br>

<button name="proses">Proses</button>

</form>

<br>
<a href="dashboard.php">Kembali</a>

</div>