<?php
include_once ('../../../connection/connect.php');

$userid=$_COOKIE['userid'];
$cateringid=$_GET['c'];
$sql='SELECT c.name,c.image,c.company_id,cl.country,cl.city,cl.address,cl.longitude,cl.latitude,cl.radius FROM catering as c INNER join cateringLocation as cl 
on (c.id=cl.catering_id)
WHERE
(ISNULL(c.expire))AND (ISNULL(cl.expire))AND(c.id='.$cateringid.')';
$catering=queryReceive($sql);

if(count($catering)==0)
{
    exit();
}
$sql='SELECT dt.id, dt.name FROM dish_type as dt WHERE ISNULL(expire) AND (dt.catering_id='.$cateringid.')';
$dishTypeDetail=queryReceive($sql);
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


    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.8/clipboard.min.js"></script>
    <link rel="stylesheet" href="../../../mapRadius/css/gmaps-lat-lng-radius.css" type="text/css">
    <style>
        .checked {
            color: orange;
        }



    </style>
</head>
<body>



<?php
include_once ("../../../webdesign/header/header.php");
?>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container">
        <a class="navbar-brand" href="#"><?php echo $catering[0][0]; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link active" href="#">Curent Catering
                        <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../Company/ClientCompany.php?c=<?php echo $catering[0][2]; ?>">Company Service</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php
$HeadingImage=$catering[0][1];
$HeadingName=$catering[0][0];
$Source='../../../images/catering/';
include_once ("../Company/Box.php");
?>

