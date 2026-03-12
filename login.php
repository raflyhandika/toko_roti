<?php
session_start();
require "koneksi.php";

if(isset($_POST['login'])){

    $user = $_POST['username'];
    $pass = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");

    $stmt->execute([
        'username' => $user,
        'password' => $pass
    ]);

    $data = $stmt->fetch();

    if($data){
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];

        header("Location: dashboard.php");
        exit;
    }else{
        echo "<script>alert('Login gagal! Username atau password salah');</script>";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">

<h2>Login Admin</h2>

<form method="POST">

<label>Username</label>
<input type="text" name="username" required>

<label>Password</label>
<input type="password" name="password" required>

<button type="submit" name="login">Login</button>

</form>

</div>