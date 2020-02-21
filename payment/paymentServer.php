<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-08
 * Time: 14:52
 */
include_once ("../connection/connect.php");
if(!isset($_SESSION['order']))
{
    header("location:../user/userDisplay.php");
}
if(isset($_POST['option']))
{
    if($_POST['option']=='GetPayment')
    {

        $name=$_POST['name'];
        $amount=chechIsEmpty($_POST['Amount']);
        $status=chechIsEmpty($_POST['status']);
        $rating=chechIsEmpty($_POST['rating']);
        $personality=$_POST['personality'];

        $userId=$_POST['user_id'];
        $orderDetail_id=$_POST['orderDetail_id'];
        $dateTime=date('Y-m-d H:i:s');
        $sql='INSERT INTO `payment`(`id`, `amount`, `nameCustomer`, `receive`, `personality`, `rating`, `IsReturn`, `orderDetail_id`, `user_id`, `sendingStatus`) VALUES (NULL,'.$amount.',"'.$name.'","'.$dateTime.'","'.$personality.'",'.$rating.','.$status.','.$orderDetail_id.','.$userId.',0)';
        querySend($sql);
    }
    else if($_POST['option']=='paymentsend')
    {
        $useid=$_POST['useid'];
        $paymentId=$_POST['paymentId'];
        $dateTime=date('Y-m-d H:i:s');
        $sql='INSERT INTO `transfer`(`id`, `Isconfirm`, `senderTimeDate`, `payment_id`, `user_id`,`Isget`) VALUES (NULL,NULL,"'.$dateTime.'",'.$paymentId.','.$useid.',0)';
        querySend($sql);
        $sql='UPDATE payment as py SET py.sendingStatus=1  WHERE py.id='.$paymentId.'';
        querySend($sql);

    }
    else if($_POST['option']=='paymentconfigration')
    {
        $paymentid=$_POST["paymentid"];
        $tranferid=$_POST['tranferid'];
        $dateTime=date('Y-m-d H:i:s');
        if ($_POST['value'] == "unconfirm")
        {
            $sql='UPDATE transfer as t SET t.Isconfirm="'.$dateTime.'"  WHERE t.id='.$tranferid.'';
            querySend($sql);
            $sql='UPDATE payment as py SET py.sendingStatus=0  WHERE py.id='.$paymentid.'';
            querySend($sql);

        } else if ($_POST['value'] == "confirm")
        {
            $sql='UPDATE transfer as t SET t.Isconfirm="'.$dateTime.'",t.Isget=1  WHERE t.id='.$tranferid.'';
            querySend($sql);
            $sql='UPDATE payment as py SET py.sendingStatus=2  WHERE py.id='.$paymentid.'';
            querySend($sql);
        }
    }
}