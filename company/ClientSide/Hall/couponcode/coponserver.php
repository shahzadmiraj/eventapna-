<?php
include_once ("../../../../connection/connect.php");

function couponcode($CoponCode,$companyid)
{
    $sql='SELECT `Title`, `PercentageORAmount`, `Discount`, `Minimum`, `Maximum`, `Noclients`, `Active`, `Expire`, `Clients_type`, `product_type`, `Conditions`, `activeuser`, `expireuser`, `couponActiveDate`  FROM `couponCode` WHERE Title="'.$CoponCode.'" AND companyId='.$companyid.' AND (ISNULL(CouponExpireDate))';
    $CouponCodeDetail=queryReceive($sql);
    if(count($CouponCodeDetail)==1)
        return $CouponCodeDetail[0];
    else
        return "No";
}


if($_POST['option']=="CouponCodeValidation")
{
    $companyid=$_POST['companyid'];
    $CoponCode=$_POST['CoponCode'];
    $Result=couponcode($CoponCode,$companyid);
    echo json_encode($Result);


}




include_once("../../../../webdesign/footer/EndOfPage.php");