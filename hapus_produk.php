<?php
require "koneksi.php";

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM produk WHERE id_produk = :id");
$stmt->execute(['id' => $id]);

header("Location: produk.php");
exit;
?>