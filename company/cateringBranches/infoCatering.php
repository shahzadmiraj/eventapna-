<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../connection/connect.php");




$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$id=$_GET['c'];
$token=$_GET['token'];

$encoded=$id;
$cateringid=$id;


//$sql='SELECT  `name`, `expire`, `image`,id, FROM `catering` WHERE id='.$cateringid.'';
$sql='SELECT c.name,c.image,cl.id,cl.longitude,cl.latitude,cl.radius,c.expire,cl.country,cl.city,cl.address,c.id,c.AdvancePercentage FROM catering as c INNER join cateringLocation as cl 
on (c.id=cl.catering_id)
WHERE
ISNULL(cl.expire)AND
(c.id='.$cateringid.')AND(c.token="'.$token.'") '
;
$cateringdetail=queryReceive($sql);

//////////////////////////////////////may be double array error check
//print_r($cateringdetail);

$userid=$_COOKIE['userid'];
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
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.8/clipboard.min.js"></script>
    <link rel="stylesheet" href="../../mapRadius/css/gmaps-lat-lng-radius.css" type="text/css">




    <style>

    </style>
</head>
<body>



<?php
//include_once ("../../webdesign/header/header.php");

?>
<div class="jumbotron  shadow text-center" style="background-image: url(<?php

if((file_exists('../../images/catering/'.$cateringdetail[0][1])) &&($cateringdetail[0][1]!=""))
{
    echo "'../../images/catering/".$cateringdetail[0][1]."'";
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
    </div>
</div>




<div class="container card">

    <form id="formcatering">

        <input type="number" hidden name="userid" value="<?php echo $userid; ?>">
        <input type="number" hidden name="cateringid" value="<?php echo $cateringid; ?>">
        <input type="text" hidden name="Previouslongitude" value="<?php echo $cateringdetail[0][3]; ?>">
        <input type="text" hidden name="Previouslatitude" value="<?php echo $cateringdetail[0][4]; ?>">
        <input type="text" hidden name="PreviousRadius" value="<?php echo $cateringdetail[0][5]; ?>">
        <input type="text" hidden name="Previouslocationid" value="<?php echo $cateringdetail[0][2]; ?>">

        <div class="form-group row">
            <label class="col-form-label ">Catering Branch Name:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-utensils"></i></span>
                </div>
                <input id="cateringname" name="cateringname" class="form-control" type="text" value="<?php echo $cateringdetail[0][0]; ?>">
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
            <label class="col-form-label">Catering Manager :</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>

                <select name="currentManager" class="form-control">
                    <?php
                    $sql='SELECT `user_id`,(SELECT u.username FROM user as u WHERE u.id=BranchesJobStatus.user_id),id FROM `BranchesJobStatus` WHERE ISNULL(ExpireDate)AND (catering_id='.$cateringid.')AND (WorkingStatus="Manager")';
                    $currentManager=queryReceive($sql);
                    echo '<option value="'.$currentManager[0][0].'">'.$currentManager[0][1].'</option>';

                    $sql='SELECT `id`,`username` FROM `user` WHERE ISNULL(expire)AND (company_id='.$userdetail[0][0].')AND ((jobTitle="Owner")OR (jobTitle="Employee"))AND(id!='.$currentManager[0][0].')';
                    $users=queryReceive($sql);
                    for($i=0;$i<count($users);$i++)
                    {
                        echo '<option value="'.$users[$i][0].'">'.$users[$i][1].'</option>';
                    }
                    ?>
                </select>
                <?php
                echo '<input hidden name="PreviousManagerId" value="'.$currentManager[0][0].'">
                <input hidden name="BranchesJobStatusManagerId" value="'.$currentManager[0][2].'">
                '
                ?>




            </div>


        </div>



        <div class="form-group row">
            <label class="col-form-label ">Advance  Online booking %</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input id="AdvanceAmount" value="0" name="AdvanceAmount" type="number" class="form-control" placeholder="Percentage of advance" value="<?php echo $cateringdetail[0][11]; ?>">
            </div>
        </div>


        <div class="form-group row" hidden>
            <label class="col-form-label ">Latitude:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input id="latitude" name="latitude" class="form-control" type="text">
            </div>
        </div>

        <div class="form-group row" hidden>
            <label class="col-form-label ">longitude</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input id="longitude" name="longitude" class="form-control" type="text">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label ">Address</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <textarea readonly id="address" name="address" class="form-control"> <?php echo $cateringdetail[0][9]; ?> </textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label ">City</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input readonly id="city" name="city" class="form-control" type="text" value="<?php echo $cateringdetail[0][8]; ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label ">Country</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input readonly id="country" name="country" class="form-control" type="text" value="<?php echo $cateringdetail[0][7]; ?>">
            </div>
        </div>


        <div class="form-group row">
            <label class="col-form-label ">Target Radius / Online market show dishes with in   </label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input readonly value="<?php echo (int)$cateringdetail[0][5]*1000;?>" id="radius" name="radius" class="form-control" type="number">
            </div>
        </div>
        <input id="pac-input" class="controls" type="text" placeholder="Enter a location">
        <div id="shape-input" class="controls ">
            <div class="shape-option selected" data-geo-type="circle">Circle</div>
            <div hidden class="shape-option" data-geo-type="polygon">Polygon</div></div>
        <div id="output-container" class="controls" hidden>
            <button class="copybtn" data-clipboard-target="#pos-output"><img class="clippy" src="https://clipboardjs.com/assets/images/clippy.svg" width="12" alt="Copy to clipboard"></button>
            <div id="pos-output">Start by searching for the city...</div>
        </div>
        <div id="map" style="height: 80vh"></div>
        <div class="form-group row">
            <h3 align="center">  <i class="fas fa-map-marker-alt"></i>Address(optional)</h3>
        </div>
        <div class="form-group row col-12 mb-5">


            <button id="Expire" type="button" class="  btn btn-danger col-6 form-control " ><span class="fas fa-window-close "></span>  Delete</button>
            <button id="submiteditcatering" type="button" class="btn btn-primary col-6 " value="Submit"><i class="fas fa-check "></i>Submit</button>

        </div>
    </form>
</div>







<script src="../../mapRadius/js/gmaps-lat-lng-radius.js"></script>
<?php
include_once ("../../webdesign/footer/footer.php");
?>


<script type="text/javascript" src="../../webdesign/JSfile/JSFunction.js"></script>
<script>


    $(document).ready(function()
    {
       /* latitude="<?php // echo $cateringdetail[0][4];?>";
        longitude="<?php //echo $cateringdetail[0][3];?>";
        $.ajax({
        url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initMap",
        dataType: "script",
        cache: false
        });
        */


    });

    $(document).ready(function ()
    {

        $("#Expire").click(function ()
        {
            var formdata = new FormData;

            formdata.append("option","DeleteCatering");
            formdata.append("id","<?php echo $cateringid;?>");
            formdata.append("userid","<?php echo $userid;?>");
            $.ajax({
                url:"cateringServer/cateringServer.php",
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
                    if(data!="")
                    {
                        alert(data);
                    }
                    else
                    {
                        window.history.back();
                    }
                }
            });
        });


        $("#submiteditcatering").click(function ()
        {

            state=false;
            if(validationWithString("cateringname","Please Enter Branch Name"))
                state=true;
            if(validationWithString("address","Please select Address"))
                state=true;

            if(state)
                return false;

            var formdata = new FormData($("#formcatering")[0]);

            formdata.append("option","EditCatering");
            $.ajax({
                url:"cateringServer/cateringServer.php",
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
                    if(data!="")
                    {
                        alert(data);
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