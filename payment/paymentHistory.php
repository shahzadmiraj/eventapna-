<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
include  ("../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfOrderBooked("Owner,Employee","../index.php");



$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);


$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);
$userId=$_COOKIE['userid'];
$orderDetail_id=$processInformation[0][5];

$sql='SELECT (SELECT p.name FROM person as p WHERE p.id=od.person_id),od.person_id,(SELECT p.image FROM person as p WHERE p.id=od.person_id) FROM orderDetail as od WHERE od.id='.$orderDetail_id.'';
$orderDetailPerson= queryReceive($sql);
$customerID=$orderDetailPerson[0][1];

include('../companyDashboard/includes/startHeader.php'); //html
?>


    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Payment History</title>
    <meta name="description" content="Payment History check only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Payment History check  Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <!--<script type="text/javascript" src="../bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <!--<link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
    <script src="../webdesign/JSfile/JSFunction.js"></script>

    <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->

    <!-- Custom fonts for this template-->
    <link href="<?php echo $Root;?>companyDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <!-- Custom styles for this template-->
    <link href="<?php echo $Root;?>companyDashboard/css/sb-admin-2.min.css" rel="stylesheet">

<?php
include('../companyDashboard/includes/endHeader.php');
include('../companyDashboard/includes/navbar.php');
?>

<?php

$whichActive = 5;
$imageCustomer = "../images/customerimage/";
$PageName="Payment History";

include_once("../webdesign/orderWizard/wizardOrder.php");
?>

<div class="container mt-5">
    <div class="row" style="background-color: #80bdff">
        <?php
        $sql='SELECT py.id,(SELECT u.username FROM user as u where u.id=py.user_id) as sender,
(SELECT u.username FROM user as u where u.id=t.user_id) as receiver,py.amount,
t.senderTimeDate,t.Isconfirm,py.receive,py.nameCustomer,py.IsReturn,t.Isget
FROM orderDetail as ot INNER JOIN payment as py
on ot.id=py.orderDetail_id
INNER join transfer as t
on py.id=t.payment_id
WHERE (ot.id='.$orderDetail_id.')';
        $historyPayment=queryReceive($sql);
        $display='';

for($k=0;$k<count($historyPayment);$k++)
{

   $display.=' <div class="col-sm-12   col-12 col-md-6 col-lg-6    card" >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Payment Id </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][0].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Sender User </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][1].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Receive User </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][2].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Amount</label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][3].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Sending Date </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][4].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Receiving Date </label >
            <label class="col-8 col-form-label" > ';

            if($historyPayment[$k][5]=="")
            {
                $display.= "request has delivered for confirm to user";
            }
            else
            {
                $display.= $historyPayment[$k][5];
            }
         $display.= ' </label >
        </div >

        <div class="form-group row" >
            <label class="col-4 col-form-label" > Geting payment Date </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][6].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Customer Name </label >
            <label class="col-8 col-form-label" > '.$historyPayment[$k][7].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > payment status </label >
            <label class="col-8 col-form-label" > ';
             if($historyPayment[$k][8]==0)
             {
                 $display.='get payment from customer';
             }
             else
             {

                 $display.='return payment to customer';
             }


             $display.='</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > transfer Status </label >
            <label class="col-8 col-form-label" > ';

                 if($historyPayment[$k][9]==0)
                 {
                     $display.="not confirm";
                 }
                 else
                 {
                     $display.="yes,I get the amount from user";
                 }
                $display.= '
            </label >
        </div >
    </div >';

}
        echo $display;

?>

    </div>



    <h1 align = "center" >Your received Payment </h1 >
    <div class="row">

        <?php

        $sql='SELECT py.id,(SELECT u.username FROM user as u where u.id=py.user_id), py.amount,py.receive,py.nameCustomer,py.IsReturn FROM orderDetail as ot INNER JOIN payment as py on ot.id=py.orderDetail_id WHERE (ot.id='.$orderDetail_id.') AND (py.sendingStatus=0)';
        $WhyPayment=queryReceive($sql);
$display='';
        for($t=0;$t<count($WhyPayment);$t++)
        {

    $display.='<div class="col-sm-12   col-12 col-md-6 col-lg-6    card" >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Payment Id </label >
            <label class="col-8 col-form-label" > '.$WhyPayment[$t][0].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > User Name </label >
            <label class="col-8 col-form-label" > '.$WhyPayment[$t][1].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Amount</label >
            <label class="col-8 col-form-label" > '.$WhyPayment[$t][2].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Receiving Date </label >
            <label class="col-8 col-form-label" > '.$WhyPayment[$t][3].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > Customer Name </label >
            <label class="col-8 col-form-label" > '.$WhyPayment[$t][4].'</label >
        </div >
        <div class="form-group row" >
            <label class="col-4 col-form-label" > payment status </label >
            <label class="col-8 col-form-label" > ';
        if($WhyPayment[$t][5]==0)
        {
            $display.='get payment from customer';
        }
        else
        {

            $display.='return payment to customer';
        }
            $display.='</label >
        </div >
    </div >';

        }
        echo $display;

?>




    </div>
</div>




<?php
include('../companyDashboard/includes/scripts.php');
include('../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>