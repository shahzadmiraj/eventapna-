<?php
include_once ("../../connection/connect.php");
if($_POST['option']=="AddNewBank")
{
    $Account_Holder_Name=$_POST['Account_Holder_Name'];
    $Bank_Name=$_POST['Bank_Name'];
    $IBAN=$_POST['IBAN'];
    $userid=$_POST['userid'];
    $companyid=$_POST['companyid'];

    $sql='INSERT INTO `Bankinfo`(`id`, `BankName`, `BankIBAN`, `BankOwnerName`, `userid`, `activeDate`, `UserIdExpire`, `UserExpire`, `company_id`) VALUES (NULL,"'.$Bank_Name.'","'.$IBAN.'","'.$Account_Holder_Name.'",'.$userid.',"'.$timestamp.'",NULL,NULL,'.$companyid.')';
    querySend($sql);
}
else if($_POST['option']=="RemoveBankAccount")
{
    $idnumberofbank=$_POST['idnumberofbank'];
    $userid=$_POST['userid'];
    $sql='UPDATE `Bankinfo` SET `UserIdExpire`='.$userid.',`UserExpire`="'.$timestamp.'" WHERE id='.$idnumberofbank;
    querySend($sql);

}

?>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>
