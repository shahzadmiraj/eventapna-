<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");

include  ("../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfOrderBooked("Owner,Employee","../index.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$userid=$_COOKIE['userid'];

$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);

$cateringid=$processInformation[0][2];
$customer=$processInformation[0][7];

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
include_once ("../webdesign/header/header.php");
?>

<div class="container">

    <div class="row" >

        <div class="container">
            <ul class="pagination float-right">
                <li class="page-item ">
                    <a class="page-link" href="#"  id="PreviouseWizard" >Previous</a>
                </li>
                <li class="page-item"><a class="page-link" href="#" id="CloseWizard">Close</a></li>
                <!--                <li class="page-item"><a class="page-link" href="#" id="NextWizard">Next</a></li>-->
            </ul>
        </div>
    </div>

</div>

<?php


$whichActive = 2;
$imageCustomer = "../images/customerimage/";
$PageName="Catering Order";
include_once("../webdesign/orderWizard/wizardOrder.php");
?>





<div class="container card ">

    <form >

        <input  hidden name="pid" value="<?php echo $pid;?>">
        <input  hidden name="token" value="<?php echo $token;?>">

        <input type="number" hidden name="customer" value=<?php echo $customer;?>   >
        <input type="number" hidden name="cateringid" value="<?php echo $cateringid;?>">
        <div class="form-group row">
        <label for="persons" class="col-form-label"> No of guests</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                </div>
                <input type="number" name="persons" id="persons" class="form-control" placeholder="etc 250,300,....persons">
            </div>

        </div>

        <div class="form-group row">
            <label for="time" class="col-form-label">Delivery Time</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                </div>
                <input type="time" name="time" id="time"  class="form-control">

            </div>



        </div>

        <div class="form-group row">
            <label for="date" class="col-form-label">Delivery Date</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input type="date" name="date" id="date" class="form-control">
            </div>




        </div>

        <div class="form-group row">
            <label for="address" class="col-form-label">Address:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-map-marker-alt"></i></span>
                </div>
                <textarea  id="address" name="address" class="form-control form-control" placeholder="order destination address "></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label for="describe" class="col-form-label">Describe Order </label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>
                <textarea  id="describe" name="describe" class="form-control form-control" placeholder="order comment /requirements"></textarea>
            </div>

        </div>

        <div class="form-group row justify-content-center">

            <a id="btnbackhistory" class="form-control col-5 btn btn-danger"><< Back</a>
            <button type="button" id="submit" class="form-control col-5 btn-primary">Next >></button>





        </div>
    </form>

</div>



<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>



    $(document).ready(function ()
    {

        $("#btnbackhistory,#PreviouseWizard").click(function (e) {
            e.preventDefault();
            <?php
            if($processInformation[0][4]==0)
            {
                //process is running
                echo 'location.replace("../customer/customerEdit.php?pid=' . $pid . '&token='.$token.'");';

            }
            ?>
        });


       $("#submit").click(function (e)
       {

           e.preventDefault();
           var state=false;


           if(validationWithString("persons","Please Enter no of Guests"))
               state=true;

           if(validationWithString("time","Please Enter Order Time"))
               state=true;

           if(validationWithString("date","Please Enter Order Date"))
               state=true;

           if(state)
               return false;

           var formdata=new FormData($('form')[0]);
           formdata.append('function',"add");
           $.ajax({
              url:"orderServer.php",
              data:formdata,
               method:"POST",
               contentType: false,
               processData: false,
               dataType:"text",

               beforeSend: function() {
                   $("#preloader").show();
               },
               success:function (data)
               {
                   $("#preloader").hide();


                  if(data!="")
                  {
                      alert(data);
                  }
                  else
                  {

                      <?php
                      if($processInformation[0][4]==0)
                      {

                          //catering order also book and select dishes
                          echo 'location.replace(".../../../dish/dishDisplay.php?pid=' . $pid . '&token='.$token.'");';

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
