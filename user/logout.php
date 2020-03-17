<?php

session_start();
session_destroy();
setcookie('userid',"" , time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("usertype","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("username","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("companyid","",time() -(86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("userimage","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);


header("location:../index.php");
exit();
?>