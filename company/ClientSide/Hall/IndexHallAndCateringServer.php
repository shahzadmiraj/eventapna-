<?php
include_once ("../../../connection/connect.php");
include_once ("functions.php");

function checKExist($post)
{
    if(isset($post))
    {
        return $post;
    }
    return "";
}
if($_POST['option']=="ShowDishes")
{
    $hallname=$_POST['hallname'];
    $daytime=$_POST['daytime'];
    $date=$_POST['date'];
    $perhead=$_POST['perhead'];
    $latitude=$_POST['latitude']=23.23;
    $longitude=$_POST['longitude']=23.4;
    $city=$_POST['city'];
    $country=$_POST['country']='Pakistan';
     $result=ShowAllHallPackages($latitude,$longitude,$country,$hallname,$daytime,$date,$perhead);
     if($result=="")
     {
         echo '<h1 class="btn-danger m-5 ">Not Found</h1>';
     }
     else
     {
         echo $result;
     }
}