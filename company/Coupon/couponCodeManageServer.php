<?php
include_once ("../../connection/connect.php");
if($_POST['option']=="AddCouponCode")
{
    $Title=$_POST['Title'];
    $PercentageORAmount=$_POST['PercentageORAmount'];
    $userid=$_POST['userid'];
    $companyid=$_POST['companyid'];
    $Discount=$_POST['Discount'];
    $Minimum=$_POST['Minimum'];
    $Maximum=$_POST['Maximum'];
    $Noclients=$_POST['Noclients'];
    $Active=$_POST['Active'];
    $Expire=$_POST['Expire'];
    $Clients_type=$_POST['Clients_type'];
    $product_type=$_POST['product_type'];
    $Conditions=$_POST['Conditions'];
    if($PercentageORAmount=="Percentage" && $Discount>100)
    {
            echo "Please enter Valid discount";
            exit();
    }

    $sql='INSERT INTO `couponCode`(`id`, `Title`, `PercentageORAmount`, `Discount`, `Minimum`, `Maximum`, `Noclients`, `Active`, `Expire`, `Clients_type`, `product_type`, `Conditions`, `activeuser`, `expireuser`, `companyId`,`couponActiveDate`, `CouponExpireDate`) VALUES (NULL,"'.$Title.'","'.$PercentageORAmount.'","'.$Discount.'",'.$Minimum.','.$Maximum.','.$Noclients.',"'.$Active.'","'.$Expire.'"
    ,"'.$Clients_type.'","'.$product_type.'","'.$Conditions.'",'.$userid.',NULL,'.$companyid.',"'.$timestamp.'",NULL)';
    querySend($sql);
}
else if($_POST['option']=="RemoveCouponcode")
{
    $idnumberofcouponcode=$_POST['idnumberofcouponcode'];
    $userid=$_POST['userid'];
    $sql='UPDATE `couponCode` SET `expireuser`='.$userid.',`CouponExpireDate`="'.$timestamp.'" WHERE id='.$idnumberofcouponcode;
    querySend($sql);
}

?>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>
