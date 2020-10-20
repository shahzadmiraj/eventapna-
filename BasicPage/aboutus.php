<?php
include_once ("../connection/connect.php");

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <?php
        include('../webdesign/header/InsertHeaderTag.php');
        ?>

        <title>About us</title>

        <meta name="description" content="TRAINING SERVICES VISION MISSION About us of eventapna
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
        <meta name="keywords" content="TRAINING SERVICES VISION MISSION about us page Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

        <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

        <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
        <script src="../jquery-3.3.1.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="../webdesign/css/loader.css">
        <link rel="stylesheet" href="../webdesign/css/complete.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
        <script type="text/javascript" src="../webdesign/JSfile/JSFunction.js"></script>

        <style>

            h2 {
                font-size: 24px;
                text-transform: uppercase;
                color: #303030;
                font-weight: 600;
                margin-bottom: 30px;
            }
            h4 {
                font-size: 19px;
                line-height: 1.375em;
                color: #303030;
                font-weight: 400;
                margin-bottom: 30px;
            }
            .jumbotron {
                background-color: #f4511e;
                color: #fff;
                padding: 100px 25px;
                font-family: Montserrat, sans-serif;
            }
            .container-fluid {
                padding: 60px 50px;
            }
            .bg-grey {
                background-color: #f6f6f6;
            }
            .logo-small {
                color: #f4511e;
                font-size: 50px;
            }
            .logo {
                color: #f4511e;
                font-size: 200px;
            }
            .thumbnail {
                padding: 0 0 15px 0;
                border: none;
                border-radius: 0;
            }
            .thumbnail img {
                width: 100%;
                height: 100%;
                margin-bottom: 10px;
            }
            .carousel-control.right, .carousel-control.left {
                background-image: none;
                color: #f4511e;
            }
            .carousel-indicators li {
                border-color: #f4511e;
            }
            .carousel-indicators li.active {
                background-color: #f4511e;
            }
            .item h4 {
                font-size: 19px;
                line-height: 1.375em;
                font-weight: 400;
                font-style: italic;
                margin: 70px 0;
            }
            .item span {
                font-style: normal;
            }
            .panel {
                border: 1px solid #f4511e;
                border-radius:0 !important;
                transition: box-shadow 0.5s;
            }
            .panel:hover {
                box-shadow: 5px 0px 40px rgba(0,0,0, .2);
            }
            .panel-footer .btn:hover {
                border: 1px solid #f4511e;
                background-color: #fff !important;
                color: #f4511e;
            }
            .panel-heading {
                color: #fff !important;
                background-color: #f4511e !important;
                padding: 25px;
                border-bottom: 1px solid transparent;
                border-top-left-radius: 0px;
                border-top-right-radius: 0px;
                border-bottom-left-radius: 0px;
                border-bottom-right-radius: 0px;
            }
            .panel-footer {
                background-color: white !important;
            }
            .panel-footer h3 {
                font-size: 32px;
            }
            .panel-footer h4 {
                color: #aaa;
                font-size: 14px;
            }
            .panel-footer .btn {
                margin: 15px 0;
                background-color: #f4511e;
                color: #fff;
            }
            .navbar {
                margin-bottom: 0;
                background-color: #f4511e;
                z-index: 9999;
                border: 0;
                font-size: 12px !important;
                line-height: 1.42857143 !important;
                letter-spacing: 4px;
                border-radius: 0;
                font-family: Montserrat, sans-serif;
            }
            .navbar li a, .navbar .navbar-brand {
                color: #fff !important;
            }
            .navbar-nav li a:hover, .navbar-nav li.active a {
                color: #f4511e !important;
                background-color: #fff !important;
            }
            .navbar-default .navbar-toggle {
                border-color: transparent;
                color: #fff !important;
            }
            footer .glyphicon {
                font-size: 20px;
                margin-bottom: 20px;
                color: #f4511e;
            }
            .slideanim {visibility:hidden;}
            .slide {
                animation-name: slide;
                -webkit-animation-name: slide;
                animation-duration: 1s;
                -webkit-animation-duration: 1s;
                visibility: visible;
            }
            @keyframes slide {
                0% {
                    opacity: 0;
                    transform: translateY(70%);
                }
                100% {
                    opacity: 1;
                    transform: translateY(0%);
                }
            }
            @-webkit-keyframes slide {
                0% {
                    opacity: 0;
                    -webkit-transform: translateY(70%);
                }
                100% {
                    opacity: 1;
                    -webkit-transform: translateY(0%);
                }
            }
            @media screen and (max-width: 768px) {
                .col-sm-4 {
                    text-align: center;
                    margin: 25px 0;
                }
                .btn-lg {
                    width: 100%;
                    margin-bottom: 35px;
                }
            }
            @media screen and (max-width: 480px) {
                .logo {
                    font-size: 150px;
                }
            }
            .jumbotron {
                background-image: url("https://png.pngtree.com/thumb_back/fw800/back_our/20190622/ourmid/pngtree-purple-geometric-flat-51-promotion-e-commerce-banner-background-image_213282.jpg");
                background-size: cover;
            }
        </style>
    </head>
    <body>
    <?php
    include_once ("../webdesign/header/header.php");
    ?>
    <div class="jumbotron text-center " id="about">
        <h1 >EVENT APNA</h1>
        <h3 >Your Booking Partner</h3>
        <div class="input-group-btn">
            <form method="POST" action="../Download/APK/DownloadAPK.php">
                <button type="submit" class="btn btn-danger">Download App for android mobile</button>
            </form>
        </div>
    </div>
    <div  class="container" id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60" >


        <!-- Container (About Section) -->
        <div  class="container-fluid">
            <div class="row">
                <div class="col-sm-8">
                    <h2>EVENT APNA</h2><br>
                    <h4>We provide a platform that can give services such as nearby hall booking, catering and food booking. We serve multiple event companies at one place. We give free software of food & catering and hall management for manage their companies.</h4><br>
                    <p>
                        We developed a system that can be used for booking nearest Hall and Food & Catering services.
                        It can be done by providing all
                        information that the user needs like Hall Venues, Catering Services , Availabilities, Prices , Correctness and Arrangements types, and
                        all other Services.<br>
                        <br><h3 class="text-center">Features </h3><br>

                    Company  Admin Panel<br>
                    Add hall Branch<br>
                    Add Member of Company (users)<br>
                    Manage Hall Packages<br>
                    Manage Extra Hall item<br>
                    Add Catering & Food Branch<br>
                    Manage Food & Catering Dishes<br>
                    Manage Orders<br>
                    Website of Company<br>
                    Email Services<br>
                    Post pictures/videos of company<br>
                    Comments Post<br>
                    Online Order Booking<br>
                    Print Order Bill in PDF file<br>
                    Payment Management of Order<br>
                    Event Apna Support Services (HELP 24/7 ) <br>
                    </p>
                    <br>
                </div>
                <div class="col-sm-4 text-center text-danger display-4">
                    <i class="fas fa-signal fa-4x"></i>
                </div>
            </div>
        </div>

        <div class="container-fluid bg-grey">
            <div class="row">
                <div class="col-sm-4  text-primary display-4"">
                <i class="fas fa-globe-americas fa-5x"></i>
            </div>
            <div class="col-sm-8">
                <h2>Our Values</h2><br>
                <h4><strong>MISSION:</strong> To be Earth’s most customer-centric company, where customers can find desire Hall, Marque, Dera, Food & Catering provider  and discover event planner they might want to buy online, and endeavors to offer its customers the lowest possible prices.</h4><br>
                <p><strong>VISION:</strong> To enable people and businesses throughout the world to realize their full potential.</p>
            </div>
        </div>
    </div>


    <div id="services" class="container-fluid text-center bg-grey">
        <h2>Services</h2><br>
        <h4>What we offer</h4>
        <div class="row text-center slideanim">
            <div class="col-sm-4">
                <div class="thumbnail" >
                    <img src="https://cedcommerce.com/blog/wp-content/uploads/2019/06/All-about-Online-Booking-Systems-850x283.jpg" alt="Paris" style="height: 25vh">
                    <p><strong>Online Booking</strong></p>
                    <p>Yes, we offer online order booking of Hall, Marquee, Dera, Food & Catering  </p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail">
                    <img src="https://i.pcmag.com/imagery/articles/0270lteaknt7h4pBahOR4az-40.fit_scale.size_1050x591.v1580751227.jpg" alt="New York" style="height: 25vh">
                    <p><strong>Free Software provide</strong></p>
                    <p>We built a powerful software for manage their order of Hall, Marquee, Dera, Food & Catering </p>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="thumbnail">
                    <img src="https://i.pinimg.com/originals/9c/d8/3b/9cd83bd835049cd8c79663b7d31bcc6c.jpg" alt="San Francisco"  style="height: 25vh">
                    <p><strong>Software Training</strong></p>
                    <p>Yes, we provide free training video to manage their Hall, Marquee, Dera, Food & Catering companies   </p>
                </div>
            </div>
        </div>
        <br>

        <h2>What our customers say</h2>
        <div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <h4>"This company is the best. I am so happy with the result!"<br><span>Hassan raza, Vice President, Comment Box</span></h4>
                </div>
                <div class="item">
                    <h4>"One word... WOW!!"<br><span>Rohit, Salesman, Rep Inc</span></h4>
                </div>
                <div class="item">
                    <h4>"Could I... BE any more happy with this company?"<br><span>Miraj din,CEO of NKFC.</span></h4>
                </div>
            </div>

            <!-- Left and right controls -->
            <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <!-- Container (Portfolio Section) -->
    <div id="Tutorial">

        <?php
        include_once ('../youtube/videoYoutube.php');
        ?>
    </div>

    <!-- Container (Pricing Section) -->
    <!--<div id="pricing" class="container-fluid">
        <div class="text-center">
            <h2>Pricing</h2>
            <h4>Choose a payment plan that works for you</h4>
        </div>
        <div class="row slideanim">
            <div class="col-sm-4 col-xs-12">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h1>Basic</h1>
                    </div>
                    <div class="panel-body">
                        <p><strong>20</strong> Lorem</p>
                        <p><strong>15</strong> Ipsum</p>
                        <p><strong>5</strong> Dolor</p>
                        <p><strong>2</strong> Sit</p>
                        <p><strong>Endless</strong> Amet</p>
                    </div>
                    <div class="panel-footer">
                        <h3>$19</h3>
                        <h4>per month</h4>
                        <button class="btn btn-lg">Sign Up</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h1>Pro</h1>
                    </div>
                    <div class="panel-body">
                        <p><strong>50</strong> Lorem</p>
                        <p><strong>25</strong> Ipsum</p>
                        <p><strong>10</strong> Dolor</p>
                        <p><strong>5</strong> Sit</p>
                        <p><strong>Endless</strong> Amet</p>
                    </div>
                    <div class="panel-footer">
                        <h3>$29</h3>
                        <h4>per month</h4>
                        <button class="btn btn-lg">Sign Up</button>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-xs-12">
                <div class="panel panel-default text-center">
                    <div class="panel-heading">
                        <h1>Premium</h1>
                    </div>
                    <div class="panel-body">
                        <p><strong>100</strong> Lorem</p>
                        <p><strong>50</strong> Ipsum</p>
                        <p><strong>25</strong> Dolor</p>
                        <p><strong>10</strong> Sit</p>
                        <p><strong>Endless</strong> Amet</p>
                    </div>
                    <div class="panel-footer">
                        <h3>$49</h3>
                        <h4>per month</h4>
                        <button class="btn btn-lg">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </div>-->



    <!-- Image of location/map -->
    <h1 class="text-center">Location</h1>
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3398.808989353502!2d74.4740596151522!3d31.58428548134846!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391911c1f18448e3%3A0x1b0d2e32ae9b4365!2sEVENT%20APNA!5e0!3m2!1sen!2s!4v1602414007360!5m2!1sen!2s" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

    <script>
        $(document).ready(function(){
            // Add smooth scrolling to all links in navbar + footer link
            $(".navbar a, footer a[href='#myPage']").on('click', function(event)
            {
                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 900, function(){

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });

            $(window).scroll(function() {
                $(".slideanim").each(function(){
                    var pos = $(this).offset().top;

                    var winTop = $(window).scrollTop();
                    if (pos < winTop + 600) {
                        $(this).addClass("slide");
                    }
                });
            });
        })
    </script>

    </div>

    <?php
    include_once ("../webdesign/footer/footer.php");
    ?>
    </body>
    </html>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>