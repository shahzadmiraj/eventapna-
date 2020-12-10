<?php
include_once ("../../../connection/connect.php");

function   AddDishes($ids,$image,$item,$type,$description,$price,$quantity)
{

}

function   AddDeal($ids,$image,$item,$type,$description,$price,$quantity)
{

}

if($_POST['option']=="CompleteCateringFormSubmitByClient")
{
    $cateringid=$_POST['cateringid'];
    $Book_Date=$_POST['Book_Date'];
    $Book_Time=$_POST['Book_Time'];
    $numberOfGuest=$_POST['numberOfGuest'];
    $BookingAddress=$_POST['BookingAddress'];
    $wizardAmountPackage=$_POST['wizardAmountPackage'];
    $ids=array();
    $image=array();
    $item=array();
    $type=array();
    $description=array();
    $price=array();
    $quantity=array();
    $total=array();
    if(isset($_POST['ids']))
    {
        $ids=$_POST['ids'];
        $image=$_POST['image'];
        $item=$_POST['item'];
        $type=$_POST['type'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $quantity=$_POST['quantity'];
        $total=$_POST['total'];
    }
    for($i=0;$i<count($ids);$i++)
    {
        if($type[$i]=="Dish")
        {
            AddDishes($ids[$i],$image[$i],$item[$i],$type[$i],$description[$i],$price[$i],$quantity[$i]);
        }
        else
        {

            AddDeal($ids[$i],$image[$i],$item[$i],$type[$i],$description[$i],$price[$i],$quantity[$i]);
        }
    }


}

include_once("../../../webdesign/footer/EndOfPage.php");
