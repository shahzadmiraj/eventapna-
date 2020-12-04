<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-08
 * Time: 14:15
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
$orderDetail_id=$processInformation[0][5];
$sql='SELECT (SELECT p.name FROM person as p WHERE p.id=od.person_id),od.person_id,(SELECT p.image FROM person as p WHERE p.id=od.person_id) FROM orderDetail as od WHERE od.id='.$orderDetail_id.'';
$orderDetailPerson= queryReceive($sql);
$customerID=$orderDetailPerson[0][1];



$sql='SELECT catering_id,status_catering FROM orderDetail WHERE id='.$orderDetail_id.'';
$StatusOrder=queryReceive($sql);
include('../companyDashboard/includes/startHeader.php'); //html

?>


    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Payment</title>
    <meta name="description" content="Payment  page only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Payment page Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">




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



<?php
$ExtraButtonHandleOnTop='';
if($processInformation[0][4]==0) {
    $ExtraButtonHandleOnTop = '
   
    <div class="container">
        <div class="row" >

            <div class="container">
                <ul class="pagination float-right">
                    <li class="page-item ">
                        <a class="page-link" href="#"  id="PreviouseWizard" >Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#" id="CloseWizard">Close</a></li>
                    <li class="page-item"><a class="page-link" href="#" id="NextWizard">Next</a></li>
                </ul>
            </div>
        </div>
    </div>';
}

    ?>

<?php

$whichActive = 5;
$imageCustomer = "../images/customerimage/";
$PageName="Payment";

include_once("../webdesign/orderWizard/wizardOrder.php");
?>



    <form class="container row" id="from2">
        <input hidden name="user_id" value="<?php
        echo $userId;
        ?>">
        <input hidden name="orderDetail_id" value="<?php
        echo $orderDetail_id;
        ?>">

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Amount paid</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input id="Amount" type="number" name="Amount" class="form-control" placeholder="Amount paid in Advance  etc 1200xxx">

            </div>



        </div>
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
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

        <h3 class="col-12"><hr>Customer behaviour </h3>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Name</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input id="name" type="text" name="name" class="form-control" placeholder="person name etc Ali,Hassan,....">

            </div>



        </div>
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Rating Customer</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-star"></i></span>
                </div>
                <span  id="showRange" class="form-control col-2"></span>
                <input  id="rangeInput" step="1" type="range" max="5" min="1" value="3" name="rating" class="col-6 ">
            </div>
        </div>
        <div class="col-sm-12  col-12 col-md-12 col-lg-12">
            <label class="col-form-label">Personality</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>
                <textarea type="text" name="personality" class="form-control" placeholder="comment on customer personality"></textarea>
            </div>
        </div>





        <div class="col-12 row">




            <?php
            if($processInformation[0][4]==0)
            {
                //processing


                echo '
    
              <button id="backbtn" class="form-control col-4 btn-danger btn"><< Back</button>
               <button id="SkipBtn" class="col-4 form-control btn btn-success">Skip>></button>
            <button id="submitBtnfrom" type="submit" class="form-control col-4 btn-primary btn">Next >></button>
            
            ';

            }
            else
            {

                echo '
              <button id="backbtn" class="form-control col-6 btn-danger btn">Close</button>
               <button id="submitBtnfrom" type="submit" class="form-control col-6 btn-primary btn">Save</button>
            
            
            ';
            }
            ?>

        </div>

    </form>




<script>

    $(document).ready(function ()
    {
        $("#backbtn,#PreviouseWizard").click(function (e)
        {
            e.preventDefault();

            <?php
            if($processInformation[0][4]==0)
            {
                //processing order
                if(($processInformation[0][3]!="") &&($StatusOrder[0][1]!="Running"))
                {
                    //came from hall book also catering doesnot  running
                    echo 'location.replace("../company/hallBranches/orderInfo/orderItem.php?pid=' . $pid . '&token='.$token.'");';
                }
                else
                {
                    //
                    echo 'location.replace("../dish/dishDisplay.php?pid=' . $pid . '&token='.$token.'");';
                }
            }
            else
            {
                echo "window.history.back();";
            }
            ?>

        });

        $('#showRange').html($("#rangeInput").val())

        $("#rangeInput").change(function () {
            $('#showRange').html($("#rangeInput").val());
        });
        $("#submitBtnfrom").click(function (e)
        {
            e.preventDefault();


            var state=false;
            if(validationWithString("name","Please Enter Customer Name"))
                state=true;
            if(validationWithString("Amount","Please Enter Amount"))
                state=true;

            if(state)
                return false;
            var formdata=new FormData($("#from2")[0]);
            formdata.append("option","GetPayment");
             $.ajax({
              url:"paymentServer.php",
              method:"POST",
              data:formdata,
              contentType: false,
              processData: false,

                 beforeSend: function() {
                     $('#pleaseWaitDialog').modal();
                 },
                 success:function (data)
                 {
                     $('#pleaseWaitDialog').modal('hide');
                     if($.trim(data)!='')
                  {
                      alert(data);
                  }
                  else
                  {

                      <?php
                      if($processInformation[0][4]==0)
                      {
                          //catering order also book and select dishes
                          echo 'location.replace("../order/PreviewOrder.php?pid=' . $pid . '&token='.$token.'");';
                      }
                      else
                      {
                          echo "window.history.back();";
                      }
                      ?>
                  }
              }
          });
        });




        $("#SkipBtn,#NextWizard").click(function (e) {
            e.preventDefault();
            <?php
            if($processInformation[0][4]==0)
            {
                //catering order also book and select dishes
                echo 'location.replace("../order/PreviewOrder.php?pid=' . $pid . '&token='.$token.'");';
            }
            ?>
        });

    });
</script>
<?php
include('../companyDashboard/includes/scripts.php');
include('../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>