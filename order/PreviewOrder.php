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

$hallid="";
$cateringid='';
$orderId="";

$orderId=$processInformation[0][5];
$sql='SELECT od.hall_id,od.catering_id FROM orderDetail as  od WHERE od.id='.$orderId.'';
$result=queryReceive($sql);
if($result[0][0]!="")
{
    $hallid=$result[0][0];
}
else
{
    $cateringid=$result[0][1];
}


$sql='SELECT (SELECT p.name FROM person as p WHERE p.id=od.person_id),od.person_id,(SELECT p.image FROM person as p WHERE p.id=od.person_id) FROM orderDetail as od WHERE od.id='.$orderId.'';
$orderDetailPerson= queryReceive($sql);
$customerID=$orderDetailPerson[0][1];


if($processInformation[0][4]==0)
{
    $sql='UPDATE `BookingProcess` SET `IsProcessComplete`=1 WHERE id='.$processInformation[0][0].'';
    querySend($sql);
}
include('../companyDashboard/includes/startHeader.php'); //html
?>
        <?php
        include('../webdesign/header/InsertHeaderTag.php');
        ?>
        <title>Order Management</title>
        <meta name="description" content="Order Management,Order services, ,Edit Food Order,Edit Order,Change  Catering Order, only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
        <meta name="keywords" content="Management Order Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
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

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order Management</h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
        </div>
    </div>


    <?php
    $whichActive = 6;
    $processInformation[0][4]=1; //complete
    $imageCustomer = "../images/customerimage/";
    $PageName="Order Management";
    include_once("../webdesign/orderWizard/wizardOrder.php");
    ?>



    <?php
    $Query='pid=' . $pid . '&token='.$token;
    ?>

    <div class="container row m-auto  alert-light">


        <form  method="GET" action="../connection/printOrderDetail.php" class="col-6 col-md-3">
            <input type="text" hidden name="userdetail" value="<?php echo $userdetail[0][1];?>">
            <input type="number" hidden name="orderid" value="<?php echo $processInformation[0][5];?>">
            <input type="text" hidden name="ViewOrDownload" value="View">
            <button type="submit"  class="col-12 shadow btn-info ext-center fa-3x" ><i class="fa fa-print" aria-hidden="true"></i><h6>Download PDF Bill</h6></button>
        </form>

        <form  method="GET" action="../connection/printOrderDetail.php" class="col-6  col-md-3">
            <input type="text" hidden name="userdetail" value="<?php echo $userdetail[0][1];?>">
            <input type="number" hidden name="orderid" value="<?php echo $processInformation[0][5];?>">
            <input type="text" hidden name="ViewOrDownload" value="Download">
            <button  type="submit" class="col-12 shadow btn-info m-2 text-center fa-3x" ><i class="fas fa-cloud-download-alt"></i><h6>Download PDF Bill</h6></button>
        </form>

        <?php

        if(onlyAccessUsersWho("Owner,Employee"))
        {
            echo '    <a href="../customer/customerEdit.php?'.$Query.'" class="h-25 col-5  col-md-3 shadow btn-info m-2 text-center fa-3x"><i class="fas fa-user-edit "></i><h6>Customer Preview</h6></a>';
            if ($hallid != "") {
                //1 hall order edit                //2 make hall order to user displaye
                echo '<a href="../company/hallBranches/EdithallOrder.php?' . $Query . '" class="h-25  col-md-3 col-5 shadow btn-info m-2 text-center fa-3x"><i class="fas fa-cart-arrow-down "></i><h6>Hall Order</h6></a>
                    <a href="../company/hallBranches/orderInfo/orderItem.php?' . $Query . '" class="h-25 col-5  col-md-3 shadow btn-info m-2 text-center fa-3x" ><i class="far fa-money-bill-alt"></i><h6>Manage Extra Items</h6></a>       

';
            } else {
                //catering order editor                  //2 make catering order to user displaye
                echo '<a href="orderEdit.php?' . $Query . '" class="h-25 col-5 shadow btn-info m-2 text-center  col-md-3 fa-3x"><i class="fas fa-cart-arrow-down "></i><h6>Catering  Order</h6></a>';
            }


            if ($result[0][1] != "") {
                echo '
             <a href="../dish/AllSelectedDishes.php?' . $Query . '" class="h-25 col-5   col-md-3 shadow btn-info m-2 text-center fa-3x"><i class="fas fa-concierge-bell "></i><h6>Dishes Booking </h6></a>';
            }

        }
        ?>

        <a href="HistoryOrder.php?<?php echo $Query;?>" class="h-25 col-5   col-md-3 shadow btn-info m-2 text-center fa-3x"><i class="fas fa-eraser"></i><h6>Order Changing history </h6></a>
        <a href="../payment/paymentHistory.php?<?php echo $Query;?>" class="h-25  col-md-3 col-5 shadow btn-info m-2 text-center fa-3x"><i class="fas fa-history "></i><h6>Payment History</h6></a>
        <a href="../payment/getPayment.php?<?php echo $Query;?>" class="h-25 col-5 shadow  col-md-3 btn-info m-2 text-center fa-3x"><i class="far fa-money-bill-alt"></i><h6>Get payment from customer</h6></a>
        <a href='../payment/paymentDisplaySend.php?<?php echo $Query;?>' class="h-25 col-5 shadow  col-md-3 btn-info m-2 text-center fa-3x"> <i class="fas fa-share-alt "></i><h6>Transfer payment <p>(user to user)</p> </h6></a>
        <a href='../payment/transferPaymentReceive.php?<?php echo $Query;?>' class="h-25 col-5 shadow  col-md-3 btn-info  m-2 text-center fa-3x"><i class="fas fa-clipboard-check "></i><h6>Payment Receiving Request <p>(user to user)</p> </h6></a>


    </div>



    <script>

        $(document).ready(function ()
        {




        });



    </script>
<?php
include('../companyDashboard/includes/scripts.php');
include('../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>