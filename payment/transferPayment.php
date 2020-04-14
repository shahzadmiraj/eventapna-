<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-08
 * Time: 14:15
 */

include_once ("../connection/connect.php");
if(!isset($_SESSION['branchtype']))
{
    header("location:../company/companyRegister/companydisplay.php");

}
if(!isset($_SESSION['order']))
{
    header("location:../user/userDisplay.php");
}
$userId=$_COOKIE['userid'];
$orderDetail_id=$_SESSION['order'];

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
    <style>
        *{
            margin:auto;
            padding: auto;
        }
    </style>
</head>
<body class="alert-light">

<div class="container"  style="margin-top:150px">

    <div  id="from3">
        <h1 align="center">your payments</h1>

        <a class="btn-success form-control col-4 " href="/public_html/order/PreviewOrder.php?order=<?php echo $orderDetail_id; ?>"> <- Preview Order</a>
        <div class="form-group row border">
            <label class="font-weight-bold col-2 col-form-label">ID</label>
            <label class="font-weight-bold col-4 col-form-label">Amount</label>
            <label class="font-weight-bold col-4 col-form-label">Date</label>
            <label class="font-weight-bold col-2 col-form-label">Send</label>
        </div>


        <?php
        $sql='SELECT py.id,py.amount,py.receive FROM payment as py
WHERE (py.user_id='.$userId.') AND (py.orderDetail_id='.$orderDetail_id.') AND (py.sendingStatus in (0,1))   order BY
py.receive  DESC';
        $paymentDetail=queryReceive($sql);
        for($l=0;$l<count($paymentDetail);$l++)
        {
            echo '<div class="form-group row border">
            <label class="col-2 col-form-label">'.$paymentDetail[$l][0].'</label>
            <label class="col-3 col-form-label">'.$paymentDetail[$l][1].'</label>
            <label class="col-5 col-form-label">'.$paymentDetail[$l][2].'</label>
            <a href="/public_html/payment/paymentDisplaySend.php?user_id='.$userId.'&payment='.$paymentDetail[$l][0].'&order='.$orderDetail_id.'" class="col-2 form-control btn-primary">Send</a>
        </div>';
        }
        ?>
    </div>


</div>





<script>

    $(document).ready(function () {



    });
</script>
</body>
</html>
