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

$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);

$companyid=$userdetail[0][0];
$userid=$_COOKIE['userid'];
$orderId=$processInformation[0][5];
$sql='SELECT `id`, `total_amount`, `describe`, `total_person`, `status_catering`, `destination_date`, `booking_date`, `destination_time`,1, `person_id`,`catering_id` ,`user_id`, `discount`, `extracharges`, `address` FROM `orderDetail` WHERE id='.$orderId.'';
$orderDetail=queryReceive($sql);

$sql='SELECT sum(amount) FROM `payment` WHERE IsReturn=0 AND orderDetail_id='.$orderId;
$PaidAmount=queryReceive($sql);


?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="../jquery-3.3.1.js"></script>

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
<body>

<?php
include_once ("../webdesign/header/header.php");




$whichActive = 2;
$imageCustomer = "../images/customerimage/";
$PageName="Catering Order";
include_once("../webdesign/orderWizard/wizardOrder.php");


?>


<div class="container">


    <form class="card container" id="editorder">
        <?php
            echo '<input name="orderid" type="number" hidden value="'.$orderDetail[0][0].'">
            
            
            <input name="PreviousUserid" type="number" hidden value="'.$orderDetail[0][11].'">
            <input name="Previoustotal_amount" type="number" hidden value="'.$orderDetail[0][1].'">
            <input name="PreviousTotal_person" type="number" hidden value="'.$orderDetail[0][3].'">
            <input name="PreviousDestination_time" type="time" hidden value="'.$orderDetail[0][7].'">
            <input name="PreviousDestination_date" type="date" hidden value="'.$orderDetail[0][5].'">
            <input name="PreviousDescribe" type="text" hidden value="'.$orderDetail[0][2].'">
            <input name="PreviousStatus_catering" type="text" hidden value="'.$orderDetail[0][4].'">
       
       
       
       
            <input name="PreviousBranchOrder" type="number" hidden value="'.$orderDetail[0][10].'">
            <input name="CurrentUserid" type="number" hidden value="'.$userid.'">
            
            ';
        ?>

        <div class="form-group row">
            <label for="persons" class="col-form-label"> No of guests</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                </div>
                <input  name="total_person" type="number"  id="persons" class="form-control" value="<?php echo $orderDetail[0][3];?>">
            </div>

        </div>


        <div class="form-group row">
            <label for="time" class="col-form-label">Delivery Time</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                </div>
                <input  name="destination_time"  type="time"  id="time"  class="form-control" value="<?php echo $orderDetail[0][7];?>">

            </div>


        </div>

        <div class="form-group row">
            <label for="date" class="col-form-label">Delivery Date</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input id="date"  name="destination_date"  type="date" class="form-control" value="<?php echo $orderDetail[0][5];?>">
            </div>


        </div>

        <div class="form-group row">
            <label for="describe" class="col-form-label">Describe order </label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>
                <textarea name="describe"  class="form-control"  id="describe"><?php echo $orderDetail[0][2];?></textarea>
            </div>
        </div>



        <div class="form-group row">
            <label for="branchOrder" class="col-form-label">Order in branch :</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-eye"></i></span>
                </div>

                <select  name="branchOrder"   class="form-control">
                    <?php

                    $sql='SELECT od.catering_id,(SELECT c.name FROM catering as c WHERE c.id=od.catering_id) FROM orderDetail as od WHERE od.id='.$orderId.'';
                    $caterinBranch=queryReceive($sql);
                    echo '<option value='.$caterinBranch[0][0].'>'.$caterinBranch[0][1].'</option>';

                    $sql='SELECT `id`, `name` FROM `catering` WHERE ISNULL(expire) && (id!='.$caterinBranch[0][0].' )&& (company_id='.$companyid.')';
                    $AllBranches=queryReceive($sql);

                    for($i=0;$i<count($AllBranches);$i++)
                    {
                            echo '<option value='.$AllBranches[$i][0].'>'.$AllBranches[$i][1].'</option>';
                    }

                    ?>
                </select>
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


        <div class="form-group row">
            <label for="address" class="col-form-label">Address:</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-map-marker-alt"></i></span>
                </div>
                <textarea  id="address" name="address" class="form-control form-control" placeholder="destination address "><?php echo $orderDetail[0][14];?>  </textarea>
            </div>
        </div>



        <div class="form-group row">
            <label class="form-check-label" for="total_amount">Total amount :(Dishes Amount)</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input  id="totalamount" readonly name="total_amount" type="number" class="form-control"  value=<?php echo (int) $orderDetail[0][1];?>>
            </div>

        </div>



        <div class="form-group row">
            <label class="form-check-label" for="Discount">Discount </label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input  id="Discount" name="Discount" type="number" class="form-control"  value=<?php echo (int) $orderDetail[0][12];?>>
            </div>

        </div>

        <div class="form-group row">
            <label class="form-check-label" for="Charges">Extra Charges </label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input  id="Charges" name="Charges" type="number" class="form-control"  value=<?php echo (int) $orderDetail[0][13];?>>
            </div>

        </div>


        <div class="form-group row">
            <label class="form-check-label" for="remaining">Paid Amount </label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input readonly  id="PaidAmount"  type="number" class="form-control"  value=<?php echo (int) ($PaidAmount[0][0]);?>>
            </div>
        </div>

        <div class="form-group row">
            <label class="form-check-label" for="remaining">Remaining Amount:</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input readonly  id="remaining" name="remaining" type="number" class="form-control"  value=<?php echo (int) ($orderDetail[0][1]-$orderDetail[0][12]+$orderDetail[0][13]-$PaidAmount[0][0]);?>>
            </div>

        </div>





        <div class="form-group row">
            <label class="form-check-label" for="booking_date">Visited Date</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-business-time"></i></span>
                </div>
                <input  type="datetime" readonly class="form-control" id="booking_date"  value="<?php echo $orderDetail[0][6];?>">
            </div>




        </div>

        <div class="form-group row justify-content-center">

            <?php
            if($processInformation[0][4]==0)
            {
                //processing


                echo '
                 <button id="backBtn" class="form-control col-6 btn btn-danger"><< Back</button>
            <button id="submit" class="form-control col-6 btn btn-primary" > Next >> </button>';

            }
            else
            {

                echo '
                 <button id="backBtn" class="form-control col-6 btn btn-danger">Close</button>
            <button id="submit" class="form-control col-6 btn btn-primary" > Save  </button>';
            }
            ?>





        </div>


    </form>
