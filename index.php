<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-15
 * Time: 11:41
 */
include_once ("connection/connect.php");
if((isset($_COOKIE['companyid']))&&(!isset($_GET['action'])))
{
    header("location:company/companyRegister/companydisplay.php");
}

include_once ("connection/indexEdit.php");

?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <script src="jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <script type="text/javascript" src="bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="webdesign/css/complete.css">
    <link rel="stylesheet" href="webdesign/css/loader.css">
    <link rel="stylesheet" href="map/style.css">


    <style>

        .carousel-item img
        {
            margin: 0;
            height: 60vh;
        }
        .carousel-caption
        {
            background-color: rgba(253, 248, 239, 0.6);
            font-weight: bold;
            color: rgba(0, 0, 0, 1);
        }
        .checked {
            color: orange;
        }
        .pictures {
            position: relative;
            text-align: center;
            color: white;
        }
        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
        }


    </style>
</head>
<body>
<?php
include_once ("webdesign/header/header.php");
?>

<div class="bd-example">
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="1" class="active"></li>
            <li data-target="#carouselExampleCaptions" data-slide-to="2" class="active"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item  active">
                <img src="https://blog.bridals.pk/wp-content/uploads/2018/11/soanam-banne-1024x512.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption ">
                    <h5 class="display-4">Hall Booking</h5>
                    <p>book your nearest Hall,Marquee and Dera and get 10% discount</p>
                </div>
            </div>
            <div class="carousel-item  ">
                <img src="https://i.ytimg.com/vi/nOPKg6I4Zfs/maxresdefault.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption ">
                    <h6 >Free Company Register first  40 owner</h6>
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
                            <a href="company/companyRegister/companyRegister.php" class="text-dark">Marquee Management software</a>
                        </p>
                        <p>
                            <a href="company/companyRegister/companyRegister.php" class="text-dark">Hall Management software</a>
                        </p>
                        <p>
                            <a href="company/companyRegister/companyRegister.php" class="text-dark">Catering Management software</a>
                        </p>
                        <p>
                            <a href="company/companyRegister/companyRegister.php" class="text-dark">Dera / Open area Management software</a>
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

<div class="container table-light  m-auto ">
<form method="get" action="" >


    <div class="text-white  text-center  row" >
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-clock"></i></div>
            </div>
            <select name="daytime" class="custom-select "  size="1">
                <option value="09:00:00">Morning Time </option>
                <option value="12:00:00">Afternoon Time</option>
                <option value="18:00:00">Evening Time</option>
            </select>
        </div>
    </div>




    <div class="text-white  text-center  row" >
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
            </div>
            <input required name="Date" type="date" class="form-control py-0" id="inlineFormInputGroupUsername2" placeholder="Booking Date">
        </div>
    </div>


    <div class="text-white  text-center  row" >
        <div class="input-group mb-2 mr-sm-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-utensils"></i></div>
            </div>
            <select name="perhead" class="custom-select "  size="1">
                <option value="0">Per head Only Seating</option>
                <option value="1">Per head Seating + Food</option>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
            </div>
            <input  value="<?php

            if(isset($_GET['address']))
            {
                echo $_GET['address'];
            }



            ?>" name="address" id="map-search" class="controls form-control" type="text" placeholder="Search Destination" size="104">
        </div>
    </div>


    <div id="map-canvas" style="width:100%;height: 60vh"  ></div>
    <div hidden>
        <label  for="">Lat: <input name="latitude" id="latitude" type="text" class="latitude"></label>
        <label  for="">Long: <input  name="longitude" id="longitude" type="text" class="longitude"></label>
        <label  for="">City <input name="city" id="reg-input-city" type="text" class="reg-input-city" placeholder="City"></label>
        <label  for="">country <input name="country" type="text" id="reg-input-country" placeholder="country"></label>

    </div>



    <div class="mt-5 mb-5">
        <button value="submit" type="submit" class="btn btn-danger col-12"><i class="fas fa-check"></i>
            Find Hall</button>
    </div>

</form>
</div>



<div class="container mt-5">


























    <div class="row" >


        <?php

        //echo hallAll();

        //echo HallUserDesire("2013-03-15",0,"09:00:00");

        if(isset($_GET["Date"]))
        {
            echo HallUserDesire($_GET["Date"],$_GET["perhead"],$_GET["daytime"],$_GET['latitude'],$_GET['longitude']);
        }
        else
        {
            echo hallAll();

        }

        ?>



    </div>



</div>


<?php
include_once ("webdesign/footer/footer.php");
?>



<script src="map/javascript.js"></script>



<script>

    $(document).ready(function()
    {
        <?php
        if(!isset($_GET['latitude']))
        {
            echo '
        getLocation();';
        }
        else
        {
            ?>
        latitude=<?php echo $_GET['latitude'];?>;
            longitude=<?php echo $_GET['longitude']; ?>;
        <?php
        }

        ?>
            /*$.ajax({
                url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initialize",
                dataType: "script",
                cache: false
            });*/

    });

    $(document).ready(function ()
    {
        $('.carousel').carousel({
            interval: 5000
        });

    });


</script>
</body>
</html>

