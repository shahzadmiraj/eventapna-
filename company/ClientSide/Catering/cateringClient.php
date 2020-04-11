<?php
include_once ('../../../connection/connect.php');

$userid=1;
$cateringid=3;
$sql='SELECT c.name,c.image,c.company_id,cl.country,cl.city,cl.address,cl.longitude,cl.latitude,cl.radius,cl.radius FROM catering as c INNER join cateringLocation as cl 
on (c.id=cl.catering_id)
WHERE
(ISNULL(c.expire))AND (ISNULL(cl.expire))AND(c.id='.$cateringid.')';
$catering=queryReceive($sql);


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

    </style>
</head>
<body>
<?php
//include_once ("../../webdesign/header/header.php");
?>


<?php
$HeadingImage=$catering[0][1];
$HeadingName=$catering[0][0];

include_once ("../Company/Box.php");
?>

<div class="container">

    <div class="row">
        <div class="col-md-8 col-12 mb-5">
            <h2>Service Range </h2>
            <hr>



            <div class="container">
                <div class="row justify-content-start">

                    <!--map service-->

                </div>
            </div>











            <a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>
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















    <h2>What Extra Charges (optional)</h2>
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



        <address class="col-md-4">
            <img src="http://placehold.it/300x200" class="img-thumbnail" style="width: 40%">
            <span>Name</span>
            <br>
            <span>Job Title</span>
            <br>
            <strong>Email</strong>
            <br>
            <strong>P#.</strong>
        </address>

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
    $destinatios="../../../images/catering/";

    include_once "../All/PictureGallery.php";
    ?>
    <script src="../../../webdesign/JSfile/Gallery.js"></script>

</div>



<div class="container" >
    <?php
    $video=$Images;
    $destinatios="../../../images/catering/";
    include_once "../All/VideoGallery.php"
    ?>
    <script src="../../../webdesign/JSfile/video.js"></script>
</div>





















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

</script>



<?php
//include_once ("../../webdesign/footer/footer.php");
?>
</body>
</html>
