<?php

include_once ("../../../connection/connect.php");
if($_POST['option']=="deleteItem")
{
    $timestamp = date('Y-m-d H:i:s');
    $id=$_POST['id'];
    $sql='UPDATE Extra_Item as et SET et.expire="'.$timestamp.'" WHERE et.id='.$id.'';
    querySend($sql);

}
else if($_POST['option']=="deleteCategory")
{

    $timestamp = date('Y-m-d H:i:s');
    $id=$_POST['id'];
    $sql='UPDATE Extra_item_type as eit SET eit.expire="'.$timestamp.'"  WHERE eit.id='.$id.'';
    querySend($sql);

}
else if($_POST['option']=="changeCategory")
{
    $value=$_POST['value'];
    $id=$_POST['id'];
    $sql='UPDATE Extra_item_type as eit SET eit.name="'.$value.'" WHERE eit.id='.$id.'';
    querySend($sql);
}
else if($_POST['option']=="addItem")
{

    $companyid=$_POST['companyid'];
    $userid=$_POST['userid'];
    $image='';
    $timestamp = date('Y-m-d H:i:s');
    $name=$_POST['name'];
    $Price=$_POST['Price'];
    $typeofitem=$_POST['typeofitem'];
    $otherTypeName=$_POST['otherTypeName'];
    if(!empty($_FILES['image']["name"]))
    {
        $passbyreference=explode('.',$_FILES['image']['name']);
        $file_ext=strtolower(end($passbyreference));
        $tokenimages=uniqueToken("Extra_Item","image",'.'.$file_ext);
        $image = "../../../images/hallExtra/" .$tokenimages;
        $resultimage = ImageUploaded($_FILES, $image);//$dishimage is destination file location;
        if ($resultimage != "")
        {
            print_r($resultimage);
            exit();
        }
        $image =$tokenimages;
    }
    if($typeofitem=="other")
    {
        $sql='INSERT INTO `Extra_item_type`(`id`, `name`, `active`, `expire`, `user_id`) VALUES (NULL,"'.$otherTypeName.'","'.$timestamp.'",NULL,'.$userid.')';
        querySend($sql);
        $typeofitem=mysqli_insert_id($connect);
    }
    $sql='INSERT INTO `Extra_Item`(`id`, `active`, `expire`, `image`, `price`, `Extra_item_type_id`, `name`, `user_id`) VALUES (NULL,"'.$timestamp.'",NULL,"'.$image.'",'.$Price.','.$typeofitem.',"'.$name.'",'.$userid.')';
    querySend($sql);

    $lastid=mysqli_insert_id($connect);


    if(isset($_POST['branchactive']))
    {
        $branchactive=$_POST['branchactive'];
        for($i=0;$i<count($branchactive);$i++)
        {
            $sql='INSERT INTO `ExtraItemControl`(`id`, `Extra_Item_id`, `hall_id`, `user_id`, `company_id`, `active`, `expire`, `expireUserid`) VALUES (NULL,'.$lastid.','.$branchactive[$i].','.$userid.','.$companyid.',"'.$timestamp.'",NULL,NULL)';
            querySend($sql);
        }
    }

}

else if($_POST['option']=="SubmitExtraItemHallSave")
{
    $companyid=$_POST['companyid'];
    $userid=$_POST['userid'];
    $packageid=$_POST['packageid'];
    $sql='SELECT `hall_id`,`id`,(SELECT hall.name from hall WHERE hall.id=ExtraItemControl.hall_id) FROM `ExtraItemControl` WHERE (ISNULL(expire))AND(Extra_Item_id='.$packageid.')';
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
        $sql='UPDATE `ExtraItemControl` SET `expire`="'.$timestamp.'",`expireUserid`='.$userid.' WHERE id='.$v.'';
        querySend($sql);
    }

    if(isset($_POST['hallactive']))
    {
        //create new
        $hallactive=$_POST['hallactive'];
        for($i=0;$i<count($hallactive);$i++)
        {
            $sql='INSERT INTO `ExtraItemControl`(`id`, `Extra_Item_id`, `hall_id`, `user_id`, `company_id`, `active`, `expire`, `expireUserid`) VALUES (NULL,'.$packageid.','.$hallactive[$i].','.$userid.','.$companyid.',"'.$timestamp.'",NULL,NULL)';
            querySend($sql);
        }
    }


}

?>
<?php
include_once ("../../../webdesign/footer/EndOfPage.php");
?>
