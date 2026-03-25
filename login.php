<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

/* cek user */
$stmt = $pdo->prepare("SELECT * FROM admin WHERE username=? AND password=?");
$stmt->execute([$username,$password]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if($user){

    /* SESSION */
    $_SESSION['login'] = true;
    $_SESSION['username'] = $user['username'];

    /* COOKIE (7 hari) */
    if(isset($_POST['remember'])){
        setcookie("username", $user['username'], time() + (60*60*24*7), "/");
        setcookie("login", "true", time() + (60*60*24*7), "/");
    }

    header("Location: dashboard.php");
    exit;

}else{
    echo "<script>alert('Login gagal')</script>";
}
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">

<h2>Login Admin</h2>

<form method="POST">

<input type="text" name="username" placeholder="Username" required>

<input type="password" name="password" placeholder="Password" required>

<input type="checkbox" name="remember"> Remember Me
<br><br>
<button name="login">Login</button>

</form>

</div>