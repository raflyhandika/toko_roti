<?php
session_start();
include "koneksi.php";

if(isset($_POST['login'])){
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $data = mysqli_query($conn,"SELECT * FROM admin 
            WHERE username='$user' AND password='$pass'");
    
    if(mysqli_num_rows($data) > 0){
        $_SESSION['login'] = true;
        header("Location: dashboard.php");
    }else{
        echo "<script>alert('Login gagal!')</script>";
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Login Admin</h2>
<form method="POST">
Username
<input type="text" name="username" required>

Password
<input type="password" name="password" required>

<button name="login">Login</button>
</form>
</div>