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


if(isset($_GET['action']))
{

    if($_GET['action']=="expire")
    {
        $date=date('Y-m-d H:i:s');
        $sql='UPDATE `catering` SET `expire`="'.$date.'" WHERE id='.$cateringid.'';
    }
    else
    {
        $sql='UPDATE `catering` SET `expire`=NULL WHERE id='.$cateringid.'';

    }
    querySend($sql);
    header("location:cateringEDIT.php?catering=".$encoded."");
}

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
        <h1 class="display-5 text-center"><i class="fas fa-cogs fa-3x"></i> <?php echo $cateringdetail[0][0];?></h1>
        <p class="lead">Edit Catering infomation name ,location,pictures... </p>
        <h1 class="text-center"> <a href="../companyRegister/companyEdit.php" class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>
    </div>
</div>




<div class="container" >

    <form id="formcatering">
        <input type="number" hidden name="cateringid" value="<?php echo $cateringid; ?>">
        <input type="text" hidden name="previousimage" value="<?php echo $cateringdetail[0][2]; ?>">
        <div class="form-group row">
            <label class="col-form-label ">Catering Branch Name:</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-utensils"></i></span>
                </div>
                <input name="cateringname" class="form-control" type="text" value="<?php echo $cateringdetail[0][0]; ?>">
            </div>


        </div>
        <div class="form-group row">
            <label class="col-form-label ">Catering Branch Image:</label>






            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input name="image" class="form-control" type="file">
            </div>



        </div>
        <div class="form-group row">
            <h3 align="center">  <i class="fas fa-map-marker-alt"></i>Address(optional)</h3>
        </div>
        <div class="form-group row col-12 mb-5">


            <?php
            if($cateringdetail[0][1]=="")
            {
                echo '<a href="?action=expire&catering='.$encoded.'" class="btn btn-danger col-6">Expire</a>';

            }
            else
            {
                echo '<a href="?action=active&catering='.$encoded.'" class="btn btn-warning col-6">Active</a>';
            }

            ?>

            <button id="submiteditcatering" type="button" class="rounded mx-auto d-block btn btn-primary col-5 " value="Submit"><i class="fas fa-check "></i>Submit</button>

        </div>
    </form>













</div>





<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {
        $("#submiteditcatering").click(function () {
            var formdata = new FormData($("#formcatering")[0]);
            formdata.append("option", "cateringedit");
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
                    if (data != '')
                    {
                        alert(data);
                        return false;
                    } else
                    {
                       window.history.back();

                    }


                }
            });
        });


    });



</script>

</body>
</html>