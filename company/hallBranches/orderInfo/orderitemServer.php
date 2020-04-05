<?php

include_once ("../../../connection/connect.php");
if($_POST['option']=="additemsInOrder")
{
    $order=$_POST['order'];
    $userid=$_POST['userid'];
    $timestamp = date('Y-m-d H:i:s');

    if(isset($_POST['selecteditem']))
    {
        $sql='';
        for($i=0;$i<count($_POST['selecteditem']);$i++)
        {
            $sql='INSERT INTO `hall_extra_items`(`id`, `active`, `expire`, `Extra_Item_id`, `orderDetail_id`, `user_id`) VALUES (NULL,"'.$timestamp.'",NULL,'.$_POST['selecteditem'][$i].','.$order.','.$userid.')';
            querySend($sql);
        }
    }
    $CurrentExtraAmount=$_POST['CurrentExtraAmount'];
    $sql='SELECT od.total_person,(select p.price FROM orderDetail as od  INNER join packageDate as pd
on (od.packageDate_id=pd.id)
INNER join packages as p 
on (p.id=pd.package_id)
where 
(od.id='.$order.')) FROM orderDetail as od WHERE od.id='.$order.'';
    $orderDetail=queryReceive($sql);
    $CurrentAmount=(int)$orderDetail[0][0]*(int)$orderDetail[0][1];
    $CurrentAmount+=(int)$CurrentExtraAmount;
    $sql='UPDATE orderDetail SET total_amount='.$CurrentAmount.' WHERE id='.$order.'';
    querySend($sql);

}
else if($_POST['option']=="deletedSelecteditems")
{
    $timestamp = date('Y-m-d H:i:s');
    $CurrentExtraAmount=$_POST['CurrentAmount'];
    $id=$_POST['id'];
    $orderid=$_POST['orderid'];
    $sql='UPDATE `hall_extra_items` SET expire="'.$timestamp.'" WHERE id='.$id.'';
    querySend($sql);


    $sql='SELECT od.total_person,(select p.price FROM orderDetail as od  INNER join packageDate as pd
on (od.packageDate_id=pd.id)
INNER join packages as p 
on (p.id=pd.package_id)
where 
(od.id='.$order.')) FROM orderDetail as od WHERE od.id='.$orderid.'';
    $orderDetail=queryReceive($sql);
    $CurrentAmount=(int)$orderDetail[0][0]*(int)$orderDetail[0][1];
    $CurrentAmount+=(int)$CurrentExtraAmount;
    $sql='UPDATE orderDetail SET total_amount='.$CurrentAmount.' WHERE id='.$orderid.'';
    querySend($sql);


}