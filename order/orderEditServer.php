<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-05
 * Time: 22:10
 */


include_once ("../connection/connect.php");


if($_POST['option']=="orderChange")
{
    $columnName=$_POST['column_name'];
    $coumnText=chechIsEmpty($_POST['value']);
    $orderId=$_POST['orderid'];
    $sql='UPDATE orderDetail as od SET od.'.$columnName.'="'.$coumnText.'" WHERE od.id='.$orderId.'';
    querySend($sql);
}
else if($_POST['option']=="addressChange")
{
    $columnName=$_POST['column_name'];
    $coumnText=chechIsEmpty($_POST['value']);
    $addressId=$_POST['addressId'];
    $sql='UPDATE `address` SET '.$columnName.'="'.$coumnText.'" WHERE id='.$addressId.'';
    querySend($sql);
}

?>