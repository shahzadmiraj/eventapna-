<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-15
 * Time: 13:36
 */
session_start();
session_destroy();
setcookie('userid',"" , time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("isOwner","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("username","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("companyid","",time() -(86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("userimage","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);


header("location:../index.php");
exit();
?>