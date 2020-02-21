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
    <form class="card-body">
        <?php
            echo '<input id="orderid" type="number" hidden value="'.$orderId.'">';
        ?>

        <div class="form-group row">
            <label for="persons" class="col-form-label"> no of guests</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                </div>
                <input  data-column="total_person" type="number" name="persons" id="persons" class="order form-control" value="<?php echo $orderDetail[0][3];?>">
            </div>

        </div>


        <div class="form-group row">
            <label for="time" class="col-form-label">delivery Time</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                </div>
                <input  data-column="destination_time"  type="time" name="time" id="time"  class="order form-control" value="<?php echo $orderDetail[0][7];?>">

            </div>


        </div>

        <div class="form-group row">
            <label for="date" class="col-form-label">delivery Date</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input  data-column="destination_date"  type="date" name="date" id="date" class="order change form-control" value="<?php echo $orderDetail[0][5];?>">
            </div>


        </div>

        <div class="form-group row">
            <label for="describe" class="col-form-label">describe order </label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>
                <textarea data-column="describe"  class="order change form-control form-control" ><?php echo $orderDetail[0][2];?></textarea>
            </div>




        </div>
        <div class="form-group row">
            <label for="orderStatus" class="col-form-label">Order Status </label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-eye"></i></span>
                </div>

                <select  data-column="status_catering"   class="order form-control form-control">
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
                <input  data-column="address_town" type="text" data-addressid=<?php echo $addressId;?> name="area" id="area" class=" address form-control" value="<?php echo $addresDetail[0][2];?>">

            </div>

        </div>
        <div class="form-group row">
            <label for="streetNO" class="col-form-label">Street no #</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-road"></i></span>
                </div>

                <input data-column="address_street_no"  type="number" data-addressid=<?php echo $addressId;?> name="streetno" id="streetNO" class=" address form-control" value=<?php echo $addresDetail[0][3];?>>
            </div>

        </div>
        <div class="form-group row">
            <label for="houseno" class="col-form-label">house no# </label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                </div>
                <input  data-column="address_house_no"  type="number" data-addressid=<?php echo $addressId;?>  name="houseno" id="houseno" class=" address form-control" value=<?php echo $addresDetail[0][4];?>>
            </div>



        </div>


        <div class="form-group row">
            <label class="form-check-label" for="total_amount">total amount</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input  data-column="total_amount" type="number" class="order form-control" id="total_amount"  value=<?php echo $orderDetail[0][1];?>>
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
            <a href="../order/PreviewOrder.php" class="m-auto col-6 form-control btn btn-danger"><i class="fas fa-check "></i> Done</a>';

            }
            else
            {
                echo '
            <a href="../customer/customerEdit.php"   id="cancel" class="form-control col-6 btn btn-danger"> <i class="fas fa-arrow-left"></i>Customer Edit</a>
            <a href="../dish/dishDisplay.php"  id="submit" class="form-control col-6 btn-success"><i class="fas fa-check "></i> Display Dish</a>';
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

      var orderid=  $("#orderid").val();



        $(document).on("change",'.order',function () {
            var columnName=$(this).data("column");
            var text=$(this).val();
            $.ajax({
                url: "orderEditServer.php",
                data:{column_name:columnName,value:text,option:'orderChange',orderid:orderid},
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
                }
            });

        });

        $(document).on("change",'.address',function () {
            var columnName=$(this).data("column");
            var addressId=$(this).data("addressid");
            var text=$(this).val();
            $.ajax({
                url: "orderEditServer.php",
                data:{column_name:columnName,value:text,option:'addressChange',addressId:addressId},
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
                }
            });

        });


        $("#btnbackhistory").click(function () {
            window.history.back();
        });


    });

</script>
</body>
</html>
