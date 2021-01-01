
<?php
include_once ('../../../connection/connect.php');

include_once ("functions.php");
if((!isset($_GET['pdid']))||(!isset($_GET['pdtoken'])))
{
    header("location:../../../index.php");
}
$userid="NoUser";
$PackageDateid=$_GET['pdid'];
$PackageToken=$_GET['pdtoken'];

if(isset($_COOKIE['userid']))
    $userid=$_COOKIE['userid'];

$sql='SELECT pd.package_id,pd.selectedDate FROM packageDate as pd 
WHERE (pd.id='.$PackageDateid.')AND(token="'.$PackageToken.'")';
$PackageDate=queryReceive($sql);
if(count($PackageDate)==0)
{
    header("location:../../../index.php");
}


$sql='SELECT  `hall_id` FROM `packageControl` WHERE ISNULL(expire)AND(package_id='.$PackageDate[0][0].')';
$PackageOrignal=queryReceive($sql);

$sql='SELECT `id`, `isFood`, `price`, `describe`, `dayTime`,'.$PackageOrignal[0][0].', `package_name`, `active`,`MinimumGuest`  FROM `packages` WHERE id='.$PackageDate[0][0].'';
$PackageDetail=queryReceive($sql);

//$sql='SELECT `id`, `dishname`, `image` FROM `menu` WHERE (package_id='.$PackageDetail[0][0].')AND(ISNULL(expire))';

$sql='SELECT `itemname`, `itemtype` FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$PackageDetail[0][0].') GROUP by itemtype';
$MenuType=queryReceive($sql);



$sql='SELECT hall.id,`name`, `max_guests`, 1, `noOfPartitions`, `ownParking`, `image`, `hallType`,`company_id`, hall.active,l.country,l.city,l.address,l.latitude,l.longitude FROM `hall` INNER join location as l 
on (hall.location_id=l.id)
WHERE
(ISNULL(l.expire))AND (hall.id='.$PackageDetail[0][5].')';
$hallInformation=queryReceive($sql);


$sql='SELECT EIT.id,EIT.name FROM ExtraItemControl as EIC INNER join  Extra_Item as EI 
on(EIC.Extra_Item_id=EI.id) INNER join Extra_item_type as EIT 
on (EI.Extra_item_type_id=EIT.id)
WHERE
(ISNULL(EIC.expire)) AND(ISNULL(EIT.expire))AND(EIC.hall_id in('.$hallInformation[0][0].'))
GROUP by (EIT.id)';

$ExtraType=queryReceive($sql);


$MaxGuestMaxPartition=hallOrderExist($PackageDetail[0][4], $hallInformation[0][0], $PackageDate[0][1]);
$SenderAddress=array();
$SenderName=array();

