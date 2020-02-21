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
        <h1 class="display-4"><i class="fas fa-images fa-1x"></i> <?php echo $halldetail[0][0]; ?></h1>
        <p class="lead">View and upload picture of hall </p>
        <h1 class="text-center"> <a href="../companyRegister/companyEdit.php " class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>
    </div>
</div>
<div class="container">



        <h1 class="font-weight-light text-lg-left mt-4 mb-3">Gallery</h1>






        <form action="" method="POST" enctype="multipart/form-data" class="form-inline">
            <input type="file" name="userfile[]" value="" multiple="" class="col-8 btn  btn-light">
            <input type="submit" name="submit" value="Upload" class="btn btn-success col-4">
        </form>
        <?php

        if(isset($_FILES['userfile']))
        {

            $file_array=reArray($_FILES['userfile']);
            $Distination='';
            for ($i=0;$i<count($file_array);$i++)
            {
                $Distination= '../../images/hall/'.$file_array[$i]['name'];
                $error=MutipleUploadFile($file_array[$i],$Distination);
                if(count($error)>0)
                {
                    echo '<h4 class="badge-danger">'.$file_array[$i]['name'].'.'.$error[0].'</h4>';
                }
                else
                {
                    $sql='INSERT INTO `images`(`id`, `image`, `expire`, `catering_id`, `hall_id`) VALUES (NULL,"'.$Distination.'",NULL,NULL,'.$hallid.')';
                    querySend($sql);
                }

            }
            unset($_FILES['userfile']);

        }



        ?>



        <hr class="mt-3 mb-5 border-white">

        <div class="row text-center text-lg-left">


            <?php


            $sql='SELECT `id`, `image` FROM `images` WHERE hall_id='.$hallid.'' ;
            echo showGallery($sql);

            ?>


        </div>



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
