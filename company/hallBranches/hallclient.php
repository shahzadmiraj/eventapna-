
<?php
include_once ('../../connection/connect.php');


$hallid=base64url_decode($_GET['hallDetail']);
if(!is_numeric($hallid))
{
    header("location:../../index.php");
}
$packageid=base64url_decode($_GET['package']);

if(!is_numeric($packageid))
{
    header("location:../../index.php");
}
$date=$_GET['date'];
$time=$_GET['time'];

$sql='SELECT `name`, `max_guests`, `noOfPartitions`, `ownParking`,`image`, `hallType`, `location_id` FROM `hall` WHERE id='.$hallid.'';
$hallinformations=queryReceive($sql);
$sql='SELECT u.username,p.name,n.number,p.image from company as c INNER JOIN hall as h 
on (h.company_id=c.id)
LEFT JOIN user as u 
on (c.user_id=u.id)
left join person as p 
on (u.person_id=p.id)
left JOIN number as n 
on (p.id=n.person_id)
WHERE h.id='.$hallid.'';
$owndetail=queryReceive($sql);


$sql='SELECT `isFood`, `price`, `describe`,`package_name` FROM `hallprice` WHERE id='.$packageid.'';
$packagedtail=queryReceive($sql);

$sql='SELECT `id`, `longitude`, `expire`, `country`, `city`, `latitude`, `active`, `address` FROM `location` WHERE id='.$hallinformations[0][6].'';
$locationDetail=queryReceive($sql);

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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <style>
        html body{
            width: 100%;
            height: 100%;
            margin-top:20px;
        }
        .comment-wrapper .panel-body {
            max-height:650px;
            overflow:auto;
        }

        .comment-wrapper .media-list .media img {
            width:64px;
            height:64px;
            border:2px solid #e5e7e8;
        }

        .comment-wrapper .media-list .media {
            border-bottom:1px dashed #efefef;
            margin-bottom:25px;
        }

    </style>
</head>
<body>
<?php
include_once ("../../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(
<?php


if(file_exists('../images/hall/'.$hallinformations[0][4]))
{
    echo "'../images/hall/".$hallinformations[0][4]."'";
}
else
{
    echo 'https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg';

}

?>);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-body text-center" style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 "><i class="fas fa-place-of-worship"></i> <?php echo $hallinformations[0][0];?></h1>
        <p class="lead">Free Order Booking</p>
    </div>
</div>




<div class="container">
    <h1 class="font-weight-light  text-lg-left mt-4 mb-0">Package Detail</h1>
    <hr class="mt-2 mb-3">

            <div class="card p-3 border-0">

                <h1 class="m-3 text-danger text-right">
                        <i class="far fa-money-bill-alt mr-3"></i>RS:<i> <?php echo $packagedtail[0][1];?> </i>
                </h1>
                <h3 class="m-3 ">
                    <i class="far fa-calendar-alt"></i>Date:<span class="text-info"><?php echo $date;?></span>
                </h3>
                <h3 class="m-3 ">
                    <i class="fas fa-clock"></i>Time:<span class="text-info"><?php echo $time;?></span>
                </h3>

                <?php

                if($packagedtail[0][0]==0)
                {
                    //if food is not
                    echo '<h3 class="m-3 ">
                    <i class="material-icons">
                        airline_seat_recline_normal
                    </i>with Seating
                </h3>';
                }
                else
                {
                    //if food
                    echo ' <h5 class="m-3 ">
                    <i class="material-icons">
                        fastfood
                    </i>package name: <span class="text-info">'.$packagedtail[0][3].'</span>
                </h5>
                
                
                <p class="d-block m-3 ">
                    <i class="far fa-clipboard"></i>

                    <span class="font-weight-bold text-info">Menu Note:</span>
                    '.$packagedtail[0][2].'
                </p>
               
                ';
                }


                    ?>




        </div>

    <?php

        $sql='SELECT `id`, `dishname`, `image` FROM `menu` WHERE ISNULL(expire) && (hallprice_id='.$packageid.')';
        $menudetail=queryReceive($sql);

        if($packagedtail[0][0]==1)
        {
            //if food then show dishes

            $display = ' 
                <div class="container">

                <h2 class="font-weight-light text-center text-lg-left mt-4 mb-0">Menu</h2>

                <hr class="mt-2 mb-5">
                
                
                <div class="row text-center text-lg-left">
                ';
            for ($i = 0; $i < count($menudetail); $i++) {
                $display .= '
                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="#' . $menudetail[$i][0] . '" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="' . $menudetail[$i][2] . '" alt="" style="width: 100%;height: 20vh">

                            <h3>' . $menudetail[$i][1] . '</h3>

                        </a>
                    </div>';
            }

            $display .= '
        
                </div>

            </div>';
            echo $display;
        }


    ?>

            <!--<div class="container">

                <h2 class="font-weight-light text-center text-lg-left mt-4 mb-0">Menu</h2>

                <hr class="mt-2 mb-5">

                <div class="row text-center text-lg-left">

                    <div class="col-lg-3 col-md-4 col-6">
                        <a href="#" class="d-block mb-4 h-100">
                            <img class="img-fluid img-thumbnail" src="https://source.unsplash.com/pWkk7iiCoDM/400x300" alt="">

                            <h3>sdsddsfds</h3>

                        </a>
                    </div>


                </div>

            </div>-->



