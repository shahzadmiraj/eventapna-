<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-15
 * Time: 11:41
 */
include_once ("../../../connection/connect.php");
include_once ("CCServer/clientCateringServer.php");

?>

<!DOCTYPE html>
<head>
    <title>Catering Deals!</title>
    <meta name="description" content="

Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Book Wedding Hall,Catering Managment system,Hall Managment system, shadi hall software,marquee Software,Book marquee">
    <meta name="author" content="shahzad miraj">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="refresh" content="120">


    <script src="../../../jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script type="text/javascript" src="../../../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="../../../webdesign/css/loader.css">

    <link rel="stylesheet" href="../../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../../map/style.css">
    <link rel="stylesheet" href="../../../webdesign/css/card.css">

    <script src="../../../map/javascript.js"></script>


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

<div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2" class="active"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item  active ">
                <img src="https://blog.bridals.pk/wp-content/uploads/2018/11/soanam-banne-1024x512.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption   ">
                    <h5 class="display-4  ">Hall Booking</h5>
                    <p>book your nearest Hall,Marquee and Dera and get 10% discount</p>
                </div>
            </div>
            <div class="carousel-item  ">
                <img src="https://i.ytimg.com/vi/nOPKg6I4Zfs/maxresdefault.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption ">
                    <h6 class="display-4" >Free Company Register first  40 owner</h6>
                    <p>Register hall and catering company and get free software</p>
                </div>
            </div>
            <div class="carousel-item ">
                <img src="https://www.brides.com/thmb/8N9PzFuItfby0vjkyjka-hfQhsE=/3615x2033/filters:fill(auto,1)/__opt__aboutcom__coeus__resources__content_migration__brides__proteus__5be5dd5661c7180ad90ce2d7__169-5f4244ae78c040a88344f8a6f6e5436a.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption ">
                    <div class="col-12 p-0 m-0">

                        <!-- Links -->
                        <h4 class="text-uppercase font-weight-bold">Software Features</h4>
                        <hr class="deep-purple accent-2 mb-4 mt-0 d-inline-block mx-auto" style="width: 60px;">
                        <p>
                            <a href="../../../user/RegisterCompanyWithUSer.php" class="text-dark">Marquee Management software</a>
                        </p>
                        <p>
                            <a href="../../../user/RegisterCompanyWithUSer.php" class="text-dark">Hall Management software</a>
                        </p>
                        <p>
                            <a href="../../../user/RegisterCompanyWithUSer.php" class="text-dark">Catering Management software</a>
                        </p>
                        <p>
                            <a href="../../../user/RegisterCompanyWithUSer.php" class="text-dark">Dera / Open area Management software</a>
                        </p>
                    </div>
                </div>
            </div>

        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<nav class="nav nav-pills nav-justified alert-info shadow mt-2">
    <a class="nav-item nav-link  " href="../../../index.php">Hall </a>
    <a class="nav-item nav-link active" href="#">Catering</a>
</nav>


<div class="container alert-info  mt-2 ">

<form method="get" action="">



    <div class="text-white  text-center  row" >
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-concierge-bell"></i></span>
            </div>
            <input

                    value="<?php
                    if(isset($_GET['Dishname']))
                    {
                        echo $_GET['Dishname'];
                    }

                    ?>"

                    name="Dishname" type="text" class="form-control py-0" id="Dishname" placeholder="Dish Name ">
        </div>
    </div>
    <div class="text-white  text-center  row" >
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-place-of-worship"></i></span>
            </div>
            <input


                    value="<?php
                    if(isset($_GET['cateringname']))
                    {
                        echo $_GET['cateringname'];
                    }

                    ?>"

                    name="cateringname" type="text" class="form-control py-0" id="cateringname" placeholder="Catering Branch Name ">
        </div>
    </div>




    <div class="form-group row">
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input   id="map-search" class="controls form-control" type="text" placeholder="Search Destination" size="104">
            </div>
        </div>

    <div id="map-canvas" style="width:100%;height: 60vh"  ></div>
    <div  hidden >
        <label  for="">Lat: <input
                    value="<?php

                    if(isset($_GET['latitude']))
                    {
                        echo $_GET['latitude'];
                    }
                    ?>
