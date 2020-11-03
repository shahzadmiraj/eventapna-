<?php
if(!isset($_POST['option']))
    exit();
if($_POST['option']=="CompleteFormSubmitByClient")
{
    $pid=$_POST['pid'];
    $userid=$_COOKIE['userid'];
    $CustomerName=$_POST['CustomerName'];
    $Phoneno=$_POST['Phoneno'];
    $CNICNumber=$_POST['CNICNumber'];
    $customerAddress=$_POST['customerAddress'];
    $listofitemtype='';
    if(isset($_POST['listofitemtype']))
    {
        $listofitemtype=$_POST['listofitemtype'];
    }
    $Arraylistofitemtype=explode(",", $listofitemtype);


}