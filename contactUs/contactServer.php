<?php

include_once ("../connection/connect.php");
require_once('../Mail/libraries/PHPMailer.php');
require_once('../Mail/libraries/SMTP.php');
include_once ("../Mail/sending/SendingMail.php");

if($_POST['option']=="EmailSentbycontact")
{
$username=$_POST['username'];
$email=$_POST['email'];
$Message=$_POST['Message'];
$userids=$_POST['userids'];
$ExtraInformation=$_POST['ExtraInformation'];
$SenderAddress=array();
$SenderName=array();

for($i=0;$i<count($userids);$i++)
{
    $sql='SELECT `email`, `username` FROM `user` WHERE id='.$userids[$i].'';
    $result=queryReceive($sql);
    $SenderAddress[$i]=$result[0][0];
    $SenderName[$i]=$result[0][1];
}
    $Subject="Customer Contact to your company";
        $html='h2>I am '.$username.' and my Email is '.$email.',</h2>'.$Message.'<h5>Information by page:</h5>'.$ExtraInformation;
        echo serverSendMessage($SenderAddress,$SenderName,$Subject,$html);
}