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
                <img src="style1.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption ">
                    <h5 class="display-4">Hall Booking</h5>
                    <p>book your nearest Hall,Marquee and Dera and get 10% discount</p>
                </div>
            </div>
            <div class="carousel-item  ">
                <img src="dolar.jpeg" class="d-block w-100" alt="...">
                <div class="carousel-caption ">
                    <h5 class="display-4">Free Company Register</h5>
                    <p>Register hall and catering company and get free software</p>
                </div>
            </div>
            <div class="carousel-item ">
                <img src="https://indiebookbutler.com/wp-content/uploads/2015/08/Free.jpg" class="d-block w-100" alt="...">
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





<div class="container">




    <div class="jumbotron card card-image mr-5 ml-5 transparencyjumbo " style="margin-top: -15px;background-repeat: no-repeat; background-size: cover;">
        <form method="get" action="">


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


            <div class="m-auto">
                <button value="submit" type="submit" class="btn btn-danger"><i class="fas fa-check"></i>
                    Submit</button>
            </div>
        </form>



    </div>


















    <div class="row" >


        <?php

        //echo hallAll();

        //echo HallUserDesire("2013-03-15",0,"09:00:00");

        if(isset($_GET["Date"]))
        {
            echo HallUserDesire($_GET["Date"],$_GET["perhead"],$_GET["daytime"]);
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
<script>

    $(document).ready(function () {


        $('.carousel').carousel({
            interval: 5000
        });


    });


</script>
</body>
</html>

