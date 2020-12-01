<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../connection/connect.php");

include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfCateringBranch("Owner","../../index.php",'c');


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$id=$_GET['c'];
$token=$_GET['token'];
$sql='SELECT `name`,`image` FROM `catering` WHERE (id='.$id.')AND(token="'.$token.'")AND(ISNULL(expire))';
$cateringdetail=queryReceive($sql);
$Query='h='.$id.'&token='.$token;
$cateringid=$id;


$userid=$_COOKIE['userid'];


include('../../companyDashboard/includes/startHeader.php'); //html
?>

    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Catering Gallery</title>
    <meta name="description" content="Catering Gallery  page,Add photo Catering,Insert picture Catering,New video Food,insert Picture Food  only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Catering Gallery Management page,Add Food Order,Insert Food Video,New Add Food Order,Add New Food Order page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="<?php echo $Root;?>bootstrap.min.css">
    <script src="<?php echo $Root;?>jquery-3.3.1.js"></script><!--
    <script type="text/javascript" src="../bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="<?php echo $Root;?>webdesign/css/loader.css">
    <!--<link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
    <script src="<?php echo $Root;?>webdesign/JSfile/JSFunction.js"></script>

    <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->

    <!-- Custom fonts for this template-->
    <link href="<?php echo $Root;?>companyDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $Root;?>webdesign/css/loader.css">
    <!-- Custom styles for this template-->
    <link href="<?php echo $Root;?>companyDashboard/css/sb-admin-2.min.css" rel="stylesheet">


<?php
include('../../companyDashboard/includes/endHeader.php');
include('../../companyDashboard/includes/navbar.php');
?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Catering Gallery</h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
        </div>
    </div>
<?php
$HeadingImage=$cateringdetail[0][1];
$HeadingName=$cateringdetail[0][0];
$Source='../../images/catering/';
$pageName='Gallery';
include_once ("../ClientSide/Company/Box.php");
?>



<div class="container card">


    <form id="multiplesimages" enctype="multipart/form-data" class="form-inline">
        <input hidden type="number" name="cateringid" value="<?php echo $cateringid;?>">
        <input hidden type="number" name="userid" value="<?php echo $userid; ?>">
        <input id="userfile" type="file" name="userfile[]" value="" multiple="" class="col-8 btn  btn-light">
        <input id="submitMultiples" type="submit" name="submit" value="Upload" class="btn btn-success col-4">
    </form>




    <hr class="mt-3 mb-5 border-white">

    <div class="row ">
        <?php



        $destination="../../images/Gallery/Catering/";
        //include_once ("gallery/galleryPage.php");




        $sql='SELECT `id`, `image`,(SELECT u.username FROM user as u WHERE u.id=images.user_id),active FROM `images` WHERE (ISNULL(expire)) AND(catering_id='.$cateringid.')' ;
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




<script>

    $(document).ready(function ()
    {
        $("#submitMultiples").click(function (e)
        {
            e.preventDefault();
            var formData=new FormData($("#multiplesimages")[0]);
            formData.append("option","cateringMutiplesImages");
            $.ajax({
                url:"galleryCatering/galleryCateringServer.php",
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

            e.preventDefault();
            if (!confirm('Are you sure you want to Delete Picture or Video  ?'))
                return  false;

            var id=$(this).data("deletegallery");

            var formData=new FormData;
            formData.append("option","deleteButtonGallery");
            formData.append("userid","<?php echo $userid;?>");
            formData.append("id",id);
            $.ajax({
                url:"galleryCatering/galleryCateringServer.php",
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

<?php
include('../../companyDashboard/includes/scripts.php');
include('../../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>