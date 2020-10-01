<?php

session_start();
session_destroy();
setcookie('userid',"" , time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
header("location:../index.php");
exit();
?>

