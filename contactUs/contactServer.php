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
$ExtraInformation=$_POST['ExtraInformation'];
    $SenderAddressList=$_POST['SenderAddress'];
    $SenderNameList=$_POST['SenderName'];

    $SenderAddress=explode(",", $SenderAddressList);
        $SenderName=explode(",", $SenderNameList);
    $Subject="Customer Contact to your company";
        $html='<h2>I am '.$username.' and my Email is '.$email.',</h2><br>Comments:'.$Message.'<h5>Information from page:</h5>'.$ExtraInformation;

        echo serverSendMessage($SenderAddress,$SenderName,$Subject,$html,$email);
}