</div>



<div class="container bg-white">

    <h1 class="font-weight-light  text-lg-left mt-4 mb-0">Package Detail</h1>
    <hr class="mt-2 mb-3">


    <?php

    //$sql='SELECT id,name FROM dish_type WHERE catering_id='.$cateringid.'';
    $sql='SELECT `id`, `name` FROM `Extra_item_type` WHERE (hall_id='.$hallid.')&&(ISNULL(expire))';

    $Category=queryReceive($sql);
    $Display='';
    $display='<div class="form-group row ">';
    for($j=0;$j<count($Category);$j++)
    {

        $display.='<h4 class="col-12 newcolor" align="center">'.$Category[$j][1].'</h4>';



        //  $sql = 'SELECT d.name, d.id, (SELECT dt.name from dish_type as dt WHERE dt.id=d.dish_type_id),(SELECT dt.isExpire from dish_type as dt WHERE dt.id=d.dish_type_id), d.isExpire,d.image FROM dish as d WHERE dish_type_id=' . $Category[$j][0] . ' ';

        $sql='SELECT ex.id,ex.name,ex.price,ex.image,ex.active FROM Extra_Item as ex WHERE (ISNULL(ex.expire)) AND (ex.Extra_item_type_id='.$Category[$j][0].')';
        $kinds = queryReceive($sql);



        $display.='<div class="container-fluid"><div class="card-deck">';
        for ($i = 0; $i < count($kinds); $i++)
        {


            $display.='
        <div class="card mb-4 col-12 col-md-6 col-lg-4 col-xl-3">';

            if( file_exists('../../../images/hallExtra/'.$kinds[$i][3]) AND($kinds[$i][3]!=""))
            {
                $display.='
            <img class="card-img-top img-fluid" src="../../../images/hallExtra/'.$kinds[$i][3].'" alt="Card image cap"  >';
            }
            else
            {

                $display.='
            <img class="card-img-top img-fluid" src="https://scx1.b-cdn.net/csz/news/800/2019/virtuallyrea.jpg" alt="Card image cap">';
            }

            $display.='   <div class="card-body ">
                <h4 class="card-title">'.$kinds[$i][1].'</h4>
              <h6 class=" "><i class="far fa-money-bill-alt mr-3"></i><i>'.$kinds[$i][2].'    <button data-option="deleteItem" data-id='.$kinds[$i][0].' class="actionDelete btn btn-danger float-right">Delete</button>
</h6>
            </div>
        </div>
        <div class="w-100 d-none d-sm-block d-md-none"></div>';
        }
        $display.='</div></div>';

    }

    $display.='</div>';
    echo $display;


    ?>



