<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-06
 * Time: 23:08
 */





include_once ("../connection/connect.php");



if($_POST['option']=="removeDish")
{
    $timestamp = date('Y-m-d H:i:s');
    $dishId=base64url_decode($_POST['dishId']);
    $sql='UPDATE `dish_detail` SET `expire_date`="'.$timestamp.'" WHERE id='.$dishId.'';
    querySend($sql);
}
else if($_POST['option']=='createDish')
{
    $orderid=$_POST['orderid'];
    $userid=$_POST['userid'];
    $dishId=$_POST['dishId'];
    $each_price=chechIsEmpty($_POST['each_price']);
    $quantity=chechIsEmpty($_POST['quantity']);
    $describe=$_POST['describe'];
    $dishesAmount=(int)$each_price*(int)$quantity;



    $CurrentDateTime=date('Y-m-d H:i:s');
   // $sql='INSERT INTO `dish_detail`(`id`, `describe`, `price`, `expire_date`, `quantity`, `dish_id`, `orderDetail_id`)VALUES(NULL,"'.$describe.'","'.$each_price.'",NULL,"'.$quantity.'",'.$dishId.','.$orderId.')';
    $token=uniqueToken('dish_detail');
    $sql='INSERT INTO `dish_detail`(`id`, `describe`, `expire`, `quantity`, `orderDetail_id`, `user_id`, `dishWithAttribute_id`, `active`, `price`, `expireUser`,`token`) VALUES (NULL,"'.$describe.'",NULL,'.$quantity.','.$orderid.','.$userid.','.$dishId.',"'.$timestamp.'",'.$each_price.',NULL,"'.$token.'")';
    querySend($sql);
    $sql='SELECT od.hall_id,od.total_amount FROM orderDetail as od WHERE od.id='.$orderid.'';
    $detailhall=queryReceive($sql);
    if(!isset($detailhall[0][0]))
    {
        $totalamount=$detailhall[0][1]+$dishesAmount;
        $sql='UPDATE `orderDetail` SET `total_amount`='.$totalamount.' WHERE id='.$orderid.'';
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
    $userid=$_POST['userid'];
    $dishDetailId=$_POST['dishDetailId'];
    $currentDate=date('Y-m-d H:i:s');
    $sql='UPDATE dish_detail as dd SET dd.expire="'.$currentDate.'",dd.expireUser='.$userid.'  WHERE dd.id='.$dishDetailId.'';
    querySend($sql);
    $totalDishesAmount=(int) $_POST['totalDishesAmount'];
    $orderid=$_POST['orderid'];

    $sql='SELECT od.hall_id,od.total_amount FROM orderDetail as od WHERE od.id='.$orderid.'';
    $detailhall=queryReceive($sql);
    if(!isset($detailhall[0][0]))
    {
        $totalamount=$detailhall[0][1]-$totalDishesAmount;
        $sql='UPDATE `orderDetail` SET `total_amount`='.$totalamount.' WHERE id='.$orderid.'';
        querySend($sql);
    }


}
else if($_POST['option']=="viewmenu")
{
    $packageid=$_POST['packageid'];
    $sql='SELECT `dishname`, `image` FROM `menu` WHERE (package_id='.$packageid.') AND ISNULL(expire)';
    $menu=queryReceive($sql);
    $display='';
    for ($i=0;$i<count($menu);$i++)
    {
        $img='../images/systemImage/imageNotFound.png';

        if((file_exists('../images/dishImages/'.$menu[$i][1]))&&($menu[$i][1]!=""))
            $img='../images/dishImages/'.$menu[$i][1];
        $display.='
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="'.$img.'" alt="Card image cap" style="height: 20vh">
  <div class="card-body">
    <p class="card-text">'.$menu[$i][0].'</p>
  </div>
</div>
     ';
    }
    echo $display;
}