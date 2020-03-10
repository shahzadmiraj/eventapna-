<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
if(isset($_SESSION['order']))
{
    header("location:orderEdit.php");
}

$cateringid=$_SESSION['branchtypeid'];
$customer=$_SESSION['customer'];

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

<div class="jumbotron  shadow" style="background-image: url(https://cdn.flatworldsolutions.com/featured-images/outsource-outbound-call-center-services.jpg);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 ><i class="fas fa-cart-plus fa-2x"></i>Order Booking </h3>
    </div>
</div>




<div class="container ">
    <form class="card-body">
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

        <h3 align="center">  <i class="fas fa-map-marker-alt mr-2"></i>Delivery Address(optional)</h3>

        <div class="form-group row">
            <label for="area" class="col-form-label">Area / Block </label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                </div>
                <input type="text" name="area" id="area" class="form-control" placeholder="block address ..">

            </div>

        </div>
        <div class="form-group row">
            <label for="streetNO" class="col-form-label">Street no #</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-road"></i></span>
                </div>

                <input type="number" name="streetno" id="streetNO" class="form-control" placeholder="street no 1,2,3....">
            </div>
        </div>
        <div class="form-group row">
            <label for="houseno" class="col-form-label">House no# </label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                </div>
                <input  type="number" name="houseno" id="houseno" class="form-control" placeholder="house no 1,2,.....">
            </div>



        </div>
        <div class="form-group row">
            <label for="describe" class="col-form-label">Describe order </label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>
                <textarea  id="describe" name="describe" class="form-control form-control" placeholder="order comment /requirements"></textarea>
            </div>




        </div>
        <div class="form-group row justify-content-center">

            <a href="../customer/customerEdit.php" class="form-control col-5 btn btn-danger"><i class="fas fa-arrow-left"></i>Edit Customer</a>
            <button type="button" id="submit" class="form-control col-5 btn-success"><i class="fas fa-check "></i> Submit</button>

        </div>
    </form>

</div>



<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {
        // location.replace("../company/companyRegister/companydisplay.php");
        //
        // //history.replaceState(null,null,"../company/companyRegister/companydisplay.php");
       $("#submit").click(function (e)
       {
           e.preventDefault();
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
                      window.location.href="../dish/dishDisplay.php";
                  }
               }
           });

       });

    });

</script>
</body>
</html>
