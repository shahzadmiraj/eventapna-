<?php

include_once ("../../../connection/connect.php");
include_once ("CalculationOfHallOrderAutoFunction.php");
if($_POST['option']=="additemsInOrder")
{
    $order=$_POST['order'];
    $userid=$_POST['userid'];
    $timestamp = date('Y-m-d H:i:s');
    $sql='SELECT hei.id FROM hall_extra_items as hei  WHERE (ISNULL(hei.expire)) AND (hei.orderDetail_id='.$order.')';
    $previousExtraItemChargesidResult=queryReceive($sql);
    $PrviousExtraItemChargesItsOneD = array_column($previousExtraItemChargesidResult, 0);
    $currentExtraItemChargesId=array();
    if(isset($_POST['AlreadyExtraItemChargesIds']))
    {
        $currentExtraItemChargesId=$_POST['AlreadyExtraItemChargesIds'];
    }
    $clean1 = array_diff($PrviousExtraItemChargesItsOneD, $currentExtraItemChargesId);
    $clean2 = array_diff($currentExtraItemChargesId, $PrviousExtraItemChargesItsOneD);
    $final_output = array_merge($clean1, $clean2);
    if(count($final_output)>0)
    {
        $List = implode(',', $final_output);
        $sql='UPDATE `hall_extra_items` SET `expire`="'.$timestamp.'",`expireUserId`='.$userid.' WHERE id in ('.$List.') AND (ISNULL(expire))';
        querySend($sql);
    }
    if(isset($_POST['selecteditem']))
    {
        $sql='';
        for($i=0;$i<count($_POST['selecteditem']);$i++)
        {
            $sql='INSERT INTO `hall_extra_items`(`id`, `active`, `expire`, `Extra_Item_id`, `orderDetail_id`, `user_id`,`expireUserId` ) VALUES (NULL,"'.$timestamp.'",NULL,'.$_POST['selecteditem'][$i].','.$order.','.$userid.',NULL)';
            querySend($sql);
        }
    }
    $CurrentAmount=calculationOfHallOrder($order);

    $sql='UPDATE orderDetail SET total_amount='.$CurrentAmount.' WHERE id='.$order.'';
    querySend($sql);

}

