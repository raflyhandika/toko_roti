<?php
require "koneksi.php";

$id = $_GET['id'];

/* jika tidak ada session */
if(!isset($_SESSION['login']))

    /* cek cookie */
    if(isset($_COOKIE['login']) && $_COOKIE['login'] == "true"){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $_COOKIE['username'];
    }else{
        header("Location: login.php");
    }

/* Ambil data produk */
$stmt = $pdo->prepare("SELECT * FROM produk WHERE id_produk = :id");
$stmt->execute(['id'=>$id]);
$row = $stmt->fetch();

if(isset($_POST['update'])){

    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    $foto = $_FILES['foto']['name'];
    $tmp  = $_FILES['foto']['tmp_name'];

    /* Jika upload foto baru */
    if($foto != ""){

        move_uploaded_file($tmp,"upload/".$foto);

        $stmt = $pdo->prepare("UPDATE produk SET
        nama_produk = :nama,
        harga_jual  = :harga,
        stok_produk = :stok,
        foto        = :foto
        WHERE id_produk = :id");

        $stmt->execute([
            'nama'=>$nama,
            'harga'=>$harga,
            'stok'=>$stok,
            'foto'=>$foto,
            'id'=>$id
        ]);

    }else{

        $stmt = $pdo->prepare("UPDATE produk SET
        nama_produk = :nama,
        harga_produk  = :harga,
        stok_produk = :stok
        WHERE id_produk = :id");

        $stmt->execute([
            'nama'=>$nama,
            'harga'=>$harga,
            'stok'=>$stok,
            'id'=>$id
        ]);
    }

    echo "<script>
    alert('Produk berhasil diupdate');
    window.location='produk.php';
    </script>";
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">

<h2>Edit Produk</h2>

<form method="POST" enctype="multipart/form-data">

<label>Nama Produk</label>
<input type="text" name="nama" value="<?php echo $row['nama_produk']; ?>" required>

<label>Harga</label>
<input type="number" name="harga" value="<?php echo $row['harga_produk']; ?>" required>

<label>Stok</label>
<input type="number" name="stok" value="<?php echo $row['stok_produk']; ?>" required>

<label>Foto Sekarang</label><br>
<img src="upload/<?php echo $row['foto']; ?>" width="100"><br><br>

<label>Ganti Foto</label>
<input type="file" name="foto">

<button name="update">Update</button>

</form>

<br>
<a href="produk.php">← Kembali</a>

</div>