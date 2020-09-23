<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-08
 * Time: 23:30
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
$orderid=$processInformation[0][5];
$companyid=$userdetail[0][0];

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

$whichActive = 5;
$imageCustomer = "../images/customerimage/";
$PageName="Payment Send To User";

include_once("../webdesign/orderWizard/wizardOrder.php");

?>
<div class="container">

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


    <div class="card shadow-lg  container mt-5">



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



        <div class="form-group row ">
            <label class="col-form-label"> User </label>


            <div class="input-group mb-3 input-group-lg  " >
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <select style="background-color: #7dff38;" id="userIdlabel<?php
                echo $paymentDetail[0][0];
                ?>" class="form-control">
                    <option  value="none">None</option>
                    <?php
                    $sql = 'SELECT id, username FROM user WHERE (id !=' . $userId . ') AND (company_id=' . $companyid . ') ';
                    $userDetail = queryReceive($sql);
                    for ($y = 0; $y < count($userDetail); $y++) {
                        echo '<option value=' . $userDetail[$y][0] . '>' . $userDetail[$y][1] . '</option>';
                    }
                    ?>
                </select>

                <div class="input-group-prepend">

                    <input data-paymentid="<?php echo $paymentDetail[0][0]; ?>" type="button"
                           class="paymentsend btn btn-success " value="<?php

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

