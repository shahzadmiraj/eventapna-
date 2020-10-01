<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include  ("../../connection/connect.php");
include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner","../../index.php");

$sql='SELECT `company_id`,`username`, `jobTitle`,`id` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$companyid=$userdetail[0][0];
?>
<!DOCTYPE html>
<head>

    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Hall Register</title>
    <meta name="description" content="Hall Register page,Add Hall,Insert Marquee,New Add Marquee,Add New Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Hall Register page,Add Hall,Insert Marquee,New Add Marquee,Add New Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <script src="../../jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../map/style.css">

    <script src="../../webdesign/JSfile/JSFunction.js"></script>
    <style>
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
    </div>
</div>

<form class="card container">
    <h2>Hall Registeration Form</h2>
    <hr>
    <div class="form-group row">
        <input hidden type="number" name="userid" value="<?php echo $userdetail[0][3];?>">
        <label class="col-form-label">Hall Name:</label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-place-of-worship"></i></span>
            </div>
            <input id="hallname" name="hallname" type="text" class="form-control" placeholder="Hall Branch Name">
        </div>



    </div>

    <div class="form-group row">
        <label class="col-form-label">Hall Type:</label>
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
        <label class="col-form-label ">Advance  Online booking in percentage%</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input id="AdvanceAmount" value="0" name="AdvanceAmount" type="number" class="form-control" placeholder="Percentage of advance">
        </div>
    </div>



    <div class="form-group row">
        <label class="col-form-label">Hall Manager :</label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>

            <select name="hallManager" class="form-control">
                <?php
                $sql='SELECT `id`,`username` FROM `user` WHERE ISNULL(expire)AND (company_id='.$userdetail[0][0].')AND ((jobTitle="Owner")OR (jobTitle="Employee"))';
                $users=queryReceive($sql);
                for($i=0;$i<count($users);$i++)
                {
                    echo '<option value="'.$users[$i][0].'">'.$users[$i][1].'</option>';
                }
                ?>
            </select>
        </div>


    </div>


    <div class="form-group row">
        <label class="col-form-label">Hall Branch Image:</label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-camera-retro"></i></span>
            </div>
            <input name="image" type="file" class="form-control">
        </div>


    </div>
    <div class="form-group row">
        <label class="col-form-label ">Maximum Capacity of guests in hall:</label>



        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-users"></i></span>
            </div>
            <input id="capacity"  name="capacity" type="number" class="form-control" placeholder="Min 50 and Max 3000 hall sitting Arrangement  ">
        </div>


    </div>

    <div class="form-group row">
        <label class="col-form-label">How Many function manage on same date and  same time (1 to 4):</label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-columns"></i></span>
            </div>
            <input id="partitions" name="partition" type="number" class="form-control" placeholder="No.of manage functions in Hall etc  1,2">
        </div>

    </div>



    <div class="form-group row">
        <label class="col-form-label">Own Parking :</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-parking"></i></span>
            </div>
            <select name="parking" class="form-control">
                <option value="0">No,we have not Own parking</option>
                <option value="1">Yes,we have  Own parking</option>
            </select>
        </div>
    </div>






    <h4   class="text-center"><i class="fas fa-map-marker-alt"></i> Hall Branch Address</h4>
    <hr>




    <div class="form-group row">

        <label for="" class="col-form-label">Address: </label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
            </div>
            <input name="address" id="map-search" class="controls form-control" type="text" placeholder="Search Box" size="104">
        </div>
    </div>


    <div id="map-canvas" style="width:100%;height: 60vh"  ></div>
    <div hidden>
        <label  for="">Lat: <input name="latitude" id="latitude" type="text" class="latitude"></label>
        <label  for="">Long: <input  name="longitude" id="longitude" type="text" class="longitude"></label>
        <label  for="">City <input name="city" id="reg-input-city" type="text" class="reg-input-city" placeholder="City"></label>
        <label  for="">country <input name="country" type="text" id="reg-input-country" placeholder="country"></label>

    </div>


    <div class="form-group row mt-5">
        <button id="cancel" type="button" class="btn btn-danger col-6 form-control"  value="Cancel"><span class="fas fa-window-close "></span>Cancel</button>
        <button id="submit" type="button" class="btn btn-primary col-6 form-control" value="Submit"><i class="fas fa-check "></i>Submit</button>
    </div>



</form>




<script src="../../map/javascript.js"></script>

<?php
include_once ("../../webdesign/footer/footer.php");
?>


<script src="../../webdesign/JSfile/JSFunction.js"></script>
<script>


    $(document).ready(function ()
    {




        $('#submit').click(function (e)
        {
            e.preventDefault();
            var state=false;
            if(NumberRange("partitions","How Many function manage on same date and  same time (1 to 4)",1,4))
            {
                state=true;
            }
            if(NumberRange("capacity","Please Enter Valid capacity up to 50 and maximum 3000",50,3000))
            {
                state=true;
            }
            if(NumberRange("AdvanceAmount","Please Enter Valid Advance online booking in % 0 to 100",0,100))
            {
                state=true;
            }
            if(validationWithString("hallname","Please Enter Name of Hall"))
            {
                state=true;
            }
            if(validationWithString("map-search","Please Select Location of Hall"))
            {
                state=true;
            }
            if(state)
                return false;

            var formdata = new FormData($("form")[0]);
            formdata.append("option", "CreateHall");
            formdata.append("companyid","<?php echo $companyid;?>");
            $.ajax({
                url: "../companyServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    if($.trim(data)!="")
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


    $(document).ready(function()
    {
        $.ajax({
            url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initialize",
            dataType: "script",
            cache: false
        });
    });

</script>

</body>
</html>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>