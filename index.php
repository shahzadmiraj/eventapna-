<?php
include_once ("connection/connect.php");
include_once ("company/ClientSide/Hall/functions.php");


if((isset($_COOKIE['userid']))&&(!isset($_GET['action'])))
{
    $sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
    $userdetail=queryReceive($sql);
    $companyid=$userdetail[0][0];
    if($companyid!="")
    header("location:company/companyRegister/companyAdminPanel.php");
}
?>

<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Wedding Hall Deals! , Catering Deals!</title>
    <meta name="description" content="
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Book Wedding Hall,Catering Managment system,Hall Managment system, shadi hall software,marquee Software,Book marquee">
    <meta name="author" conte   nt="shahzad miraj">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta http-equiv="refresh" content="120">





    <script src="jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
    <script type="text/javascript" src="bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="webdesign/css/loader.css">

    <link rel="stylesheet" href="webdesign/css/complete.css">
    <link rel="stylesheet" href="map/style.css">
    <link rel="stylesheet" href="webdesign/css/card.css">
    <style>

        .checked {
            color: orange;
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
            <div class="carousel-item  active ">
                <img src="https://blog.bridals.pk/wp-content/uploads/2018/11/soanam-banne-1024x512.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption   ">
                    <h5 class="display-4  ">Hall Booking And Catering services</h5>
                    <p>book your nearest Hall,Marquee and Dera and get 10% discount</p>
                </div>
            </div>
            <div class="carousel-item  ">
                <img src="https://www.limewoodcaterers.com/images/slide-1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption ">
                    <h6 class="display-4" >Catering Services</h6>
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
                            <a href="user/RegisterCompanyWithUSer.php" class="text-dark">Marquee Management software</a>
                        </p>
                        <p>
                            <a href="user/RegisterCompanyWithUSer.php" class="text-dark">Hall Management software</a>
                        </p>
                        <p>
                            <a href="user/RegisterCompanyWithUSer.php" class="text-dark">Catering Management software</a>
                        </p>
                        <p>
                            <a href="user/RegisterCompanyWithUSer.php" class="text-dark">Dera / Open area Management software</a>
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


<nav class="nav nav-pills nav-justified alert-info shadow  mt-2">
    <a class="nav-item nav-link active " href="#">Hall </a>
    <a class="nav-item nav-link" href="company/ClientSide/Catering/CateringIndex.php">Catering</a>
</nav>

<div class="container table-light  mt-2 ">


    <form class="container alert-info" id="formHallSeaching" method="get" action="">






        <div class="text-white  text-center  row" >
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-clock"></i></span>
                </div>
                <select id="daytime" name="daytime" class="custom-select "  size="1">


                    <?

                    if(isset($_GET['daytime']))
                    {
                        if($_GET['daytime']=="Morning")
                        {
                            echo '
                <option value="Morning">Morning Time </option>
                <option value="Afternoon">Afternoon Time</option>
                <option value="Evening">Evening Time</option>';
                        }
                        else if($_GET['daytime']=="Afternoon")
                        {

                            echo '
                  <option value="Afternoon">Afternoon Time</option>
                <option value="Morning">Morning Time </option>    
                <option value="Evening">Evening Time</option>';
                        }
                        else
                        {

                            echo '
              <option value="Evening">Evening Time</option>
                <option value="Morning">Morning Time </option>
                <option value="Afternoon">Afternoon Time</option>
  ';
                        }
                    }
                    else
                    {
                        echo ' 
                <option value="Morning">Morning Time </option>
                <option value="Afternoon">Afternoon Time</option>
                <option value="Evening">Evening Time</option>';
                    }
                    ?>
                </select>
            </div>
        </div>




        <div class="text-white  text-center  row" >
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input  value="<?php

                if(isset($_GET['Date']))
                {
                    echo $_GET['DATE'];
                }
                ?>
" name="Date" type="date" class="form-control py-0" id="date" placeholder="Booking Date">
            </div>
        </div>


        <div class="text-white  text-center  row" >
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-utensils"></i></span>
                </div>
                <select id="perhead" name="perhead" class="custom-select "  size="1">


                    <?

                    if(isset($_GET['perhead']))
                    {
                        if($_GET['perhead']==0)
                        {
                            echo '
                            <option value="0">Per head Only Seating</option>
                            <option value="1">Per head Seating + Food</option>';
                        }
                        else
                        {

                            echo '
                            <option value="1">Per head Seating + Food</option>
                            <option value="0">Per head Only Seating</option>';
                        }
                    }
                    else
                    {
                        echo ' 
                            <option value="0">Per head Only Seating</option>
                            <option value="1">Per head Seating + Food</option>';
                    }
                    ?>


                </select>
            </div>
        </div>
        <div class="text-white  text-center  row" >
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-place-of-worship"></i></span>
                </div>
                <input
                        value="<?php

                        if(isset($_GET['hallname']))
                        {
                            echo $_GET['hallname'];
                        }
                        ?>
" name="hallname" type="text" class="form-control py-0" id="hallname" placeholder="Hall Name (optional)">
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input    id="map-search" class="controls form-control" type="text" placeholder="Search Destination" size="104">
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



<div class="container form-inline" id="showHall">


    <?php
    if(isset($_GET['daytime']))
    {
        echo HallSearching($_GET['latitude'],$_GET['longitude'],$_GET['country'],$_GET['hallname'],$_GET['daytime'],$_GET['Date'],$_GET['perhead']);
    }
    else
    {

        //echo ShowAllHallPackages(12.32,12.3,"Pakistan","","Morning","2020-06-15",0);
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

</div>
-->

<?php

if(isset($_GET['daytime']))
    echo '<script src="map/constantMap.js"></script>';
else
    echo '<script src="map/javascript.js"></script>';
?>

<script>

    $(document).ready(function ()
    {
        $('.carousel').carousel({
            interval: 5000
        });
    });

    $(document).ready(function()
    {
        var date = new Date();
        var currentDate = date.toISOString().slice(0,10);




        function ShowHall()
        {
            var hallname=$("#hallname").val();
            var daytime=$("#daytime").val();
            var date=$("#date").val();
            var perhead=$("#perhead").val();
            var latitude=$("#latitude").val();
            var longitude=$("#longitude").val();
            var city=$("#reg-input-city").val();
            var country=$("#reg-input-country").val();
            if(latitude=="")
            {
                window.setTimeout(ShowHall, 100);
            }
            var formdata=new FormData;
            formdata.append("daytime",daytime);
            formdata.append("hallname",hallname);
            formdata.append("date",date);
            formdata.append("perhead",perhead);
            formdata.append("latitude",latitude);
            formdata.append("longitude",longitude);
            formdata.append("city",city);
            formdata.append("country",country);
            formdata.append("option","ShowDishes");
            $.ajax({
                url:"company/ClientSide/Hall/IndexHallAndCateringServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show('slow');
                },
                success:function (data)
                {
                    $("#preloader").hide('slow');
                    $("#showHall").html(data);
                }
            });

        }



        <?php
        if(! (isset($_GET['daytime'])))

            echo '
              $("#date").val(currentDate);
            ShowHall();';
        ?>


    });
    $.ajax({
        url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initialize",
        dataType: "script",
        cache: false
    });

</script>


<?php
include_once ("webdesign/footer/footer.php");
?>
</body>
</html>

