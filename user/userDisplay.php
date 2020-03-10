<?php
include_once ("../connection/connect.php");

$hallid='';
$cateringid='';



if(isset($_SESSION['branchtype']))
{

    if($_SESSION['branchtype']=="hall")
    {
        $hallid=$_SESSION['branchtypeid'];
    }
    else
    {
        $cateringid=$_SESSION['branchtypeid'];
    }


}
else
{
    header("location:../company/companyRegister/companydisplay.php");
}

if(isset($_SESSION['order']))
{
    unset($_SESSION['order']);
}
if(isset($_SESSION['customer']))
{
    unset($_SESSION['customer']);
}

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

<?php
$display='';
if($_SESSION['branchtype']=="hall")
{

    //hall
    $sql='SELECT name,image FROM `hall` WHERE id='.$hallid.'';
    $hallinfo=queryReceive($sql);

    $display.= '<div class="jumbotron  shadow" style="background-image: url(';

    if(file_exists('../images/hall/'.$hallinfo[0][1]))
    {
        $display.="'../images/hall/".$hallinfo[0][1]."'";
    }
    else
    {
        $display.='https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg';

    }




    $display.=');background-size:100% 115%;background-repeat: no-repeat">
    <div class="card-body text-center" style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 ">'.$hallinfo[0][0].'</h1>
        <h3><i class="fas fa-tasks mr-3"></i>User Display</h3>
        <p class="lead">Trace your orders and payments </p>
    </div>
</div>';
}
else
{
                    //catering

    $sql='SELECT `name`, `image` FROM `catering` WHERE id='.$cateringid.'';
    $cateringinfo=queryReceive($sql);


    $display.= '<div class="jumbotron  shadow" style="background-image: url(';



    if(file_exists('../images/catering/'.$cateringinfo[0][1]))
    {
        $display.="'../images/catering/".$cateringinfo[0][1]."'";
    }
    else
        {
        $display .= 'https://www.liberaldictionary.com/wp-content/uploads/2019/02/cater-4956.jpg';

    }


    $display.=');background-size:100% 115%;background-repeat: no-repeat">
    <div class="card-body text-center" style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 ">'.$cateringinfo[0][0].'</h1>
               <h3><i class="fas fa-tasks mr-3"></i>User Display</h3>

        <p class="lead">.Trace your orders and payments</p>
    </div>
</div>';
}
echo $display;
?>



    <div class="container row m-auto">
<!--        $OrderStatus=array("running","cancel","delieved","clear");-->
            <a href="../customer/CustomerCreate.php?" class="h-25 col-5 shadow text-dark m-2 text-center">
                <i class="fas fa-cart-plus fa-5x"></i><h3>Order Create</h3></a>

        <a href="../order/FindOrder.php?order_status=Today_Orders" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-book-reader fa-5x"></i><h3>Today Orders</h3></a>
        <a href="../order/FindOrder.php?order_status=Running" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-cart-arrow-down fa-5x"></i><h3>Running Order</h3></a>
            <a href="../order/FindOrder.php?order_status=Delieved" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-truck fa-5x"></i><h3>Deliever Orders</h3></a>
            <a href="../order/FindOrder.php?order_status=Clear" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="far fa-thumbs-up fa-5x"></i><h3>Clear Orders</h3></a>
            <a href="../order/FindOrder.php?order_status=Cancel" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="far fa-trash-alt fa-5x"></i><h3>Cancel Orders</h3></a>
<!--            <a href="/public_html/payment/transferPaymentReceive.php?option=userDisplay" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-money-bill-alt fa-5x"></i><h3>Receive payment</h3></a>-->
    <!--        <a href="/public_html/system/dish/dishesDetail.php" class="h-25 col-6"><h1>Guideline Dishes</h1></a>
            <a href="/public_html/system/user/usercreate.php" class="h-25 col-6"><h1>User Create</h1></a>
    -->
        <a  href="../payment/RemainingAmount.php" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fab fa-amazon-pay fa-5x"></i><h3>All Orders Payments info</h3></a>
    </div>



<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>



</script>
</body>
</html>

