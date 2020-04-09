
<?php
include_once ('../../connection/connect.php');


//$hallid=base64url_decode($_GET['hallDetail']);
//if(!is_numeric($hallid))
//{
//    header("location:../../index.php");
//}
//$packageid=base64url_decode($_GET['package']);
//
//if(!is_numeric($packageid))
//{
//    header("location:../../index.php");
//}
//$date=$_GET['date'];
//$time=$_GET['time'];

//$sql='SELECT `name`, `max_guests`, `noOfPartitions`, `ownParking`,`image`, `hallType` FROM `hall` WHERE id='.$hallid.'';
//$hallinformations=queryReceive($sql);
//$sql='SELECT u.username,p.name,n.number,p.image from company as c INNER JOIN hall as h
//on (h.company_id=c.id)
//LEFT JOIN user as u
//on (c.user_id=u.id)
//left join person as p
//on (u.person_id=p.id)
//left JOIN number as n
//on (p.id=n.person_id)
//WHERE h.id='.$hallid.'';
//$owndetail=queryReceive($sql);

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
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <style>
        * {
            font-family: "Roboto";
            list-style: none;
            margin: 0;
            padding: 0;
            text-decoration: none;
            letter-spacing: 1px;
            box-sizing: border-box;
        }
        body {
            background: #f9fafa;
            /*  padding: 20px;
              display: -webkit-box;
              display: -ms-flexbox;
              display: flex;*/
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
        }
        .block {
            margin: 20px;
            border-radius: 4px;
            width: 280px;
            min-height: 430px;
            background: #fff;
            padding: 23px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            box-shadow: 0 2px 55px rgba(0,0,0,0.1);
        }
        .top {
            border-bottom: 1px solid #e5e5e5;
            padding-bottom: 10px;
        }
        .top ul {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
        }
        .top a {
            color: #9e9e9e;
        }
        .top a:hover {
            color: #c7ccdb;
        }
        .converse {
            padding: 2px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            font-size: 14px;
        }
        .middle {
            margin-bottom: 40px;
        }
        .middle img {
            width: 100%;
        }
        .bottom {
            text-align: center;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
        }
        .heading {
            font-size: 17px;
            text-transform: uppercase;
            margin-bottom: 5px;
            letter-spacing: 0;
        }
        .info {
            font-size: 14px;
            color: #969696;
            margin-bottom: 10px;
        }
        .style {
            font-size: 16px;
            margin-bottom: 20px;
        }
        .old-price {
            color: #f00;
            text-decoration: line-through;
        }

        .checked {
            color: orange;
        }

    </style>
</head>
<body>
<?php
//include_once ("../../webdesign/header/header.php");
?>




<!-- Header -->
<header class="bg-primary py-5 mb-5">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-12">
                <h1 class="display-4 text-white mt-5 mb-2">Hall Name</h1>
                <p class="lead mb-5 text-white-50">.</p>
            </div>
        </div>
    </div>
</header>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Hall Name</a>
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
                    <a class="nav-link" href="#">Halls</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Caterings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


<div class="container">

    <div class="row">
        <div class="col-md-8 col-12 mb-5">
            <h2>What We have this current package </h2>
            <hr>



            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Name
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Name
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Date
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Date
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Time
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Time
                    </div>


                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Type
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Type
                    </div>


                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Price
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Prce
                    </div>


                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Package Descripe
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        Package Descripebjkew bjkwebjkbejw kbrewkjerbje
                    </div>
                </div>
            </div>







            <a class="btn btn-primary btn-lg" href="#">Call to Action &raquo;</a>
        </div>
        <div class="col-md-4 mb-5">
            <h2>Contact Us</h2>
            <hr>
            <address>
                <strong>Start Bootstrap</strong>
                <br>3481 Melrose Place
                <br>Beverly Hills, CA 90210
                <br>
            </address>
            <address>
                <abbr title="Phone">P:</abbr>
                (123) 456-7890
                <br>
                <abbr title="Email">E:</abbr>
                <a href="mailto:#">name@example.com</a>
            </address>
        </div>
    </div>
    <!-- /.row -->


    <h2>What include with this Current package  Menu</h2>
    <hr>
    <div class="row">
        <div class="col-md-4 mb-5">
            <div class="card h-100">
                <img class="card-img-top" src="http://placehold.it/300x200" alt="">
                <div class="card-body">
                    <h4 class="card-title">Card title</h4>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->

    <div class="row">
        <div class="col-md-8 mb-5">
            <h2>Tell me about Hall description</h2>
            <hr>
            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Hall Name
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Hall Name
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Hall Parking
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Hall Parking
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Hall Maximum Guest
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Hall Maximum Guest
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Hall No of Patition
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Hall No of Patition
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Hall Type
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3">
                        Hall Type
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <h2>Contact Us</h2>
            <hr>
            <address>
                <strong>Start Bootstrap</strong>
                <br>3481 Melrose Place
                <br>Beverly Hills, CA 90210
                <br>
            </address>
            <address>
                <abbr title="Phone">P:</abbr>
                (123) 456-7890
                <br>
                <abbr title="Email">E:</abbr>
                <a href="mailto:#">name@example.com</a>
            </address>
        </div>
    </div>


</div>












<script>


    $(document).ready(function ()
    {







    });

</script>




<?php
//include_once ("../../webdesign/footer/footer.php");
?>
</body>
</html>
