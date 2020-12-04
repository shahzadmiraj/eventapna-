<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
include  ("../access/userAccess.php");

if(isset($_GET['c']))
{
  RedirectOtherwiseOnlyAccessUserOfCateringBranch("Owner,Employee", "../index.php","c");
}
else
{
    RedirectOtherwiseOnlyAccessUserOfHall("Owner,Employee", "../index.php","h");
}

$hallid="";
$cateringid="";
$hallorcater="";
$name="";
$id=1;
$token=$_GET['token'];


$HeadingImage="";
$HeadingName="";
$Source='';
if(isset($_GET['c']))
{
    $cateringid= $_GET['c'];
    $name="c";
    $id=$_GET['c'];

    //header set
    $sql='SELECT `name`,`image` FROM `catering` WHERE (id='.$id.')AND(token="'.$token.'")AND(ISNULL(expire))';
    $detailBranch=queryReceive($sql);
    $Source="../images/catering/";
    $HeadingImage=$detailBranch[0][1];
    $HeadingName=$detailBranch[0][0];


}
else if(isset($_GET['h']))
{
    $hallid=$_GET['h'];
    $name="h";
    $id=$_GET['h'];

    //header set
    $sql='SELECT `name`,`image` FROM `hall` WHERE (id='.$id.')AND(token="'.$token.'")AND(ISNULL(expire))';
    $detailBranch=queryReceive($sql);


    $Source="../images/hall/";
    $HeadingImage=$detailBranch[0][1];
    $HeadingName=$detailBranch[0][0];

}

