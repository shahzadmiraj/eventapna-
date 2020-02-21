<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../connection/connect.php");



if(!isset($_COOKIE['companyid']))
{
    header("location:../../user/userLogin.php");
}
if(!isset($_GET['catering']))
{

    header("location:../companyRegister/companyEdit.php");
}
$encoded=$_GET['catering'];
$id=base64url_decode($encoded);

if((!is_numeric($id))||$id=="")
{
    header("location:../companyRegister/companyEdit.php");
}
$cateringid=$id;
$sql='SELECT  `name`, `expire`, `image`, `location_id` FROM `catering` WHERE id='.$cateringid.'';
$cateringdetail=queryReceive($sql);


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
<div class="jumbotron  shadow text-center" style="background-image: url(<?php

if((file_exists('../../images/catering/'.$cateringdetail[0][2])) &&($cateringdetail[0][2]!=""))
{
    echo "'../../images/catering/".$cateringdetail[0][2]."'";
}
else
{
    echo "https://www.liberaldictionary.com/wp-content/uploads/2019/02/cater-4956.jpg";
}
?>
    );background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-body " style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 text-center"><i class="fas fa-images fa-3x"></i><?php echo $cateringdetail[0][0];?> Gallery</h1>
        <p class="lead">View and upload picture of dishes </p>
        <h1 class="text-center"> <a href="../companyRegister/companyEdit.php" class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>

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
            $Distination= '../../images/catering/'.$file_array[$i]['name'];
            $error=MutipleUploadFile($file_array[$i],$Distination);
            if(count($error)>0)
            {
                echo '<h4 class="badge-danger">'.$file_array[$i]['name'].'.'.$error[0].'</h4>';
            }
            else
            {
                $sql='INSERT INTO `images`(`id`, `image`, `expire`, `catering_id`, `hall_id`) VALUES (NULL,"'.$Distination.'",NULL,'.$cateringid.',NULL)';
                querySend($sql);
            }

        }
        unset($_FILES['userfile']);

    }



    ?>



    <hr class="mt-3 mb-5 border-white">

    <div class="row text-center text-lg-left">


        <?php


        $sql='SELECT `id`, `image` FROM `images` WHERE catering_id='.$cateringid.'' ;
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