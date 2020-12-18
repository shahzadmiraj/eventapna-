<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-06
 * Time: 16:48
 */
include_once ("../connection/connect.php");
include  ("../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfOrderBooked("Owner,Employee","../index.php");
include_once ('dishesFunctions.php');
$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);



$orderId=$processInformation[0][5];

$userid=$_COOKIE['userid'];
$timestamp = date('Y-m-d H:i:s');




//selected Dealid
$SelectedDealid=array();
if(isset($_POST['SelectedDealid']))
{
    $SelectedDealid=$_POST['SelectedDealid'];
}
//previous Deal id
$previousDealId=array();
$previousDealId=array_column(GetAllDealsInOrder($orderId), 0);
//Expire Previous deals

$clean1 = array_diff($SelectedDealid, $previousDealId);
$clean2 = array_diff($previousDealId, $SelectedDealid);
$final_output = array_merge($clean1, $clean2);
if(count($final_output)>0)
{
    $List = implode(',', $final_output);
    $sql='UPDATE `OrderCateringDealManage` SET `expire`="'.$timestamp.'",`expireUser`='.$userid.' WHERE id in ('.$List.')';
    querySend($sql);
}

$CreateDealid=array();
$CreateDealImage=array();
$CreateDealName=array();
$CreateDealDetail=array();
$CreateDealPrice=array();
$CreateDealQuantity=array();
if(isset($_POST['CreateDealid']))
{
    //Create New Deal
    $CreateDealid=$_POST['CreateDealid'];
    $CreateDealImage=$_POST['CreateDealImage'];
    $CreateDealName=$_POST['CreateDealName'];
    $CreateDealDetail=$_POST['CreateDealDetail'];
    $CreateDealPrice=$_POST['CreateDealPrice'];
    $CreateDealQuantity=$_POST['CreateDealQuantity'];
    for($i=0;$i<count($CreateDealid);$i++)
    {
        dealCreate($CreateDealDetail[$i],$CreateDealQuantity[$i],$userid,$CreateDealPrice[$i],$CreateDealName[$i],$CreateDealImage[$i],$orderId,$CreateDealid[$i]);
    }

}







        //expired if alreaady exist
    $AlreadyDishesDishDetail=array();
    if(isset($_POST['AlreadyDishes']))
    $AlreadyDishesDishDetail=$_POST['AlreadyDishes'];
    $sql='SELECT  dd.id  FROM dish_detail as dd WHERE (ISNULL(dd.expire))AND (dd.orderDetail_id='.$orderId.')';
    $detailDishes=queryReceive($sql);
    $PreviousDishDetailIds=array_column($detailDishes, 0);
    $clean1 = array_diff($AlreadyDishesDishDetail, $PreviousDishDetailIds);
    $clean2 = array_diff($PreviousDishDetailIds, $AlreadyDishesDishDetail);
    $final_output = array_merge($clean1, $clean2);
    if(count($final_output)>0)
    {
        $List = implode(',', $final_output);
        $sql='UPDATE `dish_detail` SET `expire`="'.$timestamp.'",`expireUser`='.$userid.' WHERE id in ('.$List.')';
        querySend($sql);

    }


$dishesName=array();
$dishesid=array();
$prices=array();
$images=array();
$quantity=array();

if(isset($_POST['dishesid']))
{
    $dishesName=$_POST['dishesName'];
    $dishesid=$_POST['dishesid'];
    $prices=$_POST['prices'];
    $images=$_POST['images'];
    $quantity=$_POST['quantity'];
}
?>


    <?php
    for($j=0;$j<count($dishesid);$j++)
    {
        $sql = 'SELECT d.image,d.name,dish_type_id FROM dish as d INNER JOIN dishWithAttribute as dwa
on (d.id=dwa.dish_id)
WHERE 
dwa.id=' . $dishesid[$j] . '';
        $EachDishInfo = queryReceive($sql);
        CreateNewDishes($orderId, $userid, $dishesid[$j], $prices[$j], $quantity[$j], "", $EachDishInfo[0][0], $EachDishInfo[0][1], $EachDishInfo[0][2]);
    }






    SetCateringTotalAmount($orderId);
    //redirect
        if(($processInformation[0][4]==0))
        {
            header("location:../payment/getPayment.php?pid=$pid&token=$token");
        }
        else {
            echo   '<script>  window.history.back();</script>';
        }


        ?>

