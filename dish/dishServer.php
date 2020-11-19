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
    $Orderid=$_POST['Orderid'];

    $sql='SELECT m.itemname,m.price,m.itemtype FROM hallChoiceSelect as hcs INNER join menu as m
on (hcs.menu_id=m.id)

WHERE (hcs.orderDetail_id='.$Orderid.')AND (ISNULL(hcs.expire))'; //menu Prices
    $menu=queryReceive($sql);
    $display='<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item Name</th>
      <th scope="col">Type Type</th>
    </tr>
  </thead>
  <tbody>';

    for($i=0;$i<count($menu);$i++)
    {
            $display.='<tr>
      <th scope="row">'.($i+1).'</th>
      <td>'.$menu[$i][0].'</td>
      <td>'.$menu[$i][2].'</td>
    </tr>';
    }
    $display.='
  </tbody>
</table>';
    $sql='SELECT `describe` FROM `orderDetail` WHERE id='.$Orderid;
    $orderDescription=queryReceive($sql);
    $display.='<p class="col-12">Order Description:'.$orderDescription[0][0].'</p>';

    echo $display;
}

include_once("../webdesign/footer/EndOfPage.php");