?>
<!DOCTYPE html>
<head xmlns="http://www.w3.org/1999/html">

    <?php
    include('../../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Hall Package View</title>
    <meta name="description" content="Hall Package View page,Hall Package View Client see package, Order Manage Extra Item Hall,Manage Extra Item Marquee, Order Manage Extra Item Add Marquee,Manage Extra Item New Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Hall Package View,Manage Extra Item Hall Marquee,Marquee,Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script src="../../../jquery-3.3.1.js"></script>
  <!--  <script type="text/javascript" src="../../../bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">

    <link rel="stylesheet" href="../../../webdesign/css/Gallery.css">
    <link rel="stylesheet" href="../../../webdesign/css/comment.css">


    <link rel="stylesheet" href="../../../Fractional-Star-Rating-jsRapStar/jsRapStar.css" />
    <link rel="stylesheet" href="../../../Fractional-Star-Rating-jsRapStar/index.css" />
    <script src="../../../Fractional-Star-Rating-jsRapStar/jsRapStar.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="../../../webdesign/JSfile/JSFunction.js"></script>
    <link rel="stylesheet" href="../HallOrderwizard/assets/css/bd-wizard.css">
    <script  src="js/userLogin.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <style>
        .checked {
            color: orange;
        }
        .bgImgCenter{
            background-image: url('https://st2.depositphotos.com/3336339/11976/i/950/depositphotos_119763698-stock-photo-abstract-futuristic-hall-background.jpg');
            width: 100%;
            height: auto;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        /*hall gallery*/
    </style>
</head>
<body>
<?php
include_once ("../../../webdesign/header/header.php");
?>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container">
        <a class="navbar-brand" href="HallClient.php?h=<?php echo $hallInformation[0][0]; ?>"><?php echo $hallInformation[0][1]; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Curent Package
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../../../contactUs/companyContact.php?c=<?php echo $hallInformation[0][8];?>">Contact us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="HallClient.php?h=<?php echo $hallInformation[0][0]; ?>">Hall Packages </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Company/ClientCompany.php?c=<?php echo $hallInformation[0][8]; ?>">Company Service</a>
                </li>
            </ul>
        </div>
    </div>
</nav>




<?php
$HeadingImage=$hallInformation[0][6];
$HeadingName=$hallInformation[0][1];
$Source='../../../images/hall/';
include_once ("../Company/Box.php");
include_once ('extraitemHall.php');
include_once ('includeItems.php');
?>


<div class="container">

    <div class="row">
        <div class="col-md-12 mb-5">
            <h2>What We have this current package </h2>
            <hr>



            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Package id#
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo $PackageDate[0][0];?>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Package Name
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo $PackageDetail[0][6];?>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Package Date
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo $PackageDate[0][1];?>
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Package Time
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo $PackageDetail[0][4];?>
                    </div>


                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Package Type
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php

                        if($PackageDetail[0][1]==0)
                        {
                            echo "Seating only";
                        }
                        else
                        {
                            echo "Food and Seating";
                        }
                        ?>
                    </div>


                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Package Price per head
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2 alert-danger">
                        <?php echo $PackageDetail[0][2];?>
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Total Partition
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo  $MaxGuestMaxPartition[1];?>
                    </div>


                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Remaining Partition
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                         <?php echo $MaxGuestMaxPartition[3];?>
                    </div>



                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Total Arrangement of Seating
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo $MaxGuestMaxPartition[0];?>
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Remaining Arrangement of Seating
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo $MaxGuestMaxPartition[2];?>
                        <input hidden value="<?php echo $MaxGuestMaxPartition[2];?>" type="number" id="Remaingseating">
                    </div>


                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-2">
                        <p>Package Descripe :  <?php echo $PackageDetail[0][3];

                        ?></p>
                    </div>
                </div>
            </div>






<?php
$isbook=false;
if($MaxGuestMaxPartition[3]<=0)
    $isbook=true;
if($MaxGuestMaxPartition[2]<=0)
    $isbook=true;

if($isbook)
{
    echo '  <a id="BookingNotAvailablebtn" class="btn btn-danger btn-lg float-right" href="#">Booking Not Available </a>';
}
else
{
    echo '  <a id="BookingAvailablebtn" class="btn btn-success btn-lg float-right" href="#">Booking Available >> </a>';
}
?>




        </div>







    </div>
    <!-- /.row -->


</div>

<form id="SubmitFormOfPackage" class="container">
    <?php
    $OneD = array_column($MenuType, 1);
    $Listofitemtypes = implode(',', $OneD);
    ?>
    <input hidden type="text" name="listofitemtype" value="<?php echo $Listofitemtypes;?>">
    <input hidden type="number" name="pid" value="<?php echo $PackageDateid;?>">
    <input hidden type="text" name="cateringid" value="No">
    <input hidden type="number" name="hallid" value="<?php echo $PackageDetail[0][5];?>">
    <input hidden type="date" name="date" value="<?php echo $PackageDate[0][1];?>">
    <input hidden type="text" name="time" value="<?php echo $PackageDetail[0][4];?>">
    <input hidden type="number" name="perheadwith" value="<?php echo $PackageDetail[0][1];?>">
    <input hidden type="number" name="Charges" value="<?php echo '0';?>">
    <?php
    include_once ("../HallOrderwizard/index.php");
    echo $displayModelExtraItems;
    ?>
</form>


<div id="OrderDetailHistory" class="container">





    <h2>Your Order of this hall</h2>
    <div class="row" style="height: 60vh;overflow: auto">
        <?php
        $DetailofThisOrder=array();
        $display='';
        $sql='';
        if(isset($_COOKIE["userid"])) {

            $sql = 'SELECT od.id,p.name,od.hall_id,od.status_hall,od.destination_date,od.booking_date FROM BookingProcess as bp INNER join orderDetail as od
on (bp.orderDetail_id=od.id)
INNER join person as p 
on (p.id=od.person_id)
WHERE
(od.hall_id=' . $hallInformation[0][0] . ')AND(od.user_id=' . $_COOKIE["userid"] . ') AND(bp.BuyerOrSeller="Buyer") order by (od.destination_date)';

            $DetailofThisOrder = queryReceive($sql);
            $display = '';
            for ($i = 0; $i < count($DetailofThisOrder); $i++) {
                $display .= '
              <div class="card col-md-4 m-auto" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Order id # ' . $DetailofThisOrder[$i][0] . '</h5>
                <h6 class="card-subtitle mb-2 text-muted">Order status :' . $DetailofThisOrder[$i][3] . '</h6>
                
                <p class="card-text">';
                if ($DetailofThisOrder[$i][3] == "Not Active") {
                    $display .= '<span class="text-danger">You must call to the owner of this hall for activation of order</span><br>';
                }
                $display .= '
Visited Date: ' . $DetailofThisOrder[$i][5] . '<br>
Booked Data: ' . $DetailofThisOrder[$i][4] . '<br>


</p>

                 <div class="row form-inline">
   <form  method="GET" action="' . $Root . 'connection/printOrderDetail.php" class="col-6">
            <input type="text" hidden name="userdetail" value="' . $_COOKIE["userid"] . '">
            <input type="number" hidden name="orderid" value="' . $DetailofThisOrder[$i][0] . '">
            <input type="text" hidden name="ViewOrDownload" value="View">
            <button type="submit"  class="card-link btn btn-outline-primary" ><i class="fa fa-print" aria-hidden="true"></i>View Bill</button>
        </form>

        <form  method="GET" action="' . $Root . 'connection/printOrderDetail.php" class="col-6">
            <input type="text" hidden name="userdetail" value="' . $_COOKIE["userid"] . '">
            <input type="number" hidden name="orderid" value="' . $DetailofThisOrder[$i][0] . '">
            <input type="text" hidden name="ViewOrDownload" value="Download">
            <button  type="submit" class="card-link btn btn-outline-secondary" ><i class="fas fa-cloud-download-alt"></i>Save Bill</button>
        </form>  
    </div>

            </div>
        </div>';
            }
        }
        echo $display;

        ?>


    </div>
</div>
<?php

if(count($DetailofThisOrder)==0)
{
    echo '<script>
        $("#OrderDetailHistory").hide();
    </script>';
}
?>





<div class="container">

    <h2>What include with this Current package  Menu</h2>
    <hr>


    <div class="row container">


<?php
echo $includeitemStyleOne;
?>







    </div>
    <!-- /.row -->





    <div class="row">
        <div class="col-md-8 mb-5">
            <h2>Tell me about Hall description</h2>
            <hr>
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2 ">
                        Hall Name
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo $hallInformation[0][1];?>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Hall Parking
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php
                        if($hallInformation[0][5]==0)
                        {
                            echo "No Own Parking";
                        }
                        else
                        {
                            echo "Yes Own Parking";
                        }
                            ?>
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Hall Maximum Guest
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo $hallInformation[0][2];?>
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Hall No of Patition
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo $hallInformation[0][5];?>
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        Hall Type
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php
                        $halltype=array("Marquee","Hall","Deera /Open area");
                        echo $halltype[$hallInformation[0][7]];?>
                    </div>

                </div>
            </div>
        </div>




        <div class="col-md-4 mb-5">
            <h2>Location </h2>
            <hr>
            <address>
                <span class="p-2">City   <?php echo $hallInformation[0][11];?> </span>
                <br>
                <span class="p-2">cuntry    <?php echo $hallInformation[0][10];?></span>
                <p class="p-2">Address:  <?php echo $hallInformation[0][12];?></p>
                <button class="btn btn-primary" id="See_Map">Click to see Map</button>
            </address>



            <div hidden>
                <label  for="">Lat: <input name="latitude" id="latitude" type="text" class="latitude" ></label>
                <label  for="">Long: <input  name="longitude" id="longitude" type="text" class="longitude" ></label>
                <label  for="">City <input name="city" id="reg-input-city" type="text" class="reg-input-city" placeholder="City"></label>
                <label  for="">country <input name="country" type="text" id="reg-input-country" placeholder="country" ></label>
            </div>


        </div>
        <div id="map-canvas"></div>
    </div>







    <h2>What Extra Charges (optional)</h2>
    <hr>
    <div class="row ">


<?php
//extra item
echo $ExtraitemStyleOne;
?>





    </div>





    <h2>Team information</h2>
    <hr>
    <div class="row">



        <?php
        //'.$hallInformation[0][0].'
        $sql='SELECT u.username, u.image,BJS.WorkingStatus, u.email, u.number FROM user as u inner join BranchesJobStatus as BJS on (u.id=BJS.user_id) WHERE (ISNULL(BJS.ExpireDate)AND(BJS.WorkingStatus="Manager") AND(ISNULL(u.expire))AND(BJS.hall_id='.$hallInformation[0][0].') )';
        $users=queryReceive($sql);
        $sql='SELECT  `username`,`image`,`jobTitle`, `email`, `number` FROM `user` WHERE ISNULL(expire)AND(company_id='.$hallInformation[0][8].')AND(jobTitle="Owner")';
        $Owners=queryReceive($sql);




        $count=count($Owners);
        if(count($users)>0)
            $Owners[$count]=$users[0];
        for($i=0;$i<count($Owners);$i++)
        {
            $SenderAddress[$i]=$Owners[$i][3];
            $SenderName[$i]=$Owners[$i][0];

            $imageUser='../../../images/systemImage/imageNotFound.png';
            if(file_exists('../../../images/users/'.$Owners[$i][1])&&($Owners[$i][1]!=""))
            {
                $imageUser= '../../../images/users/'.$Owners[$i][1];
            }

            echo '
    <div class="col-md-4 mb-5">

        <address>

            <img src="'.$imageUser.'" class="img-thumbnail" style="width: 40%">
            <span>'.$Owners[$i][0].'</span>
            <br>
            <strong>'.$Owners[$i][2].'</strong>
            <br>
            <span>'.$Owners[$i][3].'</span>
            <br>
            <span>P# '.$Owners[$i][4].'.</span>
        </address>


    </div>';
        }
        $SenderAddressUnique=array_unique($SenderAddress);
        $SenderNameUnique=array_unique($SenderName);
        $SenderAddressList= implode(',', $SenderAddressUnique);
        $SenderNameList=implode(',',$SenderNameUnique)



        ?>

    </div>









</div>







<div class="container">

    <?php
    $sql='SELECT  image FROM images WHERE ISNULL(expire)AND (hall_id='.$hallInformation[0][0].')';
    $Images=queryReceive($sql);
    $destinatios="../../../images/Gallery/Hall/";

    include_once "../All/PictureGallery.php";
    ?>
<script src="../../../webdesign/JSfile/Gallery.js"></script>

</div>


<div class="container" >
    <?php
    $video=$Images;
    $destinatios="../../../images/Gallery/Hall/";
    include_once "../All/VideoGallery.php"
    ?>
    <script src="../../../webdesign/JSfile/video.js"></script>
</div>








<div class="container">
    <h2>Contact us</h2>
</div>

<?php
$urlContactus="../../../contactUs/contactServer.php";
$ExtraInformation="contact form hall name: ".'<h2>'.$hallInformation[0][1].' , package name : '.$PackageDetail[0][6].' , package Date is '.$PackageDetail[0][1].' and package timing is '.$PackageDetail[0][4].'</h2>';
include_once ("../../../contactUs/contactUs.php");
?>





<?php
$formApend= '<input hidden type="number" name="hallid" value="'.$hallInformation[0][0].'">
<input hidden type="text" name="userid" value="'.$userid.'">
<input hidden type="number" name="packageid" value="'.$PackageDetail[0][0].'">
';
$sql='SELECT `hall_id`, `catering_id`, `id`, `comment`, `expire`, `active`, (SELECT u.username FROM user as u 
where u.id=comments.user_id), (SELECT u.image FROM user as u 
where u.id=comments.user_id), `PackOrDishId`, `expireUser`,`rating`,`image` FROM `comments` WHERE (hall_id='.$hallInformation[0][0].')AND(ISNULL(expire))AND(PackOrDishId='.$PackageDetail[0][0].') ';

$destinatiosUser="../../../images/users/";
$destinationComment="../../../images/comment/hallComment/";
$isPackShow=0;
$urldata="../../hallBranches/comment/commentHallServer.php";
$option="CommentOnHall";
include_once "../All/Comments.php"
?>




























<script src="../../../map/constantMap.js"></script>

<script>

    $(document).ready(function()
    {



        latitude=<?php echo $hallInformation[0][13];?>;
        longitude=<?php echo $hallInformation[0][14];?>;



        $("#See_Map").click(function ()
        {
            $("#map-canvas").css({"width": "100%", "height": "60vh"});
            $.ajax({
                url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initialize",
                dataType: "script",
                cache: false
            });
        });





        $(document).on("click",".dishtypes",function () {
            var display=$(this).data("display");
            var IdDisplay=$(this).data("dishtype");
            if(display=="hide")
            {
                $("#dishtype"+IdDisplay).show('slow');
                $(this).data("display","show");
            }
            else
            {

                $("#dishtype"+IdDisplay).hide('slow');
                $(this).data("display","hide");
            }

        });

     /*   setInterval(function(){
            $("#OrderDetailHistory").load(window.location.href + " #OrderDetailHistory" );
        }, 1000);*/

        /*$("#headerCardOrders").click(function(event){
            event.stopPropagation();
            /!*$('#headerCardOrders').addClass('btn-primary');*!/
            $("#showheaderCardOrders").slideToggle();
        });
        $("#showheaderCardOrders").slideToggle();*/

    });

</script>


<script src="../HallOrderwizard/assets/js/jquery.steps.min.js"></script>
<script src="../HallOrderwizard/assets/js/bd-wizard.js"></script>
<script  src="js/Packagesselections.js"></script>

<?php
include_once ("../../../webdesign/footer/footer.php");
?>

</body>
</html>
<?php
include_once ("../../../webdesign/footer/EndOfPage.php");
?>