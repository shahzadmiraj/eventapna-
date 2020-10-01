<?php
include_once ('../../connection/connect.php');
include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfHall("Owner,Employee","../../index.php",'h');

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$id=$_GET['h'];
$token=$_GET['token'];
$sql='SELECT `name`,`image` FROM `hall` WHERE (id='.$id.')AND(token="'.$token.'")AND(ISNULL(expire))';
$halldetail=queryReceive($sql);

$hallid=$id;
$companyid=$userdetail[0][0];
$userid=$_COOKIE['userid'];

?>
<!DOCTYPE html>
<head>
    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Hall Gallery</title>
    <meta name="description" content="Hall Gallery  page,Add photo Hall,Insert picture Marquee,New video Marquee,insert Picture Dera  only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Hall Gallery Management page,Add Hall Order,Insert Marquee Order,New Add Marquee Order,Add New Dera Order page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">

    <style>

    </style>
</head>
<body>

<?php
include_once ("../../webdesign/header/header.php");

?>

<?php
$HeadingImage=$halldetail[0][1];
$HeadingName=$halldetail[0][0];
$Source='../../images/hall/';
$pageName='Gallery';
include_once ("../ClientSide/Company/Box.php");
?>





<div class="container card">
    <h1 class="font-weight-light text-lg-left mt-4 mb-3">Gallery</h1>


    <form id="multiplesimages" enctype="multipart/form-data" class="form-inline">
        <input hidden type="number" name="hallid" value="<?php echo $hallid;?>">
        <input hidden type="number" name="userid" value="<?php echo $userid; ?>">
        <input id="userfile" type="file" name="userfile[]" value="" multiple="" class="col-8 btn  btn-light">
        <input id="submitMultiples" type="submit" name="submit" value="Upload" class="btn btn-success col-4">
    </form>




    <hr class="mt-3 mb-5 border-white">

    <div class="row ">
        <?php



        $destination="../../images/Gallery/Hall/";
        //include_once ("gallery/galleryPage.php");




        $sql='SELECT `id`, `image`,(SELECT u.username FROM user as u WHERE u.id=images.user_id),active FROM `images` WHERE (ISNULL(expire)) AND(hall_id='.$hallid.')' ;
        $result=queryReceive($sql);

        $source='';
        $display='';
        $extensions= array("jpeg","jpg","png");
        for($k=0;$k<count($result);$k++)
        {
            if((file_exists($destination.$result[$k][1]))&&($result[$k][1]!=""))
            {
                $passbyreference = explode('.', $result[$k][1]);
                $file_ext = strtolower(end($passbyreference));

                if (in_array($file_ext, $extensions) === true) {
                    //image file

                    $display .= '
                        <div class="col-lg-5 m-auto col-md-6  col-xl-4 col-12   embed-responsive border shadow-lg">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-thumbnail embed-responsive" src="'.$destination.''. $result[$k][1] . '" alt="" style="width:100%;height:60vh">
                           
                            <p class="card-img-bottom alert-light">
                          <i class="fas fa-user"></i> '.$result[$k][2].'
                            <i class="far fa-calendar-alt ml-3"></i>'.$result[$k][3].'
                          
                            <button data-deletegallery="'.$result[$k][0].'" class="float-right btn btn-danger deleteButtonGallery"><i class="fas fa-trash-alt"></i>Delete</button>
                            </p>
                            </a>
                        </div>';
                } else {
                    //video file

                    $source = $result[$k][1];
                    $video = substr_replace($source, "", -4);
                    $display .= '
                         
                          <div class="col-lg-4 col-md-6  col-xl-3 col-12 mb-2 mt-2 embed-responsive border shadow-lg">
                                <div class="embed-responsive embed-responsive-16by9 d-block mb-4 h-100">
                                    <video width="320" height="440" controls class="card"  >
                                        <source src="'.$destination.'' . $video . '.mp4" type="video/mp4">
                                        <source src="'.$destination.'' . $video . '.ogg" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                                <p class="card-img-bottom alert-light">
                           <i class="fas fa-user"></i>'.$result[$k][2].'
                           <i class="far fa-calendar-alt ml-3"></i> '.$result[$k][3].'
                         
                            <button data-deletegallery="'.$result[$k][0].'" class="float-right btn btn-danger deleteButtonGallery"><i class="fas fa-trash-alt"></i>Delete</button>
                                
                           </div>
                         
                         ';
                }
            }


        }
        echo $display;
        ?>





    </div>



</div>

<?php
include_once ("../../webdesign/footer/footer.php");
?>



<script>

    $(document).ready(function ()
    {
        $("#submitMultiples").click(function (e)
        {
            if (!confirm('Are you sure you want to Add picture/video ?'))
                return  false;
            e.preventDefault();
            var formData=new FormData($("#multiplesimages")[0]);
            formData.append("option","hallmutiplesimages");
            $.ajax({
                url:"gallery/galleryServer.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    if($.trim(data)!='')
                    {
                        alert(data);
                    }
                    $("#userfile").val("");
                    location.reload();


                }
            });




        });

        $(".deleteButtonGallery").click(function (e)
        {
            if (!confirm('Are you sure you want to Delete picture/video ?'))
                return  false;
            e.preventDefault();

            var id=$(this).data("deletegallery");

            var formData=new FormData;
            formData.append("option","deleteButtonGallery");
            formData.append("userid","<?php echo $userid;?>");
            formData.append("id",id);
            $.ajax({
                url:"gallery/galleryServer.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    if($.trim(data)!='')
                    {
                        alert(data);
                    }
                    location.reload();
                }
            });

        });

    });



</script>
</body>
</html>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>