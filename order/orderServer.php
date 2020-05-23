<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-05
 * Time: 17:56
 */


include_once ("../connection/connect.php");

$userid=$_COOKIE['userid'];
function orderChange($post)
{
//chechIsEmpty
    //checknumberOtherNull

    $total_person=chechIsEmpty($post['total_person']);
    $destination_time=$post['destination_time'];
    $destination_date=$post['destination_date'];
    $describe=$post['describe'];
    $status_catering=$post['status_catering'];
    $branchOrder=$post['branchOrder'];
    $orderid=$post['orderid'];
    $userid=$post['CurrentUserid'];
    $total_amount=$post['total_amount'];
    $Discount=$post['Discount'];
    $Charges=$post['Charges'];
    $address=$post['address'];


    //update order
    $sql='UPDATE `orderDetail` SET  `address`="'.$address.'",`discount`='.$Discount.',`extracharges`='.$Charges.',`catering_id`='.$branchOrder.',`user_id`='.$userid.',`total_person`='.$total_person.',`destination_date`="'.$destination_date.'",`destination_time`="'.$destination_time.'",`status_catering`="'.$status_catering.'",`describe`="'.$describe.'" WHERE `id` = '.$orderid.'';

    querySend($sql);


}
function CheckOrder($post)
{


    $total_person=$post['total_person'];
    $destination_time=$post['destination_time'];
    $destination_date=$post['destination_date'];
    $describe=$post['describe'];
    $status_catering=$post['status_catering'];
    $branchOrder=$post['branchOrder'];
    $total_amount=$post['total_amount'];
    //
    $PreviousTotal_person=$post['PreviousTotal_person'];
    $PreviousDestination_time=$post['PreviousDestination_time'];
    $PreviousDestination_date=$post['PreviousDestination_date'];
    $PreviousDescribe=$post['PreviousDescribe'];
    $PreviousStatus_catering=$post['PreviousStatus_catering'];
    $PreviousBranchOrder=$post['PreviousBranchOrder'];
    $Previoustotal_amount=$post['Previoustotal_amount'];



    if($total_person!=$PreviousTotal_person)
    {
        return 1;
    }
    else if($destination_time!=$PreviousDestination_time)
    {
        return 1;
    }
    else if($total_amount!=$Previoustotal_amount)
    {
        return 1;
    }
    else if($destination_date!=$PreviousDestination_date)
    {
        return 1;
    }
    else if($describe!=$PreviousDescribe)
    {
        return 1;
    }
    else if($status_catering!=$PreviousStatus_catering)
    {
        return 1;
    }
    else if($branchOrder!=$PreviousBranchOrder)
    {
        return 1;
    }
    return 0;
}

function checkAddress($post)
{

    $town=$post['town'];
    $street_no=$post['street_no'];
    $houseno=$post['house_no'];

    $PreviousTown=$post['PreviousTown'];
    $PreviousStreet_no=$post['PreviousStreet_no'];
    $PreviousHouse_no=$post['PreviousHouse_no'];

    if($town!=$PreviousTown)
    {
        return 1;
    }
    else if($street_no!=$PreviousStreet_no)
    {
        return 1;
    }
    else if($houseno!=$PreviousHouse_no)
    {
        return 1;
    }
    return 0;
}
function CreateNewAddress($post)
{
    $town=$post['town'];
    $street_no=$post['street_no'];
    $houseno=$post['house_no'];
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
    $address=$_POST['address'];
    $describe=$_POST['describe'];

$sql='INSERT INTO `orderDetail`(`id`, `hall_id`, `catering_id`, `packageDate_id`, `user_id`, `person_id`,`total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`,`status_catering`, `describe`,  `address`, `location_id`, `discount`, `extracharges`)VALUES (NULL,NULL,'.$cateringid.',NULL,'.$userid.','.$customerId.',NULL,'.$persons.',NULL,'.$date.',"'.$timestamp.'",'.$time.',"Running","'.$describe.'","'.$address.'",NULL,NULL,NULL)';
    querySend($sql);
    $last=mysqli_insert_id($connect);
    $pid=$_POST['pid'];
    $token=$_POST['token'];
    $sql='UPDATE BookingProcess as bp SET bp.orderDetail_id='.$last.'  WHERE (bp.id='.$pid.')AND(bp.token="'.$token.'")';
    querySend($sql);


}



else if($_POST['function']=="orderSaveAfterChange")
{

    $timestamp = date('Y-m-d H:i:s');
    $post=array();
    $post=$_POST;
    $total_person=chechIsEmpty($post['total_person']);
    $destination_time=$post['destination_time'];
    $destination_date=$post['destination_date'];
    $describe=$post['describe'];
    $status_catering=$post['status_catering'];
    $branchOrder=$post['branchOrder'];
    $orderid=$post['orderid'];
    $userid=$post['CurrentUserid'];
    $total_amount=$post['total_amount'];
    $address=$_POST['address'];
    $Charges=$_POST['Charges'];
    $Discount=$_POST['Discount'];


    if(checkChangeHallOrder($orderid,NULL,$branchOrder,$destination_date,$destination_time,NULL,$total_person,NULL,$total_amount,NULL,$describe,$status_catering,$timestamp,$address,$Charges,$Discount))
    {
        orderChange($post);
    }









}


?>