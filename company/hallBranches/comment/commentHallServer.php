<?php


include_once ("../../../connection/connect.php");
if($_POST['option']=="CommentOnHall")
{
    $stars=$_POST['stars'];
    $image='';
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

    $hallid=$_POST['hallid'];
    $comments=$_POST['comment'];
    $userid=$_POST['userid'];
    //$sql='INSERT INTO `comments`(`hall_id`, `catering_id`, `id`, `comment`, `email`, `datetime`, `expire`) VALUES ('.$hallid.',NULL,NULL,"'.$comments.'","'.$email.'","'.$currentdatetime.'",NULL)';
    $sql='INSERT INTO `comments`(`hall_id`, `catering_id`, `id`, `comment`, `expire`, `active`, `user_id`, `PackOrDishId`, `expireUser`, `rating`, `image`) VALUES ('.$hallid.',NULL,NULL,"'.$comments.'",NULL,"'.$timestamp.'",'.$userid.',NULL,NULL,'.$stars.',"'.$image.'")';

    querySend($sql);
}
else if($_POST['option']=="deletecomment")
{
    $id=$_POST['id'];
    $userid=$_POST['userid'];
    $sql='UPDATE `comments` SET `expireUser`="'.$userid.'",expire="'.$timestamp.'" WHERE id='.$id.'';
    querySend($sql);
}