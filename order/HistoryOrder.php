<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
$orderid=$_SESSION['order'];
$sql='SELECT h.id, h.hall_id, h.catering_id, h.hallprice_id, h.user_id, h.address_id, h.total_person, h.status_hall, h.destination_date, h.destination_time, h.status_catering, h.comments, h.orderDetail_id, h.total_amount,(SELECT c.name FROM catering as c WHERE c.id=h.catering_id),(SELECT ha.name FROM hall as ha WHERE ha.id=h.hall_id ),(SELECT hp.isFood FROM hallprice as hp WHERE hp.id=h.hallprice_id),(SELECT hp.package_name FROM hallprice as hp WHERE hp.id=h.hallprice_id),(SELECT u.username FROM user  as u WHERE u.id=h.user_id),h.changeTimeDate FROM history_order as h WHERE h.orderDetail_id='.$orderid.'';
$Allorder=queryReceive($sql);

function timingConvert($Time)
{
    if($Time=="09:00:00")
    {
        return 'Morning';
    }
    else if($Time=="12:00:00")
    {
        return "Afternoon";
    }
    return "Evening";
}


?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="../jquery-3.3.1.js"></script>

    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <style>
        .ownText{
            margin-left: 10px;
            color: #5f6799;
        }

    </style>
</head>
<body>

<?php
include_once ("../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://cdn.flatworldsolutions.com/featured-images/outsource-outbound-call-center-services.jpg);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 ><i class="fas fa-cart-plus fa-2x"></i>Order  Changing History </h3>
    </div>
</div>

<div class="container">


    <?php
    for($i=0;$i<count($Allorder);$i++)
    {


        ?>


        <form class="card card-header badge-light m-4">


            <div class="form-group row">
                <label class="col-form-label"> <span><i class="fas fa-users"></i></span> UserName</label>
                <label class="col-form-label ownText"> <?php echo $Allorder[$i][18]; ?></label>
            </div>

            <div class="form-group row">
                <label for="persons" class="col-form-label"> <span><i class="fas fa-users"></i></span> No of
                    guests</label>
                <label class="col-form-label ownText"> <?php echo $Allorder[$i][6]; ?></label>
            </div>


            <div class="form-group row">
                <label for="time" class="col-form-label"> <span><i class="fas fa-clock"></i></span> Delivery
                    Time</label>
                <label class="col-form-label ownText">
                    <?php

                    if (isset($Allorder[$i][2])) {
                        echo timingConvert($Allorder[$i][9]);

                    } else {
                        echo $Allorder[$i][9];
                    }


                    ?>
                </label>
            </div>

            <div class="form-group row">
                <label for="date" class="col-form-label"> <span><i class="far fa-calendar-alt"></i></span> Delivery Date</label>
                <label class="col-form-label ownText"> <?php echo $Allorder[$i][8]; ?></label>
            </div>


            <div class="form-group row">
                <label for="date" class="col-form-label"> <span><i class="far fa-calendar-alt"></i></span> Order
                    changing At</label>
                <label class="col-form-label ownText"> <?php echo $Allorder[$i][19]; ?></label>
            </div>

            <div class="form-group row">
                <label for="describe" class="col-form-label"> <span><i class="fas fa-comments"></i></span>
                    Describe order </label>

                <label class="col-form-label ownText"> <?php echo $Allorder[$i][11]; ?></label>
            </div>


            <?php
            if (isset($Allorder[$i][2])) {


                //hall
                ?>

                <div class="form-group row">
                    <label for="branchOrder" class="col-form-label"> <span><i class="far fa-eye"></i></span>Catering
                        Branch:</label>
                    <label class="col-form-label ownText"> <?php echo $Allorder[$i][14]; ?></label>
                </div>


                <div class="form-group row">
                    <label for="orderStatus" class="col-form-label"><span><i class="far fa-eye"></i></span>Catering
                        Status </label>
                    <label class="col-form-label ownText"> <?php echo $Allorder[$i][10]; ?></label>
                </div>


                <?php
                if (($Allorder[$i][17]) != '') {


                    ?>
                    <div class="form-group row">
                        <label for="orderStatus" class="col-form-label"><span><i class="far fa-eye"></i></span>Package
                            Name </label>
                        <label class="col-form-label ownText"> <?php echo $Allorder[$i][17]; ?></label>
                    </div>

                    <?php

                }
            }
            ?>




            <?php
            if (isset($Allorder[$i][1])) {
                //catering
                ?>


                <div class="form-group row">
                    <label for="branchOrder" class="col-form-label"> <span><i class="far fa-eye"></i></span>Hall Branch:</label>

                    <label class="col-form-label ownText"> <?php echo $Allorder[$i][15]; ?></label>
                </div>


                <div class="form-group row">
                    <label for="orderStatus" class="col-form-label"><span><i class="far fa-eye"></i></span>Hall Status
                    </label>
                    <label class="col-form-label ownText"> <?php echo $Allorder[$i][7]; ?></label>

                </div>

                <?php
            }
            ?>


            <div class="form-group row">
                <label class="col-form-label" for="total_amount"> <span><i class="far fa-money-bill-alt"></i></span>
                    Total amount</label>
                <label class="col-form-label ownText"> <?php echo $Allorder[$i][13]; ?></label>
            </div>


            <?php
            if (isset($Allorder[$i][5])) {
                $sql = 'SELECT `id`, `address_city`, `address_town`, `address_street_no`, `address_house_no`, `person_id` FROM `address` WHERE id=' . $Allorder[$i][5] . '';
                $AddressInfo = queryReceive($sql);

                ?>
                <P align="center"><i class="fas fa-map-marker-alt mr-2"></i>Delivery Address(optional)</P>
                <div class="form-group row">
                    <label for="area" class="col-form-label"> <span><i class="fas fa-city"></i></span> Area / Block
                    </label>

                    <label class="col-form-label ownText"> <?php
                        echo $AddressInfo[0][2];
                        ?></label>

                </div>
                <div class="form-group row">
                    <label for="streetNO" class="col-form-label"> <span><i class="fas fa-road"></i></span> Street no
                        #</label>

                    <label class="col-form-label ownText"> <?php
                        echo $AddressInfo[0][3];
                        ?></label>

                </div>
                <div class="form-group row">
                    <label for="houseno" class="col-form-label"> <span><i class="fas fa-street-view"></i></span> House
                        no# </label>
                    <label class="col-form-label ownText"> <?php
                        echo $AddressInfo[0][4];
                        ?></label>


                </div>


                <?php

            }
            ?>


        </form>
        <?php
    }
    ?>

</div>





<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function () {


    });

</script>
</body>
</html>
