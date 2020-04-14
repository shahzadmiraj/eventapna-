
<?php

include_once ("../connection/connect.php");
//2//2
if(!isset($_SESSION['branchtype']))
{
    header("location:../company/companyRegister/companydisplay.php");

}
if(!isset($_SESSION['order']))
{
    header("location:../user/userDisplay.php");
}
$userId=$_COOKIE['userid'];
$orderid=$_SESSION['order'];
$companyid=$_COOKIE['companyid'];
$sql='SELECT (SELECT p.name FROM person as p WHERE p.id=od.person_id),od.person_id,(SELECT p.image FROM person as p WHERE p.id=od.person_id) FROM orderDetail as od WHERE od.id='.$orderid.'';
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">

</head>




<body>
<?php
include_once ("../webdesign/header/header.php");
?>
<div class="jumbotron  shadow" style="background-image: url(https://instabug.com/blog/wp-content/uploads/2018/05/SurveysRequests_2-02.jpg);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 class="text-dark">  <i class="fas fa-clipboard-check fa-3x"></i> Payment Receiving Request</h3>
        <p >Other user is requesting to you to confirm their payments</p>
    </div>

</div>
<div class="container">
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
                echo  $orderid;
                ?></label>
        </div>
    </div>

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
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
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
