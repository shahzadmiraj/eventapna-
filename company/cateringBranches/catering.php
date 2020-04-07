<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-27
 * Time: 17:29
 */
include_once ("../../connection/connect.php");

if(!isset($_COOKIE['companyid']))
{
    header("location:../../user/userLogin.php");
}
$companyid=$_COOKIE['companyid'];
$CateringBranches=1;
$sql='SELECT name,id FROM systemDishType WHERE ISNULL(isExpire)';
$dishType=queryReceive($sql);

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
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.8/clipboard.min.js"></script>
    <link rel="stylesheet" href="../../mapRadius/css/gmaps-lat-lng-radius.css" type="text/css">
    <style>

    </style>
</head>
<body>
<?php
include_once ("../../webdesign/header/header.php");

?>
<div class="jumbotron  shadow" style="background-image: url(https://www.hnfc.com.my/data1/images/slide2.jpg);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-body " style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 text-center"><i class="fas fa-registered"></i> Catering Branches</h1>
    <p class="lead">Free register catering branches and also get free software . Book your order easily</p>
       <h1 class="text-center"> <a href="../companyRegister/companyEdit.php " class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>
    </div>
</div>



<div class="container card">
    <h1 ><i class="fas fa-utensils"></i> <i class="fas fa-registered"></i>Catering Registeration</h1>
    <form id="cateringform">

        <input type="hidden" name="userid" value="<?php echo $userid;?>">
        <input type="hidden" name="companyid" value="<?php echo $companyid;?>">

    <div class="form-group row ">
        <label class="col-form-label">Catering Branch name:</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-utensils"></i></span>
            </div>
            <input placeholder="Catering Branch name" name="namecatering" type="text" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label ">Catering Branch Image:</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-camera"></i></span>
            </div>
            <input name="image" type="file" class="form-control">
        </div>
    </div>


        <div class="form-group row">
            <label class="col-form-label ">Latitude:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input readonly id="latitude" name="latitude" class="form-control" type="text" placeholder="Latitude Set Map">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label ">longitude</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input  readonly id="longitude" name="longitude" class="form-control" type="text" placeholder="Longitude Set Map">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label ">Address</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <textarea  readonly id="address" name="address" class="form-control"  placeholder="Address Set Map"></textarea>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label ">City</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input readonly id="city" name="city" class="form-control" type="text" placeholder="City Set Map">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label ">Country</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input readonly id="country" name="country" class="form-control" type="text" placeholder="Country Set Map">
            </div>
        </div>


        <div class="form-group row">
            <label class="col-form-label ">Target Radius / Online market show dishes with in  KM  </label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input value="9000" readonly id="radius" name="radius" class="form-control" type="text" placeholder="Target Radius Set Map ">
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


        <div class="form-group row mt-3">
        <button  type="button" class="cancelform  btn btn-danger col-6 form-control " ><span class="fas fa-window-close "></span>  Cancel</button>
        <button  type="button" id="submitform" class="btn btn-primary col-6  form-control" ><i class="fas fa-check "></i>  Submit</button>
    </div>
    </form>
</div>



<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script src="../../mapRadius/js/gmaps-lat-lng-radius.js"></script>
<script>



    $(document).ready(function() {
        getLocation();
        $.ajax({
            url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initMap",
            dataType: "script",
            cache: false
        });
    });

    $(document).ready(function ()
    {
        $("#submitform").click(function ()
        {
            var formdata=new FormData($("#cateringform")[0]);
            formdata.append("option","createCatering");
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



        $(".cancelform").click(function ()
        {
            window.history.back();
        });






    });

</script>
</body>
</html>
