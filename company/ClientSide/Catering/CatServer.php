<?php
include_once ("../../../connection/connect.php");
include_once ("CCServer/clientCateringServer.php");

if($_POST['option']=="ShowDishes")
{
    $Dishname=$_POST['Dishname'];
    $cateringname=$_POST['cateringname'];
    $latitude=$_POST['latitude']=31.478216052060176;
    $longitude=$_POST['longitude']=74.35737400898438;
    $city=$_POST['city'];
    $country=$_POST['country']="Pakistan";
  echo ShowAllCateringDishes($latitude,$longitude,$country,"","");
}