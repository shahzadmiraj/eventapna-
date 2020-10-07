<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-05
 * Time: 13:39
 */

include_once ("../connection/connect.php");

function changeCheckCustomer($post)
{
    global $timestamp;
    $state=false;
    $sql='SELECT `name`, `cnic`, `id`, `image`, `active`, `expire`, `address`, `company_id` FROM `person` WHERE id='.$post["customerid"].'';
    $previousReault=queryReceive($sql);
    if($post["image"]!=$previousReault[0][3])
    {
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`) VALUES (NULL,"person","image","'.$previousReault[0][3].'",'.$post["userid"].',"'.$timestamp.'")';
        querySend($sql);
        $state=true;
    }
    else  if($post["name"]!=$previousReault[0][0])
    {
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`) VALUES (NULL,"person","name","'.$previousReault[0][0].'",'.$post["userid"].',"'.$timestamp.'")';
        querySend($sql);
        $state=true;
    }
    else  if($post["cnic"]!=$previousReault[0][1])
    {
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`) VALUES (NULL,"person","cnic","'.$previousReault[0][1].'",'.$post["userid"].',"'.$timestamp.'")';
        querySend($sql);
        $state=true;
    }
    else  if($post["address"]!=$previousReault[0][6])
    {
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`) VALUES (NULL,"person","address","'.$previousReault[0][6].'",'.$post["userid"].',"'.$timestamp.'")';
        querySend($sql);
        $state=true;
    }
    return $state;

}
function updateExistcustomer($post)
{
    $sql='UPDATE `person` SET `name`="'.$post["name"].'",`cnic`="'.$post["cnic"].'",`image`="'.$post["image"].'",`address`="'.$post["address"].'" WHERE id='.$post["customerid"].'';
    querySend($sql);
}

if(isset($_POST['option']))
{

     if($_POST['option']=="deleteNumber")
    {
        $userid=$_POST['userid'];
        $id=$_POST['id'];
        //$sql='DELETE FROM number  WHERE id='.$id.'';
        $sql='UPDATE `number` SET `expire`="'.$timestamp.'",`userExpire`='.$userid.' WHERE id='.$id.'';
        querySend($sql);
    }
    else if($_POST['option']=="addNumber")
    {
             $userid=$_POST['userid'];
             $customerId = $_POST['customerid'];
            $numberText=$_POST['number'];

        $sql='INSERT INTO `number`(`number`, `id`, `person_id`, `active`, `expire`, `userActive`, `userExpire`) VALUES ("'.$numberText.'",NULL,'.$customerId.',"'.$timestamp.'",NULL,'.$userid.',NULL)';
        querySend($sql);

    }
    else if($_POST['option']=="EditCustomerform")
    {
        $post=$_POST;
       $post['image']='';
        if(!empty($_FILES['image']['name']))
        {
            $passbyreference=explode('.',$_FILES['image']['name']);
            $file_ext=strtolower(end($passbyreference));
            $tokenimages=uniqueToken("person","image",'.'.$file_ext);
            $image =  "../images/customerimage/"  .$tokenimages;

            //$image = "../images/customerimage/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $image);//$dishimage is destination file location;
            if ($resultimage != "") {
                print_r($resultimage);
                exit();
            }
            $image = $tokenimages;
           $post['image']=$image;
        }
        if(changeCheckCustomer($post))
        {
            updateExistcustomer($post);
        }



    }
}

?>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>
