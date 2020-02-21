<?php
include_once ('../../connection/connect.php');


if(!isset($_GET['hall']))
{

    header("location:../companyRegister/companyEdit.php");
}
$encoded=$_GET['hall'];
$id=base64url_decode($encoded);

if((!is_numeric($id))||$id=="")
{
    header("location:../companyRegister/companyEdit.php");
}


$hallid='';
$companyid='';
$hallid=$id;
$companyid=$_COOKIE['companyid'];
$sql='SELECT `name`, `max_guests`, `noOfPartitions`, `ownParking`, `expire`, `image`, `hallType`, `location_id` FROM `hall` WHERE id='.$hallid.'';
$halldetail=queryReceive($sql);
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
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <style>

    </style>
</head>
<body>

<?php
include_once ("../../webdesign/header/header.php");

?>




<div class="jumbotron jumbotron-fluid text-center" style="background-image: url(<?php
if((file_exists('../../images/hall/'.$halldetail[0][5]))&&($halldetail[0][5]!=""))
{
    echo "'../../images/hall/".$halldetail[0][5]."'";
}
else
{
    echo "https://www.pakvenues.com/system/halls/cover_images/000/000/048/original/Umar_Marriage_Hall_lahore.jpg?1566758537";
}
?>);background-repeat: no-repeat ;background-size: 100% 100%">
    <div class="container" style="background-color: white;opacity: 0.7">
        <h1 class="display-4"><i class="fas fa-comments fa-1x"></i>   <?php echo $halldetail[0][0]; ?></h1>
        <p class="lead">you can see what the user comment on you customer.</p>
        <h1 class="text-center"> <a href="../companyRegister/companyEdit.php " class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>
    </div>
</div>



<div class="container">
    <h1 class="font-weight-light  mt-4 mb-0">Comments</h1>

    <hr class="mt-2 mb-3">




    <div class="row bootstrap snippets">

        <div class="col-md-12 col-md-offset-2 col-sm-12 m-auto">
            <div class="comment-wrapper">
                <div class="panel panel-info ">
                    <form id="commentform">
                        <?php
                        echo '<input hidden type="number" name="hallid" value="'.$hallid.'">';
                        ?>
                        <div class="panel-body">
                            <textarea name="comment" class="form-control" placeholder="write a comment..." rows="3"></textarea>
                            <br>

                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text"><i class="fas fa-comments"></i></div>
                                </div>
                                <input name="email" type="email" class="form-control "  placeholder="Email">
                            </div>


                            <button id="btncoment" type="button" class="btn btn-info pull-right float-right col-5">Post</button>
                    </form>

                    <?php
                    $display='';

                    $sql='SELECT `hall_id`, `catering_id`, `id`, `comment`, `email`, `datetime`, `expire` FROM `comments` WHERE (hall_id='.$hallid.')&&(ISNULL(expire))';
                    $commentresult=queryReceive($sql);
                    for ($i=0;$i<count($commentresult);$i++)
                    {
                        $display.='                   
                    <div class="clearfix"></div>
                        <hr>
                        <ul class="media-list text-white">





                            <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                <span class="text-muted pull-right">
                                    <small class="text-dark">'.$commentresult[$i][5].'</small>
                                </span>
                                    <strong class="text-warning">@'.$commentresult[$i][4].'</strong>
                                    <p>
                                       '.$commentresult[$i][3].'
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









<?php
include_once ("../../webdesign/footer/footer.php");
?>

<script>

    $(document).ready(function ()
    {



        $("#btncoment").click(function ()
        {
            var formdata = new FormData($("#commentform")[0]);
            formdata.append("option", "commentAdd");

            $.ajax({
                url: "../companyServer.php",
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
                    location.reload();

                }


            });
        }) ;








    });



</script>
</body>
</html>
