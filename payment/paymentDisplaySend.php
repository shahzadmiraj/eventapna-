<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-08
 * Time: 23:30
 */
include_once ("../connection/connect.php");


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
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
</head>




<body>
<?php
include_once ("../webdesign/header/header.php");
?>
<div class="jumbotron  shadow" style="background-image: url(https://as1.ftcdn.net/jpg/02/48/64/56/500_F_248645634_PXszpu8MVoW8P6wXxD5yEEInauZjrFc7.jpg);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 class="text-dark">  <i class="fas fa-share-alt fa-3x"></i> transfer payment</h3>
        <p >You can  transfer your payment to another user</p>
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


$sql='SELECT py.id FROM payment as py
WHERE (py.user_id='.$userId.') AND (py.orderDetail_id='.$orderid.') AND (py.sendingStatus in (0,1))   order BY
py.receive  DESC';
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
                <select id="userIdlabel<?php
                echo $paymentDetail[0][0];
                ?>" class="form-control">
                    <option value="none">None</option>
                    <?php
                    $sql = 'SELECT id, username FROM user WHERE (id !=' . $userId . ') AND (company_id=' . $companyid . ') ';
                    $userDetail = queryReceive($sql);
                    for ($y = 0; $y < count($userDetail); $y++) {
                        echo '<option value=' . $userDetail[$y][0] . '>' . $userDetail[$y][1] . '</option>';
                    }
                    ?>
                </select>
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
            <input data-paymentid="<?php echo $paymentDetail[0][0]; ?>" type="button"
                   class="paymentsend col-6 btn btn-success" value="<?php

            if ($paymentDetail[0][5] == 0) {
                echo "Send";
            } else if ($paymentDetail[0][5] == 1) {
                echo "Confirming";
            } else {
                echo "not part of this";
            }
            ?>">

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
    //window.history.back();
    $(document).ready(function () {
       $(".paymentsend") .click(function () {
          var btnsender=$(this).val();
           var paymentId=$(this).data("paymentid");
          if(btnsender=='Send')
          {
              var userID=$("#userIdlabel"+paymentId).val();
              if(userID=='none')
              {
                  alert("please select User");
                  return false;
              }
              $.ajax({
                 url:"paymentServer.php",
                 data:{useid:userID,paymentId:paymentId,option:"paymentsend"} ,
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
                            window.location.reload();
                        }
                  }
              });

          }
          else if(btnsender=='Confirming')
          {
              alert("your request has been sent to the next user so please wait for it");
          }
       });

    });
</script>
</body>
</html>