</div>





<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function () {


        function RemainingAmount()
        {
            var totalamount= Number($("#totalamount").val());
            var newDiscount=Number($("#Discount").val());
            var newcharges=Number($("#Charges").val());
            var paidamount=Number($("#PaidAmount").val());
            $("#remaining").val(totalamount+newcharges-newDiscount-paidamount);
        }


        $("#Discount").change(function (e)
        {
            RemainingAmount();
        });
        $("#Charges").change(function ()
        {
            RemainingAmount();
        });

        $(document).on('click', '#submit', function (e) {
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
            var href = "'" + $(this).data("href") + "'";
            var formdata = new FormData($('#editorder')[0]);
            formdata.append("function", "orderSaveAfterChange");
            $.ajax({
                url: "orderServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function () {
                    $("#preloader").show();
                },
                success: function (data) {
                    $("#preloader").hide();

                    if (data != '') {
                        alert(data);
                        //console.log(data);
                    } else
                    {


                        <?php
                        if($processInformation[0][4]==0)
                        {
                            //catering order also book and select dishes
                            echo 'location.replace("../dish/dishDisplay.php?pid=' . $pid . '&token='.$token.'");';
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

        $('#backBtn').click(function (e)
        {
            e.preventDefault();

            <?php
            if($processInformation[0][4]==0)
            {
                //process is running
                echo 'location.replace("../customer/customerEdit.php?pid=' . $pid . '&token='.$token.'");';

            }
            else
            {
                echo "window.history.back();";
            }
            ?>
        });
    });

</script>
</body>
</html>
