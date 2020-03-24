<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-06
 * Time: 23:08
 */





include_once ("../connection/connect.php");

if(!isset($_POST['option']))
{
    echo "option is not created";
    exit();
}


$orderId='';
if(isset($_SESSION['order']))
{

    $orderId=$_SESSION['order'];
}
if($_POST['option']=="removeDish")
{
    $timestamp = date('Y-m-d H:i:s');
    $dishId=base64url_decode($_POST['dishId']);
    $sql='UPDATE `dish_detail` SET `expire_date`="'.$timestamp.'" WHERE id='.$dishId.'';
    querySend($sql);
}

if($_POST['option']=='createDish')
{
    $orderid=$_POST['orderid'];
    $userid=$_POST['userid'];
    $dishId=$_POST['dishId'];
    $each_price=chechIsEmpty($_POST['each_price']);
    $quantity=chechIsEmpty($_POST['quantity']);
    $describe=$_POST['describe'];



    $CurrentDateTime=date('Y-m-d H:i:s');
   // $sql='INSERT INTO `dish_detail`(`id`, `describe`, `price`, `expire_date`, `quantity`, `dish_id`, `orderDetail_id`)VALUES(NULL,"'.$describe.'","'.$each_price.'",NULL,"'.$quantity.'",'.$dishId.','.$orderId.')';

    $sql='INSERT INTO `dish_detail`(`id`, `describe`, `expire`, `quantity`, `orderDetail_id`, `user_id`, `dishWithAttribute_id`, `active`, `price`, `expireUser`) VALUES (NULL,"'.$describe.'",NULL,'.$quantity.','.$orderId.','.$userid.','.$dishId.',"'.$timestamp.'",'.$each_price.',NULL)';
    querySend($sql);

}
else if($_POST["option"]=='attributeChange')
{
    $attributeid=$_POST['attributeid'];
    $valueAttribute=chechIsEmpty($_POST['value']);
    $sql='UPDATE attribute_name as an SET an.quantity ='.$valueAttribute.' WHERE an.id='.$attributeid.'';
    querySend($sql);
}
else if($_POST['option']=='dishDetailChange')
{
    $dishDetailId=$_POST['dishDetailId'];
    $columnName=$_POST['columnName'];
    $columnValue=chechIsEmpty($_POST['columnValue']);
    $sql='UPDATE dish_detail as dd SET dd.'.$columnName.'="'.$columnValue.'" WHERE dd.id='.$dishDetailId.'';
    querySend($sql);
}
else if($_POST['option']=='deleteDish')
{
    $userid=$_POST['userid'];
    $dishDetailId=$_POST['dishDetailId'];
    $currentDate=date('Y-m-d H:i:s');
    $sql='UPDATE dish_detail as dd SET dd.expire="'.$currentDate.'",dd.expireUser='.$userid.'  WHERE dd.id='.$dishDetailId.'';
    querySend($sql);

}
else if($_POST['option']=="viewmenu")
{
    $packageid=$_POST['packageid'];
    $sql='SELECT `dishname`, `image` FROM `menu` WHERE (hallprice_id='.$packageid.') AND ISNULL(expire)';
    $menu=queryReceive($sql);
    $display='<h4 align="center" class="col-12">Menu</h4>';
    for ($i=0;$i<count($menu);$i++)
    {
        $display.='
            <div  class="col-3 alert-danger shadow border m-2 form-group rounded" style="height: 30vh;" >
                <img src="'.substr($menu[$i][1],3).'" class="col-12 " style="height: 15vh">
                <p class="col-form-label" class="form-control col-12">'.$menu[$i][0].'</p>
            </div>';
    }
    echo $display;
}