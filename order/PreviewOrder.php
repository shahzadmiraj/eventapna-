<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
include_once ("../connection/printOrderDetail.php");
if(!isset($_SESSION['order']))
{
    header("location:../user/userDisplay.php");
}
if(isset($_GET['action']))
{
    $orderId=$_SESSION['order'];

    $currentdate = (string) date_create()->format('Y-m-d:H:i:s');
   //$currentdate=date('now');
    //$currentdate="";
    if($_GET['action']=="see")
    {
        action($_COOKIE['username'],$currentdate,$orderId,"I");
        exit();
    }
    else
    {
        action($_COOKIE['username'],$currentdate,$orderId,"D");
        exit();
    }

}
$hallid="";
$cateringid='';
$orderId="";
if(isset($_SESSION['order']))
{
    $orderId=$_SESSION['order'];
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
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
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

    <div class="card text-center card-header">
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



<div class="container row m-auto">


    <a href="?action=see " class="h-25 col-5 shadow text-dark m-2 text-center fa-5x"   resource=""><i class="fas fa-eye"></i><h4>See Bill / Preview order</h4></a>
    <a href="?action=Download" class="h-25 col-5 shadow text-dark m-2 text-center fa-5x" download><i class="fas fa-cloud-download-alt"></i><h4>Download Bill</h4></a>



        <a href="../customer/customerEdit.php?action=preview" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-user-edit fa-5x"></i><h4>Customer Preview</h4></a>
        <?php
            if($hallid!="")
            {
                //1 hall order edit                //2 make hall order to user displaye
                echo '<a href="../company/hallBranches/EdithallOrder.php" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-cart-arrow-down fa-5x"></i><h4>Order Edit</h4></a>';

            }
            else
            {
                //catering order editor                  //2 make catering order to user displaye
                echo '<a href="orderEdit.php?action=preview" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-cart-arrow-down fa-5x"></i><h4>Order edit</h4></a>';
            }
        ?>
    <a href="../user/userDisplay.php" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-grip-horizontal fa-5x"></i><h4>User Display</h4></a>
    <a href="../dish/AllSelectedDishes.php" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-file-word fa-5x"></i><h4>Bill Detail/ extend  </h4></a>
            <a href="../payment/paymentHistory.php" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-history fa-5x"></i><h4>Payment History</h4></a>

            <a href="../payment/getPayment.php" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="far fa-money-bill-alt fa-5x"></i><h4>Get payment from customer</h4></a>
            <a href="../payment/paymentDisplaySend.php" class="h-25 col-5 shadow text-dark m-2 text-center"> <i class="fas fa-share-alt fa-5x"></i><h4>Transfer payment <p>(user to user)</p> </h4></a>

    <a href="../payment/transferPaymentReceive.php" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-clipboard-check fa-5x"></i><h4>Payment Receiving Request <p>(user to user)</p> </h4></a>


</div>



<?php
include_once ("../webdesign/footer/footer.php");
?>

<script>


</script>
</body>
</html>
