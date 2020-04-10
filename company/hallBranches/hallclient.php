
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
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../webdesign/css/CardStyle.css">
    <link rel="stylesheet" href="../../webdesign/css/Gallery.css">
    <style>
        .checked {
            color: orange;
        }


    </style>
</head>
<body>
<?php
//include_once ("../../webdesign/header/header.php");
?>

<?php
include_once ("../ClientSide/Company/header.php");
?>


<div class="container">

    <div class="row">
        <div class="col-md-8 col-12 mb-5">
            <h2>What We have this current package </h2>
            <hr>



            <div class="container">
                <div class="row justify-content-start">
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Name
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Name
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Date
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Date
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Time
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Time
                    </div>


                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Type
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Type
                    </div>


                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Price
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Prce
                    </div>


                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Package Descripe
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 btn">
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
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Hall Name
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Hall Name
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Hall Parking
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Hall Parking
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Hall Maximum Guest
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Hall Maximum Guest
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Hall No of Patition
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Hall No of Patition
                    </div>

                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Hall Type
                    </div>
                    <div class="col-6 col-sm-6 col-md-6 col-lg-3 col-xl-3 btn">
                        Hall Type
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4 mb-5">
            <h2>Location </h2>
            <hr>
            <address>
                <span>City lahore </span>
                <br>cuntry  Pakistan
                <h5>Address:jkfnjkerfjkerjkfernrk</h5>
                <strong>Distance 20KM </strong>
                <br>
            </address>
        </div>
    </div>











    <!--
                Video Gallery-->
    <h2>Video Gallery</h2>
    <hr>
    <!-- Grid row -->
    <div class="row">

        <!-- Grid column -->
        <div class="col-lg-4 col-md-12 mb-4">

            <!--Modal: Name-->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">

                    <!--Content-->
                    <div class="modal-content">

                        <!--Body-->
                        <div class="modal-body mb-0 p-0">

                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/A3PDXmYoF5U"
                                        allowfullscreen></iframe>
                            </div>

                        </div>

                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <span class="mr-4">Spread the word!</span>
                            <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                            <!--Twitter-->
                            <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                            <!--Google +-->
                            <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
                            <!--Linkedin-->
                            <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

                            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                        </div>

                    </div>
                    <!--/.Content-->

                </div>
            </div>
            <!--Modal: Name-->

            <a><img class="img-fluid z-depth-1" src="https://mdbootstrap.com/img/screens/yt/screen-video-1.jpg" alt="video"
                    data-toggle="modal" data-target="#modal1"></a>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-lg-4 col-md-6 mb-4">

            <!--Modal: Name-->
            <div class="modal fade" id="modal6" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">

                    <!--Content-->
                    <div class="modal-content">

                        <!--Body-->
                        <div class="modal-body mb-0 p-0">

                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/wTcNtgA6gHs"
                                        allowfullscreen></iframe>
                            </div>

                        </div>

                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <span class="mr-4">Spread the word!</span>
                            <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                            <!--Twitter-->
                            <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                            <!--Google +-->
                            <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
                            <!--Linkedin-->
                            <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

                            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                        </div>

                    </div>
                    <!--/.Content-->

                </div>
            </div>
            <!--Modal: Name-->

            <a><img class="img-fluid z-depth-1" src="https://mdbootstrap.com/img/screens/yt/screen-video-2.jpg" alt="video"
                    data-toggle="modal" data-target="#modal6"></a>

        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-lg-4 col-md-6 mb-4">

            <!--Modal: Name-->
            <div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">

                    <!--Content-->
                    <div class="modal-content">

                        <!--Body-->
                        <div class="modal-body mb-0 p-0">

                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/vlDzYIIOYmM"
                                        allowfullscreen></iframe>
                            </div>

                        </div>

                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <span class="mr-4">Spread the word!</span>
                            <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                            <!--Twitter-->
                            <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                            <!--Google +-->
                            <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
                            <!--Linkedin-->
                            <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

                            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4" data-dismiss="modal">Close</button>

                        </div>

                    </div>
                    <!--/.Content-->

                </div>
            </div>
            <!--Modal: Name-->

            <a><img class="img-fluid z-depth-1" src="https://mdbootstrap.com/img/screens/yt/screen-video-3.jpg" alt="video"
                    data-toggle="modal" data-target="#modal4"></a>

        </div>
        <!-- Grid column -->

    </div>
    <!-- Grid row -->


    <!--
     End Video Gallery-->

