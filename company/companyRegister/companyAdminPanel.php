<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */

include  ("../../connection/connect.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);


$companyid=$userdetail[0][0];




$sql='SELECT  c.name FROM company as c WHERE c.id='.$companyid.'';
$companydetail=queryReceive($sql);


$sql='SELECT `id`, `name`,`image` FROM `hall` WHERE ISNULL(expire) AND (company_id='.$companyid.')';
$halls=queryReceive($sql);

$sql='SELECT `id`, `name`,`image` FROM `catering` WHERE ISNULL(expire) AND (company_id='.$companyid.')';
$caterings=queryReceive($sql);

$sql='SELECT u.id FROM user as u WHERE u.company_id='.$companyid.'';
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

    </style>
</head>
<body>

<?php
include_once ("../../webdesign/header/header.php");

?>

<div class="jumbotron  shadow " style="background-image: url(https://i2.wp.com/findlawyer.com.ng/wp-content/uploads/2018/05/Pros-and-Cons-of-Working-at-Large-Companies.jpg?resize=1024%2C512&ssl=1);background-size:100% 115%;background-repeat: no-repeat;">

    <div class="card-body text-center" style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 "><i class="fas fa-city mr-2"></i><?php echo $companydetail[0][0];?></h1>
        <p>check your orders of hall and as well as catering</p>
    </div>
</div>



<div class="container ">


    <div class="container mt-2 mb-2  ">
        <h3  class="float-left"> <i class="fas fa-place-of-worship "></i> Halls Management System</h3>
        <a href="../hallBranches/hallRegister.php" class="btn btn-success float-right"><i class="fas fa-plus"></i><i class="fas fa-place-of-worship "></i> Add Hall</a>
    </div>



    <div class="row container">

        <?php


        for($i=-1;$i<count($halls);$i++)
        {

            $img= "";

            /*if((file_exists('../../images/hall/'.$halls[$i][2]))&&($halls[$i][2]!=""))
        {
            $img= "../../images/hall/".$halls[$i][2];
        }
        else
        {
            $img='https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg';
        }*/

            $img='https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg';

           // $hallEncorded=base64url_encode($halls[$i][0]);
            $hallEncorded=1;
            ?>

            <div class="col-md-4 mb-5">
                <img src="<?php echo $img;?>" class="img-thumbnail" style="width: 100%;height: 100%">
            </div>


            <div class="col-md-8 col-12 mb-5">
                <h4>
                    Name of branch <i class="fas fa-place-of-worship "></i>
                </h4>
                <hr>
                <div class="container">
                    <div class="row justify-content-start">
                        <a href="../../customer/CustomerCreate.php?" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-cart-plus fa-3x"></i><h6>Order Create</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Today_Orders&h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-book-reader fa-3x"></i><h6>Most Recent Running Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Running&h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-cart-arrow-down fa-3x"></i><h6>Running Order</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Delieved&h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-truck fa-3x"></i><h6>Deliever Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Clear&h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="far fa-thumbs-up fa-3x"></i><h6>Clear Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Cancel&h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="far fa-trash-alt fa-3x"></i><h6>Cancel Orders</h6></a>

                         <a  href="../hallBranches/userDisplay/OrderCalender/OrderCalender.php?h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="far fa-calendar-alt fa-3x"></i><h6>Calender Orders</h6></a>
                         <a  href="../hallBranches/userDisplay/extraItem/ExtraitemHall.php?h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="far fa-calendar-alt fa-3x"></i><h6>Extra items Price List</h6></a>
                         <a  href="../ClientSide/Hall/HallClient.php?h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fab fa-chrome fa-3x"></i> <h6>Hall Website</h6></a>

                        <a  href="../../payment/RemainingAmount.php?h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fab fa-amazon-pay fa-3x"></i><h6>All Orders Payments info</h6></a>
                        <a href="../hallBranches/hallInfo.php?h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-cogs fa-3x"></i><h6> Hall Setting</h6></a>
                        <a href="../hallBranches/galleryhall.php?h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-images fa-3x"></i> <h6> Gallery</h6></a>
                        <a href="../hallBranches/HallprizeLists.php?h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-clipboard-list fa-3x"></i> <h6> Prize list</h6></a>
                        <a href="../hallBranches/extraItems/Hallitem.php?h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-comments fa-3x"></i> <h6> Extra items</h6></a>
                        <a href="../hallBranches/comment.php?h=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-comments fa-3x"></i> <h6> Comments</h6></a>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>


    </div>



</div>











<div class="container ">


    <div class="container mt-2 mb-2 alert-primary " >
        <h4  class="float-left">  <i class="fas fa-utensils"></i> Caterings Management system</h4>
        <a href="../cateringBranches/catering.php" class="btn btn-success float-right"><i class="fas fa-plus"></i> <i class="fas fa-utensils"></i> Add Catering</a>
    </div>

    <div class="row container">

        <?php


        for($i=-1;$i<count($caterings);$i++)
        {

            $img= "";

            /*if((file_exists('../../images/catering/'.$caterings[$i][2]))&&($caterings[$i][2]!=""))
            {
                $img= "../../images/catering/".$caterings[$i][2];
            }
            else
            {
                $img='https://www.liberaldictionary.com/wp-content/uploads/2019/02/cater-4956.jpg';
            }*/

            $img='https://www.liberaldictionary.com/wp-content/uploads/2019/02/cater-4956.jpg';

            // $hallEncorded=base64url_encode($halls[$i][0]);
            $hallEncorded=1;
            ?>

            <div class="col-md-4 mb-5">
                <img src="<?php echo $img;?>" class="img-thumbnail" style="width: 100%;height: 100%">
            </div>


            <div class="col-md-8 col-12 mb-5">
                <h4>
                    Name of branch <i class="fas fa-utensils"></i>
                </h4>
                <hr>
                <div class="container">
                    <div class="row justify-content-start">
                        <a href="../../customer/CustomerCreate.php?" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-cart-plus fa-3x"></i><h6>Order Create</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Today_Orders&c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-book-reader fa-3x"></i><h6>Most Recent Running Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Running&c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-cart-arrow-down fa-3x"></i><h6>Running Order</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Delieved&c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-truck fa-3x"></i><h6>Deliever Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Clear&c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="far fa-thumbs-up fa-3x"></i><h6>Clear Orders</h6></a>
                        <a href="../../order/FindOrder.php?order_status=Cancel&c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="far fa-trash-alt fa-3x"></i><h6>Cancel Orders</h6></a>
                        <a href="../cateringBranches/infoCatering.php?c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-cogs fa-3x"></i><h6>Branch Setting</h6></a>
                        <a href="../cateringBranches/gallerycatering.php?c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-images fa-3x"></i> <h6>Gallery</h6></a>
                        <a href="../cateringBranches/dish/dishesInfo.php?c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-hamburger fa-3x"></i><h6>Dishes Mangement system</h6></a>
                        <a href="../cateringBranches/cateringComment/cateringComment.php?c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fas fa-comments fa-3x"></i><h6>Comments</h6></a>
                         <a  href="../../company/cateringBranches/dish/dishPriceList.php?c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fa fa-list-ol fa-3x" ></i><h6>Dishes Price List</h6></a>
                        <a  href="../../company/cateringBranches/DisplauUser/Ordercalender/OrderCalender.php?c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="far fa-calendar-alt fa-3x"></i><h6>Calender Orders</h6></a>
                        <a  href="../../company/ClientSide/Catering/cateringClient.php?c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fab fa-chrome fa-3x"></i> <h6>Website</h6></a>
                        <a  href="../../payment/RemainingAmount.php?c=<?php echo $hallEncorded;?>" class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2  badge-light"><i class="fab fa-amazon-pay fa-3x"></i><h6>All Orders Payments info</h6></a>
                    </div>
                </div>
            </div>

            <?php
        }
        ?>

    </div>

</div>

















<div class="container ">


    <div class="container mt-2 mb-2  ">
        <h3  class="float-left"> <i class="fas fa-user  mr-1"></i> Users</h3>
        <a href="../../system/user/usercreate.php" class="btn btn-success float-right"><i class="fas fa-user-plus"></i> Add User</a>
    </div>



    <div class="row container">

        <?php


        for($i=-1;$i<count($users);$i++)
        {

            $img= "";

            /*if(file_exists('../../images/users/'.$users[$i][3])&&($users[$i][3]!=""))
            {
                $img='../../images/users/'.$users[$i][3];

            }
            else
            {
                $img='https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';
            }*/

            $img='https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';

            ?>

            <div class="col-md-4 mb-5">
                <img src="<?php echo $img;?>" class="img-thumbnail" style="width: 100%;height: 20vh">
            </div>


            <div class="col-md-8 col-12 mb-5">
                <h4>
                    User name <i class="fas fa-user  mr-1"></i>
                </h4>
                <hr>
                <div class="container">
                    <div class="row justify-content-start">



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
