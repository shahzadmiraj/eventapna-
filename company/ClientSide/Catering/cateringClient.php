<?php
include_once ('../../../connection/connect.php');



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


        /*hall gallery*/
    </style>
</head>
<body>
<?php
//include_once ("../../webdesign/header/header.php");
?>


<?php
include_once ("../Company/header.php");
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
                <strong class="p-3">Branch Location</strong><br>
                <span class="p-3">City  </span>
                <br>
                <span class="p-3">cuntry  Pakistan</span><br>
                <span class="p-3">Address:jkfnjkerfjkerjkfernrk</span><br>
                <span class="p-3">Target Area Range </span><br>
                <strong class="p-3">2 Km</strong>
                <br>
            </address>









        </div>


    </div>
    <!-- /.row -->















    <h2>What Extra Charges (optional)</h2>
    <hr>
    <div class="row">


        <h4 class="col-md-12 text-center">Type </h4>


        <div class="col-md-4 mb-5">
            <div class="card h-80">
                <img class="card-img-top" src="http://placehold.it/300x200" alt="">
                <div class="card-body">
                    <h6 class="card-title">Card title <span class="float-right">Rs</span></h6>
                </div>
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


<div class="container">

    <?php
    include_once "../Hall/PictureGallery.php";
    ?>
    <script src="../../../webdesign/JSfile/Gallery.js"></script>
</div>

<div class="container">
    <?php
    include_once "../Hall/VideoGallery.php"
    ?>
    <script src="../../../webdesign/JSfile/video.js"></script>
</div>































<div class="container">
    <div class="mb-5">
        <?php

        $hallid=1;
        $userid=1;
        ?>
        <h2>Comments </h2>
        <hr>
        <div class="row bootstrap snippets">

            <div class="col-12 col-md-offset-2 col-sm-12 m-auto">
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
                                    <strong class="text-primary">@'.$commentresult[$i][6].' </strong><br>
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
                                $display.='<img class="col-12"  style="width: 100%;height: 40vh" class="m-2"  src="../../images/comment/hallComment/'.$commentresult[$i][11].'"><br>';
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
</div>







<script>


</script>



<?php
//include_once ("../../webdesign/footer/footer.php");
?>
</body>
</html>
