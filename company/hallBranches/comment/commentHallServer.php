<?php


include_once ("../../../connection/connect.php");
if($_POST['option']=="CommentOnHall")
{
    $hallid=$_POST['hallid'];
    $comments=$_POST['comment'];
    $userid=$_POST['userid'];
    //$sql='INSERT INTO `comments`(`hall_id`, `catering_id`, `id`, `comment`, `email`, `datetime`, `expire`) VALUES ('.$hallid.',NULL,NULL,"'.$comments.'","'.$email.'","'.$currentdatetime.'",NULL)';
    $sql='INSERT INTO `comments`(`hall_id`, `catering_id`, `id`, `comment`, `expire`, `active`, `user_id`, `PackOrDishId`, `expireUser`) VALUES ('.$hallid.',NULL,NULL,"'.$comments.'",NULL,"'.$timestamp.'",'.$userid.',NULL,NULL)';

    querySend($sql);
}
else if($_POST['option']=="deletecomment")
{
    $id=$_POST['id'];
    $userid=$_POST['userid'];
    $sql='UPDATE `comments` SET `expireUser`="'.$userid.'",expire="'.$timestamp.'" WHERE id='.$id.'';
    querySend($sql);
}