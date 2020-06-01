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

function checkDetailAndinsert($userPreviousDetail,$username,$PhoneNo,$jobtitle,$image,$CurrentUserid)
{
    global $timestamp;
    if($userPreviousDetail[0][0]!=$username)
    {
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"user","username","'.$userPreviousDetail[0][0].'",'.$CurrentUserid.',"'.$timestamp.'",'.$userPreviousDetail[0][4].')';
        querySend($sql);
        $sql='UPDATE user as u SET u.username="'.$username.'" WHERE u.id='.$userPreviousDetail[0][4].'';
        querySend($sql);

    }
    if($userPreviousDetail[0][3]!=$PhoneNo)
    {
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"user","number","'.$userPreviousDetail[0][3].'",'.$CurrentUserid.',"'.$timestamp.'",'.$userPreviousDetail[0][4].')';
        querySend($sql);
        $sql='UPDATE user as u SET u.number="'.$PhoneNo.'" WHERE u.id='.$userPreviousDetail[0][4].'';
        querySend($sql);
    }
    if($userPreviousDetail[0][2]!=$jobtitle)
    {
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"user","jobTitle","'.$userPreviousDetail[0][2].'",'.$CurrentUserid.',"'.$timestamp.'",'.$userPreviousDetail[0][4].')';
        querySend($sql);
        $sql='UPDATE user as u SET u.jobTitle="'.$jobtitle.'" WHERE u.id='.$userPreviousDetail[0][4].'';
        querySend($sql);
    }
    if(($userPreviousDetail[0][1]!=$image) AND ($image!=""))
    {
        $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"user","image","'.$userPreviousDetail[0][1].'",'.$CurrentUserid.',"'.$timestamp.'",'.$userPreviousDetail[0][4].')';
        querySend($sql);
        $sql='UPDATE user as u SET u.image="'.$image.'" WHERE u.id='.$userPreviousDetail[0][4].'';
        querySend($sql);
    }
}




function CheckUserName($username)
{
    $sql='SELECT  `username` FROM `user` WHERE (username="'.$username.'")';
    $user=queryReceive($sql);
    if(count($user)>0)
    {
        return  true;
    }
    return  false;
}

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

