<?php
session_start();

/* hapus session */
session_destroy();

/* hapus cookie */
setcookie("username","",time()-3600,"/");
setcookie("login","",time()-3600,"/");

header("Location: login.php");
exit;
?>