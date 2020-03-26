<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-11
 * Time: 16:25
 */
include_once ("../../../connection/connect.php");
if(isset($_POST['option']))
{
    if($_POST["option"]=="addDishsystem")
    {
        $dishname=chechIsEmpty($_POST['dishname']);
        $cateringid=$_POST['cateringid'];
        $userid=$_POST['userid'];
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
        $dishtype='';
        if($_POST["dishtype"]=="others")
        {
            $dishtypename=$_POST['otherdishType'];

            $sql='INSERT INTO `dish_type`(`id`, `name`, `expire`, `catering_id`, `active`, `user_id`) VALUES (NULL,"'.$dishtypename.'",NULL,'.$cateringid.',"'.$timestamp.'",'.$userid.')';
            //$sql='INSERT INTO `dish_type`(`id`, `name`, `isExpire`,`catering_id`) VALUES (NULL,"'.$dishtypename.'",NULL,'.$cateringid.')';
            querySend($sql);
            $dishtype=mysqli_insert_id($connect);
        }
        else
        {
            $dishtype=$_POST["dishtype"];
        }
        $sql='INSERT INTO `dish`(`name`, `id`, `image`, `dish_type_id`, `expire`, `catering_id`, `active`, `user_id`) VALUES ("'.$dishname.'",NULL,"'.$dishimage.'",'.$dishtype.',NULL,'.$cateringid.',"'.$timestamp.'",'.$userid.')';
       // $sql='INSERT INTO `dish`(`name`, `id`, `image`, `isExpire`, `dish_type_id`,`catering_id`) VALUES ("'.$dishname.'",NULL,"'.$dishimage.'",NULL,'.$dishtype.','.$cateringid.')';
        querySend($sql);
        $dishid=mysqli_insert_id($connect);
        $countAttribute=0;
            if(isset($_POST['attribute']))
            {
                $addAttributes = $_POST['attribute'];
                $countAttribute=count($addAttributes);
                $CountQuantity=0;

                $prices=$_POST['price'];
                $quantity=$_POST['quantity'];
                for($i=0;$i<count($prices);$i++)
                {
                    $sql='INSERT INTO `dishWithAttribute`(`id`, `active`, `expire`, `price`, `dish_id`, `user_id`) VALUES (NULL,"'.$timestamp.'",NULL,'.$prices[$i].','.$dishid.','.$userid.')';
                    querySend($sql);
                    $dishWithAttributeid=mysqli_insert_id($connect);
                    for($j=0;$j<$countAttribute;$j++)
                    {
                        $sql='INSERT INTO `attribute`(`name`, `id`, `expire`, `active`, `quantity`, `dishWithAttribute_id`, `user_id`) VALUES ("'.$addAttributes[$j].'",NULL,NULL,"'.$timestamp.'",'.checknumberOtherNull($quantity[$CountQuantity]).','.$dishWithAttributeid.','.$userid.')';
                        querySend($sql);
                        $CountQuantity++;
                    }

                }
            }
            else
            {
                $dishprice=$_POST['dishprice'];
                $sql='INSERT INTO `dishWithAttribute`(`id`, `active`, `expire`, `price`, `dish_id`, `user_id`) VALUES (NULL,"'.$timestamp.'",NULL,'.$dishprice.','.$dishid.','.$userid.')';
                querySend($sql);
            }


    }
    else if($_POST['option']=="attributesCreate")
    {
        $dishid=$_POST["dishid"];
        if(!isset($_POST['attribute']))
        {
            exit();
        }
        $addAttributes=$_POST['attribute'];
        for($i=0;$i<count($addAttributes);$i++)
        {
            $sql='INSERT INTO `attribute`(`name`, `id`, `dish_id`, `isExpire`) VALUES ("'.$addAttributes[$i].'",NULL,'.$dishid.',NULL)';
            querySend($sql);
        }
    }
    else if($_POST['option']=="dishchanges")
    {
        $dishid=$_POST['dishid'];
        $column=$_POST['column'];
        $text=chechIsEmpty($_POST['text']);
        $sql='UPDATE `dish` SET '.$column.'="'.$text.'" WHERE id='.$dishid.'';
        querySend($sql);
    }
    else if($_POST['option']=='changeAttributes')
    {
        $attributeid=$_POST['attributeid'];
        $text=chechIsEmpty($_POST['text']);
        $sql='UPDATE `attribute` SET `name`="'.$text.'" WHERE id='.$attributeid.'';
        querySend($sql);
    }
    else if($_POST['option']=="RemoveAttribute")
    {
        $attributeid=$_POST['attributeid'];
        $timestamp = date('Y-m-d H:i:s');
        $sql='UPDATE attribute as a SET a.isExpire="'.$timestamp.'" WHERE a.id='.$attributeid.'';
        querySend($sql);
    }
    else if($_POST['option']=="ExpireDish")
    {
        $dishid=$_POST['dishid'];
        $sql='UPDATE dish SET expire="'.$timestamp.'" WHERE id='.$dishid.'';
        querySend($sql);
    }
    else if($_POST['option']=="ExpireDishPrice")
    {
        $timestamp = date('Y-m-d H:i:s');
        $dishid=$_POST['dishid'];
        $sql='UPDATE dishWithAttribute SET expire="'.$timestamp.'" WHERE id='.$dishid.'';
        querySend($sql);
    }
    else if($_POST['option']=="addnewDishprice")
    {
        $userid=$_POST['userid'];
        $addAttributes = $_POST['attribute'];
        $countAttribute=count($addAttributes);
        $dishid=$_POST['dishid'];

        $price=checknumberOtherNull($_POST['price']);
        $quantity=$_POST['quantity'];

            $sql='INSERT INTO `dishWithAttribute`(`id`, `active`, `expire`, `price`, `dish_id`, `user_id`) VALUES (NULL,"'.$timestamp.'",NULL,'.$price.','.$dishid.','.$userid.')';
            querySend($sql);
            $dishWithAttributeid=mysqli_insert_id($connect);
            for($j=0;$j<$countAttribute;$j++)
            {
                $sql='INSERT INTO `attribute`(`name`, `id`, `expire`, `active`, `quantity`, `dishWithAttribute_id`, `user_id`) VALUES ("'.$addAttributes[$j].'",NULL,NULL,"'.$timestamp.'",'.checknumberOtherNull($quantity[$j]).','.$dishWithAttributeid.','.$userid.')';
                querySend($sql);
            }


    }
    else if($_POST['option']=="changeDishType")
    {
        $id=$_POST['id'];
        $value=chechIsEmpty($_POST['value']);
        $sql='UPDATE dish_type as dt SET dt.name="'.$value.'" WHERE dt.id='.$id.'';
        querySend($sql);
    }
    else if($_POST['option']=="Delele_Dish_Type")
    {
        $id=$_POST['id'];
        $value=chechIsEmpty($_POST['value']);
        if($value=="Disable")
        {
            $timestamp = date('Y-m-d H:i:s');
            $sql = 'UPDATE dish_type as dt SET dt.expire="' . $timestamp . '" WHERE dt.id=' . $id . '';
        }
        else
        {

            $sql = 'UPDATE dish_type as dt SET dt.expire=NULL WHERE dt.id=' . $id . '';
        }
        querySend($sql);
    }
    else if ($_POST['option']=="changeImage")
    {
        if(empty($_FILES['image']["name"]))
        {
            exit();

        }
        $dishId=$_POST['dishId'];



        $dishimage="../../../images/dishImages/".$_FILES['image']['name'];
        $resultimage=ImageUploaded($_FILES,$dishimage);//$dishimage is destination file location;
        if($resultimage!="")
        {
            print_r($resultimage);
            exit();
        }

        $dishimage=$_FILES['image']['name'];
        $sql='UPDATE `dish` SET image="'.$dishimage.'" WHERE id='.$dishId.'';
        querySend($sql);


        $imagepath=$_POST['imagepath'];
        if(file_exists("../../../images/dishImages/".$imagepath))
        {
            unlink("../../../images/dishImages/".$imagepath);
        }


    }
}


?>