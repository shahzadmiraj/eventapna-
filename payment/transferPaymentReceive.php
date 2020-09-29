
<?php

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
$orderid=$processInformation[0][5];
$companyid=$userdetail[0][0];
$sql='SELECT (SELECT p.name FROM person as p WHERE p.id=od.person_id),od.person_id,(SELECT p.image FROM person as p WHERE p.id=od.person_id) FROM orderDetail as od WHERE od.id='.$orderid.'';
$orderDetailPerson= queryReceive($sql);
$customerID=$orderDetailPerson[0][1];


?>

<!DOCTYPE html>
<head>

    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Payment Received</title>
    <meta name="description" content="Payment Received only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Payment Received  Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">

</head>




<body>
<?php
include_once ("../webdesign/header/header.php");

$whichActive = 5;
$imageCustomer = "../images/customerimage/";
$PageName="Payment Confirmation ";

include_once("../webdesign/orderWizard/wizardOrder.php");
?>



<div class="container">

    <?php


    $sql = 'SELECT py.id,(SELECT u.username FROM user as u WHERE u.id=py.user_id) as username,py.amount,py.nameCustomer,py.IsReturn,t.senderTimeDate,py.receive,t.id,py.sendingStatus FROM orderDetail as ot INNER join payment as py on ot.id=py.orderDetail_id INNER join transfer as t on py.id=t.payment_id where (ot.id=' . $orderid . ') AND (t.user_id=' . $userId . ')AND (py.sendingStatus in (0,1,2))
';
    $Yourpayment=queryReceive($sql);


    for ($i=0;$i<count($Yourpayment);$i++)
    {


        $sql = 'SELECT `id`, `amount`, `nameCustomer`, `receive`, `IsReturn`,`sendingStatus` FROM `payment` WHERE id=' . $Yourpayment[$i][0] . '';
        $paymentDetail = queryReceive($sql);

        ?>


        <div class="card-header shadow-lg  col-12 border mt-5">



            <div class="form-group row">
                <label class="col-form-label"> payment ID</label>


                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>


                    <h1 class="col-form-label"> <?php

                        echo $paymentDetail[0][0];
                        ?></h1>
                </div>


            </div>



            <div class="form-group row">
                <label class="col-form-label"> User </label>


                <div class="input-group mb-3 input-group-lg ">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>

                    <label class="col-form-label"> <?php

                        echo $Yourpayment[$i][1];
                        ?></label>
                </div>

            </div>


            <div class="form-group row">
                <label class="col-form-label"> Amount</label>


                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                    </div>


                    <h1 class="col-form-label"> <?php

                        echo $paymentDetail[0][1];
                        ?></h1>
                </div>


            </div>
            <div class="form-group row">
                <label class="col-form-label"> customer Name</label>


                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-edit"></i></span>
                    </div>


                    <label class="col-form-label"> <?php

                        echo $paymentDetail[0][2];
                        ?></label>
                </div>


            </div>
            <div class="form-group row">
                <label class="col-form-label"> Receive Date</label>


                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <label class="col-form-label"> <?php

                        echo $paymentDetail[0][3];
                        ?></label>
                </div>


            </div>

            <div class="form-group row">
                <label class="col-form-label"> payment Status</label>


                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                    </div>
                    <label class="col-form-label"> <?php

                        if ($paymentDetail[0][4] == 0) {
                            echo "Get amount to customer";
                        } else {
                            echo "return amount to customer";
                        }
                        ?></label>
                </div>


            </div>
            <div class="form-group row">
                <label class="col-form-label"> User Send to you on Data</label>


                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <label class="col-form-label"> <?php

                        echo $Yourpayment[$i][5];
                        ?></label>
                </div>


            </div>

            <div class="form-group row">

                <?php
                $displayDetailOfPayment='';
                if($Yourpayment[$i][8]==1)
                {

                $displayDetailOfPayment.= '<input  data-paymentid="'.$Yourpayment[$i][0].'" data-tranferid="'.$Yourpayment[$i][7].'" type="button" class="configration col-6 form-control btn btn-danger" value="unconfirm">
                <input data-paymentid="'.$Yourpayment[$i][0].'" data-tranferid="'.$Yourpayment[$i][7].'" type="button" class="configration col-6 form-control btn btn-success" value="confirm">';
                }
                else if($Yourpayment[$i][8]==2)
                {

                $displayDetailOfPayment.='<input  type="button" class="confirmed btn btn-info col-6" value="confirmed">';

                }
                else if($Yourpayment[$i][8]==0)
                {

                    $displayDetailOfPayment.='<input  type="button" class="Unconfirmed btn btn-light col-8" value="Unconfirmed">';

                }
                echo $displayDetailOfPayment;

                ?>


            </div>













        </div>

        <?php
    }
    ?>

</div>
<?php
include_once ("../webdesign/footer/footer.php");
?>





<script>


    $(document).ready(function () {




        $(".configration").click(function ()
        {
            var tranferid=$(this).data("tranferid");
            var paymentid=$(this).data("paymentid");
            var value=$(this).val();
            $.ajax({
                url:"paymentServer.php",
                data:{paymentid:paymentid,value:value,tranferid:tranferid,option:"paymentconfigration"} ,
                dataType:"text",
                method:"POST",

                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    if(data!='')
                    {
                        alert(data);
                    }
                    else
                    {
                        location.reload(true);
                    }
                }
            });
        });
        $(".confirmed").click(function () {
           alert("The payment has been confirmed by you");
        });

        $(".Unconfirmed").click(function () {
            alert("The payment has been Unconfirmed by you");
        });

    });
</script>
</body>
</html>