<div class="container">

    <div class="row">
        <div class="col-md-8 col-12 mb-5">
            <h2>Service Range </h2>
            <hr>



            <div class="container">
                <input hidden value="<?php echo $catering[0][8];?>"  id="radius" name="radius" class="form-control" type="number" placeholder="Target Radius Set Map ">
                <input hidden  value="<?php echo $catering[0][7];?>" id="latitude" name="latitude" class="form-control" type="number" placeholder="Latitude Set Map">
                <input hidden value="<?php echo $catering[0][6];?>"   id="longitude" name="longitude" class="form-control" type="number" placeholder="Longitude Set Map">


                <input hidden id="pac-input" class="controls" type="text" placeholder="Enter a location">
                <div hidden id="shape-input" class="controls">
                    <div class="shape-option selected" data-geo-type="circle">Circle</div>
                    <div class="shape-option" data-geo-type="polygon">Polygon</div></div>
                <div hidden id="output-container" class="controls">
                    <button class="copybtn" data-clipboard-target="#pos-output"><img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="12" alt="Copy to clipboard"></button>
                    <div id="pos-output">Start by searching for the city...</div>
                </div>
                <div id="map" style="height: 100vh"></div>
            </div>
        </div>


        <div class="col-md-4 mb-5 ">
            <h2>Service inormation </h2>
            <hr>
            <address>

                <span class="p-3">Country  <?php echo $catering[0][3]; ?></span><br>
                <span class="p-3">City <?php echo $catering[0][4]; ?> </span>
                <br>
                <p class="p-3">Address:<?php echo $catering[0][5]; ?></p><br>
                <span class="p-3">Target Area within below range </span><br>
                <strong class="p-3"><?php echo $catering[0][8]; ?>KM</strong>
                <br>
            </address>









        </div>


    </div>
    <!-- /.row -->















    <h2>How many Dishes Available</h2>
    <hr>
        <?php

    $display='';
    for($i=0;$i<count($dishTypeDetail);$i++) {
        $display .= '<div class="row">';
        $display .= '<h4  data-dishtype="' . $i . '" data-display="hide"  class="col-md-12 text-center dishtypes">' . $dishTypeDetail[$i][1] . '</h4>';
        $sql = 'SELECT `name`, `id`, `image`, `dish_type_id` FROM `dish` WHERE (dish_type_id=' . $dishTypeDetail[$i][0] . ') AND (ISNULL(expire)) AND(catering_id=' . $cateringid . ')';
        $dishDetail = queryReceive($sql);

        for ($j=0;$j<count($dishDetail);$j++)
        {


            $image='';
            if(file_exists('../../../images/dishImages/'.$dishDetail[$j][2])&&($dishDetail[$j][2]!=""))
            {
                $image= '../../../images/dishImages/'.$dishDetail[$j][2];
            }
            else
            {
                $image='https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';
            }

            $display.='
          
        <div class="col-md-4 mb-5" >
            <div class="card h-80">
                <img class="card-img-top" src="'.$image.'" alt="">
                <div class="card-body">
                    <h6 class="card-title">' . $dishDetail[$j][0] . ' </h6>
                         <button type="button"  data-image="'.$dishDetail[$j][2].'" data-dishname="'. $dishDetail[$j][0] .'"  data-dishid="'. $dishDetail[$j][1] .'"   data-toggle="modal" data-target="#myModal"   class="adddish col-12 mb-0 btn btn-primary"><i class="fas fa-check "></i>  Show Price</button>
                </div>
            </div>
        </div>
            ';


        }





        $display.='</div>';

        }

        echo $display;

    ?>

    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">





            <!-- Modal content-->
            <div class="modal-content"  id="AddDishDetail"  >

            </div>

        </div>



    </div>










    <h2>Contact Us</h2>
    <hr>

    <div class="row">



        <?php
        $SenderAddress=array();
        $SenderName=array();
        //'.$hallInformation[0][0].'
        $sql='SELECT u.username, u.image,BJS.WorkingStatus, u.email, u.number FROM user as u inner join BranchesJobStatus as BJS on (u.id=BJS.user_id) WHERE (ISNULL(BJS.ExpireDate)AND(BJS.WorkingStatus="Manager") AND(ISNULL(u.expire))AND(BJS.catering_id='.$cateringid.') )';
        $users=queryReceive($sql);
        $sql='SELECT  `username`,`image`,`jobTitle`, `email`, `number` FROM `user` WHERE ISNULL(expire)AND(company_id='.$catering[0][2].')AND(jobTitle="Owner")';
        $Owners=queryReceive($sql);


        $count=count($Owners);
        if(count($users)>0)
            $Owners[$count]=$users[0];
        for($i=0;$i<count($Owners);$i++)
        {
            $SenderAddress[$i]=$Owners[$i][3];
                $SenderName[$i]=$Owners[$i][0];

            $imageUser='https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';
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



        ?>

    </div>


    </div>




    </div>






<!--
container-->
</div>








<div class="container">

    <?php
    $sql='SELECT  image FROM images WHERE ISNULL(expire)AND (catering_id='.$cateringid.')';
    $Images=queryReceive($sql);
    $destinatios="../../../images/Gallery/Catering/";

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












<?php
$urlContactus="../../../contactUs/contactServer.php";
$ExtraInformation="contact form".'<h2>'.$catering[0][0].'</h2>';
include_once ("../../../contactUs/contactUs.php");
?>








<?php
$formApend= '
<input hidden type="number" name="cateringid" value="'.$cateringid.'">
<input hidden type="number" name="userid" value="'.$userid.'">
';
$sql='SELECT `hall_id`, `catering_id`, `id`, `comment`, `expire`, `active`, (SELECT u.username FROM user as u 
where u.id=comments.user_id), (SELECT u.image FROM user as u 
where u.id=comments.user_id), `PackOrDishId`, `expireUser`,`rating`,`image` FROM `comments` WHERE (catering_id='.$cateringid.')AND(ISNULL(expire)) ';

$destinatiosUser="../../../images/users/";
$destinationComment="../../../images/comment/cateringComment/";
$isPackShow=0;
$urldata="../../cateringBranches/cateringComment/commentCateringServer.php";
$option="commentCatering";
include_once "../All/Comments.php"
?>





<script src="../../../mapRadius/js/constantMap.js"></script>

<script>


    $(document).ready(function ()
    {


        $(".adddish").click(function ()
        {
            var image=$(this).data("image");
            var dishName=$(this).data("dishname");
            var dishid=$(this).data("dishid");
            var formdata = new FormData;
            formdata.append("dishid", dishid);
            formdata.append("image",image);
            formdata.append("dishName",dishName);
            formdata.append("option", "showPriceofAllDishes");

            $.ajax({
                url: "../../cateringBranches/dish/dishServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                  $("#preloader").show();
                },
                success:function (data)
                {
                  $("#preloader").hide();
                    $("#AddDishDetail").html(data);
                }

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
    });

    $(document).ready(function()
    {
        /*
        $.ajax({
            url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initMap",
            dataType: "script",
            cache: false
        });*/
    });
</script>



<?php
include_once ("../../../webdesign/footer/footer.php");
?>
</body>
</html>
