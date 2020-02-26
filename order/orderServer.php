<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-05
 * Time: 17:56
 */


include_once ("../connection/connect.php");

$userid=$_COOKIE['userid'];
function orderChange($_POST,$PreviousAddressId)
{


    $total_person=$_POST['total_person'];
    $destination_time=$_POST['destination_time'];
    $destination_date=$_POST['destination_date'];
    $describe=$_POST['describe'];
    $status_catering=$_POST['status_catering'];



    $sql='SELECT `id`, `hall_id`, `catering_id`, `hallprice_id`, `user_id`, `address_id`, `person_id`, `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, `status_catering`, `describe` FROM `orderDetail` WHERE id='.$orderid.'';
    $previousDetail=queryReceive($sql);

    $sql='INSERT INTO `history_order`(`id`, `hall_id`, `catering_id`, `hallprice_id`, `user_id`, `address_id`, `total_person`, `status_hall`, `destination_date`, `destination_time`, `status_catering`, `comments`, `orderDetail_id`) VALUES (NULL,'.$previousDetail[0][1].','.$previousDetail[0][2].','.$previousDetail[0][3].','.$previousDetail[0][4].','.$previousDetail[0][5].','.$previousDetail[0][8].',"'.$previousDetail[0][9].'","'.$previousDetail[0][10].'","'.$previousDetail[0][12].'","'.$previousDetail[0][13].'","'.$previousDetail[0][14].'",'.$previousDetail[0][0].')';
}
function CheckOrder($_POST)
{


    $total_person=$_POST['total_person'];
    $destination_time=$_POST['destination_time'];
    $destination_date=$_POST['destination_date'];
    $describe=$_POST['describe'];
    $status_catering=$_POST['status_catering'];
    //
    $PreviousTotal_person=$_POST['PreviousTotal_person'];
    $PreviousDestination_time=$_POST['PreviousDestination_time'];
    $PreviousDestination_date=$_POST['PreviousDestination_date'];
    $PreviousDescribe=$_POST['PreviousDescribe'];
    $PreviousStatus_catering=$_POST['PreviousStatus_catering'];


    if($total_person==$PreviousTotal_person)
    {
        return 1;
    }
    else if($destination_time==$PreviousDestination_time)
    {
        return 1;
    }
    else if($destination_date==$PreviousDestination_date)
    {
        return 1;
    }
    else if($describe==$PreviousDescribe)
    {
        return 1;
    }
    else if($status_catering==$PreviousStatus_catering)
    {
        return 1;
    }
    return 0;
}

function checkAddress($_POST)
{

    $town=$_POST['town'];
    $street_no=$_POST['street_no'];
    $houseno=$_POST['houseno'];

    $PreviousTown=$_POST['PreviousTown'];
    $PreviousStreet_no=$_POST['PreviousStreet_no'];
    $PreviousHouse_no=$_POST['PreviousHouse_no'];

    if($town==$PreviousTown)
    {
        return 1;
    }
    else if($street_no==$PreviousStreet_no)
    {
        return 1;
    }
    else if($houseno==$PreviousHouse_no)
    {
        return 1;
    }
    return 0;
}
function CreateNewAddress($_POST)
{
    $town=$_POST['town'];
    $street_no=$_POST['street_no'];
    $houseno=$_POST['houseno'];
    $sql='INSERT INTO `address`(`id`, `address_city`, `address_town`, `address_street_no`, `address_house_no`, `person_id`) VALUES (NULL,NULL,"'.$town.'",'.$street_no.','.$houseno.',NULL)';
    querySend($sql);
}

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
 `user_id`,
 `address_id`, `person_id`, 
`total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, 
`destination_time`, `status_catering`,`describe`) VALUES 
(NULL,NULL,'.$cateringid.',NULL,'.$userid.','.$address_id.','.$customerId.',0,'.$persons.',NULL,'.$date.',"'.$currentDate.'",
'.$time.',"Running","'.$describe.'")';
    querySend($sql);
    $ordeID=mysqli_insert_id($connect);
    $_SESSION['order']=$ordeID;
}



else if($_POST['function']=="orderSaveAfterChange")
{

    $PreviousAddressId=$_POST['PreviousAddressId'];
    if(checkAddress($_POST))
    {
        CreateNewAddress($_POST);
        $PreviousAddressId=mysqli_insert_id($connect);
        orderChange($_POST,$PreviousAddressId);
    }
    else
    {
        if(CheckOrder($_POST))
        {
            orderChange($_POST,$PreviousAddressId);
        }

    }










}

?>