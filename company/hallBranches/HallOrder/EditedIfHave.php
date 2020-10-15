<?php


function checkChangeHallOrder($order,$packageid,$cateringid,$date,$time,$perheadwith,$guests,$orderStatus,$totalamount,$HallOrderBranch,$describe,$catering,$timestamp,$address,$Charges,$Discount)
{
    $status=false;
    $sql='SELECT `id`, `hall_id`, `catering_id`, `packageDate_id`, `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, `status_catering`, `describe`, `user_id`, `discount`, `extracharges`,`address`  FROM `orderDetail` WHERE id='.$order.'';
    $PreviouseDetailOrder=queryReceive($sql);

    if(trim($PreviouseDetailOrder[0][15])!=trim($address))
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"address","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][15].'")';
        querySend($sql);
        $status=true;
    }
    if((int)checknumberOtherNull($PreviouseDetailOrder[0][14])!=(int)$Charges)
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"extracharges","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][14].'")';
        querySend($sql);
        $status=true;
    }
    if((int)checknumberOtherNull($PreviouseDetailOrder[0][13])!=(int)$Discount)
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"discount","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][13].'")';
        querySend($sql);
        $status=true;
    }


    if($PreviouseDetailOrder[0][3]!=$packageid)
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"packageDate_id","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][3].'")';
        querySend($sql);
        $status=true;
    }
    if(checknumberOtherNull($PreviouseDetailOrder[0][2])!=$cateringid)
    {

        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"catering_id","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][2].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][7]!=$date)
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"destination_date","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][7].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][9]!=$time)
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"destination_time","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][9].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][5]!=$guests)
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"total_person","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][5].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][6]!=$orderStatus)
    {

        //hall status

        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"status_hall","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][6].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][1]!=$HallOrderBranch)
    {


        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"hall_id","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][1].'")';
        querySend($sql);
        $status=true;
    }
    if((int)$PreviouseDetailOrder[0][4]!=(int)$totalamount)
    {


        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"total_amount","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][4].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][11]!=$describe)
    {


        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"describe","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][11].'")';
        querySend($sql);
        $status=true;
    }

    if((checknumberOtherNull($PreviouseDetailOrder[0][10])!=$catering)AND(checknumberOtherNull($PreviouseDetailOrder[0][2])!=NULL))
    {

        //catering status
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"status_catering","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][10].'")';
        querySend($sql);
        $status=true;
    }
    return$status;
}