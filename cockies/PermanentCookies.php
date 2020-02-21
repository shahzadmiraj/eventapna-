<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2020-01-05
 * Time: 16:38
 */




setcookie('userid',"" , time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("isOwner","",time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("username","",time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("companyid","",time() +(86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("userimage","",time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);


