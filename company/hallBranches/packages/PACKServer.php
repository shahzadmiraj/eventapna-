<?php

include_once ("../../../connection/connect.php");

if(isset($_POST['option']))
{

     if($_POST['option']=="PackDelete")
    {
        $id=$_POST['packageid'];
        $userid=$_POST['userid'];
        $sql='UPDATE `packages` SET expire="'.$timestamp.'",expireUser='.$userid.' WHERE id='.$id.'';
        querySend($sql);
    }
    else if($_POST['option']=="CreatePackage")
    {


        $companyid=$_POST['companyid'];
        $selectedDatesString=$_POST['selectedDates'];
        $selectedDates=explode (",", $selectedDatesString);
        $MinimumGuest=$_POST['MinimumGuest'];
        $PackagesType=$_POST['PackagesType'];
        $userid=$_POST['userid'];
        $daytime=$_POST['Daytime'];
        $packagename=$_POST['packagename'];
        $rate=chechIsEmpty($_POST['rate']);
        $describe=$_POST['describe'];
        $token=uniqueToken('packages');
        $sql='INSERT INTO `packages`(`id`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `package_name`, `active`, `user_id`, `expireUser`, `MinimumGuest`,`token`) VALUES (NULL,'.$PackagesType.','.$rate.',"'.$describe.'","'.$daytime.'",NULL,"'.$packagename.'","'.$timestamp.'",'.$userid.',NULL,'.$MinimumGuest.',"'.$token.'")';
        querySend($sql);
        $id=mysqli_insert_id($connect);
        for ($i=0;$i<count($selectedDates);$i++)
        {
            $token=uniqueToken('packageDate');
            $date=date('Y-m-d ',strtotime(trim($selectedDates[$i])));
            $sql = 'INSERT INTO `packageDate`(`id`, `active`, `expire`, `package_id`, `user_id`, `expireUser`, `selectedDate`, `token`) VALUES (NULL,"' . $timestamp . '",NULL,' . $id . ',' . $userid . ',NULL,"' .$date.'","'.$token.'")';
            querySend($sql);
        }
        $itemsName=array();
        $itemsType=array();
        $PriceItem=array();
        if(isset($_POST['itemsName']))
        {

            $itemsName=$_POST['itemsName'];
            $itemsType=$_POST['itemsType'];
            $PriceItem=$_POST['PriceItem'];
        }
        for ($i=0;($i<count($itemsName));$i++)
        {
            $sql='INSERT INTO `menu`(`id`, `itemname`, `expire`, `package_id`, `active`, `itemtype`, `companyid`, `userActive`,`price`) VALUES (NULL,"'.$itemsName[$i].'",NULL,'.$id.',"' . $timestamp . '","'.$itemsType[$i].'",'.$companyid.','.$userid.','.$PriceItem[$i].')';
            querySend($sql);
        }

        if(isset($_POST['hallactive']))
        {
            $hallactive=$_POST['hallactive'];
            for($i=0;$i<count($hallactive);$i++)
            {
                $sql='INSERT INTO `packageControl`(`id`, `package_id`, `hall_id`, `user_id`, `company_id`, `active`, `expire`, `expireUserid`) VALUES (NULL,'.$id.','.$hallactive[$i].','.$userid.','.$companyid.',"'.$timestamp.'",NULL,NULL)';
                querySend($sql);
            }
        }

    }
    else if($_POST['option']=="SubmitPackagesSave")
    {
        $companyid=$_POST['companyid'];
        $userid=$_POST['userid'];
        $packageid=$_POST['packageid'];
        $sql='SELECT `hall_id`,`id`,(SELECT hall.name from hall WHERE hall.id=packageControl.hall_id) FROM `packageControl` WHERE (ISNULL(expire))AND(package_id='.$packageid.')';
        $Selective=queryReceive($sql); //previous selections
        $Selectived= array_column($Selective, 1);
       $selectedHalls=array();
        if(isset($_POST['selectedHalls']))
        {
           $selectedHalls=$_POST['selectedHalls'];//current selections packageControl ids

        }
        $result=array_diff($Selectived,$selectedHalls); //different packageControl ids

        foreach ($result as $k => $v) //disactive different packageControl ids
        {
            $sql='UPDATE `packageControl` SET `expire`="'.$timestamp.'",`expireUserid`='.$userid.' WHERE id='.$v.'';
            querySend($sql);
        }

        if(isset($_POST['hallactive']))
        {
            //create new
            $hallactive=$_POST['hallactive'];
            for($i=0;$i<count($hallactive);$i++)
            {
                $sql='INSERT INTO `packageControl`(`id`, `package_id`, `hall_id`, `user_id`, `company_id`, `active`, `expire`, `expireUserid`) VALUES (NULL,'.$packageid.','.$hallactive[$i].','.$userid.','.$companyid.',"'.$timestamp.'",NULL,NULL)';
                querySend($sql);
            }
        }


    }




}