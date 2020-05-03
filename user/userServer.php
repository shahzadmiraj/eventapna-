<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-10
 * Time: 11:50
 */

include_once ("../connection/connect.php");

function CheckUserExist($username,$Email)
{
    $sql='SELECT  `username`,`email` FROM `user` WHERE (username="'.$username.'")||(email="'.$Email.'")';
    $user=queryReceive($sql);
    if(count($user)>0)
    {
        return  true;
    }
    return  false;
}


if($_POST['option']=="RegisterCompanyWithUserAlso")
{
$CompanyName=$_POST['CompanyName'];
$username=$_POST['username'];
$Email=$_POST['Email'];
$PhoneNo=$_POST['PhoneNo'];
    $image="";
    if(!empty($_FILES['image']["name"]))
    {
        $image = "../images/users/" . $_FILES['image']['name'];
        $resultimage = ImageUploaded($_FILES, $image);//$dishimage is destination file location;
        if ($resultimage != "") {
            print_r($resultimage);
            exit();
        }
        $image =$_FILES['image']['name'];
    }

$password=$_POST['password'];
$UserExist=CheckUserExist($username,$Email);
if($UserExist)
{
    echo "User has existed ";
    exit();
}
$string=base64url_encodeLength();
$sql='INSERT INTO `userSession`(`id`, `username`, `password`, `active`, `expire`, `senderId`, `companyName`, `image`, `jobTitle`, `email`, `number`) VALUES (NULL,"'.$username.'","'.$password.'","'.$timestamp.'",NULL,"'.$string.'","'.$CompanyName.'","'.$image.'","Owner","'.$Email.'","'.$PhoneNo.'")';
$UserSession=queryReceive($sql);

}
else if($_POST['option']=="companyWithUser")
{

}
else if($_POST['option']=="CompanyUserRegister")
{

}



?>