"

                    name="latitude"    id="latitude" type="number" step="any" class="latitude"></label>
        <label  for="">Long: <input

                    value="<?php

                    if(isset($_GET['longitude']))
                    {
                        echo $_GET['longitude'];
                    }
                    ?>
"

                    name="longitude"                         id="longitude" type="number"  step="any" class="longitude"></label>
        <label  for="">City <input


                    value="<?php

                    if(isset($_GET['city']))
                    {
                        echo $_GET['city'];
                    }
                    ?>
"

                    name="city" id="reg-input-city" type="text" class="reg-input-city" placeholder="City"></label>
        <label  for="">country



            <input

                    value="<?php

                    if(isset($_GET['country']))
                    {
                        echo $_GET['country'];
                    }
                    ?>"  name="country" type="text" id="reg-input-country" placeholder="country"></label>
    </div>

    <button id="submit" class="btn btn-success col-12 form-control" type="submit">Find</button>

</form>
</div>



<div class="container form-inline" id="SHowCatering">


    <?php

    if(isset($_GET['longitude']))
    {
        echo ShowAllCateringDishes(trim($_GET['latitude']),trim($_GET['longitude']),trim($_GET['country']),trim($_GET['Dishname']),trim($_GET['cateringname']));
    }
    ?>

</div>




<!--

<div class="block ">

    <div class="top">
        <ul>
            <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
            <li><span class="converse">Converse</span></li>
            <li><a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                </a></li>
        </ul>
    </div>

    <div class="middle">
        <img src="https://www.converse.com/on/demandware.static/-/Sites-ConverseMaster/default/dw48f5fc3c/images/hi-res/M9621C_standard.png?sw=580&sh=580&sm=fit" alt="pic" />
    </div>

    <div class="bottom">
        <div class="heading">Chuck Taylor All Star Classic Colours</div>
        <div class="info">Classic red converse edition</div>
        <div class="style">Color: Red / Style: M9621C</div>
        <div class="price">$50.00 <span class="old-price">$75.00</span></div>
    </div>

</div>-->


<?php

if(isset($_GET['daytime']))
    echo '<script src="../../../map/constantMap.js"></script>';
else
    echo '<script src="../../../map/javascript.js"></script>';
?>


<script>




    $(document).ready(function ()
    {

        $('.carousel').carousel({
            interval: 5000
        });
        /*$.ajax({
            url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initialize",
            dataType: "script",
            cache: false
        });*/

        function showDishes()
        {
            var Dishname=$("#Dishname").val();
            var cateringname=$("#cateringname").val();
            var latitude=$("#latitude").val();
            var longitude=$("#longitude").val();
            var city=$("#reg-input-city").val();
            var country=$("#reg-input-country").val();
          /*  if(latitude=="")
            {
                window.setTimeout(showDishes, 100);
            }*/
            var formdata=new FormData;
            formdata.append("Dishname",Dishname);
            formdata.append("cateringname",cateringname);
            formdata.append("latitude",latitude);
            formdata.append("longitude",longitude);
            formdata.append("city",city);
            formdata.append("country",country);
            formdata.append("option","ShowDishes");
            $.ajax({
                url:"CatServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                   $("#preloader").show();
                },
                success:function (data)
                {
                     $("#preloader").hide();
                    $("#SHowCatering").html(data);
                }
            });

        }
    //    showDishes();


        <?php
        if(! (isset($_GET['latitude'])))

            echo '
            showDishes();';
        ?>

    });


</script>

<?php
include_once ("../../../webdesign/footer/footer.php");
?>

</body>
</html>

