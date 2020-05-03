<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-10
 * Time: 11:50
 */

include_once ("../connection/connect.php");

function CheckUserExist($username,$Email)
{
    $sql='';
    $Count=queryReceive($sql);
}


if($_POST['option']=="RegisterCompanyWithUserAlse")
{
$CompanyName=$_POST['CompanyName'];
$username=$_POST['username'];
$Email=$_POST['Email'];
$PhoneNo=$_POST['PhoneNo'];
$Image=$_POST['Image'];
$password1=$_POST['password1'];

}
else if($_POST['option']=="companyWithUser")
{

}
else if($_POST['option']=="CompanyUserRegister")
{

}



?>