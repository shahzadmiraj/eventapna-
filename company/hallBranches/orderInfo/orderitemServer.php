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
}