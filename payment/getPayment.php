<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-08
 * Time: 14:15
 */

//
//if(!isset($_GET["user_id"]) && !isset($_GET["order"]))
//{
//    echo 'orderDetail id and user id is not GET';
//    exit();
//}

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
$sql='SELECT (SELECT p.name FROM person as p WHERE p.id=od.person_id),od.person_id,(SELECT p.image FROM person as p WHERE p.id=od.person_id) FROM orderDetail as od WHERE od.id='.$orderDetail_id.'';
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
<body >
<?php
include_once ("../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://insidesmallbusiness.com.au/wp-content/uploads/2018/12/bigstock-204968347.jpg);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-body text-center" style="opacity: 0.7 ;background: #fdfdff;">
        <h3 ><i class="far fa-money-bill-alt fa-1x mr-3"></i>Get payment from customer </h3>
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
            echo  $orderDetail_id;
            ?></label>
    </div>
</div>

    <form class="card container" id="from2">
        <input hidden name="user_id" value="<?php
        echo $userId;
        ?>">
        <input hidden name="orderDetail_id" value="<?php
        echo $orderDetail_id;
        ?>">
        <div class="form-group row">
            <label class="col-form-label">Name</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" name="name" class="form-control" placeholder="person name etc Ali,Hassan,....">

            </div>



        </div>
        <div class="form-group row">
            <label class="col-form-label">Amount</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input type="number" name="Amount" class="form-control" placeholder="amount total etc 1200xxx">

            </div>



        </div>
        <div class="form-group row">
            <label class="col-form-label">Status amount</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-exchange-alt"></i></span>
                </div>

                <select name="status" class="custom-select">
                    <option value="0">Get Amount </option>
                    <option value="1">Return Amount</option>
                </select>
            </div>



        </div>
        <div class="form-group row">
            <label class="col-form-label">Rating Customer</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-star"></i></span>
                </div>
                <span  id="showRange" class="form-control col-2"></span>
                <input  id="rangeInput" step="1" type="range" max="5" min="1" value="3" name="rating" class="col-6 ">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label">personality</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>

                <textarea type="text" name="personality" class="form-control" placeholder="comment on customer personality"></textarea>

            </div>



        </div>





        <div class="form-group row ">
            <button id="backbtn" class="form-control col-6 btn-danger btn"><i class="fas fa-times-circle"></i>Cancel</button>
            <button id="submitBtnfrom" type="submit" class="form-control col-6 btn-primary btn"><i class="fas fa-check "></i>Submit</button>

        </div>

    </form>



<?php
include_once ("../webdesign/footer/footer.php");
?>


<script>

    $(document).ready(function ()
    {
        $("#backbtn").click(function (e)
        {
            e.preventDefault();
            window.history.back();

        });

        $('#showRange').html($("#rangeInput").val())

        $("#rangeInput").change(function () {
            $('#showRange').html($("#rangeInput").val());
        });
        $("#submitBtnfrom").click(function (e) {
            e.preventDefault();
            var formdata=new FormData($("#from2")[0]);
            formdata.append("option","GetPayment");
             $.ajax({
              url:"paymentServer.php",
              method:"POST",
              data:formdata,
              contentType: false,
              processData: false,

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
                      window.history.back();
                  }
              }
          });
        });


    });
</script>
</body>
</html>
