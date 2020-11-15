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
    $Subject="Test begar";
        $html=$Message;

        echo serverSendMessage($email,$SenderName,$Subject,$html,$email);
}

include_once("../webdesign/footer/EndOfPage.php");
