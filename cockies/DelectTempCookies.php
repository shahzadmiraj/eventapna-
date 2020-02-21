<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2020-01-05
 * Time: 16:37
 */

//session are customerid,typebranch,branchtypeid,tempid,2ndpage,order

setcookie('customerid',"" , time() - (86400 * 30), "/",
$_SERVER["SERVER_NAME"]);
setcookie("typebranch","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("branchtypeid","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("tempid","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("2ndpage","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
setcookie("order","",time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);