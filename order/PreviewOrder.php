<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");

include_once ("../connection/printOrderDetail.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);



$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);


if(isset($_GET['action']))
{
    $orderId=$processInformation[0][5];

    $currentdate = (string) date_create()->format('Y-m-d:H:i:s');
   //$currentdate=date('now');
    //$currentdate="";
    if($_GET['action']=="see")
    {
        action($userdetail[0][1],$currentdate,$orderId,"I");
        exit();
    }
    else
    {
        action($userdetail[0][1],$currentdate,$orderId,"D");
        exit();
    }

}
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
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <style>

    </style>
</head>
<body>
<?php
include_once ("../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://www.myofficeapps.com/wp-content/uploads/2017/10/streamline-process.jpg);background-size:100% 130%;background-repeat: no-repeat">

    <div class="card-body text-center" style="opacity: 0.7 ;background: #fdfdff;">
        <h3 ><i class="fas fa-book fa-2x mr-2"></i>Order informations </h3>
    </div>

</div>
<div class="row justify-content-center col-12" style="margin-top: -60px">

    <div class="card text-center">
    <img src="<?php




    if(file_exists('../images/customerimage/'.$orderDetailPerson[0][2])&&($orderDetailPerson[0][2]!=""))
    {
        echo '../images/customerimage/'.$orderDetailPerson[0][2];
    }
    else
    {
        echo 'https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';
    }


    ?> " style="height: 20vh;" class="figure-img rounded-circle" alt="image is not set">
        <h5 ><?php
            echo  $orderDetailPerson[0][0];
            ?></h5>
        <label >Order ID:<?php
            echo  $orderId;
            ?></label>
    </div>
</div>


<?php

$Query='pid=' . $pid . '&token='.$token;
?>

<div class="container row m-auto  alert-light">
<h3 class="col-12 h-25">Order Detail</h3>



    <a href="?action=see&<?php echo $Query;?>" class="h-25 col-5 shadow btn-info m-2 text-center fa-3x"   resource=""><i class="fa fa-print" aria-hidden="true"></i>  <h6>See PDF Bill</h6></a>
    <a href="?action=Download&<?php echo $Query;?>" class="h-25 col-5 shadow btn-info m-2 text-center fa-3x" download><i class="fas fa-cloud-download-alt"></i><h6>Download PDF Bill</h6></a>



        <a href="../customer/customerEdit.php?<?php echo $Query;?>" class="h-25 col-5 shadow btn-info m-2 text-center"><i class="fas fa-user-edit fa-3x"></i><h6>Customer Preview</h6></a>
        <?php
            if($hallid!="")
            {
                //1 hall order edit                //2 make hall order to user displaye
                echo '<a href="../company/hallBranches/EdithallOrder.php?'.$Query.'" class="h-25 col-5 shadow btn-info m-2 text-center"><i class="fas fa-cart-arrow-down fa-3x"></i><h6>Hall Order</h6></a>';

            }
            else
            {
                //catering order editor                  //2 make catering order to user displaye
                echo '<a href="orderEdit.php?'.$Query.'" class="h-25 col-5 shadow btn-info m-2 text-center"><i class="fas fa-cart-arrow-down fa-3x"></i><h6>Catering  Order</h6></a>';
            }
        ?>



    <a href='../dish/AllSelectedDishes.php?<?php echo $Query;?>' class="h-25 col-5 shadow btn-info m-2 text-center"><i class="fas fa-concierge-bell fa-3x"></i><h6>Dishes Booking </h6></a>
            <a href='../payment/paymentHistory.php?<?php echo $Query;?>' class="h-25 col-5 shadow btn-info m-2 text-center"><i class="fas fa-history fa-3x"></i><h6>Payment History</h6></a>

    <a href='HistoryOrder.php?<?php echo $Query;?>' class="h-25 col-5 shadow btn-info m-2 text-center"><i class="fas fa-eraser fa-3x"></i><h6>Order Changing history </h6></a>

            <a href='../payment/getPayment.php?<?php echo $Query;?>' class="h-25 col-5 shadow btn-info m-2 text-center"><i class="far fa-money-bill-alt fa-3x"></i><h6>Get payment from customer</h6></a>
            <a href='../payment/paymentDisplaySend.php?<?php echo $Query;?>' class="h-25 col-5 shadow btn-info m-2 text-center"> <i class="fas fa-share-alt fa-3x"></i><h6>Transfer payment <p>(user to user)</p> </h6></a>

    <a href='../payment/transferPaymentReceive.php?<?php echo $Query;?>' class="h-25 col-5 shadow btn-info  m-2 text-center"><i class="fas fa-clipboard-check fa-3x"></i><h6>Payment Receiving Request <p>(user to user)</p> </h6></a>


</div>



<?php
include_once ("../webdesign/footer/footer.php");
?>

<script>



</script>
</body>
</html>
