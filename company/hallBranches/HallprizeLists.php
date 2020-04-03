<?php
include_once ('../../connection/connect.php');
include_once('packages/packagesServerfunction.php');

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

if(isset($_GET['editpackage']))
{

    $packageEncoded=base64url_encode($_GET['packageid']);
    header("location:Editpackage.php?hallname=".$_GET['hallname']."&month=".$_GET['month']."&daytime=".$_GET['daytime']."&hall=".$encoded."&pack=".$packageEncoded."");

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
        <h1 class="display-4"><i class="fas fa-clipboard-list fa-1x"></i>    <?php echo $halldetail[0][0]; ?></h1>
        <p class="lead">You can manage month wise prize list.Prize list consist of per head with food  and per head only seating .</p>
        <h1 class="text-center"> <a href="../companyRegister/companyEdit.php " class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>
    </div>
</div>


<div class="container card">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
    </li>
</ul>
        </div>
    </nav>
<div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">FIRST TABE</div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">SECOND TABE</div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">THIRD TABE</div>
</div>
</div>


<!--
<h3 class="text-white">Prize list Management</h3>
<hr class="mt-2 mb-3 border-white">


    <div class="form-group row  container m-auto badge-light">
        <div data-daytime="Morning" class="col-4 daytime"style="height: 25vh">
            <a  class="btn btn-primary">
                <img class="rounded-circle" src="https://www.incimages.com/uploaded_files/image/970x450/getty_503667408_2000133320009280259_352507.jpg"  style="height: 20vh;width: 100%;">
                <p   class="text-white"><i class="fas fa-coffee"></i> Morning </p>
            </a>
        </div>
        <div  data-daytime="Afternoon" class="daytime col-4" style="height: 25vh">
            <a  class="btn btn-warning">
                <img class="rounded-circle" src="https://www.ellieteramoto.com/wordpress/wp-content/uploads/2018/11/the-sun-and-lake-kussharo-hokkaido-japan.jpg" style="height: 20vh;width: 100%">
                <p class="text-white" ><i class="fas fa-sun"></i> Afternoon</p>
            </a>
        </div>
        <div data-daytime="Evening" class="daytime col-4" style="height: 25vh">
            <a  class="btn btn-dark">
                <img class="rounded-circle" src="https://www.murals.shop/1777-thickbox_default/starry-sky-half-moon-scenic-cloudscape-wall-mural.jpg"  style="height: 20vh;width: 100%">
                <p class="text-white" ><i class="fas fa-moon"></i> Evening </p>
            </a>
        </div>
    </div>






    <div  class="border mt-5" id="showDaytimes">
        <?php
/*        if(isset($_GET['daytime']))
        {
            echo showPrizrListDetail($halldetail[0][0],$hallid,$_GET['daytime'],$companyid);
        }
        else
        {

          echo  showPrizrListDetail($halldetail[0][0],$hallid,"Morning",$companyid);
        }


        */?>



    </div>-->













<?php

include_once ("../../webdesign/footer/footer.php");
?>

<script>

    $(document).ready(function ()
    {

        $(".daytime").click(function ()
        {
            var daytime=$(this).data("daytime");
            window.location.href="?daytime="+daytime+"&hall=<?php echo $_GET['hall'];?>";

        }) ;

        $(document).on("change",".changeSeating",function () {
            var id=$(this).data("menuid");
            var value=$(this).val();
            var formdata=new FormData();
            formdata.append("option","changeSeating");
            formdata.append("packageid",id);
            formdata.append("value",value);
            $.ajax({
                url:"../companyServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
                    if(data!='')
                    {
                        alert(data);
                        return false;
                    }

                }
            });


        }) ;













    });



</script>
</body>
</html>
