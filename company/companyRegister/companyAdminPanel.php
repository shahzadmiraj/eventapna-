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

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$companyid=$userdetail[0][0];




$sql='SELECT  c.name FROM company as c WHERE c.id='.$companyid.'';
$companydetail=queryReceive($sql);


$sql='SELECT `id`, `name`,`image`,`token` FROM `hall` WHERE ISNULL(expire) AND (company_id='.$companyid.')';
$halls=queryReceive($sql);

$sql='SELECT `id`, `name`,`image`,`token` FROM `catering` WHERE ISNULL(expire) AND (company_id='.$companyid.')';
$caterings=queryReceive($sql);

$sql='SELECT `id`, `username`,`image`, `jobTitle`,`token` FROM `user` WHERE (company_id='.$companyid.')AND(ISNULL(expire))';
$users=queryReceive($sql);

$encoded=1;
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>

    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
            border: solid;
            border-color: white;
            background-color: #eee2e2;
        }

    </style>
</head>
<body>

<?php
include_once ("../../webdesign/header/header.php");

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
             "><i class="fas fa-clipboard-list fa-3x"></i> <h6> Hall Packages Manage</h6></a>
            <a href="../hallBranches/hallRegister.php" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-place-of-worship fa-3x "></i> <h6> + Add Hall</h6></a>
            <a href="../cateringBranches/catering.php" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-utensils fa-3x"></i> <h6> + Add Catering</h6></a>
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
            } ?>"><i class="fas fa-guitar fa-3x"></i> <h6>Hall Extra items Mangement</h6></a>
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

            <div class="col-md-4 mb-5">
                <img src="<?php echo $img;?>" class="img-thumbnail" style="width: 100%;height: 100%">
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
                            echo '      <a href="../../customer/CustomerCreate.php?'.$Query.'" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cart-plus fa-3x"></i><h6>Order Create</h6></a>';
                        } ?>
                        <a href="../../order/FindOrder.php?order_status=Today_Orders&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-book-reader fa-3x"></i><h6>Most Recent Running Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Running&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cart-arrow-down fa-3x"></i><h6>Running Order</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Delieved&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-truck fa-3x"></i><h6>Deliever Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Clear&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-thumbs-up fa-3x"></i><h6>Clear Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Cancel&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-trash-alt fa-3x"></i><h6>Cancel Orders</h6></a>

                         <a  href="../hallBranches/userDisplay/OrderCalender/OrderCalender.php?<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-calendar-alt fa-3x"></i><h6>Calender Orders</h6></a>
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
        echo '<a  href="../hallBranches/hallRegister.php"  class="text-muted col-12 text-center">Add Hall branches</a>
';
    }
    ?>
    <hr>
</div>











<div class="container ">


    <div class="container mt-2 mb-2 alert-primary " >
        <h4  class="float-left">  <i class="fas fa-utensils"></i> Caterings Management system</h4>
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

            <div class="col-md-4 mb-5">
                <img src="<?php echo $img;?>" class="img-thumbnail" style="width: 100%;height: 100%">
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
                            echo '<a href="../../customer/CustomerCreate.php?'.$Query.'" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cart-plus fa-3x"></i><h6>Order Create</h6></a>';
                        } ?>
                        <a href="../../order/FindOrder.php?order_status=Today_Orders&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-book-reader fa-3x"></i><h6>Most Recent Running Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Running&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cart-arrow-down fa-3x"></i><h6>Running Order</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Delieved&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-truck fa-3x"></i><h6>Delievered Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Clear&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-thumbs-up fa-3x"></i><h6>Clear Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Cancel&<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-trash-alt fa-3x"></i><h6>Cancel Orders</h6></a>
                        <?php if(onlyAccessUsersWho("Owner"))
                        {
                            echo '    <a href="../cateringBranches/infoCatering.php?'.$Query.'" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-cogs fa-3x"></i><h6>Branch Setting</h6></a>';
                        } ?>
                        <a href="../cateringBranches/gallerycatering.php?<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="fas fa-images fa-3x"></i> <h6>Gallery</h6></a>
                        <a  href="../../company/cateringBranches/DisplauUser/Ordercalender/OrderCalender.php?<?php echo $Query; ?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light text-center"><i class="far fa-calendar-alt fa-3x"></i><h6>Calender Orders</h6></a>
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
        echo '<a  href="../cateringBranches/catering.php"  class="text-muted col-12 text-center">Add Catering branches</a>
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

            <div class="col-md-4 mb-5">
                <img src="<?php echo $img;?>" class="img-thumbnail" style="width: 100%;height: 20vh">
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










<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>

</script>
</body>
</html>
