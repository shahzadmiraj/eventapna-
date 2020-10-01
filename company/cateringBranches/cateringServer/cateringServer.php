<?php
include_once ("../../../connection/connect.php");



if($_POST['option']=="createCatering")
{
    $companyid = $_POST['companyid'];
    $userid=$_POST['userid'];
    $namecatering=$_POST['namecatering'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $radius=$_POST['radius'];
    $Cateringimage = '';
    if (!empty($_FILES['image']["name"]))
    {
        $Cateringimage = "../../../images/catering/" . $_FILES['image']['name'];
        $resultimage = ImageUploaded($_FILES, $Cateringimage);//$dishimage is destination file location;
        if ($resultimage != "") {
            print_r($resultimage);
            exit();
        }
        $Cateringimage = $_FILES['image']['name'];
    }

    $AdvanceAmount=$_POST['AdvanceAmount'];
    $token=uniqueToken('catering');
    $sql = 'INSERT INTO `catering`(`id`, `name`, `expire`, `image`, `company_id`,`active`, `user_id`,`expireUser`, `token`, `AdvancePercentage`) VALUES (NULL,"' . $namecatering . '",NULL,"' . $Cateringimage . '",' . $companyid . ',"' . $timestamp . '",'.$userid.',NULL,"'.$token.'",'.$AdvanceAmount.')';
    querySend($sql);
    $cateringid=mysqli_insert_id($connect);

    $sql='INSERT INTO `cateringLocation`(`id`, `longitude`, `latitude`, `expire`, `country`, `city`, `address`, `active`, `expireUser`, `user_id`, `catering_id`, `radius`) VALUES (
NULL,'.$longitude.','.$latitude.',NULL,"'.$country.'","'.$city.'","'.$address.'","'.$timestamp.'",NULL,'.$userid.','.$cateringid.','.$radius.')';
    querySend($sql);


    $cateringManager=$_POST['cateringManager'];


    $sql='INSERT INTO `BranchesJobStatus`(`id`, `hall_id`, `catering_id`, `ActiveUserId`, `ExpireUserId`, `ActiveDate`, `ExpireDate`, `WorkingStatus`, `user_id`) VALUES (NULL,NULL,'.$cateringid.','.$userid.',NULL,"'.$timestamp.'",NULL,"Manager",'.$cateringManager.')';
    querySend($sql);

}
else if($_POST['option']=="EditCatering")
{


    $cateringid=$_POST['cateringid'];
    $userid=$_POST['userid'];
    $namecatering=$_POST['cateringname'];
    $latitude=$_POST['latitude'];
    $longitude=$_POST['longitude'];
    $address=$_POST['address'];
    $city=$_POST['city'];
    $country=$_POST['country'];
    $radius=$_POST['radius'];
    $Cateringimage= '';
    $Previouslongitude=$_POST['Previouslongitude'];
    $Previouslatitude=$_POST['Previouslatitude'];
    $PreviousRadius=$_POST['PreviousRadius'];
    $Previouslocationid=$_POST['Previouslocationid'];
    if (!empty($_FILES['image']["name"]))
    {
        $Cateringimage = "../../../images/catering/" . $_FILES['image']['name'];
        $resultimage = ImageUploaded($_FILES, $Cateringimage);//$dishimage is destination file location;
        if ($resultimage != "") {
            print_r($resultimage);
            exit();
        }
        $Cateringimage = $_FILES['image']['name'];
    }
    if(($Previouslongitude!=$longitude)||($Previouslatitude!=$latitude)||($PreviousRadius!=$radius))
    {
        $sql='UPDATE cateringLocation as cl SET cl.expire="'.$timestamp.'",cl.expireUser='.$userid.'  WHERE cl.id='.$Previouslocationid.'';
        querySend($sql);
        $sql='INSERT INTO `cateringLocation`(`id`, `longitude`, `latitude`, `expire`, `country`, `city`, `address`, `active`, `expireUser`, `user_id`, `catering_id`, `radius`) VALUES (
NULL,'.$longitude.','.$latitude.',NULL,"'.$country.'","'.$city.'","'.$address.'","'.$timestamp.'",NULL,'.$userid.','.$cateringid.','.$radius.')';
        querySend($sql);
    }
    $sql='SELECT  `name`,`image`, `AdvancePercentage` FROM `catering` WHERE id='.$cateringid.'';
    $cateringDetail=queryReceive($sql);
    $AdvanceAmount=$_POST['AdvanceAmount'];

    if($cateringDetail[0][2]!=$AdvanceAmount)
    {
        //catering Advance Percentage change
        $sql='UPDATE catering as c SET c.AdvancePercentage='.$AdvanceAmount.' WHERE c.id='.$cateringid.'';
        querySend($sql);

        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"catering","AdvancePercentage",'.$cateringDetail[0][2].','.$userid.',"'.$timestamp.'",'.$cateringid.')';
        querySend($sql);
    }
    if($cateringDetail[0][0]!=$namecatering)
    {
        //catering name change
        $sql='UPDATE catering as c SET c.name="'.$namecatering.'" WHERE c.id='.$cateringid.'';
        querySend($sql);

        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"catering","name","'.$cateringDetail[0][0].'",'.$userid.',"'.$timestamp.'",'.$cateringid.')';
        querySend($sql);
    }
    if($cateringDetail[0][1]!=$Cateringimage)
    {

        //catering image change
        $sql='UPDATE catering as c SET c.image="'.$Cateringimage.'" WHERE c.id='.$cateringid.'';
        querySend($sql);

        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"catering","image","'.$cateringDetail[0][1].'",'.$userid.',"'.$timestamp.'",'.$cateringid.')';
        querySend($sql);
    }
    $PreviousManagerId=$_POST['PreviousManagerId'];
    $BranchesJobStatusManagerId=$_POST['BranchesJobStatusManagerId'];
    $currentManager=$_POST['currentManager'];
    if($currentManager!=$PreviousManagerId)
    {
        $sql='UPDATE `BranchesJobStatus` SET ExpireUserId`='.$userid.',`ExpireDate`="'.$timestamp.'"  WHERE id='.$BranchesJobStatusManagerId.'';
        querySend($sql);
        $sql='INSERT INTO `BranchesJobStatus`(`id`, `hall_id`, `catering_id`, `ActiveUserId`, `ExpireUserId`, `ActiveDate`, `ExpireDate`, `WorkingStatus`, `user_id`) VALUES (NULL,NULL,'.$cateringid.','.$userid.',NULL,"'.$timestamp.'",NULL,"Manager",'.$currentManager.')';
        querySend($sql);
    }


}
else if($_POST['option']=="DeleteCatering")
{
    $id=$_POST['id'];
    $userid=$_POST['userid'];
    $sql='UPDATE catering SET expire="'.$timestamp.'",expireUser='.$userid.' WHERE id='.$id.'';
    querySend($sql);

}

include_once("../../../webdesign/footer/EndOfPage.php");
