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

$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);
$orderid=$processInformation[0][5];

$sql='SELECT `hall_id` FROM `orderDetail` WHERE id='.$orderid.'';
$isHall=queryReceive($sql);

//remove hallprice_id from sql below in wher clause then you can get packages id  column

$sql='SELECT (SELECT u.username FROM user as u WHERE u.id=ho.user_id),ho.active,ho.user_id FROM HistoryOrder as ho WHERE ISNULL(ho.expire) AND (ho.orderDetail_id='.$orderid.') AND (ho.ColumnName!="hallprice_id") GROUP BY ho.active,ho.user_id';
$KindOFOrder=queryReceive($sql);

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
    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Orders History</title>
    <meta name="description" content="Orders History only company user can used this to get payment
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Orders  History  Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <script src="../jquery-3.3.1.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

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
$whichActive = 5;
$imageCustomer = "../images/customerimage/";
$PageName="Order History ";

include_once("../webdesign/orderWizard/wizardOrder.php");
?>


<div class="container">


    <?php







    for($i=0;$i<count($KindOFOrder);$i++)
    {



        ?>


        <form class="card card-header badge-light m-4">
            <h6><i class="fas fa-users"></i><?php echo $KindOFOrder[$i][0];?><i class="fas fa-clock"></i><?php echo $KindOFOrder[$i][1];?></h6>
            <hr>

            <?php



            $sql='SELECT ho.ColumnName,ho.columnValue FROM HistoryOrder as ho WHERE (ho.active="'.$KindOFOrder[$i][1].'")AND (ho.user_id='.$KindOFOrder[$i][2].')AND (ho.orderDetail_id='.$orderid.')';

            $infoDetail=queryReceive($sql);

            for($j=0;$j<count($infoDetail);$j++)
            {

                if($infoDetail[$j][0]=="hall_id")
                {
                    $sql='SELECT h.name FROM hall as h WHERE h.id='.$infoDetail[$j][1].'';
                    $HallName=queryReceive($sql);

                    echo '  <div class="form-group row">
                <label for="date" class="col-form-label"> <span><i class="far fa-calendar-alt"></i></span>Hall Order in Branch</label>
                <label class="col-form-label ownText">'.$HallName[0][0].' </label>
            </div>';

                }
                else if($infoDetail[$j][0]=="catering_id")
                {
                    $sql='SELECT c.name FROM catering as c WHERE c.id='.$infoDetail[$j][1].'';
                    $CateringName=queryReceive($sql);

                    echo '  <div class="form-group row">
                <label for="date" class="col-form-label"> <span><i class="far fa-calendar-alt"></i></span>Catering Order in Branch</label>
                <label class="col-form-label ownText">'.$CateringName[0][0].' </label>
            </div>';

                }

                else if($infoDetail[$j][0]=="hallprice_id")
                {

                }
                else if($infoDetail[$j][0]=="address_id")
                {
                    $sql = 'SELECT `id`, `address_city`, `address_town`, `address_street_no`, `address_house_no`, `person_id` FROM `address` WHERE id=' . $infoDetail[$j][1] . '';
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
                else if($infoDetail[$j][0]=="total_amount")
                {
                    echo '<div class="form-group row">
                <label class="col-form-label" for="total_amount"> <span><i class="far fa-money-bill-alt"></i></span>
                    Auto Total amount</label>
                <label class="col-form-label ownText"> '.$infoDetail[$j][1].'</label>
            </div>';

                }
                else if($infoDetail[$j][0]=="address")
                {
                    echo '<div class="form-group row">
                <label class="col-form-label" for="total_amount"> <span><i class="far fa-money-bill-alt"></i></span>
                    Address :</label>
                <label class="col-form-label ownText"> '.$infoDetail[$j][1].'</label>
            </div>';

                }
                else if($infoDetail[$j][0]=="extracharges")
                {
                    echo '<div class="form-group row">
                <label class="col-form-label" for="total_amount"> <span><i class="far fa-money-bill-alt"></i></span>
                    Extra Charges</label>
                <label class="col-form-label ownText"> '.$infoDetail[$j][1].'</label>
            </div>';
                }

                else if($infoDetail[$j][0]=="discount")
                {
                    echo '<div class="form-group row">
                <label class="col-form-label" for="total_amount"> <span><i class="far fa-money-bill-alt"></i></span>
                    Discount </label>
                <label class="col-form-label ownText"> '.$infoDetail[$j][1].'</label>
            </div>';

                }
                else if($infoDetail[$j][0]=="total_person")
                {
                    echo '
            <div class="form-group row">
                <label for="persons" class="col-form-label"> <span><i class="fas fa-users"></i></span> No of
                    guests</label>
                <label class="col-form-label ownText"> '.$infoDetail[$j][1].'</label>
            </div>';

                }
                else if($infoDetail[$j][0]=="status_hall")
                {
                    echo ' <div class="form-group row">
                    <label for="orderStatus" class="col-form-label"><span><i class="far fa-eye"></i></span>Hall Status
                    </label>
                    <label class="col-form-label ownText"> '.$infoDetail[$j][1].'</label>

                </div>';


                }
                else if($infoDetail[$j][0]=="destination_date")
                {
                  echo '
            <div class="form-group row">
                <label for="date" class="col-form-label"> <span><i class="far fa-calendar-alt"></i></span> Delivery Date</label>
                <label class="col-form-label ownText">'.$infoDetail[$j][1].' </label>
            </div>';


                }
                else if($infoDetail[$j][0]=="destination_time")
                {
                    $Show='';
                    $Show= ' <div class="form-group row">
                <label for="time" class="col-form-label"> <span><i class="fas fa-clock"></i></span> Delivery
                    Time</label>
                <label class="col-form-label ownText">';

                    if (count($isHall)>0)
                    {
                        $Show.= timingConvert($infoDetail[$j][1]);

                    } else
                    {
                        $Show.= $infoDetail[$j][1];
                    }

                    $Show.='</label>
            </div>';
                    echo $Show;
                }
                else if($infoDetail[$j][0]=="status_catering")
                {
                    echo '
                <div class="form-group row">
                    <label for="orderStatus" class="col-form-label"><span><i class="far fa-eye"></i></span>Catering
                        Status </label>
                    <label class="col-form-label ownText"> '.$infoDetail[$j][1].'</label>
                </div>';
                }
                else if($infoDetail[$j][0]=="describe")
                {
                    echo '
            <div class="form-group row">
                <label for="describe" class="col-form-label"> <span><i class="fas fa-comments"></i></span>
                    Describe order </label>

                <label class="col-form-label ownText">'.$infoDetail[$j][1].' </label>
            </div>';

                }



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
