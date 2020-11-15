<?php
include_once ("../../../connection/connect.php");

function checkAndUpdateDishControlInCaterings($post)
{

    global $timestamp;
    $companyid=$post['companyid'];
    $userid=$post['userid'];
    $packageid=$post['dishid'];
    $sql = 'SELECT `catering_id`,`id`,(SELECT catering.name from catering WHERE catering.id=cateringPackageControl.catering_id) FROM `cateringPackageControl` WHERE (ISNULL(expire))AND(cateringPackages_id=' . $packageid . ')';
    $Selective=queryReceive($sql); //previous selections
    $Selectived= array_column($Selective, 1);
    $selectedPrevious=array();
    if(isset($post['selected']))
    {
        $selectedPrevious=$post['selected'];//current selections packageControl ids
    }

    $clean1 = array_diff($Selectived, $selectedPrevious);
    $clean2 = array_diff($selectedPrevious, $Selectived);
    $final_output = array_merge($clean1, $clean2);

    for($i=0;$i<count($final_output);$i++)//disactive different packageControl ids
    {
        $sql = 'UPDATE `cateringPackageControl` SET `expire`="' . $timestamp . '",`expireUserid`=' . $userid . ' WHERE id=' . $final_output[$i] . '';
        querySend($sql);
    }
    if(isset($post['active']))
    {
        //create new
        $createActive=$post['active'];
        for($i=0;$i<count($createActive);$i++)
        {
            $sql='INSERT INTO `cateringPackageControl`(`id`, `cateringPackages_id`, `catering_id`, `user_id`, `company_id`, `active`, `expire`, `expireUserid`) VALUES (NULL,'.$packageid.','.$createActive[$i].','.$userid.','.$companyid.',"'.$timestamp.'",NULL,NULL)';
            querySend($sql);
        }

    }




}
if($_POST['option']=="packageADDForm")
{
    $companyid=$_POST['companyid'];
    $dishname=chechIsEmpty($_POST['PackageName']); //PackageName
    $userid=$_POST['userid'];
    $PackagePerHeadRate=$_POST['PackagePerHeadRate'];
    $PackageDescription=$_POST['PackageDescription'];
    $dishimage='';
    if(!empty($_FILES['PackageImage']["name"])) //PackageImage
    {
        $passbyreference=explode('.',$_FILES['PackageImage']['name']);
        $file_ext=strtolower(end($passbyreference));
        $tokenimages=uniqueToken("cateringPackages","image",'.'.$file_ext);
        $dishimage = "../../../images/cateringPackage/".$tokenimages;
        $resultimage = ImageUploaded($_FILES, $dishimage);//$dishimage is destination file location;
        if ($resultimage != "") {
            print_r($resultimage);
            exit();
        }

        $dishimage =$tokenimages;
    }


    $token=uniqueToken("cateringPackages","token",'');
    $sql='INSERT INTO `cateringPackages`(`id`, `packageName`, `description`, `image`, `token`, `PerHeadprice`, `activeDate`, `expireDate`, `activeUser`, `expireUser`) VALUES (NULL,"'.$dishname.'","'.$PackageDescription.'","'.$dishimage.'","'.$token.'",'.$PackagePerHeadRate.',"'.$timestamp.'",NULL,'.$userid.',NULL)';
    querySend($sql);
    $dishid=mysqli_insert_id($connect);
    if(isset($_POST['branchactive']))
    {
        $branchactive=$_POST['branchactive'];
        for($i=0;$i<count($branchactive);$i++)
        {
            $sql='INSERT INTO `cateringPackageControl`(`id`, `cateringPackages_id`, `catering_id`, `user_id`, `company_id`, `active`, `expire`, `expireUserid`) VALUES (NULL,'.$dishid.','.$branchactive[$i].','.$userid.','.$companyid.',"'.$timestamp.'",NULL,NULL)';
            querySend($sql);
        }
    }
}
else if($_POST['option']=="SubmitFormActivationDishes")
{
    $post=$_POST;
    checkAndUpdateDishControlInCaterings($post);
}
include_once("../../../webdesign/footer/EndOfPage.php");
