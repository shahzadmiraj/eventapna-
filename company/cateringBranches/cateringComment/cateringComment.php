<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");



if(!isset($_COOKIE['companyid']))
{
    header("location:../../../user/userLogin.php");
}
if(!isset($_GET['catering']))
{

    header("location:../../../companyRegister/companyEdit.php");
}
$encoded=$_GET['catering'];
$id=base64url_decode($encoded);

if((!is_numeric($id))||$id=="")
{
    header("location:../../companyRegister/companyEdit.php");
}
$cateringid=$id;
$sql='SELECT  `name`, `expire`, `image`, `location_id` FROM `catering` WHERE id='.$cateringid.'';
$cateringdetail=queryReceive($sql);

$userid=$_COOKIE['userid'];


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
    <link rel="stylesheet" href="../../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">

    <link rel="stylesheet" href="../../../webdesign/css/comment.css">

    <link rel="stylesheet" href="../../../Fractional-Star-Rating-jsRapStar/jsRapStar.css" />
    <link rel="stylesheet" href="../../../Fractional-Star-Rating-jsRapStar/index.css" />
    <script src="../../../Fractional-Star-Rating-jsRapStar/jsRapStar.js"></script>
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
        <h1 class="display-4"><i class="fas fa-comments fa-1x"></i>   Comment In all packages and Catering</h1>
        <p class="lead">you can see what the user comment on you customer.</p>
        <h1 class="text-center"> <a href="../../companyRegister/companyEdit.php " class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>
    </div>
</div>



<div class="container badge-light">
    <h1 class="font-weight-light  mt-4 mb-0">Comments</h1>
    <hr class="mt-2 mb-3">
    <div class="row bootstrap snippets">

        <div class="col-md-12 col-md-offset-2 col-sm-12 m-auto">
            <div class="comment-wrapper">
                <div class="panel panel-info ">
                    <form id="commentform">
                        <?php
                        echo '<input hidden type="number" name="cateringid" value="'.$cateringid.'">';
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
where u.id=comments.user_id), `PackOrDishId`, `expireUser`,`rating`,`image` FROM `comments` WHERE (catering_id='.$cateringid.')AND(ISNULL(expire))';
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
                        if((file_exists('../../../images/users/'.$commentresult[$i][7])) &&($commentresult[$i][7]!=""))
                        {
                            $display.='../../../images/users/'.$commentresult[$i][7];
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
                        if((file_exists('../../../images/comment/cateringComment/'.$commentresult[$i][11])) &&($commentresult[$i][11]!=""))
                        {
                            $display.='<img  style="width: 100%;height: 40vh" class="m-2"  src="../../../images/comment/cateringComment/'.$commentresult[$i][11].'"><br>';
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




<?php
include_once ("../../../webdesign/footer/footer.php");
?>


<script>
    var scores=3;
    $(document).ready(function(){
        $('#demo1').jsRapStar({
            onClick:function(score){
                $(this)[0].StarF.css({color:'red'});
                scores=score;
            }});
    });
    $(document).ready(function ()
    {


        $(".deletecomment").click(function (e) {
            e.preventDefault();
            var id = $(this).data("deletecomment");
            var userid = "<?php  echo $userid;?>";
            $.ajax({
                url: "commentCateringServer.php",
                method: "POST",
                data: {id: id, userid: userid, option: "deletecomment"},
                dataType: "text",
                beforeSend: function () {
                    $("#preloader").show();
                },
                success: function (data) {
                    $("#preloader").hide();
                    location.reload();
                }
            });
        });

        $("#btncoment").click(function ()
        {
            var formdata = new FormData($("#commentform")[0]);
            formdata.append("option", "commentCatering");
            formdata.append("stars", scores);
            $.ajax({
                url: "commentCateringServer.php",
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
                    if(data)
                    {
                        alert(data);
                    }
                    location.reload();
                }
            });
        }) ;

    });


</script>

</body>
</html>