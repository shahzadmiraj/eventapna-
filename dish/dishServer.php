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

if($_POST['option']=='createDish')
{
    $dishId=$_POST['dishId'];
    $attributesId=array();
    $attributesValue=array();
    if(isset($_POST['attributeId']))
    {
        $attributesId=$_POST['attributeId'];
        $attributesValue=$_POST['attributeValue'];
    }
    $each_price=chechIsEmpty($_POST['each_price']);
    $quantity=chechIsEmpty($_POST['quantity']);
    $describe=$_POST['describe'];



    $CurrentDateTime=date('Y-m-d H:i:s');
    $sql='INSERT INTO `dish_detail`(`id`, `describe`, `price`, `expire_date`, `quantity`, `dish_id`, `orderDetail_id`)VALUES(NULL,"'.$describe.'","'.$each_price.'",NULL,"'.$quantity.'",'.$dishId.','.$orderId.')';
    querySend($sql);
    $dishDetailId=mysqli_insert_id($connect);
    for ($i=0;$i<count($attributesId);$i++)
    {
        $sql='INSERT INTO `attribute_name`(`id`, `quantity`, `attribute_id`, `dish_detail_id`) 
VALUES (NULL,"'.$attributesValue[$i].'",'.$attributesId[$i].','.$dishDetailId.')';
        querySend($sql);
    }

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
    $dishDetailId=$_POST['dishDetailId'];
    $currentDate=date('Y-m-d H:i:s');
    $sql='UPDATE dish_detail as dd SET dd.expire_date="'.$currentDate.'"  WHERE dd.id='.$dishDetailId.'';
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