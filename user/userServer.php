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
$sql='INSERT INTO `userSession`(`id`, `username`, `password`, `active`, `expire`, `senderId`, `companyIdentificaton`, `image`, `jobTitle`, `email`, `number`) VALUES (NULL,"'.$username.'","'.$password.'","'.$timestamp.'",NULL,"'.$string.'","'.$CompanyName.'","'.$image.'","Owner","'.$Email.'","'.$PhoneNo.'")';
querySend($sql);

}
else if($_POST['option']=="RegisterUserofCompany")
{

    $CompanyName=$_POST['Companyid'];
    $username=$_POST['username'];
    $Email=$_POST['Email'];
    $PhoneNo=$_POST['PhoneNo'];
    $jobtitle=$_POST['jobtitle'];
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
        echo "<span class='alert-danger'> User has existed </span>";
        exit();
    }
    $string=base64url_encodeLength();
    $sql='INSERT INTO `userSession`(`id`, `username`, `password`, `active`, `expire`, `senderId`, `companyIdentificaton`, `image`, `jobTitle`, `email`, `number`) VALUES (NULL,"'.$username.'","'.$password.'","'.$timestamp.'",NULL,"'.$string.'","'.$CompanyName.'","'.$image.'","'.$jobtitle.'","'.$Email.'","'.$PhoneNo.'")';
    querySend($sql);

}
else if($_POST['option']=="LocatUserRegisters")
{
    $username=$_POST['username'];
    $Email=$_POST['Email'];
    $password=$_POST['password'];
    $string=base64url_encodeLength();
    $sql='INSERT INTO `userSession`(`id`, `username`, `password`, `active`, `expire`, `senderId`, `companyIdentificaton`, `image`, `jobTitle`, `email`, `number`) VALUES (NULL,"'.$username.'","'.$password.'","'.$timestamp.'",NULL,"'.$string.'",NULL,NULL,"User","'.$Email.'",NULL)';
    querySend($sql);
}



?>