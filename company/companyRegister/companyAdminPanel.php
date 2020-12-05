<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */

include  ("../../connection/connect.php");
include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner,Employee,Viewer","../../index.php");
header("location:../../index.php");

?>
<!DOCTYPE html>
<head>

    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Company Management</title>
    <meta name="description" content="Admin Panel ,Company Admin Panel ,DashBoard Company Management page, Order Manage Extra Item Hall,Manage Extra Item Marquee, Order Manage Extra Item Add Marquee,Manage Extra Item New Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Admin Panel ,Company Admin Panel ,DashBoardCompany Management,Manage Extra Item Hall Marquee,Marquee,Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>

    <script type="text/javascript" src="../../bootstrap.min.js"></script>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
</head>
<body>

<?php
//include_once ("../../webdesign/header/header.php");
?>



<div class="container ">

    <h2 class="text-center text-muted">Company Management</h2>

    <?php
    if(onlyAccessUsersWho("Owner"))
    {
        ?>
        <hr>
        <div class="container">
            <div class="row justify-content-start">
                <a href="../hallBranches/HallprizeLists.php" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center

    <?php if(count($halls)==0)
                {
                    echo 'disabled';
                } ?>
             "><i class="fas fa-clipboard-list fa-3x"></i> <h6>Manage Hall Packages </h6></a>
                <a href="../hallBranches/hallRegister.php" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-place-of-worship fa-3x "></i> <h6> + Add Hall</h6></a>
                <a href="../cateringBranches/catering.php" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-utensils fa-3x"></i> <h6> + Add Food & Catering</h6></a>
                <a href="../../user/RegisterCompanyUser.php" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-user-plus fa-3x"></i> <h6> + Add User</h6></a>
                <a href="../ClientSide/Company/ClientCompany.php?c=<?php echo $companyid;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fab fa-chrome fa-3x"></i> <h6> Your website</h6></a>
                <a href="../cateringBranches/dish/dishesInfo.php" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center


<?php if(count($caterings)==0)
                {
                    echo 'disabled';
                } ?>
"><i class="fas fa-hamburger fa-3x"></i><h6>Catering Dishes Mangement system</h6></a>



                <a href="../hallBranches/extraItems/Hallitem.php?" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center
<?php if(count($halls)==0)
                {
                    echo 'disabled';
                } ?>"><i class="fas fa-guitar fa-3x"></i> <h6>Hall Extra items Management</h6></a>
            </div>
        </div>



        <?php
    }
    ?>



    <hr>



    <div class="container mt-2 mb-2  ">
        <h3  class="float-left"> <i class="fas fa-place-of-worship "></i> Halls Management System</h3>
    </div>



    <div class="row container">

        <?php


        for($i=0;$i<count($halls);$i++)
        {

            $img= "";

            if((file_exists('../../images/hall/'.$halls[$i][2]))&&($halls[$i][2]!=""))
            {
                $img= "../../images/hall/".$halls[$i][2];
            }
            else
            {
                $img='../../images/systemImage/imageNotFound.png';
            }


            // $hallEncorded=base64url_encode($halls[$i][0]);
            $token=$halls[$i][3];
            $hallEncorded=$halls[$i][0];
            $Query='h='.$hallEncorded.'&token='.$token;
            ?>

            <div class="col-md-4 mb-5 m-auto">
                <img src="<?php echo $img;?>" class="embed-responsive embed-responsive-16by9">
            </div>


            <div class="col-md-8 col-12 mb-5">
                <h4>
                    <?php echo $halls[$i][1]; ?> <i class="fas fa-place-of-worship "></i>
                </h4>
                <hr>
                <div class="container">
                    <div class="row justify-content-start">
                        <?php if(onlyAccessUsersWho("Owner,Employee"))
                        {
                            echo '      <a href="../../customer/CustomerCreate.php?'.$Query.'" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cart-plus fa-3x"></i><h6>Add Order</h6>(Book a new order)</a>';
                        } ?>
                        <a href="../../order/FindOrder.php?order_status=Today_Orders&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-book-reader fa-3x"></i><h6>Most Recent Running Orders</h6>(Nearly orders which are in process)</a>
                        <a href="../../order/FindOrder.php?order_status=Running&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cart-arrow-down fa-3x"></i><h6>Running Order</h6>(Future orders which are in process)</a>
                        <a href="../../order/FindOrder.php?order_status=Delivered&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-truck fa-3x"></i><h6>Delivered Orders</h6>(Orders which are  delivered but payments are Remaining)</a>
                        <a href="../../order/FindOrder.php?order_status=Clear&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-thumbs-up fa-3x"></i><h6>Clear Orders</h6>(Orders which are done)</a>
                        <a href="../../order/FindOrder.php?order_status=Cancel&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-trash-alt fa-3x"></i><h6>Cancel Orders</h6>(Orders which are Cancel)</a>

                        <a  href="../hallBranches/userDisplay/OrderCalender/OrderCalender.php?<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-calendar-alt fa-3x"></i><h6>Calender Orders</h6>(View all Orders in calender)</a>
                        <!--                         <a  href="../hallBranches/userDisplay/extraItem/ExtraitemHall.php?h=--><?php //echo $hallEncorded;?><!--" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="far fa-calendar-alt fa-3x"></i><h6>Extra items Price List</h6></a>-->
                        <a  href="../ClientSide/Hall/HallClient.php?<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fab fa-chrome fa-3x"></i> <h6>Hall Website</h6></a><!--
                        <a  href="../../payment/RemainingAmount.php?<?php /*echo $Query; */?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fab fa-amazon-pay fa-3x"></i><h6>All Orders Payments information</h6></a>-->

                        <?php if(onlyAccessUsersWho("Owner"))
                        {
                            echo '  <a href="../hallBranches/hallInfo.php?'.$Query.'" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cogs fa-3x"></i><h6> Hall Setting</h6></a>';
                        } ?>
                        <a href="../hallBranches/galleryhall.php?<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-images fa-3x"></i><h6>Gallery</h6></a>
                    </div>
                </div>
            </div>

            <?php
        }

        ?>


    </div>


    <?php

    if((count($halls)==0)&&(onlyAccessUsersWho("Owner")))
    {
        echo '<a  href="../hallBranches/hallRegister.php"  class="alert-info">Add Halls : So you can manage Hall orders ,Hall Extra items Management ,Manage Hall Packages</a>
';
    }
    ?>
    <hr>
