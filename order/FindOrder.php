<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");

if(!isset($_SESSION['branchtype']))
{
    header("location:../company/companyRegister/companydisplay.php");
}
if(isset($_SESSION['order']))
{
    unset($_SESSION['order']);
}
if(isset($_SESSION['customer']))
{
    unset($_SESSION['customer']);
}


if(isset($_GET['action']))
{
    $_SESSION['order']=$_GET['order'];
    $_SESSION['customer']=$_GET['customer'];
    header("location:PreviewOrder.php");
}

$hallid="";
$cateringid="";
$hallorcater="";
$order_info=$_GET['order_status'];



if(isset($_SESSION['branchtype']))
{
    if($_SESSION['branchtype']=="hall")
    {
        $hallid=$_SESSION['branchtypeid'];
    }
    else
    {
        $cateringid=$_SESSION['branchtypeid'];
    }
}

$midOfHallOrCater="";
if(isset($_GET['order_status']))
{
    if ($_GET['order_status'] == "Today_Orders")
    {
        $date=date('Y-m-d');
        $CurrentDateTime = date('Y-m-d H:i:s');
        $CurrentDate = date('Y-m-d', strtotime($CurrentDateTime)); // d.m.YYYY
        $CurrentTime = date('H:i:s', strtotime($CurrentDateTime));

        $NextDateTime = date('Y-m-d H:i:s', strtotime($CurrentDateTime . ' +1 day'));
        $NextDate = date('Y-m-d', strtotime($NextDateTime)); // d.m.YYYY
        $NextTime = date('H:i:s', strtotime($NextDateTime));


        $midOfHallOrCater .= "AND (od.destination_date   BETWEEN '" . $CurrentDate . "' AND '" . $NextDate . "' )";

        $order_info = "Running";
    }

}

if(!empty($hallid))
{
    //hall order
    $hallorcater="(od.hall_id=".$hallid.")";
    $hallorcater.=$midOfHallOrCater;
if(isset($_GET['order_status']))
    $hallorcater .= "AND (od.status_hall='" . $order_info . "') ";
}
else
{
        //catering order
    $hallorcater="(od.catering_id=".$cateringid.")";
    $hallorcater.=$midOfHallOrCater;
    if(isset($_GET['order_status']))
    $hallorcater .= "AND (od.status_catering='" . $order_info . "')";
}
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">

    <style>
    </style>
</head>
<body>

