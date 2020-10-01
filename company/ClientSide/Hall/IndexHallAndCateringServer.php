<?php
include_once ("../../../connection/connect.php");
include_once ("functions.php");

if($_POST['option']=="ShowDishes")
{
    $hallname=$_POST['hallname'];
    $daytime=$_POST['daytime'];
    $date=$_POST['date'];
    $perhead=$_POST['perhead'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    $city=$_POST['city'];
    $country=$_POST['country'];
     $result=ShowAllHallPackages($latitude,$longitude,$country,$hallname,$daytime,$date,$perhead);
     if($result=="")
     {
         echo '';
     }
     else
     {
         echo $result;
     }
}

include_once("../../../webdesign/footer/EndOfPage.php");
