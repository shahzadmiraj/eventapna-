<?php
include_once ("../../../connection/connect.php");
include_once('../../hallBranches/HallOrder/CheckPackageForOrderValidFunction.php');
if(!isset($_POST['option']))
    exit();
$customerId=0;
$branchid=0;
$branchtype='No';
$orderProcessId=0;
$orderid=0;
if($_POST['option']=="CompleteFormSubmitByClient")
{
    $pid=$_POST['pid'];
    $userid=$_COOKIE['userid'];
    $CustomerName=$_POST['CustomerName'];
    $Phoneno=$_POST['Phoneno'];
    $CNICNumber=$_POST['CNICNumber'];
    $customerAddress=$_POST['customerAddress'];
    customerBookService();
    hallorderBooking();
    $listofitemtype='';
    if(isset($_POST['listofitemtype']))
    {
        $listofitemtype=$_POST['listofitemtype'];
    }
    $Arraylistofitemtype=explode(",", $listofitemtype);
    $itemExtraId=array();
    $itemQuantity=array();
    if(isset($_POST['itemExtraId']))
    {
        $itemExtraId=$_POST['itemExtraId'];
        $itemQuantity=$_POST['itemQuantity'];
    }

}
function customerBookService()
{
 global $timestamp,$connect,$_POST,$customerId,$branchid,$branchtype,$orderProcessId;
    $image='';

    /* if(!empty($_FILES['image']["name"]))
     {
         $passbyreference=explode('.',$_FILES['image']['name']);
         $file_ext=strtolower(end($passbyreference));
         $tokenimages=uniqueToken("person","image",'.'.$file_ext);
         $image =  "../../../images/customerimage/"  .$tokenimages;
         //$image = "../images/customerimage/" . $_FILES['image']['name'];
         $resultimage = ImageUploaded($_FILES, $image);//$dishimage is destination file location;
         if ($resultimage != "") {
             print_r($resultimage);
             exit();
         }

         $image=$tokenimages;
     }*/

    $name = trim($_POST['CustomerName']);
    $numberArray = $_POST['Phoneno'];
    $cnic = chechIsEmpty($_POST['CNICNumber']);
    $address=$_POST['customerAddress'];
    $userid=$_COOKIE['userid'];

    $sql='INSERT INTO `person`(`name`, `cnic`, `id`, `image`, `active`, `expire`, `address`,`company_id`) VALUES ("'.$name.'","'.$cnic.'",NULL,"'.$image.'","'.$timestamp.'",NULL,"'.$address.'",NULL)';

    querySend($sql);
    $last_id=mysqli_insert_id($connect);

    /*for ($i = 0; $i < count($numberArray); $i++)
    {
        $sql='INSERT INTO `number`(`number`, `id`, `person_id`, `active`, `expire`, `userActive`, `userExpire`) VALUES ("'.trim($numberArray[$i]).'",NULL,'.$last_id.',"'.$timestamp.'",NULL,'.$userid.',NULL)';
        querySend($sql);
    }*/
    $sql='INSERT INTO `number`(`number`, `id`, `person_id`, `active`, `expire`, `userActive`, `userExpire`) VALUES ("'.trim($numberArray).'",NULL,'.$last_id.',"'.$timestamp.'",NULL,'.$userid.',NULL)';
    querySend($sql);
    $customerId = $last_id;


    $token= uniqueToken('BookingProcess',"token",'');
    //$token=base64url_encodeLength();
    $cateringid=$_POST['cateringid'];
    $hallid=$_POST['hallid'];
    $sql="";
    if($cateringid!='No')
    {
        $sql='INSERT INTO `BookingProcess`(`id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id`,`BuyerOrSeller`) VALUES (NULL,"'.$token.'",'.$cateringid.',NULL,0,NULL,"'.$timestamp.'",'.$customerId.',"Buyer")';
        $branchtype='Catering';
        $branchid=$cateringid;
    }
    else if($hallid!="No")
    {
        $sql='INSERT INTO `BookingProcess`(`id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id`,`BuyerOrSeller`) VALUES (NULL,"'.$token.'",NULL,'.$hallid.',0,NULL,"'.$timestamp.'",'.$customerId.',"Buyer")';
        $branchtype='hall';
        $branchid=$hallid;
    }
    querySend($sql);
    $last_id= mysqli_insert_id($connect);
    $orderProcessId=$last_id;
}
function hallorderBooking()
{

    global $timestamp,$connect,$_POST,$customerId,$branchid,$branchtype,$orderProcessId,$orderid;
    $packageDateid='';
    if(isset($_POST['pid']))
        $packageDateid=$_POST['pid'];
    $hallid=$branchid;
    $userid=$_COOKIE['userid'];
    $personid=$customerId;
    $guests=chechIsEmpty($_POST['numberOfGuest']);
    $date=$_POST['date'];
    $time=$_POST['time'];
    $perheadwith=$_POST['perheadwith'];
    $describe=$_POST['describe'];
    $totalamount=chechIsEmpty($_POST['wizardTotalAmountPackage']);
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
        $catering="'Draft'";

        $sql='SELECT c.id FROM catering as c WHERE company_id=(select h.company_id FROM hall as h WHERE (h.id='.$hallid.')AND ISNULL(h.expire) LIMIT 1 )AND(ISNULL(c.expire))';
        $Cateringsdetail=queryReceive($sql);
        if(count($Cateringsdetail)!=0)
        {
            $cateringid=$Cateringsdetail[0][0];
        }

    }
    $sql='INSERT INTO `orderDetail`(`id`, `hall_id`, `catering_id`, `packageDate_id`, `user_id`, `person_id`, 
        `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, 
        `status_catering`,`describe`, `address`, `location_id`, `discount`, `extracharges`) 
        VALUES (NULL,'.$hallid.','.$cateringid.','.$packageDateid.','.$userid.','.$personid.','.$totalamount.','.$guests.',"Draft","'.$date.'","'.$timestamp.'",
        "'.$time.'",'.$catering.',"'.$describe.'",NULL,NULL,'.$Discount.','.$Charges.')';
    querySend($sql);
    $last=mysqli_insert_id($connect);
    $orderid=$last;

    $listofitemtype='';
    if(isset($_POST['listofitemtype']))
    {
        $listofitemtype=$_POST['listofitemtype'];
    }
    $Arraylistofitemtype=explode(",", $listofitemtype);
    for ($i = 0; $i < count($Arraylistofitemtype); $i++)
    {
            if(($_POST[$Arraylistofitemtype[$i]]!="Default"))
            {
                $sql = 'INSERT INTO `hallChoiceSelect`(`id`, `expire`, `active`, `ActiveUser`, `ExpireUser`, `menu_id`, `orderDetail_id`) VALUES (NULL,NULL,"' . $timestamp . '",' . $userid . ',NULL,' . $_POST[$Arraylistofitemtype[$i]] . ',' . $last . ')';
                querySend($sql);
            }
    }
    $sql='UPDATE BookingProcess as bp SET bp.orderDetail_id='.$last.',bp.IsProcessComplete=1  WHERE (bp.id='.$orderProcessId.')';
    querySend($sql);

    $sql='SELECT `id`, `isFood`, `price`, `describe`, `dayTime`,`package_name`, `MinimumGuest` FROM `packages` WHERE id=(SELECT pd.package_id FROM packageDate as pd WHERE pd.id='.$packageDateid.' LIMIT 1)';
    $packageDetails=queryReceive($sql);
    $sql='INSERT INTO `Order_Package_History`(`id`, `isFood`, `price`, `describe`, `dayTime`, `package_name`, `MinimumGuest`, `packages_id`, `activeDate`, `ActiveUserId`, `orderDetail_id`, `ExpireUserId`, `ExpireUserDate`) 
VALUES (NULL,'.$packageDetails[0][1].','.$packageDetails[0][2].',"'.$packageDetails[0][3].'","'.$packageDetails[0][4].'","'.$packageDetails[0][5].'",'.$packageDetails[0][6].','.$packageDetails[0][0].',"'.$timestamp.'",'.$userid.','.$last.',NULL,NULL)';
    querySend($sql);

}

include_once("../../../webdesign/footer/EndOfPage.php");
