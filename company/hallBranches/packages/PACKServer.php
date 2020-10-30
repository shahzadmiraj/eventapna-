<?php

include_once ("../../../connection/connect.php");
function checkAndUpdatePackageChanges()
{
    global  $_POST,$timestamp;

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
    $clean1 = array_diff($Selectived, $selectedHalls);
    $clean2 = array_diff($selectedHalls, $Selectived);
    $result = array_merge($clean1, $clean2);//different packageControl ids
    if(count($result)>0)
    {
        $List = implode(',', $result);
        $sql='UPDATE `packageControl` SET `expire`="'.$timestamp.'",`expireUserid`='.$userid.' WHERE id in ('.$List.')';
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
    $SelecteditemIds=array();
    if(isset($_POST['SelecteditemIds']))
    {
        $SelecteditemIds=$_POST['SelecteditemIds'];
    }
    $sql='SELECT `id` FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$packageid.')';
    $Previousmenuid=queryReceive($sql);
    $OneD = array_column($Previousmenuid, 0);
    $clean1 = array_diff($OneD, $SelecteditemIds);
    $clean2 = array_diff($SelecteditemIds, $OneD);
    $final_output = array_merge($clean1, $clean2);
    if(count($final_output)>0)
    {
        $List = implode(',', $final_output);
        $sql='UPDATE `menu` SET `expire`="'.$timestamp.'",`ExpireUserId`='.$userid.' WHERE id in ('.$List.')';
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
        $sql='INSERT INTO `menu`(`id`, `itemname`, `expire`, `package_id`, `active`, `itemtype`, `companyid`, `userActive`,`price`,`ExpireUserId`) VALUES (NULL,"'.$itemsName[$i].'",NULL,'.$packageid.',"' . $timestamp . '","'.$itemsType[$i].'",'.$companyid.','.$userid.','.$PriceItem[$i].',NULL)';
        querySend($sql);
    }

}
function onlyChangingOfPackage()
{
    global  $_POST;
    $package_name=$_POST['package_name'];
    $PriceRate=$_POST['PriceRate'];
    $PackagesType=$_POST['PackagesType'];
    $Daytime=$_POST['Daytime'];
    $MinimumGuest=$_POST['MinimumGuest'];
    $describe=$_POST['describe'];
    $packageid=$_POST['packageid'];
    $userid=$_POST['userid'];
    $companyid=$_POST['companyid'];
    $sql='SELECT  `isFood`, `price`, `describe`, `dayTime`, `package_name`,`MinimumGuest` FROM `packages` WHERE (id='.$packageid.')AND(ISNULL(expire))';
    $packageDetail=queryReceive($sql);
    if($packageDetail[0][0]!=$PackagesType)
    {
            return true;
    }
    if($packageDetail[0][1]!=$PriceRate)
    {

        return true;
    }
    if($packageDetail[0][2]!=$describe)
    {

        return true;
    }
    if($packageDetail[0][3]!=$Daytime)
    {
        return true;

    }
    if($packageDetail[0][4]!=$package_name)
    {

        return true;
    }
    if($packageDetail[0][5]!=$MinimumGuest)
    {

        return true;
    }

    return false;
}
function ChangeAndUpdate()
{
    global  $_POST,$timestamp;
    $package_name=$_POST['package_name'];
    $PriceRate=$_POST['PriceRate'];
    $PackagesType=$_POST['PackagesType'];
    $Daytime=$_POST['Daytime'];
    $MinimumGuest=$_POST['MinimumGuest'];
    $describe=$_POST['describe'];
    $packageid=$_POST['packageid'];
    $userid=$_POST['userid'];
    $companyid=$_POST['companyid'];
    $sql='SELECT  `isFood`, `price`, `describe`, `dayTime`, `package_name`,`MinimumGuest`,`id`  FROM `packages` WHERE (id='.$packageid.')AND(ISNULL(expire))';
    $packageDetail=queryReceive($sql);
    $sql='INSERT INTO `package_history`(`id`, `isFood`, `price`, `describe`, `dayTime`, `package_name`, `MinimumGuest`, `packages_id`, `activeDate`, `ActiveUserId`) VALUES (NULL,'.$packageDetail[0][0].','.$packageDetail[0][1].',"'.$packageDetail[0][2].'","'.$packageDetail[0][3].'","'.$packageDetail[0][4].'",'.$packageDetail[0][5].','.$packageDetail[0][6].',"'.$timestamp.'",'.$userid.')';
    querySend($sql);
    $sql='UPDATE `packages` SET  `isFood`='.$PackagesType.',`price`='.$PriceRate.',`describe`="'.trim($describe).'",`dayTime`="'.$Daytime.'",`package_name`="'.$package_name.'",`MinimumGuest`='.$MinimumGuest.' WHERE id='.$packageDetail[0][6].'';
    querySend($sql);
}
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
        $token=uniqueToken('packages',"token",'');
        $sql='INSERT INTO `packages`(`id`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `package_name`, `active`, `user_id`, `expireUser`, `MinimumGuest`,`token`) VALUES (NULL,'.$PackagesType.','.$rate.',"'.$describe.'","'.$daytime.'",NULL,"'.$packagename.'","'.$timestamp.'",'.$userid.',NULL,'.$MinimumGuest.',"'.$token.'")';
        querySend($sql);
        $id=mysqli_insert_id($connect);
        for ($i=0;$i<count($selectedDates);$i++)
        {
            $token=uniqueToken('packageDate',"token",'');
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
            $sql='INSERT INTO `menu`(`id`, `itemname`, `expire`, `package_id`, `active`, `itemtype`, `companyid`, `userActive`,`price`,`ExpireUserId`) VALUES (NULL,"'.$itemsName[$i].'",NULL,'.$id.',"' . $timestamp . '","'.$itemsType[$i].'",'.$companyid.','.$userid.','.$PriceItem[$i].',NULL)';
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

        checkAndUpdatePackageChanges();
        if(onlyChangingOfPackage())
        {
            ChangeAndUpdate();
        }

    }




}

?>
<?php
include_once ("../../../webdesign/footer/EndOfPage.php");
?>
