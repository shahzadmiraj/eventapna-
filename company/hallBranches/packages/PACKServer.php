<?php

include_once ("../../../connection/connect.php");
include_once ("packagesServerfunction.php");


if(isset($_POST['option']))
{
    if ($_POST['option'] == "jsonPackagesDetail")
    {


        $packagesid = $_POST['packagesid'];

        $sql = 'SELECT `id`, `month`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `hall_id`, `package_name` FROM `hallprice` WHERE id=' . $packagesid . '';
        $packageDetail = mysqli_query($connect, $sql);

        $sql = 'SELECT `id`, `dishname`, `image`, `expire`, `hallprice_id` FROM `menu` WHERE (hallprice_id=' . $packagesid . ') AND ISNULL(expire)';
        $menuDetail = mysqli_query($connect, $sql);

        $json_package = array();
        while ($row = mysqli_fetch_assoc($packageDetail)) {
            $json_package[] = $row;
        }
        $json_menu = array();
        while ($row = mysqli_fetch_assoc($menuDetail)) {
            $json_menu[] = $row;
        }
        $json = array($json_package, $json_menu);
        echo json_encode($json);

    }
    else if($_POST['option']=="PackDelete")
    {
        $id=$_POST['packageid'];
        $userid=$_POST['userid'];
        $sql='UPDATE `packages` SET expire="'.$timestamp.'",expireUser='.$userid.' WHERE id='.$id.'';
        querySend($sql);
    }
    else if($_POST['option']=="formDishadd")
    {

        $dishname=chechIsEmpty($_POST['dishname']);
        $dishimage='';
        if(!empty($_FILES['image']["name"]))
        {
            $dishimage = "../../../images/dishImages/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $dishimage);//$dishimage is destination file location;
            if ($resultimage != "") {
                print_r($resultimage);
                exit();
            }
            $dishimage =$_FILES['image']['name'];
        }
        /* $sql='INSERT INTO `systemDish`(`name`, `id`, `image`, `isExpire`, `systemDishType_id`) VALUES ("'.$dishname.'",NULL,"'.$dishimage.'",NULL,NULL)';
         querySend($sql);*/
        $userid=$_POST['userid'];
        $companyid=$_POST['$companyid'];
        $sql='INSERT INTO `systemItem`(`id`, `image`, `active`, `expire`, `user_id`, `company_id`, `name`) VALUES (NULL,"'.$dishimage.'","'.$timestamp.'",NULL,'.$userid.','.$companyid.',"'.$dishname.'")';
        querySend($sql);
        // $sql = 'SELECT `name`, `id`, `image` FROM `systemDish` WHERE ISNULL(isExpire) ';
        $sql='SELECT  `name`,`id`, `image` FROM `systemItem` WHERE (ISNULL(expire))AND(company_id='.$companyid.')';
        echo dishesOfPakage($sql);

    }




}