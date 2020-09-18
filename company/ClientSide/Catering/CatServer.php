<?php
include_once ("../../../connection/connect.php");
include_once ("CCServer/clientCateringServer.php");

if($_POST['option']=="ShowDishes")
{
    $Dishname=$_POST['Dishname'];
    $cateringname=$_POST['cateringname'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    $city=$_POST['city'];
    $country=$_POST['country'];
  echo ShowAllCateringDishes(trim($latitude),trim($longitude),trim($country),trim($Dishname),trim($cateringname));
}