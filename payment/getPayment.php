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

    <script src="../webdesign/JSfile/JSFunction.js"></script>
    <style>

    </style>
</head>
<body >
<?php
//include_once ("../webdesign/header/header.php");
$whichActive = 5;
$imageCustomer = "../images/customerimage/";
$PageName="Payment";

include_once("../webdesign/orderWizard/wizardOrder.php");
?>



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
                <input id="name" type="text" name="name" class="form-control" placeholder="person name etc Ali,Hassan,....">

            </div>



        </div>
        <div class="form-group row">
            <label class="col-form-label">Amount</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input id="Amount" type="number" name="Amount" class="form-control" placeholder="amount total etc 1200xxx">

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




            <?php
            if($processInformation[0][4]==0)
            {
                //processing


                echo '
    
              <button id="backbtn" class="form-control col-6 btn-danger btn"><< Back</button>
            <button id="submitBtnfrom" type="submit" class="form-control col-6 btn-primary btn">Next >></button>
            
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



<?php
//include_once ("../webdesign/footer/footer.php");
?>


<script>

    $(document).ready(function ()
    {
        $("#backbtn").click(function (e)
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


    });
</script>
</body>
</html>
