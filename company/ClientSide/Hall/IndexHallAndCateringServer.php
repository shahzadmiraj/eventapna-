<?php
include_once ("../../../connection/connect.php");
include_once ("functions.php");


if($_POST['option']=="ShowDishes")
{
    $daytime=$_POST['daytime'];
    $date=$_POST['date'];
    $perhead=$_POST['perhead'];
    $latitude=$_POST['latitude']=31.478216052060176;
    $longitude=$_POST['longitude']=74.35737400898438;
    $city=$_POST['city'];
    $country=$_POST['country']="Pakistan";
    echo ShowAllHallPackages($latitude,$longitude,$country,"","","","");
}