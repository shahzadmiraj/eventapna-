<?php

include_once ("../../../connection/connect.php");
include_once ("orderCheckMenu.php");
include_once ('CheckPackageForOrderValidFunction.php');
include_once ('EditedIfHave.php');

lockTableForWrite('orderDetail WRITE, hallChoiceSelect WRITE,BookingProcess as bp WRITE,packages as p WRITE,packageDate as pd WRITE,packageControl as pc WRITE ,hall as h WRITE,orderDetail as od WRITE,packageDate WRITE,HistoryOrder WRITE,Order_Package_History WRITE,packages WRITE');
 if($_POST['option']=="createOrderofHall")
{

    $packageDateid='';
    if(isset($_POST['packageDateid']))
        $packageDateid=$_POST['packageDateid'];
    $hallid=$_POST['hallid'];
    $userid=$_POST['userid'];
    $personid=$_POST['personid'];
    $guests=chechIsEmpty($_POST['guests']);
    $date=$_POST['date'];
    $time=$_POST['time'];
    $perheadwith=$_POST['perheadwith'];
    $describe=$_POST['describe'];
    $totalamount=chechIsEmpty($_POST['totalamount']);
    $currentdate=date('Y-m-d');
    $Discount=chechIsEmpty($_POST['Discount']);
    $Charges=chechIsEmpty($_POST['Charges']);
    $timestamp = date('Y-m-d H:i:s');
    if(!IsAvailableOrderAgainCheck("No",$guests,$date,$time,$perheadwith,$hallid))
    {
        echo "SameOrderBooked";
        exit();
    }
    if($time=="Morning")
    {
        $time="09:00:00";
    }
    else if($time=="Afternoon")
    {

        $time="12:00:00";
    }
    else
    {
        $time = "18:00:00";
    }

    $cateringid="NULL";
    $catering="NULL";
    if($perheadwith==1)
    {
        $catering="'Running'";
        $cateringid=$_POST['cateringid'];
    }

    $sql='INSERT INTO `orderDetail`(`id`, `hall_id`, `catering_id`, `packageDate_id`, `user_id`, `person_id`, 
        `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, 
        `status_catering`,`describe`, `address`, `location_id`, `discount`, `extracharges`) 
        VALUES (NULL,'.$hallid.','.$cateringid.','.$packageDateid.','.$userid.','.$personid.','.$totalamount.','.$guests.',"Running","'.$date.'","'.$currentdate.'",
        "'.$time.'",'.$catering.',"'.$describe.'",NULL,NULL,'.$Discount.','.$Charges.')';
    querySend($sql);
    $pid=$_POST['pid'];
    $token=$_POST['token'];
    $last=mysqli_insert_id($connect);

    if(isset($_POST['MenuTypeInpackages']))
    {
        $MenuTypeInpackages = $_POST['MenuTypeInpackages'];
        $MenuTypeInpackagesArray = explode(",", $MenuTypeInpackages);
        for ($i = 0; $i < count($MenuTypeInpackagesArray); $i++) {
            if (isset($_POST["SelectOptionFromItem" . $MenuTypeInpackagesArray[$i]]))
            {
                if(($_POST["SelectOptionFromItem" . $MenuTypeInpackagesArray[$i]]!="Default"))
                {
                    $sql = 'INSERT INTO `hallChoiceSelect`(`id`, `expire`, `active`, `ActiveUser`, `ExpireUser`, `menu_id`, `orderDetail_id`) VALUES (NULL,NULL,"' . $timestamp . '",' . $userid . ',NULL,' . $_POST["SelectOptionFromItem" . $MenuTypeInpackagesArray[$i]] . ',' . $last . ')';
                    querySend($sql);
                }
            }

        }
    }

    $sql='UPDATE BookingProcess as bp SET bp.orderDetail_id='.$last.'  WHERE (bp.id='.$pid.')AND(bp.token="'.$token.'")';
    querySend($sql);

    $sql='SELECT `id`, `isFood`, `price`, `describe`, `dayTime`,`package_name`, `MinimumGuest` FROM `packages` WHERE id=(SELECT pd.package_id FROM packageDate as pd WHERE pd.id='.$packageDateid.' LIMIT 1)';
    $packageDetails=queryReceive($sql);
    $sql='INSERT INTO `Order_Package_History`(`id`, `isFood`, `price`, `describe`, `dayTime`, `package_name`, `MinimumGuest`, `packages_id`, `activeDate`, `ActiveUserId`, `orderDetail_id`, `ExpireUserId`, `ExpireUserDate`) 
VALUES (NULL,'.$packageDetails[0][1].','.$packageDetails[0][2].',"'.$packageDetails[0][3].'","'.$packageDetails[0][4].'","'.$packageDetails[0][5].'",'.$packageDetails[0][6].','.$packageDetails[0][0].',"'.$timestamp.'",'.$userid.','.$last.',NULL,NULL)';
    querySend($sql);


}
 else if($_POST['option']=="Edithallorder")
 {
     $order=$_POST['order'];
     $packageDateid='';
     if(isset($_POST['packageDateid']))  //packageDateid
         $packageDateid=$_POST['packageDateid'];
     $guests=chechIsEmpty($_POST['guests']);
     $date=$_POST['date'];
     $time=$_POST['time'];
     $perheadwith=$_POST['perheadwith'];

     $cateringid='NULL';
     if(isset($_POST['cateringid']) &&($perheadwith==1))
     {
         $cateringid=$_POST['cateringid'];
     }

     $describe=$_POST['describe'];
     $totalamount=chechIsEmpty($_POST['totalamount']);
     $Discount=chechIsEmpty($_POST['Discount']);
     $Charges=chechIsEmpty($_POST['Charges']);
     $catering="";

     if($time=="Morning")
     {
         $time="09:00:00";
     }
     else if($time=="Afternoon")
     {

         $time="12:00:00";
     }
     else if($time=="Evening")
     {

         $time="18:00:00";
     }
     $orderStatus=$_POST['orderStatus'];
     if($perheadwith==0)
     {
         //just cancel of catering /../
         $catering="Cancel";
     }
     else
     {
         $catering=$orderStatus;
     }
     $branchOrder=$_POST['branchOrder'];
     $userid=$_POST['userid'];


     $timestamp = date('Y-m-d H:i:s');
     if(!IsAvailableOrderAgainCheck($order,$guests,$date,$_POST['time'],$perheadwith,$branchOrder))
     {
         echo "SameOrderBooked";
         exit();
     }

     $post=$_POST;
     checkChangeOfMenuOfPackages($post);


     if(checkChangeHallOrder($order,$packageDateid,$cateringid,$date,$time,$perheadwith,$guests,$orderStatus,$totalamount,$branchOrder,$describe,$catering,$timestamp,NULL,$Charges,$Discount))
     {
         $sql='UPDATE `orderDetail` SET `catering_id`='.$cateringid.',`packageDate_id`='.$packageDateid.',
`total_amount`='.$totalamount.',`total_person`='.$guests.',`status_hall`
="'.$orderStatus.'",`destination_date`="'.$date.'",`destination_time`="'.$time.'",
`status_catering`="'.$catering.'",`describe`="'.$describe.'" , `hall_id`='.$branchOrder.',`user_id`='.$userid.',`discount`='.$Discount.',`extracharges`='.$Charges.'
WHERE  id='.$order.'';
         querySend($sql);
     }
 }
unlockTables();
 ?>


<?php
include_once ("../../../webdesign/footer/EndOfPage.php");
?>