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
$SenderAddress=unserialize(base64_decode($_POST['SenderAddress']));
$SenderName=unserialize(base64_decode($_POST['SenderName']));

    $Subject="Customer Contact to your company";
        $html='h2>I am '.$username.' and my Email is '.$email.',</h2>'.$Message.'<h5>Information by page:</h5>'.$ExtraInformation;
       echo $html;
        //echo serverSendMessage($SenderAddress,$SenderName,$Subject,$html);
}