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

        #formhall
        {
            margin: 5%;;

        }
        #showDaytimes
        {
            background: #dd3e54;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #6be585, #dd3e54);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #6be585, #dd3e54); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
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
        <h1 class="display-4"><i class="fas fa-place-of-worship"></i><?php echo $halldetail[0][0]; ?></h1>
        <p class="lead">You can control hall setting and also month wise prize list.Prize list consist of per head with food  and per head only seating .</p>
        <h1 class="text-center"> <a href="../companyRegister/companyEdit.php " class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>
    </div>
</div>


<div class="container row m-auto">
    <a href="hallInfo.php?hall=<?php echo $encoded;?>" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-cogs fa-5x"></i><h4> Change info</h4></a>
    <a href="galleryhall.php?hall=<?php echo $encoded;?>" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-images fa-5x"></i> <h4> Gallery</h4></a>
    <a href="HallprizeLists.php?hall=<?php echo $encoded;?>" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-clipboard-list fa-5x"></i> <h4> Prize list</h4></a>
    <a href="comment.php?hall=<?php echo $encoded;?>" class="h-25 col-5 shadow text-dark m-2 text-center"><i class="fas fa-comments fa-5x"></i> <h4> Comments</h4></a>
</div>



<?php
include_once ("../../webdesign/footer/footer.php");
?>

<script>

    $(document).ready(function ()
    {










    });



</script>
</body>
</html>
