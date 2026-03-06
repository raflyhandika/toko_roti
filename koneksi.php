<?php
$conn = mysqli_connect("localhost","root","","db_toko_roti");

if(!$conn){
    die("Koneksi gagal : " . mysqli_connect_error());
}
?>