</div>































<div class="container">




    <div class="col-12 mb-5">
        <?php

        $hallid=1;
        $userid=1;
        ?>
        <h2>Comments </h2>
        <hr>
        <div class="row bootstrap snippets">

            <div class="col-md-12 col-md-offset-2 col-sm-12 m-auto">
                <div class="comment-wrapper">
                    <div class="panel panel-info ">
                        <form id="commentform">
                            <?php
                            echo '<input hidden type="number" name="hallid" value="'.$hallid.'">';
                            echo '<input hidden type="number" name="userid" value="'.$userid.'">';
                            ?>
                            <div class="panel-body">
                                <textarea name="comment" class="form-control" placeholder="write a comment..." rows="3"></textarea>
                                <br>
                                <div id="divMain ">
                                    <div id="demo1" name="stars" value="3" ></div>
                                </div>
                                <input name="image" type="file" class="btn-outline-secondary   btn col-5 ">
                                <button id="btncoment" type="button" class="btn btn-info pull-right float-right col-5">Post</button>
                        </form>
                        <?php
                        $display='';

                        // $sql='SELECT `hall_id`, `catering_id`, `id`, `comment`, `email`, `datetime`, `expire` FROM `comments` WHERE (hall_id='.$hallid.')&&(ISNULL(expire))';
                        $sql='SELECT `hall_id`, `catering_id`, `id`, `comment`, `expire`, `active`, (SELECT u.username FROM user as u 
where u.id=comments.user_id), (SELECT u.image FROM user as u 
where u.id=comments.user_id), `PackOrDishId`, `expireUser`,`rating`,`image` FROM `comments` WHERE (hall_id='.$hallid.')AND(ISNULL(expire))';
                        $commentresult=queryReceive($sql);
                        for ($i=0;$i<count($commentresult);$i++)
                        {
                            $display.='                   
                    <div class="clearfix" ></div>
                        <hr>
                        <ul class="media-list" >
                                                        
                            <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="';
                            //userimage
                            if((file_exists('../../images/users/'.$commentresult[$i][7])) &&($commentresult[$i][7]!=""))
                            {
                                $display.='../../images/users/'.$commentresult[$i][7];
                            }
                            else
                            {
                                $display.='https://bootdey.com/img/Content/user_1.jpg"';
                            }
                            $display.='alt="" class="img-circle"></a>
                                <div class="media-body">
                                <span class="text-muted pull-right">
                                    <small class="text-dark">'.$commentresult[$i][5].'</small>
                                </span>
                                    <strong class="text-primary">@'.$commentresult[$i][6].' </strong>
                             ';
                            //star out of 5
                            for($s=0;$s<5;$s++)
                            {
                                if($commentresult[$i][10]>$s)
                                {

                                    $display.='<span class="fa fa-star checked"></span>';
                                }
                                else
                                {
                                    $display.='<span class="fa fa-star"></span>';
                                }
                            }


                            //paragraph of image uploaded comment packageid
                            $display.='
                                   <p>';


                            //user uploaded image or video
                            if((file_exists('../../images/comment/hallComment/'.$commentresult[$i][11])) &&($commentresult[$i][11]!=""))
                            {
                                $display.='<img  style="width: 100%;height: 40vh" class="m-2"  src="../../images/comment/hallComment/'.$commentresult[$i][11].'"><br>';
                            }
                            //package id
                            if($commentresult[$i][8]!="")
                            {
                                $display.='
                                                          <span class="alert-light ml-3">Packageid#'.$commentresult[$i][8]. '<br></span>';
                            }
                            //comment and delete button
                            $display.=$commentresult[$i][3].'<button hidden type="button" class="btn btn-danger float-right deletecomment" data-deletecomment="'.$commentresult[$i][2].'"><i class="fas fa-trash-alt"></i>Delete</button>
                                    
                                    
                                    </p>
                                     
                                </div>
                                
                            </li>

                        </ul>
';
                        }
                        echo $display;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>







<script>


</script>

<?php
//include_once ("../../webdesign/footer/footer.php");
?>
</body>
</html>
