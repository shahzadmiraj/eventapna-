<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-10
 * Time: 11:50
 */

include_once ("../connection/connect.php");
require_once('../Mail/libraries/PHPMailer.php');
require_once('../Mail/libraries/SMTP.php');
include_once ("../Mail/sending/SendingMail.php");


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
    echo "<span class='alert-danger'>User has existed</span> ";
    exit();
}
$string=base64url_encodeLength();
$sql='INSERT INTO `userSession`(`id`, `username`, `password`, `active`, `expire`, `senderId`, `companyIdentificaton`, `image`, `jobTitle`, `email`, `number`) VALUES (NULL,"'.$username.'","'.$password.'","'.$timestamp.'",NULL,"'.$string.'","'.$CompanyName.'","'.$image.'","Owner","'.$Email.'","'.$PhoneNo.'")';
querySend($sql);
$last=  mysqli_insert_id($connect);

$htmlBody='<pre>
Dear '.$username.',
Please click this link for confirmation <a href="?id='.$last.'&confim='.$string.'">www.eventapna.com?id='.$last.'&confim='.$string.'"</a>
username :'.$username.'
password:'.$password.'
email :'.$Email.'
company name:'.$CompanyName.'
phone no:'.$PhoneNo.'
</pre>';
    $display="";
   $display=serverSendMessage($Email,$username,"Confirmation of Email",$htmlBody);
    if($display=="")
    {
        echo '<p class="alert-success">We have sent an email with a confirmation link to your email address. <a href="?id='.$last.'&confim='.$string.'">resend email</a></p>';
    }
    else
    {
        echo  "<span class='alert-danger'>Check Email :".$display."</span>";
    }

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