</div>











<div class="container ">


    <div class="container mt-2 mb-2 alert-primary " >
        <h4  class="float-left">  <i class="fas fa-utensils"></i> Foods & Caterings Management System</h4>
    </div>

    <div class="row container">

        <?php


        for($i=0;$i<count($caterings);$i++)
        {

            $img= "";

            if((file_exists('../../images/catering/'.$caterings[$i][2]))&&($caterings[$i][2]!=""))
            {
                $img= "../../images/catering/".$caterings[$i][2];
            }
            else
            {
                $img='../../images/systemImage/imageNotFound.png';
            }


            $token=$caterings[$i][3];
            $id=$caterings[$i][0];
            //  $CateringQuery='id='.$id.'&token='.$token.'&c='.$id;
            $Query='c='.$id.'&token='.$token;
            ?>

            <div class="col-md-4 mb-5 m-auto">
                <img src="<?php echo $img;?>" class="embed-responsive embed-responsive-16by9" >
            </div>


            <div class="col-md-8 col-12 mb-5">
                <h4>
                    <?php echo $caterings[$i][1]; ?><i class="fas fa-utensils"></i>
                </h4>
                <hr>
                <div class="container">
                    <div class="row justify-content-start">

                        <?php if(onlyAccessUsersWho("Owner,Employee"))
                        {
                            echo '<a href="../../customer/CustomerCreate.php?'.$Query.'" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cart-plus fa-3x"></i><h6>Add Order</h6>(Book a new order)</a>';
                        } ?>
                        <a href="../../order/FindOrder.php?order_status=Today_Orders&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-book-reader fa-3x"></i><h6>Most Recent Running Orders</h6>(Nearly orders which are in process)</a>
                        <a href="../../order/FindOrder.php?order_status=Running&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cart-arrow-down fa-3x"></i><h6>Running Order</h6>(Future orders which are in process)</a>
                        <a href="../../order/FindOrder.php?order_status=Delivered&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-truck fa-3x"></i><h6>Delivered Orders</h6>(Orders which are  delivered but payments are Remaining)</a>
                        <a href="../../order/FindOrder.php?order_status=Clear&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-thumbs-up fa-3x"></i><h6>Clear Orders</h6>(Orders which are done)</a>
                        <a href="../../order/FindOrder.php?order_status=Cancel&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-trash-alt fa-3x"></i><h6>Cancel Orders</h6>(Orders which are Cancel)</a>
                        <?php if(onlyAccessUsersWho("Owner"))
                        {
                            echo '    <a href="../cateringBranches/infoCatering.php?'.$Query.'" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cogs fa-3x"></i><h6>Branch Setting</h6></a>';
                        } ?>
                        <a href="../cateringBranches/gallerycatering.php?<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-images fa-3x"></i> <h6>Gallery</h6></a>
                        <a  href="../../company/cateringBranches/DisplauUser/Ordercalender/OrderCalender.php?<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-calendar-alt fa-3x"></i><h6>Calender Orders</h6>(View all Orders in calender)</a>
                        <a  href="../../company/ClientSide/Catering/cateringClient.php?<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fab fa-chrome fa-3x"></i> <h6>Website</h6></a>
                        <!--                        <a  href="../../payment/RemainingAmount.php?<?php /*echo $Query; */?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fab fa-amazon-pay fa-3x"></i><h6>All Orders Payments info</h6></a>-->
                    </div>
                </div>
            </div>

            <?php
        }
        ?>


    </div>
    <?php

    if((count($caterings)==0)&&(onlyAccessUsersWho("Owner")))
    {
        echo '<a  href="../cateringBranches/catering.php"  class="alert-info">Add Caterings : So you can manage Food orders ,Catering Dishes Management System</a>
';
    }
    ?>
    <hr>
