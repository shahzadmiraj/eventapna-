<?php


include_once ("../../../connection/connect.php");
if($_POST['option']=="commentCatering")
{
    $stars=$_POST['stars'];
    $image='';
    $packageid='NULL';

    if(isset($_POST['packid']))
    {
        $packageid=$_POST['packid'];
    }
    if(!empty($_FILES['image']["name"]))
    {
        $hallimage = "../../../images/hall/" . $_FILES['image']['name'];
        $resultimage = ImageUploaded($_FILES, $hallimage);//$dishimage is destination file location;
        if ($resultimage != "")
        {
            print_r($resultimage);
            exit();
        }

        $image =$_FILES['image']['name'];
    }

    $cateringid=$_POST['cateringid'];
    $comments=$_POST['comment'];
    $userid=$_POST['userid'];
    //$sql='INSERT INTO `comments`(`hall_id`, `catering_id`, `id`, `comment`, `email`, `datetime`, `expire`) VALUES ('.$hallid.',NULL,NULL,"'.$comments.'","'.$email.'","'.$currentdatetime.'",NULL)';
    $sql='INSERT INTO `comments`(`hall_id`, `catering_id`, `id`, `comment`, `expire`, `active`, `user_id`, `PackOrDishId`, `expireUser`, `rating`, `image`) VALUES (NULL,'.$cateringid.',NULL,"'.$comments.'",NULL,"'.$timestamp.'",'.$userid.','.$packageid.',NULL,'.$stars.',"'.$image.'")';

    querySend($sql);
}
else if($_POST['option']=="deletecomment")
{
    $id=$_POST['id'];
    $userid=$_POST['userid'];
    $sql='UPDATE `comments` SET `expireUser`="'.$userid.'",expire="'.$timestamp.'" WHERE id='.$id.'';
    querySend($sql);
}