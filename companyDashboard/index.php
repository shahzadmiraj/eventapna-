<?php
include_once ("../connection/connect.php");
include  ("../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner,Employee,Viewer","../../index.php");

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetailCom=queryReceive($sql);
$companyidCom=$userdetailCom[0][0];

$sql='SELECT  c.name FROM company as c WHERE c.id='.$companyidCom.'';
$companydetailCom=queryReceive($sql);


$sql='SELECT `id`, `name`,`image`,`token` FROM `hall` WHERE ISNULL(expire) AND (company_id='.$companyidCom.')';
$hallsCom=queryReceive($sql);

$sql='SELECT `id`, `name`,`image`,`token` FROM `catering` WHERE ISNULL(expire) AND (company_id='.$companyidCom.')';
$cateringsCom=queryReceive($sql);

$sql='SELECT `id`, `username`,`image`, `jobTitle`,`token` FROM `user` WHERE (company_id='.$companyidCom.')AND(ISNULL(expire))';
$usersCom=queryReceive($sql);

include('includes/startHeader.php'); //html

?>
<?php
include('../webdesign/header/InsertHeaderTag.php');
?>
    <title>Company Management</title>
    <meta name="description" content="Admin Panel ,Company Admin Panel ,DashBoard Company Management page, Order Manage Extra Item Hall,Manage Extra Item Marquee, Order Manage Extra Item Add Marquee,Manage Extra Item New Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords"  content="Admin Panel ,Company Admin Panel ,DashBoardCompany Management,Manage Extra Item Hall Marquee,Marquee,Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
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
include('includes/endHeader.php');
include('includes/navbar.php');

?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
  </div>

    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Hall</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Catering</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">User</a>
        </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">...</div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">...</div>
        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">...</div>
    </div>


    <div class="row">



        <?php

        $displayNav='';
        for($iCom=0;$iCom<count($hallsCom);$iCom++)
        {

            $img= "";

            if((file_exists('../images/hall/'.$hallsCom[$iCom][2]))&&($hallsCom[$iCom][2]!=""))
            {
                $img= "../images/hall/".$hallsCom[$iCom][2];
            }
            else
            {
                $img='../images/systemImage/imageNotFound.png';
            }


            $tokenCom=$hallsCom[$iCom][3];
            $hallEncordedCom=$hallsCom[$iCom][0];
            $QueryCom='h='.$hallEncordedCom.'&token='.$tokenCom;
            ?>


            <?php
            $displayNav.='
                  <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                 <img src="'.$img.'" class="" >
                    <h6 class="m-0 font-weight-bold text-primary">'.$hallsCom[$iCom][1].'</h6>
                </div>
                <div class="card-body">
                 
                 
           ';

            //start link

            if (onlyAccessUsersWho("Owner,Employee"))
            {
                $displayNav.= '<a href="'.$Root.'customer/CustomerCreate.php?' . $QueryCom . '" class="btn btn-primary btn-icon-split"> <span class="icon text-white-50"><i class="fas fa-cart-plus"></i></span> <span class="text">Add Order</span></a><div class="my-2"></div>';
            }

            $displayNav.='<a href="'.$Root.'order/FindOrder.php?order_status=Today_Orders&' . $QueryCom . '" class="btn btn-outline-dark btn-icon-split"><span class="icon text-white-50">  <i class="fas fa-flag"></i></span> <span class="text">Next 24 Process Orders</span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Running&' . $QueryCom . '" class="btn btn-warning btn-icon-split"><span class="icon text-white-50"> <i class="fas fa-exclamation-triangle"></i></span> <span class="text">Process Order</span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Delivered&' . $QueryCom . '" class="btn  btn-info  btn-icon-split"><span class="icon text-white-50"><i class="fas fa-info-circle"></i></span><span class="text"> Delivered Orders</span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Clear&'.$QueryCom . '" class="btn btn-success btn-icon-split"><span class="icon text-white-50">  <i class="fas fa-check"></i></span> <span class="text">Clear Orders</span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Cancel&'.$QueryCom.'" class="btn btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-trash"></i></span> <span class="text">Cancel Orders</span></a><div class="my-2"></div>
                       <a  href="'.$Root.'company/hallBranches/userDisplay/OrderCalender/OrderCalender.php?'. $QueryCom . '" class="btn btn-light btn-icon-split"><span class="icon text-white-50"><i class="far fa-calendar-alt "></i></span> <span class="text">Calender Orders</span></a><div class="my-2"></div>
                       <a  href="'.$Root.'company/ClientSide/Hall/HallClient.php?'.$QueryCom.'" class="btn btn-outline-primary btn-icon-split"><span class="icon text-white-50"><i class="fab fa-chrome "></i></span> <span class="text">Hall Website</span></a><div class="my-2"></div>';
            if (onlyAccessUsersWho("Owner"))
            {
                $displayNav.='  <a href="'.$Root.'company/hallBranches/hallInfo.php?' . $QueryCom . '" class="btn btn-outline-info btn-icon-split"><span class="icon text-white-50"><i class="fas fa-cogs "></i></span> <span class="text">Setting</span></a><div class="my-2"></div>';
            }
            $displayNav.='<a href="'.$Root.'company/hallBranches/galleryhall.php?' . $QueryCom . '" class="btn btn-outline-warning btn-icon-split"><span class="icon text-white-50"><i class="fas fa-images "></i></span> <span class="text">Gallery</span></a><div class="my-2"></div>';


            //end link

            $displayNav.='     </div>
              </div>

            </div>';

            ?>



            <?php
        }


        echo $displayNav;




        ?>



    </div>


    <?php
    include_once ('Analysis/index.php');
    ?>


  <!-- Content Row -->








  <?php
include('includes/scripts.php');
include('includes/footer.php');
?>


    <?php
    include_once ("../webdesign/footer/EndOfPage.php");
    ?>
