<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include  ("../../connection/connect.php");
$companyid=$_COOKIE['companyid'];
$hallBranches='';

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
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <style>

        form
        {
            margin: 5%;

        }
    </style>
</head>
<body>
<?php
include_once ("../../webdesign/header/header.php");

?>
<div class="jumbotron  shadow" style="background-image: url(https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-body text-center" style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 "><i class="fas fa-registered"></i> Hall Branch Register</h1>
        <p class="lead">Free register Hall branches and also get free software . Book your order easily</p>

        <a href="../companyRegister/companyEdit.php " class="col-6 btn btn-info"> <i class="fas fa-city mr-2"></i>Edit Company</a>

    </div>
</div>

<form class="card-body ">
    <div class="form-group row">
    <label class="col-form-label">Hall Branch Name:</label>
<!--    <input name="hallname" class="form-control col-8" type="text">-->



        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-place-of-worship"></i></span>
            </div>
            <input id="hallname" name="hallname" type="text" class="form-control" placeholder="Hall Branch Name">
        </div>



    </div>

    <div class="form-group row">
        <label class="col-form-label">Hall Type:</label>
        <!--<select name="halltype" class="form-control col-8">
            <option value="1">Marquee</option>
            <option value="2">Hall</option>
            <option value="3">Deera /Open area</option>
        </select>-->



        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fab fa-accusoft"></i></span>
            </div>

            <select name="halltype" class="form-control">
                <option value="0">Marquee</option>
                <option value="1">Hall</option>
                <option value="2">Deera /Open area</option>
            </select>
        </div>


    </div>
    <div class="form-group row">
        <label class="col-form-label">Hall Branch Image:</label>
<!--        <input name="image" class="form-control col-8" type="file">-->


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-camera-retro"></i></span>
            </div>
            <input name="image" type="file" class="form-control">
        </div>


    </div>
    <div class="form-group row">
        <label class="col-form-label"><i class="fas fa-map-marker-alt"></i> Hall Branch Address</label>
    </div>
    <div class="form-group row">
        <label class="col-form-label ">Maximum Capacity of guests in hall:</label>
<!--        <input name="capacity" class="form-control col-4" type="number">-->



        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-users"></i></span>
            </div>
            <input name="capacity" type="number" class="form-control" placeholder="Maximum Capacity of guests in hall">
        </div>


    </div>

    <div class="form-group row">
        <label class="col-form-label">No of Partition in Hall:</label>
<!--        <input name="partition" class="form-control col-4" type="number">-->






        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-columns"></i></span>
            </div>
            <input name="partition" type="number" class="form-control" placeholder="No of Partition in Hall">
        </div>


    </div>

    <div class="form-inline form-group">
        <input name="parking" class="form-check-input  " type="checkbox">
        <label class="form-check-label "><i class="fas fa-parking"></i> Have Your own parking</label>
    </div>
    <div class="form-group row">
<!--        <input id="cancel" type="button" class="btn btn-danger col-4 form-control"  value="cancel">-->
<!--        <input id="submit" type="button" class=" btn btn-success col-4 form-control" value="Submit">-->


        <button id="cancel" type="button" class="btn btn-danger col-4 form-control"  value="Cancel"><span class="fas fa-window-close "></span>Cancel</button>
        <button id="submit" type="button" class=" btn btn-success col-4 form-control" value="Submit"><i class="fas fa-check "></i>Submit</button>




    </div>


</form>





<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function () {
        $('#submit').click(function ()
        {
            if($.trim($("#hallname").val()).length==0)
            {
                alert("hall name must enter");
                return false;

            }
            var formdata = new FormData($("form")[0]);
            formdata.append("option", "CreateHall");
            formdata.append("companyid",<?php echo $companyid;?>);
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
                    if(data!="")
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
        $("#cancel").click(function ()
        {
            window.history.back();

        });
    });

</script>
</body>
</html>
