<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-05
 * Time: 17:56
 */


include_once ("../connection/connect.php");

$userid=$_COOKIE['userid'];


if(!isset($_POST['function'])) //add customer
{
    echo "option in order is not created";
    exit();
}
if($_POST['function']=="add") {

    $customerId=$_POST['customer'];
    $cateringid=$_POST['cateringid'];
    $persons = chechIsEmpty($_POST['persons']);
    $time = '';
    if (empty($_POST['time'])) {
        $time = "NULL";
    } else {
        $time = '"' . $_POST['time'] . '"';
    }
    $date = '';
    if (empty($_POST['date'])) {
        $date="NULL";
    }
    else
    {
        $date='"'.$_POST['date'].'"';
    }

    $area=$_POST['area'];
    $streetno=chechIsEmpty($_POST['streetno']);
    $houseno=chechIsEmpty($_POST['houseno']);
    $describe=$_POST['describe'];


    $currentDate=date('Y-m-d');
    $CurrenttimeDate = date('Y-m-d H:i:s');
    $sql='INSERT INTO `address`(`id`, `address_street_no`, `address_house_no`, `person_id`, `address_city`, `address_town`) VALUES (NULL,"'.$streetno.'","'.$houseno.'","'.$customerId.'","lahore","'.$area.'")';
    querySend($sql);
    $address_id=mysqli_insert_id($connect);
    $sql='INSERT INTO `orderDetail`(`id`, `hall_id`, `catering_id`, `hallprice_id`,
 `user_id`, `sheftCatering`, `sheftHall`, `sheftCateringUser`, `sheftHallUser`, 
 `address_id`, `person_id`, 
`total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, 
`destination_time`, `status_catering`, `notice`,`describe`) VALUES 
(NULL,NULL,'.$cateringid.',NULL,'.$userid.',NULL,NULL,NULL,
NULL,'.$address_id.','.$customerId.',0,'.$persons.',NULL,'.$date.',"'.$currentDate.'",
'.$time.',"Running","","'.$describe.'")';
    querySend($sql);
    $ordeID=mysqli_insert_id($connect);
    $_SESSION['order']=$ordeID;
}

?>