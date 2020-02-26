<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");

if(!isset($_SESSION['order']))
{
    header("location:../user/userDisplay.php");
}
if(!isset($_SESSION['customer']))
{
    header("location:../customer/CustomerCreate.php");
}
$orderId=$_SESSION['order'];
$sql='SELECT `id`, `total_amount`, `describe`, `total_person`, `status_catering`, `destination_date`, `booking_date`, `destination_time`, `address_id`, `person_id` FROM `orderDetail` WHERE id='.$orderId.'';
$orderDetail=queryReceive($sql);
$addressId=$orderDetail[0][8];
$sql='SELECT `id`, `address_city`, `address_town`, `address_street_no`, `address_house_no`, `person_id` FROM `address` WHERE id='.$addressId.'';
$addresDetail=queryReceive($sql);

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
<body>

<?php
include_once ("../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://cdn.flatworldsolutions.com/featured-images/outsource-outbound-call-center-services.jpg);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 ><i class="fas fa-cart-plus fa-2x"></i>Order Edit </h3>
    </div>
</div>

<div class="container">
    <form class="card-body" id="editorder">
        <?php
            echo '<input name="orderid" type="number" hidden value="'.$orderDetail[0][0].'">
            <input name="PreviousTotal_person" type="number" hidden value="'.$orderDetail[0][3].'">
            <input name="PreviousDestination_time" type="number" hidden value="'.$orderDetail[0][7].'">
            <input name="PreviousDestination_date" type="number" hidden value="'.$orderDetail[0][5].'">
            <input name="PreviousDescribe" type="number" hidden value="'.$orderDetail[0][2].'">
            <input name="PreviousStatus_catering" type="number" hidden value="'.$orderDetail[0][4].'">
            <input name="PreviousTown" type="number" hidden value="'.$addresDetail[0][2].'">
            <input name="PreviousStreet_no" type="number" hidden value="'.$addresDetail[0][3].'">
            <input name="PreviousHouse_no" type="number" hidden value="'.$addresDetail[0][4].'">
            <input name="PreviousAddressId" type="number" hidden value="'.$addresDetail[0][0].'">
            ';
        ?>

        <div class="form-group row">
            <label for="persons" class="col-form-label"> no of guests</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                </div>
                <input  name="total_person" type="number"  id="persons" class="form-control" value="<?php echo $orderDetail[0][3];?>">
            </div>

        </div>


        <div class="form-group row">
            <label for="time" class="col-form-label">delivery Time</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                </div>
                <input  name="destination_time"  type="time"  id="time"  class="form-control" value="<?php echo $orderDetail[0][7];?>">

            </div>


        </div>

        <div class="form-group row">
            <label for="date" class="col-form-label">delivery Date</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input  name="destination_date"  type="date" class="form-control" value="<?php echo $orderDetail[0][5];?>">
            </div>


        </div>

        <div class="form-group row">
            <label for="describe" class="col-form-label">describe order </label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>
                <textarea name="describe"  class="form-control"  id="describe"><?php echo $orderDetail[0][2];?></textarea>
            </div>




        </div>
        <div class="form-group row">
            <label for="orderStatus" class="col-form-label">Order Status </label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-eye"></i></span>
                </div>

                <select  name="status_catering"   class="form-control">
                    <?php
                    $OrderStatus=array("Running","Cancel","Delieved","Clear");
                    echo '<option value='.$orderDetail[0][4].'>'.$orderDetail[0][4].'</option>';
                    for($i=0;$i<count($OrderStatus);$i++)
                    {
                        if($orderDetail[0][4]!=$OrderStatus[$i])
                        {

                            echo '<option value='.$OrderStatus[$i].'>'.$OrderStatus[$i].'</option>';
                        }

                    }

                    ?>
                </select>
            </div>


        </div>



        <h3 align="center">  <i class="fas fa-map-marker-alt mr-2"></i>Delivery Address(optional)</h3>
        <div class="form-group row">
            <label for="area" class="col-form-label">area / block </label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                </div>
                <input  name="town" type="text"  id="area" class="form-control" value="<?php echo $addresDetail[0][2];?>">

            </div>

        </div>
        <div class="form-group row">
            <label for="streetNO" class="col-form-label">Street no #</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-road"></i></span>
                </div>

                <input name="street_no"  type="number"  id="streetNO" class="form-control" value=<?php echo $addresDetail[0][3];?>>
            </div>

        </div>
        <div class="form-group row">
            <label for="houseno" class="col-form-label">house no# </label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                </div>
                <input  name="house_no"  type="number"  id="houseno" class="form-control" value=<?php echo $addresDetail[0][4];?>>
            </div>



        </div>


        <div class="form-group row">
            <label class="form-check-label" for="booking_date">order booking date</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-business-time"></i></span>
                </div>
                <input  type="date" readonly class="form-control" id="booking_date"  value="<?php echo $orderDetail[0][6];?>">
            </div>




        </div>

        <div class="form-group row justify-content-center">
            <?php
               /* if(isset($_GET['option']))
                {
                    if($_GET['option']=="dishDisplay")
                    {
                        echo '
            <a href="/public_html/customer/customerEdit.php?order='.$_GET['order'].'&customer='.$_GET['customer'].'&option=customerAndOrderalreadyHave"   id="cancel" class="form-control col-6 btn btn-danger"> <i class="fas fa-arrow-left"></i>Customer Edit</a>
            <a href="/public_html/dish/dishDisplay.php?order='.$_GET['order'].'"  id="submit" class="form-control col-6 btn-success"><i class="fas fa-check "></i> Display Dish</a>';
                    }
                    else if($_GET['option']=="customerEdit")
                    {

                        echo '
            <a href="/public_html/customer/customerEdit.php?order='.$_GET['order'].'&customer='.$_GET['customer'].'&option=customerAndOrderalreadyHave"   id="cancel" class="form-control col-6 btn btn-danger"><i class="fas fa-arrow-left"></i> Customer Edit</a>
            <a href="/public_html/dish/dishDisplay.php?order='.$_GET['order'].'&option=orderEdit"  id="submit" class="form-control col-6 btn-success"><i class="fas fa-check "></i> Display Dish</a>';

                    }
                    else if($_GET['option']=="PreviewOrder")
                    {
                        echo '<input type="button" id="btnbackhistory" class="col-6  form-control btn btn-outline-primary" value="Done">';
                    }
                }*/


//14,11

            if(isset($_GET['action']))
            {
                echo '
            <button id="btnbackhistory" class="form-control col-6 btn btn-danger">Cancel</button>
            <button id="submit" class="form-control col-6 btn btn-primary" data-href="../order/PreviewOrder.php"><i class="fas fa-check "></i>  Save</button>';


            }
            else
            {
                echo '
            <a href="../customer/customerEdit.php"   id="cancel" class="form-control col-6 btn btn-danger"> <i class="fas fa-arrow-left"></i>Customer Edit</a>
             <button id="submit" class="form-control col-6 btn btn-primary" data-href="../dish/dishDisplay.php"><i class="fas fa-check "></i>  Save</button>';

            }
            ?>


        </div>


    </form>
</div>





<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {

        $("#submit").click(function (e)
        {
            e.preventDefault();
            var href="'"+$(this).data("href")+"'";
            var formdata=new FormData($('#editorder')[0]);
            formdata.append("function","orderSaveAfterChange");
            $.ajax({
                url:"orderServer.php",
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
                        window.location.href=href;
                    }
                }
            });

        $("#btnbackhistory").click(function () {
            window.history.back();
        });


    });

</script>
</body>
</html>