function UserLogin($username,$password)
{
    $sql='SELECT  `username`,`password` FROM `user` WHERE (username="'.$username.'")||(password="'.$password.'")';
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
    $UserExist=CheckUserExist($username,$Email);
    if($UserExist)
    {
        echo "<span class='alert-danger'>User has already available</span> ";
        exit();
    }
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

$string=base64url_encodeLength();
 $sql='INSERT INTO `userSession`(`id`, `username`, `password`, `active`, `expire`, `senderId`, `companyName`, `image`, `jobTitle`, `email`, `number`,`isMakeCompany`,`Companyid` ) VALUES (NULL,"'.$username.'","'.$password.'","'.$timestamp.'",NULL,"'.$string.'","'.$CompanyName.'","'.$image.'","Owner","'.$Email.'","'.$PhoneNo.'",1,NULL)';
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
  // $display=serverSendMessage($Email,$username,"Confirmation of Email",$htmlBody);
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

    $Companyid=$_POST['Companyid'];
    $username=$_POST['username'];
    $Email=$_POST['Email'];
    $PhoneNo=$_POST['PhoneNo'];
    $jobtitle=$_POST['jobtitle'];
    $image="";
    $UserExist=CheckUserExist($username,$Email);
    if($UserExist)
    {
        echo "<span class='alert-danger'> User has already available </span>";
        exit();
    }
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
    $string=base64url_encodeLength();
    $sql='INSERT INTO `userSession`(`id`, `username`, `password`, `active`, `expire`, `senderId`, `companyName`, `image`, `jobTitle`, `email`, `number`,`isMakeCompany`,`Companyid` ) VALUES (NULL,"'.$username.'","'.$password.'","'.$timestamp.'",NULL,"'.$string.'",NULL,"'.$image.'","'.$jobtitle.'","'.$Email.'","'.$PhoneNo.'",0,'.$Companyid.')';
    querySend($sql);



    $last=  mysqli_insert_id($connect);

    $htmlBody='<pre>
Dear '.$username.',
Please click this link for confirmation <a href="?id='.$last.'&confim='.$string.'">www.eventapna.com?id='.$last.'&confim='.$string.'"</a>
username :'.$username.'
password:'.$password.'
email :'.$Email.'
phone no:'.$PhoneNo.'
Position in Company:'.$jobtitle.'
</pre>';

    $display="";
    // $display=serverSendMessage($Email,$username,"Confirmation of Email",$htmlBody);
    if($display=="")
    {
        echo '<p class="alert-success">We have sent an email with a confirmation link to your email address. <a href="?id='.$last.'&confim='.$string.'">resend email </a></p>';
    }
    else
    {
        echo  "<span class='alert-danger'>Check Email :".$display."</span>";
    }

}
else if($_POST['option']=="LocatUserRegisters")
{
    $username=$_POST['username'];
    $Email=$_POST['Email'];
    $password=$_POST['password'];
    $string=base64url_encodeLength();
    $sql='INSERT INTO `userSession`(`id`, `username`, `password`, `active`, `expire`, `senderId`, `companyName`, `image`, `jobTitle`, `email`, `number`,`isMakeCompany`,`Companyid`) VALUES (NULL,"'.$username.'","'.$password.'","'.$timestamp.'",NULL,"'.$string.'",NULL,NULL,"User","'.$Email.'",NULL,0,NULL)';

    querySend($sql);


    $last=  mysqli_insert_id($connect);

    $htmlBody='<pre>
Dear '.$username.',
Please click this link for confirmation <a href="?id='.$last.'&confim='.$string.'">www.eventapna.com?id='.$last.'&confim='.$string.'"</a>
username :'.$username.'
password:'.$password.'
email :'.$Email.'
</pre>';

    $display="";
    //$display=serverSendMessage($Email,$username,"Confirmation of Email",$htmlBody);
    if($display=="")
    {
        echo '<p class="alert-success">We have sent an email with a confirmation link to your email address. <a href="?id='.$last.'&confim='.$string.'">resend email </a></p>';
    }
    else
    {
        echo  "<span class='alert-danger'>Check Email :".$display."</span>";
    }

}
else if($_POST['option']=="login")
{
    $UserName=$_POST['UserName'];
    $password=$_POST['password'];
    $sql='SELECT  `company_id`,`jobTitle`,`id` FROM `user` WHERE (username="'.$UserName.'")AND(password="'.$password.'")';
    $user=queryReceive($sql);
    if(count($user)==1)
    {
        if($user[0][1]=="User")
        {
            echo "back";
        }
        else
        {
            echo 'companyUser';
        }
        setcookie('userid',$user[0][2] , time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
    }
    else
    {
        echo "<span class='alert-danger'>Please enter valid Username and Password </span>";
    }

}
else if($_POST['option']=="saveandChangeLogin")
{

    $CurrentUserid=$_POST['CurrentUserid'];
    $profileUserid=$_POST['profileUserid'];
    $sql='SELECT `username`, `image`,`jobTitle`, `number`, `id` FROM `user` WHERE id='.$profileUserid.'';
    $userPreviousDetail=queryReceive($sql);
    $username=$_POST['username'];
    $PhoneNo=$_POST['PhoneNo'];
    $jobtitle=$_POST['jobtitle'];
    $image="";

    if($userPreviousDetail[0][0]!=$username)
    {

        if(CheckUserName($username))
        {
            echo "<span class='alert-danger'> User name has already available  </span>";
            exit();
        }
    }
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
    checkDetailAndinsert($userPreviousDetail,$username,$PhoneNo,$jobtitle,$image,$CurrentUserid);

    $htmlBody='<pre>
Dear '.$username.',
new detail 
username : '.$username.'
password: '.$userPreviousDetail[0][0].'
email : '.$userPreviousDetail[0][4].'
phone no: '.$PhoneNo.'
Position in Company: '.$jobtitle.'
</pre>';

    $display="";
    // $display=serverSendMessage($Email,$username,"Confirmation of Email",$htmlBody);


}
else if($_POST['option']=="resentPAssword")
{
    $userid=$_POST['userid'];
    $sql='SELECT  `username`, `jobTitle`,`email` , `number`,`password` FROM `user` WHERE id='.$userid.'';
    $userdetail=queryReceive($sql);
    $htmlBody='<pre>
Dear '.$userdetail[0][0].',
new detail 
username : '.$userdetail[0][0].'
password: '.$userdetail[0][4].'
email : '.$userdetail[0][2].'
phone no: '.$userdetail[0][3].'
Position in Company: '.$userdetail[0][1].'
</pre>';

    $display="";
    // $display=serverSendMessage($Email,$username,"Detail  of password",$htmlBody);
    echo "<span class='alert-success'>Your pasword and other detail has been sent to your email :".$userdetail[0][2]."</span>";
}
else if($_POST['option']=="ResetPassword")
{
   $password1=$_POST['password1'];
    $userid=$_POST['userid'];
    $sql='UPDATE `user` SET user.password="'.$password1.'" WHERE id='.$userid.'';

    querySend($sql);

    echo "<span class='alert-success'>Your password has succesfully updated</span>";
}
?>