$order_info="";
if (isset($_GET['order_status']))
{
    $order_info= $_GET['order_status'];
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

include('../companyDashboard/includes/startHeader.php'); //html
?>




    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Orders Finder</title>
    <meta name="description" content="Orders Finder only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Orders  Finder  Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>

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
$pageName=$order_info." Orders :".'<button data-display="hide" id="searchBtn" class="btn-outline-primary btn justify-content-center "><i class="fas fa-search"></i>Search Order</button>';

include_once ("../company/ClientSide/Company/Box.php");
?>




<div class="container">


        <form class="row border mb-4 alert-info" id="formId1" style="display: none" >

            <?php
            echo '<input type="number" name="'.$name.'" value='.$id.' hidden>
            <input type="text" name="token" value="'.$token.'" hidden>
            <input type="text" name="order_status" hidden value="'.$_GET['order_status'].'">
           
            ';
            ?>



        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Customer name</label>


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
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
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
            <div class="col-sm-12   col-12 col-md-6 col-lg-6">
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
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
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
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Visited Date</label>



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
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label"> Booked Date</label>



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

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Order status</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-eye"></i></span>
                </div>


                <?php
                if($hallid=="")
                {
                    //catering
                    echo '<input class="form-control" readonly type="text" name="od_status_catering" value="'.$order_info.'">';
                }
                else
                {
                    //hall
                    echo '<input class="form-control" readonly type="text" name="od_status_hall" value="'.$order_info.'">';
                }

                ?>


            </div>


        </div>

        <div class="col-sm-12   col-12 col-md-12 col-lg-12 align-content-center mb-4">
            <button type="submit" class="form-control btn-success float-right"><i class="fas fa-search"></i>Find</button>
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

             $OrdersOneD = array_column($orderdetail, 0);
            $List = implode(',', $OrdersOneD);
            echo '
<div class="row alert-info">
                <form action="../PDF/PdfVendorOnly.php"  method="POST" class="col-6">
                <input hidden name="BranchName" value="' .$detailBranch[0][0].'" >
                <input hidden type="text" name="PrintedOrders" value="'.$List.'">
                <input hidden type="text" name="ViewOrDownload" value="View">
                <button type="submit" class="btn btn-primary col-12"><i class="fa fa-print" aria-hidden="true"></i> PDF View</button>
                </form>
                <form action="../PDF/PdfVendorOnly.php"  method="POST" class="col-6">
                <input hidden name="BranchName" value="' .$detailBranch[0][0].'" >
                <input hidden type="text" name="PrintedOrders" value="'.$List.'">
                <input hidden type="text" name="ViewOrDownload" value="Download">
                <button type="submit" class="btn btn-info col-12"><i class="fas fa-cloud-download-alt"></i> PDF Save</button>
                </form>
</div>';



            $display='<div>

<div class="container">
';
            for ($i=0;$i<count($orderdetail);$i++)
            {
                $sql='SELECT `id`, `token` FROM `BookingProcess`  WHERE `orderDetail_id`='.$orderdetail[$i][0].'';
                $OrderProcess=queryReceive($sql);

                $Query='pid='.$OrderProcess[0][0].'&token='.$OrderProcess[0][1];
                $display.='
        <div  class="row container mb-2 mb-2 border btn-light border-left-primary  border-bottom-primary">
   

<nav class="navbar  navbar-light bg-light  col-sm-12    col-12 col-md-12 col-lg-12 row ">
  <a class="navbar-brand" href="#">No # '.($i+1).'</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown'.$i.'" aria-controls="navbarNavDropdown'.$i.'" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavDropdown'.$i.'">
    <ul class="navbar-nav form-inline row">
   ';


            if(onlyAccessUsersWho("Owner,Employee"))
            {
                $display.='    
                
                 <li class="nav-item">
                            <a href="../customer/customerEdit.php?'.$Query.'" class="nav-link"><i class="fas fa-user-edit "></i> Customer Detail</a>
                  </li>';
               if(!empty($hallid))
               {
                    //1 hall order edit                //2 make hall order to user displaye
                    $display.=' 
                    
                    
                     <li class="nav-item">
                    <a href="../company/hallBranches/EdithallOrder.php?' . $Query . '"  class="nav-link"><i class="fas fa-cart-arrow-down "></i> Hall Order</a>
                  </li> 
                  <li class="nav-item">
                    <a href="../company/hallBranches/orderInfo/orderItem.php?' . $Query . '" class="nav-link"><i class="far fa-money-bill-alt"></i> Manage Hall Extra Items</a>
                  </li>
';
                } else {
                    //catering order editor                  //2 make catering order to user displaye
                    $display.=' 
                      <li class="nav-item">
                    <a href="orderEdit.php?' . $Query . '" class="nav-link"><i class="fas fa-cart-arrow-down "></i> Catering  Order</a>
                  </li>';
                }


                if (($orderdetail[$i][6]!="")&&($orderdetail[$i][8]!=""))
                {//catering status
                    $display.=' 
                     <li class="nav-item ">
                        <a href="../dish/AllSelectedDishes.php?' . $Query . '" class="nav-link"><i class="fas fa-concierge-bell "></i> Dishes Booking</a>
                      </li>';
                }

            }

      
      
 $display.=' 
    <li class="nav-item ">
        <a href="../payment/getPayment.php?' . $Query . '" class="nav-link"><i class="far fa-money-bill-alt"></i> Get Payment</a>
      </li>
      <li class="nav-item">
         <a href="../payment/paymentHistory.php?' . $Query . '" class="nav-link"><i class="fas fa-history "></i> Payment History</a>
      </li>
      <li class="nav-item">
        <a href="HistoryOrder.php?' . $Query . '" class="nav-link"><i class="fas fa-eraser"></i> Order History</a>
      </li>
      <li class="nav-item">
        <a href="../payment/paymentDisplaySend.php?' . $Query . '" class="nav-link"><i class="fas fa-share-alt "></i> Transfer payment (user to user)</a>
      </li>
      <li class="nav-item">
        <a href="../payment/transferPaymentReceive.php?' . $Query . '" class="nav-link"><i class="fas fa-clipboard-check "></i> Payment Received Request (user to user)</a>
      </li>
         <li class="nav-item">
        <a href="../order/PreviewOrder.php?' . $Query . '" class="nav-link">  <i class="navbar-toggler-icon"></i> Order Management</a>
      </li>
 
 
 
   </ul>
  </div>
</nav>
       
        <img style="height:60px;weight:60px" src="';


                if(file_exists('../images/customerimage/'.$orderdetail[$i][2])&&($orderdetail[$i][2]!=""))
                {
                    $display.='../images/customerimage/'.$orderdetail[$i][2];

                }
                else
                {
                    $display.='../images/systemImage/imageNotFound.png';
                }





                $display.='"class="col-sm-12   col-12 col-md-3 col-lg-3 p-0">
        <label class="col-sm-12   col-12 col-md-3 col-lg-3">Order id:<i class="text-secondary">'.$orderdetail[$i][0].'</i> </label>
            <label class="col-sm-12   col-12 col-md-3 col-lg-3">Name: <i class="text-secondary">'.$orderdetail[$i][1].'</i></label>
            <label class="col-sm-12   col-12 col-md-3 col-lg-3">Date: <i class="text-secondary">'.$orderdetail[$i][3].'</i></label>
      
        <label class="col-sm-12   col-12 col-md-3 col-lg-3">Time: <i class="text-secondary">';

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

                    $display .= '<label class="col-sm-12   col-12 col-md-3 col-lg-3">Per Head:<i class="text-secondary">';
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
        <label class="col-sm-12   col-12 col-md-3 col-lg-3">Catering Status:<i class="text-secondary">'.$orderdetail[$i][6].'</i> </label>';
                }
                if(($orderdetail[$i][5]!="")&&($orderdetail[$i][7]!=""))
                {
                    //hall status
                    $display.='
        <label class="col-sm-12   col-12 col-md-3 col-lg-3">Hall Status:<i class="text-secondary">'.$orderdetail[$i][5].'</i> </label>';
                }
                $display.='
        <a href="../order/PreviewOrder.php?' . $Query . '" class="btn btn-success col-sm-12   col-12 col-md-3 col-lg-3">  <i class="navbar-toggler-icon"></i> Order Management</a>


</div>';

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
<?php
include('../companyDashboard/includes/scripts.php');
include('../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>