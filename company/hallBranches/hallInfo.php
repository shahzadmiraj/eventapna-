<?php
include_once ('../../connection/connect.php');



if(!isset($_GET['hall']))
{

  header("location:../companyRegister/companyEdit.php");
}
$encoded=$_GET['hall'];
$id=base64url_decode($encoded);

if((!is_numeric($id))||($id==""))
{
  header("location:../companyRegister/companyEdit.php");
}

if(isset($_GET['action']))
{

    if($_GET['action']=="expire")
    {
        $date=date('Y-m-d H:i:s');
        $sql='UPDATE `hall` SET `expire`="'.$date.'" WHERE id='.$id.'';
    }
    else
    {
        $sql='UPDATE `hall` SET `expire`=NULL WHERE id='.$id.'';

    }
    querySend($sql);
   header("location:daytimeAll.php?hall=".$encoded."");
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
        <h1 class="display-4"><i class="fas fa-cogs fa-1x"></i> <?php echo $halldetail[0][0]; ?></h1>
        <p class="lead">Edit Hall infomation name ,location,pictures....</p>
        <h1 class="text-center"> <a href="../companyRegister/companyEdit.php " class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>
    </div>
</div>


<div class="container">
    <h1> Hall Setting </h1>
    <hr class="mt-2 mb-3 border-white">
    <form class="shadow card-body" id="formhall" >
        <input type="number" hidden name="hallid" value="<?php echo $hallid; ?>">

        <input type="text" hidden name="previousimage" value="<?php echo $halldetail[0][5]; ?>">
        <div class="form-group row">
            <label class="col-form-label ">Hall Branch Name:</label>
            <!--        <input name="hallname" class="form-control col-8" type="text" value="--><?php //echo $halldetail[0][0]; ?><!--">-->




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-place-of-worship"></i></span>
                </div>
                <input name="hallname" type="text" class="form-control" value="<?php echo $halldetail[0][0]; ?>">
            </div>



        </div>

        <div class="form-group row">
            <label class="col-form-label">Hall Type:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-accusoft"></i></span>
                </div>

                <select name="halltype" class="form-control">
                    <?php
                    $halltype=array("Marquee","Hall","Deera /Open area");

                    echo '<option value="'.$halldetail[0][6].'">'.$halltype[$halldetail[0][6]].'</option>';
                    for($i=0;$i<count($halltype);$i++)
                    {
                        if($i!=$halldetail[0][6])
                        {

                            echo '<option value="'.$i.'">'.$halltype[$i].'</option>';
                        }
                    }


                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label ">Hall Branch Image:</label>
            <!--        <input name="image" class="form-control col-8" type="file">-->





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera-retro"></i></span>
                </div>
                <input name="image" type="file" class="form-control">
            </div>

        </div>
        <div class="form-group row">
            <label class="col-form-label"><i class="fas fa-map-marker-alt"> </i>Hall Branch Address</label>
        </div>
        <div class="form-group row">
            <label class="col-form-label">Maximum Capacity of guests in hall:</label>
            <!--        <input name="capacity" class="form-control col-4" type="number" value="--><?php //echo $halldetail[0][1]; ?><!--">-->





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                </div>
                <input type="number" value="<?php echo $halldetail[0][1]; ?>" class="form-control" name="capacity">
            </div>


        </div>

        <div class="form-group row">
            <label class="col-form-label ">No of Partition in Hall:</label>
            <!--        <input name="partition" class="form-control col-4" type="number" value="--><?php //echo $halldetail[0][2]; ?><!--">-->



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-columns"></i></span>
                </div>
                <input name="partition" type="number" class="form-control" value="<?php echo $halldetail[0][2]; ?>">
            </div>


        </div>

        <div class="form-group row">
            <!--        <input name="parking" class="form-check-input" type="checkbox" --><?php //if($halldetail[0][3]==1){ echo "checked";} ?><!-- >-->
            <!--        <label class="form-check-label ">Have Your own parking</label>-->

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                <span class="input-group-text">
                <input name="parking" class="form-check-input " type="checkbox" <?php if($halldetail[0][3]==1){ echo "checked";} ?> ><i class="fas fa-parking"></i>
                </span>
                </div>
                <label class="form-check-label ml-3">  Have Your own parking</label>
            </div>

        </div>
        <div class="form-group row mb-5">


            <?php
            if($halldetail[0][4]=="")
            {
                echo '<a href="?action=expire&hall='.$encoded.'" class="btn btn-danger col-6">Expire</a>';

            }
            else
            {
                echo '<a href="?action=active&hall='.$encoded.'" class="btn btn-warning col-6">Active</a>';
            }

            ?>

            <button id="submitedithall" type="button" class="rounded mx-auto d-block btn btn-primary col-6 " value="Submit"> <i class="fas fa-check "></i>Save</button>

        </div>


    </form>


</div>



<?php

include_once ("../../webdesign/footer/footer.php");
?>

<script>

    $(document).ready(function ()
    {
        $("#submitedithall").click(function ()
        {
            var formdata=new FormData($("#formhall")[0]);
            formdata.append("option","halledit");
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
                    else
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