</div>





<div class="container" >
    <h1 class="font-weight-light text-lg-left mt-4 mb-0">Hall Information</h1>
    <hr class="mt-2 mb-5">

    <div class="row card-body mb-2">

        <div class="container p-0">

            <div class="row">
            <img src="<?php
            if(file_exists($owndetail[0][3]))
            {
                echo $owndetail[0][3];
            }
            else
            {
                echo "https://cdn.pixabay.com/photo/2016/04/25/07/49/man-1351346_960_720.png";
            }

            ?> " class="img-thumbnail" style="width: 200px">
            <h4 class="m-3"><span class="text-white">Name: <?php echo $owndetail[0][1];?></span></h4>
            </div>

            <?php
            $display='';
            for($i=0;$i<count($owndetail);$i++)
            {
                $display.='<h5 class="m-3">
                <i class="fas fa-phone-volume"></i>
          Phone No:<span class="text-white"> '.$owndetail[$i][2].'</span></h5>';
            }
            echo $display;



            ?>



            <h5 class="m-3">
                <i class="fas fa-users"></i>
                  Maximum Guest: <span class="text-white"><?php echo $hallinformations[0][1];?></span></h5>

            <h5 class="m-3">
                <i class="fas fa-columns"></i>
                Number of partitions: <span class="text-white"><?php echo $hallinformations[0][2];?></span></h5>
            <h5 class="m-3">
                <i class="fas fa-parking"></i>Parking : <span class="text-white"><?php


                if($hallinformations[0][2]==1)
                {
                    echo " Yes";
                }
                else
                {
                    echo " NO";
                }


                ?>
           </span> </h5>

            <h5 class="m-3">
                <i class="fas fa-archway"></i>
                Hall Type: <span class="text-white"><?php
                $halltype=array("Marquee","Hall","Deera /Open area");

                echo $halltype[$hallinformations[0][5]];

                ?> </span></h5>




            <h5 class="m-3">
                <i class="fas fa-columns"></i>
                Distance from your location is : <span class="text-white"><?php echo $_GET['distance']." KM";?></span>
            </h5>

            <h5 class="m-3">
                <i class="fas fa-columns"></i>
                Address : <span class="text-white"><?php echo $locationDetail[0][7]; ?></span>
            </h5>

            <div id="map-canvas" style="width:100%;height: 60vh"  ></div>
        </div>
    </div>

</div>




<div class="form-group row" hidden>

    <label for="" class="col-form-label">Address: </label>
    <div class="input-group mb-3 input-group-lg">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
        </div>
        <input  name="address" id="map-search" class="controls form-control" type="text" placeholder="Search Box" size="104">
    </div>
</div>


<div hidden>
    <label  for="">Lat: <input name="latitude" id="latitude" type="text" class="latitude"></label>
    <label  for="">Long: <input  name="longitude" id="longitude" type="text" class="longitude"></label>
    <label  for="">City <input name="city" id="reg-input-city" type="text" class="reg-input-city" placeholder="City"></label>
    <label  for="">country <input name="country" type="text" id="reg-input-country" placeholder="country"></label>
</div>
<script src="../../map/javascript.js"></script>






<script>
    urlData="gallery/galleryServer.php";
</script>
<div class="d-block">
    <?php
    $destination="../../images/hall/";
    include_once ("gallery/galleryPage.php");
    ?>
</div>


<script>

    var urldata="../companyServer.php";

</script>

<div  class="d-block">

    <?php
    include_once ("../hallBranches/comment/comentServering.php");
    ?>
</div>











<script>


    $(document).ready(function ()
    {

        latitude=<?php echo $locationDetail[0][5];?>;
        longitude=<?php echo $locationDetail[0][1]; ?>;

        //callback constantmap function
        // $.ajax({
        //     url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=constantmap",
        //     dataType: "script",
        //     cache: false
        // });






    });

</script>




<?php
include_once ("../../webdesign/footer/footer.php");
?>
</body>
</html>