<?php
include_once ("../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://university.daraz.pk/pluginfile.php/26/course/section/10/Order%20Fulfilment-01.png);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 class="text-dark"> <i class="fas fa-search-plus fa-3x"></i>Find Orders</h3>
        <p> Check <?php echo $order_info." order and "?> all orders</p>
        <button data-display="hide" id="searchBtn" class="btn-warning btn justify-content-center "><i class="fas fa-search"></i>Search Order</button>
    </div>

</div>


<div class="container card">

        <form class="col-12 shadow mb-4   " id="formId1" >

        <div class="form-group row">
            <label class="col-form-label"> Customer name</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input
                        value="<?php
                       if(isset($_GET['p_name']))
                           echo $_GET['p_name'];

                        ?>"



                        name="p_name" type="text" class="changeColumn form-control" placeholder="or customer name etc ali,....">
            </div>



        </div>
        <div class="form-group row">
            <label class="col-form-label"> Customer CNIC</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-id-card"></i></span>
                </div>
                <input
                        value="<?php
                        if(isset($_GET['p_cnic']))
                            echo $_GET['p_cnic'];

                        ?>" name="p_cnic" type="number" class="changeColumn form-control" placeholder="or cnic 23212xxxxx">
            </div>

        </div>
            <div class="form-group row">
                <label  class="col-form-label"> Customer ID</label>



                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input
                            value="<?php
                            if(isset($_GET['p_id']))
                                echo $_GET['p_id'];

                            ?>"  name="p_id" type="number" class="changeColumn form-control" placeholder="customer ID 1,2,3,4,.....">
                </div>


            </div>
        <div class="form-group row">
            <label class="col-form-label"> Customer phone</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                </div>
                <input
                        value="<?php
                        if(isset($_GET['n_number']))
                            echo $_GET['n_number'];

                        ?>" name="n_number" type="text" class="changeColumn form-control" placeholder="number 03231xxxxxx">
            </div>


        </div>
        <div class="form-group row">
            <label class="col-form-label">Booking Date</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input
                        value="<?php
                        if(isset($_GET['od_booking_date']))
                            echo $_GET['od_booking_date'];

                        ?>" name="od_booking_date" type="date" class="changeColumn form-control">
            </div>



        </div>
        <div class="form-group row">
            <label class="col-form-label"> Destination Date</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-business-time"></i></span>
                </div>
                <input
                        value="<?php
                        if(isset($_GET['od_destination_date']))
                            echo $_GET['od_destination_date'];

                        ?>" name="od_destination_date" type="date" class="changeColumn form-control">
            </div>


        </div>

        <div class="form-group row">
            <label class="col-form-label ">Order status</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-eye"></i></span>
                </div>


                <?php
                if($hallid=="")
                {

                    //catering
                    echo '<input class="form-control" readonly type="text" name="od_status_catering" value="Running">';
                }
                else
                {
                    //hall
                    echo '<input class="form-control" readonly type="text" name="od_status_hall" value="Running">';
                }

                ?>


            </div>


        </div>

        <div class="form-group row justify-content-center">
            <button type="submit" class="form-control btn-success col-6"><i class="fas fa-search"></i>Find</button>
        </div>

        </form>

        <div  id="recordsAll" >





            <?php


            $sql='SELECT     
DISTINCT
od.id,p.name,p.image,od.destination_date,od.destination_time,od.status_hall,od.status_catering,od.hall_id,od.catering_id,hp.package_name,p.id FROM orderDetail as od INNER JOIN person as p 
on (p.id=od.person_id)
left JOIN number as n
on (p.id=n.person_id)
left JOIN packageDate as pd
on (od.packageDate_id=pd.id)
left JOIN packages as hp
on (pd.package_id=hp.id)
WHERE

 ';


            if(isset($_GET['p_name']))
            {
                if(trim($_GET['p_name'])!='')
                    $sql.=' (p.name LIKE "%'.trim($_GET["p_name"]).'%") AND ';
            }

            if(isset($_GET['p_cnic']))
            {
                if(trim($_GET['p_cnic'])!='')
                    $sql.=' (p.cnic LIKE "%'.trim($_GET["p_cnic"]).'%") AND ';
            }
            if(isset($_GET['p_id']))
            {
                if(trim($_GET['p_id'])!='')
                    $sql.=' (p.id ='.$_GET["p_id"].') AND ';
            }
            if(isset($_GET['n_number']))
            {
                if(trim($_GET['n_number'])!='')
                    $sql.=' (n.number LIKE "%'.trim($_GET["n_number"]).'%") AND ';
            }
            if(isset($_GET['od_booking_date']))
            {
                if(trim($_GET['od_booking_date'])!='')
                    $sql.=' (od.booking_date = "'.trim($_GET["od_booking_date"]).'") AND ';
            }
            if(isset($_GET['od_destination_date']))
            {
                if(trim($_GET['od_destination_date'])!='')
                    $sql.=' (od.destination_date ="'.trim($_GET["od_destination_date"]).'") AND ';
            }
            if(isset($_GET['od_status_catering']))
            {
                if(trim($_GET['od_status_catering'])!='None')
                    $sql.=' (od.status_catering = "'.trim($_GET["od_status_catering"]).'" ) AND ';
            }

            if(isset($_GET['od_status_hall']))
            {
                if(trim($_GET['od_status_hall'])!='None')
                    $sql.=' (od.status_hall = "'.trim($_GET["od_status_hall"]).'") AND ';
            }


            $sql.=''.$hallorcater.' 
order by 
od.destination_date ASC,od.destination_time ASC';

            $orderdetail=queryReceive($sql);
            $display='';
            for ($i=0;$i<count($orderdetail);$i++)
            {
                $display.='
        <a href="?action=preview&order='.$orderdetail[$i][0].'&customer='.$orderdetail[$i][10].'" class="col-12   row  shadow m-3 newcolor">
        <img style="height:8vh" src="';

                if(file_exists('../images/customerimage/'.$orderdetail[$i][2])&&($orderdetail[$i][2]!=""))
                {
                    $display.='../images/customerimage/'.$orderdetail[$i][2];

                }
                else
                {
                    $display.='https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';
                }





                $display.='"class="col-3 p-0">
        <div class="col-9">
            <label class="col-12">Order id:<i class="text-secondary">'.$orderdetail[$i][0].'</i> </label>
            <label class="col-12">Name: <i class="text-secondary">'.$orderdetail[$i][1].'</i></label>
            <label class="col-12">Date: <i class="text-secondary">'.$orderdetail[$i][3].'</i></label>
        </div>
        <label class="col-12">Time: <i class="text-secondary">';

                if(!empty($hallid))
                {
                    //if order is hall order timing
                    if ($orderdetail[$i][4] == "09:00:00")
                    {
                        $display .= "Morning";
                    } else if ($orderdetail[$i][4] == "12:00:00") {
                        $display .= "Afternoon";
                    } else
                    {
                        $display .= "18:00:00";
                    }
                }
                else
                {
                    //catering order
                    $display.=$orderdetail[$i][4];
                }

                $display.='</i></label>';

                if($orderdetail[$i][7]!="")
                {
                    //if order is hall

                    $display .= '<label class="col-12">Per Head:<i class="text-secondary">';
                    if ($orderdetail[$i][9] != "")
                    {
                        //hall is booked wth food+seaating
                        $display.=$orderdetail[$i][9].'   Food+Seating';
                    } else
                    {
                        //hall is book only seating
                        $display.='Only Seating';

                    }
                    $display.='</i> </label>';
                }


                if(($orderdetail[$i][6]!="")&&($orderdetail[$i][8]!=""))
                {
                    //catering status
                    $display.='
        <label class="col-12">Catering Status:<i class="text-secondary">'.$orderdetail[$i][6].'</i> </label>';
                }
                if(($orderdetail[$i][5]!="")&&($orderdetail[$i][7]!=""))
                {
                    //hall status
                    $display.='
        <label class="col-12">Hall Status:<i class="text-secondary">'.$orderdetail[$i][5].'</i> </label>';
                }
                $display.='</a>';

            }
            echo $display;


            ?>






        </div>

<!--    <a href="#" class="col-12  btn-outline-danger row  shadow m-3">-->
<!--        <img src="../gmail.png" class="col-3 p-0">-->
<!--        <div class="col-9">-->
<!--            <label class="col-12">order id:<i class="text-secondary">1</i> </label>-->
<!--            <label class="col-12">Name: <i class="text-secondary">shahzad miraj</i></label>-->
<!--            <label class="col-12">date: <i class="text-secondary">12:9:21</i></label>-->
<!--        </div>-->
<!--        <label class="col-12">time: <i class="text-secondary">1</i></label>-->
<!--        <label class="col-12">catering status:<i class="text-secondary">1</i> </label>-->
<!--        <label class="col-12">Hall status:<i class="text-secondary">1</i> </label>-->
<!--    </a>-->





</div>




<?php
include_once ("../webdesign/footer/footer.php");
?>

<script>

    $(document).ready(function ()
    {



        $("#searchBtn").click(function () {
           var display=$(this).data("display");
           if(display=="hide")
           {
               $("#formId1").show('slow');
               $(this).data("display","show");
           }
           else
           {
               $("#formId1").hide('slow');

               $(this).data("display","hide");

           }

        });




    });





</script>
</body>
</html>
