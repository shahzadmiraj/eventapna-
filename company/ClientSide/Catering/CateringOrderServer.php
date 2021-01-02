<?php
include_once ("../../../connection/connect.php");
include_once ('../../../dish/dishesFunctions.php');
$customerId=0;
$branchid=0;
$branchtype='No';
$orderProcessId=0;
$orderid=0;

if($_POST['option']=="CompleteFormSubmitByClient")
{

    $userid=$_COOKIE['userid'];
    $CustomerName=$_POST['CustomerName'];
    $Phoneno=$_POST['Phoneno'];
    $CNICNumber=$_POST['CNICNumber'];
    $customerAddress=$_POST['customerAddress'];
    customerBookService();


}

function checkCouponCode()
{
    global  $_POST,$orderid,$timestamp;
    $CoponCodeReal=$_POST['CoponCodeReal'];
    $companyid=$_POST['companyid'];
    $couponDetail= couponcode($CoponCodeReal,$companyid);
    if($couponDetail!="No")
    {
        $sql='INSERT INTO `orderWithCouponCode`(`id`, `activedate`, `expireDate`, `orderDetail_id`, `couponCode_id`) VALUES (NULL,"'.$timestamp.'",NULL,'.$orderid.','.$couponDetail.')';
        querySend($sql);
    }
}
function customerBookService()
{
    global $timestamp,$connect,$_POST,$customerId,$branchid,$branchtype,$orderProcessId;
    $image='';



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
    $sql="";
    if($cateringid!='No')
    {
        $sql='INSERT INTO `BookingProcess`(`id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id`,`BuyerOrSeller`) VALUES (NULL,"'.$token.'",'.$cateringid.',NULL,0,NULL,"'.$timestamp.'",'.$customerId.',"Buyer")';
        $branchtype='Catering';
        $branchid=$cateringid;
    }
    querySend($sql);
    $last_id= mysqli_insert_id($connect);
    $orderProcessId=$last_id;
}
function CateringOrderBooking()
{

    global $timestamp,$connect,$_POST,$customerId,$branchid,$branchtype,$orderProcessId,$orderid;

    $cateringIDS=$branchid;
    $userid=$_COOKIE['userid'];
    $personid=$customerId;
    $guests=chechIsEmpty($_POST['numberOfGuest']);
    $date=$_POST['Book_Date'];
    $time=$_POST['Book_Time'];
    $totalamount=chechIsEmpty($_POST['wizardTotalAmountPackage']);
    $Describe=$_POST['Describe'];

    $timestamp = date('Y-m-d H:i:s');



    $catering="'Draft'";



    $sql='INSERT INTO `orderDetail`(`id`, `hall_id`, `catering_id`, `packageDate_id`, `user_id`, `person_id`, 
        `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, 
        `status_catering`,`describe`, `address`, `location_id`, `discount`, `extracharges`) 
        VALUES (NULL,NULL,'.$cateringIDS.',NULL,'.$userid.','.$personid.','.$totalamount.','.$guests.',NULL,"'.$date.'","'.$timestamp.'",
        "'.$time.'",'.$catering.',"'.$Describe.'",NULL,NULL,0,0)';
    querySend($sql);
    $last=mysqli_insert_id($connect);
    $orderid=$last;


    $sql='UPDATE BookingProcess as bp SET bp.orderDetail_id='.$last.',bp.IsProcessComplete=1  WHERE (bp.id='.$orderProcessId.')';
    querySend($sql);



}
function   AddDishes($ids,$image,$item,$type,$description,$price,$quantity)
{
    global $orderid;
    $userid=$_COOKIE['userid'];
    CreateNewDishes($orderid, $userid,$ids , $price, $quantity, $description, $image, $item, $type);
}
function   AddDeal($ids,$image,$item,$description,$price,$quantity)
{
    global $orderid;
    $userid=$_COOKIE['userid'];
    dealCreate($description,$quantity,$userid,$price,$item,$image,$orderid,$ids);
}

if($_POST['option']=="CompleteCateringFormSubmitByClient")
{
    $cateringid=$_POST['cateringid'];
    $Book_Date=$_POST['Book_Date'];
    $Book_Time=$_POST['Book_Time'];
    $numberOfGuest=$_POST['numberOfGuest'];
    $BookingAddress=$_POST['BookingAddress'];
    //$wizardAmountPackage=$_POST['wizardAmountPackage'];
    $Describe=$_POST['Describe'];
    customerBookService();
    CateringOrderBooking();
    $ids=array();
    $image=array();
    $item=array();
    $type=array();
    $description=array();
    $price=array();
    $quantity=array();
    $total=array();
    if(isset($_POST['ids']))
    {
        $ids=$_POST['ids'];
        $image=$_POST['image'];
        $item=$_POST['item'];
        $type=$_POST['type'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $quantity=$_POST['quantity'];
        $total=$_POST['total'];
    }
    for($i=0;$i<count($ids);$i++)
    {
        if($type[$i]=="Dish")
        {
            AddDishes($ids[$i],$image[$i],$item[$i],$type[$i],$description[$i],$price[$i],$quantity[$i]);
        }
        else
        {
            AddDeal($ids[$i],$image[$i],$item[$i],$description[$i],$price[$i],$quantity[$i]);
        }
    }

    SetCateringTotalAmount($orderid);

    checkCouponCode();

}
function couponcode($CoponCode,$companyid)
{
    $sql='SELECT `id`, `Title`, `PercentageORAmount`, `Discount`, `Minimum`, `Maximum`, `Noclients`, `Active`, `Expire`, `Clients_type`, `product_type`, `Conditions`, `activeuser`, `expireuser`, `couponActiveDate`  FROM `couponCode` WHERE Title="'.$CoponCode.'" AND companyId='.$companyid.' AND (ISNULL(CouponExpireDate))';
    $CouponCodeDetail=queryReceive($sql);
    if(count($CouponCodeDetail)==1)
        return $CouponCodeDetail[0][0];
    else
        return "No";
}

include_once("../../../webdesign/footer/EndOfPage.php");
