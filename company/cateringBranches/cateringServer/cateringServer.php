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
    $sql = 'INSERT INTO `catering`(`id`, `name`, `expire`, `image`, `company_id`,`active`, `user_id`,`expireUser`) VALUES (NULL,"' . $namecatering . '",NULL,"' . $Cateringimage . '",' . $companyid . ',"' . $timestamp . '",'.$userid.',NULL)';
    querySend($sql);
    $cateringid=mysqli_insert_id($connect);
    $sql='INSERT INTO `cateringLocation`(`id`, `longitude`, `latitude`, `expire`, `country`, `city`, `address`, `active`, `expireUser`, `user_id`, `catering_id`, `radius`) VALUES (
NULL,'.$longitude.','.$latitude.',NULL,"'.$country.'","'.$city.'","'.$address.'","'.$timestamp.'",NULL,'.$userid.','.$cateringid.','.$radius.')';
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
    $sql='SELECT  `name`,`image` FROM `catering` WHERE id='.$cateringid.'';
    $cateringDetail=queryReceive($sql);
    if($cateringDetail[0][0]!=$namecatering)
    {
        //catering name change
        $sql='UPDATE catering as c SET c.name="'.$namecatering.'" WHERE c.id='.$cateringid.'';
        querySend($sql);

        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`) VALUES (NULL,"catering","name","'.$cateringDetail[0][0].'",'.$userid.',"'.$timestamp.'")';
        querySend($sql);
    }
    if($cateringDetail[0][1]!=$Cateringimage)
    {

        //catering image change
        $sql='UPDATE catering as c SET c.image="'.$Cateringimage.'" WHERE c.id='.$cateringid.'';
        querySend($sql);

        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`) VALUES (NULL,"catering","image","'.$cateringDetail[0][1].'",'.$userid.',"'.$timestamp.'")';
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