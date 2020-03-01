<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-05
 * Time: 17:56
 */


include_once ("../connection/connect.php");

$userid=$_COOKIE['userid'];
function orderChange($post,$AddressId)
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

    //get all information of order
    $sql='SELECT `id`, `hall_id`, `catering_id`, `hallprice_id`, `user_id`, `address_id`, `person_id`, `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, `status_catering`, `describe` FROM `orderDetail` WHERE id='.$orderid.'';
    $previousDetail=queryReceive($sql);

    //make history of order
    $sql='INSERT INTO `history_order`(`id`, `hall_id`, `catering_id`, `hallprice_id`, `user_id`, `address_id`, `total_person`, `status_hall`, `destination_date`, `destination_time`, `status_catering`, `comments`, `orderDetail_id`) VALUES (NULL,'.checknumberOtherNull($previousDetail[0][1]).','.$previousDetail[0][2].','.checknumberOtherNull($previousDetail[0][3]).','.$previousDetail[0][4].','.$previousDetail[0][5].','.$previousDetail[0][8].',"'.$previousDetail[0][9].'","'.$previousDetail[0][10].'","'.$previousDetail[0][12].'","'.$previousDetail[0][13].'","'.$previousDetail[0][14].'",'.$previousDetail[0][0].')';
    querySend($sql);

    //update order
    $sql='UPDATE `orderDetail` SET `catering_id`='.$branchOrder.',`user_id`='.$userid.',`address_id`='.$AddressId.',`total_person`='.$total_person.',`destination_date`="'.$destination_date.'",`destination_time`="'.$destination_time.'",`status_catering`="'.$status_catering.'",`describe`="'.$describe.'" WHERE id='.$orderid.'';
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
    //
    $PreviousTotal_person=$post['PreviousTotal_person'];
    $PreviousDestination_time=$post['PreviousDestination_time'];
    $PreviousDestination_date=$post['PreviousDestination_date'];
    $PreviousDescribe=$post['PreviousDescribe'];
    $PreviousStatus_catering=$post['PreviousStatus_catering'];
    $PreviousBranchOrder=$post['PreviousBranchOrder'];


    if($total_person!=$PreviousTotal_person)
    {
        return 1;
    }
    else if($destination_time!=$PreviousDestination_time)
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

    $post=array();
    $post=$_POST;
    if(checkAddress($post))
    {
        CreateNewAddress($post);
        $PreviousAddressId=mysqli_insert_id($connect);
        orderChange($post,$PreviousAddressId);
        echo 'address';
    }
    else
    {
        if(CheckOrder($post))
        {
            orderChange($post,$PreviousAddressId);
            echo 'orderchange';
        }

    }










}


?>