</div>


















<div class="container ">


    <div class="container mt-2 mb-2  ">
        <h3  class="float-left"> <i class="fas fa-user  mr-1"></i> Users</h3>
    </div>



    <div class="row container">

        <?php


        for($i=0;$i<count($users);$i++)
        {

            $img= "";

            if(file_exists('../../images/users/'.$users[$i][2])&&($users[$i][2]!=""))
            {
                $img='../../images/users/'.$users[$i][2];

            }
            else
            {
                $img='../../images/systemImage/imageNotFound.png';
            }


            ?>

            <div class="col-md-4 mb-5 m-auto">
                <img src="<?php echo $img;?>" class="img-thumbnail" class="embed-responsive embed-responsive-16by9">
            </div>


            <div class="col-md-8 col-12 mb-5">
                <h4>
                    <?php echo $users[$i][1]?> <i class="fas fa-user  mr-1"></i>
                    <span class="float-right"><?php echo $users[$i][3]?></span>
                </h4>
                <hr>
                <div class="container">
                    <div class="row justify-content-start">
                        <a  href="../../user/UserProfile.php?uid=<?php echo $users[$i][0]."&token=".$users[$i][4]?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-id-card fa-3x"></i><h6>User Profile</h6></a>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>


    </div>



</div>









<!---->
<?php
//include_once ("../../webdesign/footer/footer.php");
//?>
<script>

</script>
</body>
</html>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>