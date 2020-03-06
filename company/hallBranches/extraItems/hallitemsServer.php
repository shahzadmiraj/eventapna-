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

    $image='';
    $timestamp = date('Y-m-d H:i:s');
    $hall=$_POST['hall'];
    $name=$_POST['name'];
    $Price=$_POST['Price'];
    $typeofitem=$_POST['typeofitem'];
    $otherTypeName=$_POST['otherTypeName'];
    if(!empty($_FILES['image']["name"]))
    {
        $image = "../../../images/hallExtra/" . $_FILES['image']['name'];
        $resultimage = ImageUploaded($_FILES, $image);//$dishimage is destination file location;
        if ($resultimage != "")
        {
            print_r($resultimage);
            exit();
        }
        $image =$_FILES['image']['name'];
    }
    if($typeofitem=="other")
    {
        $sql='INSERT INTO `Extra_item_type`(`id`, `name`, `active`, `expire`, `hall_id`) VALUES (NULL,"'.$otherTypeName.'","'.$timestamp.'",NULL,'.$hall.')';
        querySend($sql);
        $typeofitem=mysqli_insert_id($connect);
    }
    $sql='INSERT INTO `Extra_Item`(`id`, `active`, `expire`, `image`, `price`, `Extra_item_type_id`, `name`) VALUES (NULL,"'.$timestamp.'",NULL,"'.$image.'",'.$Price.','.$typeofitem.',"'.$name.'")';
    querySend($sql);
}
?>