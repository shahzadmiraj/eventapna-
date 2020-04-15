
<?php
include_once ('../../../connection/connect.php');

$userid=1;
$PackageDateid=base64url_decode($_GET['pack']);
$sql='SELECT pd.package_id,pd.selectedDate FROM packageDate as pd 
WHERE pd.id='.$PackageDateid.'';
$PackageDate=queryReceive($sql);

$sql='SELECT `id`, `isFood`, `price`, `describe`, `dayTime`, `hall_id`, `package_name`, `active`,`minimumAmountBooking` FROM `packages` WHERE id='.$PackageDate[0][0].'';
$PackageDetail=queryReceive($sql);

$sql='SELECT `id`, `dishname`, `image` FROM `menu` WHERE (package_id='.$PackageDetail[0][0].')AND(ISNULL(expire))';
$Menu=queryReceive($sql);



$sql='SELECT hall.id,`name`, `max_guests`, `function_per_Day`, `noOfPartitions`, `ownParking`, `image`, `hallType`,`company_id`, hall.active,l.country,l.city,l.address,l.latitude,l.longitude FROM `hall` INNER join location as l 
on (hall.location_id=l.id)
WHERE
(ISNULL(l.expire))AND (hall.id='.$PackageDetail[0][5].')';
$hallInformation=queryReceive($sql);


$sql='SELECT `id`, `name` FROM `Extra_item_type` WHERE  ISNULL(expire)AND(hall_id='.$hallInformation[0][0].')';
$ExtraType=queryReceive($sql);





?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script src="../../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../../webdesign/css/CardStyle.css">
    <link rel="stylesheet" href="../../../webdesign/css/Gallery.css">
    <link rel="stylesheet" href="../../../webdesign/css/comment.css">


    <link rel="stylesheet" href="../../../Fractional-Star-Rating-jsRapStar/jsRapStar.css" />
    <link rel="stylesheet" href="../../../Fractional-Star-Rating-jsRapStar/index.css" />
    <script src="../../../Fractional-Star-Rating-jsRapStar/jsRapStar.js"></script>

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

include_once ("../Company/Box.php");
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
                        Package Price
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 p-2">
                        <?php echo $PackageDetail[0][2];?>
                    </div>



                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 p-2">
                        <p>Package Descripe  <?php echo $PackageDetail[0][3];?></p>
                    </div>
                </div>
            </div>











            <a class="btn btn-primary btn-lg" href="#">Booking&raquo;</a>
        </div>






    </div>
    <!-- /.row -->








    <h2>What include with this Current package  Menu</h2>
    <hr>



    <div class="row">

        <?php
        $display='';
        $image="";
        for ($i=0;$i<count($Menu);$i++)
        {
            $image=$Menu[$i][2];
            if((file_exists('../../images/dishImages/'.$image))&&($image!=""))
                $image='../../images/dishImages/'.$image;
            else
                $image='https://static1.bigstockphoto.com/3/1/1/large1500/113342513.jpg';

            $display.='
            
            <div class="col-md-4 mb-5">
            <div class="card h-100">
                <img src="'.$image.'" class="card-img-top" src="" alt="Image">
                <div class="card-body">
                    <h4 class="card-title">'.$Menu[$i][1].'</h4>
                </div>
            </div>
        </div>
            
            ';
        }

        echo $display;
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

                <br>
            </address>


            <div id="map-canvas" style="width:100%;height: 60vh"  ></div>
            <div hidden>
                <label  for="">Lat: <input name="latitude" id="latitude" type="text" class="latitude" ></label>
                <label  for="">Long: <input  name="longitude" id="longitude" type="text" class="longitude" ></label>
                <label  for="">City <input name="city" id="reg-input-city" type="text" class="reg-input-city" placeholder="City"></label>
                <label  for="">country <input name="country" type="text" id="reg-input-country" placeholder="country" ></label>
            </div>


        </div>
    </div>







    <h2>What Extra Charges (optional)</h2>
    <hr>
    <div class="row">






        <?php
        $display='';
        for ($j=0;$j<count($ExtraType);$j++)
        {


            $display = '<h4  data-dishtype="'.$j.'" data-display="hide" class="col-md-12 text-center dishtypes badge-info">'.$ExtraType[$j][1].' </h4>
    <div id="dishtype'.$j.'"  class="row   " style="display: none">


';

            $sql='SELECT `id`,`image`, `price`,`name` FROM `Extra_Item` WHERE (ISNULL(expire))AND(Extra_item_type_id='.$ExtraType[$j][0].')';

            $Extraitem=queryReceive($sql);
            $image = "";
            for ($i = 0; $i < count($Extraitem); $i++) {
                $image = $Extraitem[$i][1];
                if ((file_exists('../../images/hallExtra/' . $image)) && ($image != ""))
                    $image = '../../images/hallExtra/' . $image;
                else
                    $image = 'https://static1.bigstockphoto.com/3/1/1/large1500/113342513.jpg';

                $display .= '
            
            <div class="col-md-4 mb-5 ">
            <div class="card h-100">
                <img src="' . $image . '" class="card-img-top" src="" alt="Image">
                <div class="card-body">
                    <h6 class="card-title">' . $Extraitem[$i][3] . '<span class="float-right text-danger">Amount ' . $Extraitem[$i][2] . '</span></h6>
                </div>
            </div>
            </div>
            
            ';
            }
            $display.=' </div>';
        }
        echo $display;
        ?>




    </div>




    <h2>Contact Us</h2>
    <hr>
    <div class="row">
    <div class="col-md-4 mb-5">

        <address>

            <img src="http://placehold.it/300x200" class="img-thumbnail" style="width: 40%">
            <span>Name</span>
            <br>
            <span>job title</span>
            <br>
            <strong>Email</strong>
            <br>
            <strong>P#.</strong>
        </address>
    </div>

    </div>









</div>







<div class="container">

    <?php
    $sql='SELECT  image FROM images WHERE ISNULL(expire)AND (hall_id='.$hallInformation[0][0].')';
    $Images=queryReceive($sql);
    $destinatios="../../../images/hall/";

    include_once "../All/PictureGallery.php";
    ?>
<script src="../../../webdesign/JSfile/Gallery.js"></script>

</div>


<div class="container" >
    <?php
    $video=$Images;
    $destinatios="../../../images/hall/";
    include_once "../All/VideoGallery.php"
    ?>
    <script src="../../../webdesign/JSfile/video.js"></script>
</div>






<?php
$formApend= '<input hidden type="number" name="hallid" value="'.$hallInformation[0][0].'">
<input hidden type="number" name="userid" value="'.$userid.'">
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
/*        $.ajax({
            url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initialize",
            dataType: "script",
            cache: false
        });*/





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
    });

</script>



<?php
include_once ("../../../webdesign/footer/footer.php");
?>
</body>
</html>
