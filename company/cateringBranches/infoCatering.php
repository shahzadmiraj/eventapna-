<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../connection/connect.php");
include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfCateringBranch("Owner","../../index.php",'c');




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

$userid=$_COOKIE['userid'];

include('../../companyDashboard/includes/startHeader.php'); //html
?>

    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Edit Catering</title>
    <meta name="description" content="Edit Catering Branch ,Edit Catering Services,Food Services page, Edit Catering Services,Food Services Manage Extra Item Hall,Manage Extra Item Marquee, Order Manage Extra Item Add Marquee,Manage Extra Item New Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Edit Catering Services,Food Services Company Management,Food Branch Edit ,Food branches Chagnes,Catering  system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="<?php echo $Root;?>bootstrap.min.css">
    <script src="<?php echo $Root;?>jquery-3.3.1.js"></script><!--
    <script type="text/javascript" src="../bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="<?php echo $Root;?>webdesign/css/loader.css">

    <script src="<?php echo $Root;?>webdesign/JSfile/JSFunction.js"></script>



    <!-- Custom fonts for this template-->
    <link href="<?php echo $Root;?>companyDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $Root;?>webdesign/css/loader.css">
    <!-- Custom styles for this template-->
    <link href="<?php echo $Root;?>companyDashboard/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.8/clipboard.min.js"></script>
    <link rel="stylesheet" href="../../mapRadius/css/gmaps-lat-lng-radius.css" type="text/css">






<?php
include('../../companyDashboard/includes/endHeader.php');
include('../../companyDashboard/includes/navbar.php');
?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Edit Catering Branch</h1>

        </div>
    </div>

<?php
$HeadingImage=$cateringdetail[0][1];
$HeadingName=$cateringdetail[0][0];
$Source='../../images/catering/';
$pageName='General Setting';
include_once ("../ClientSide/Company/Box.php");
?>




<div class="container">

    <form id="formcatering" class="row">

        <input type="number" hidden name="userid" value="<?php echo $userid; ?>">
        <input type="number" hidden name="cateringid" value="<?php echo $cateringid; ?>">
        <input type="text" hidden name="Previouslongitude" value="<?php echo $cateringdetail[0][3]; ?>">
        <input type="text" hidden name="Previouslatitude" value="<?php echo $cateringdetail[0][4]; ?>">
        <input type="text" hidden name="PreviousRadius" value="<?php echo $cateringdetail[0][5]; ?>">
        <input type="text" hidden name="Previouslocationid" value="<?php echo $cateringdetail[0][2]; ?>">

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Catering Branch Name:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-utensils"></i></span>
                </div>
                <input id="cateringname" name="cateringname" class="form-control" type="text" value="<?php echo $cateringdetail[0][0]; ?>">
            </div>
        </div>
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Catering Branch Image:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input name="image" class="form-control" type="file">
            </div>
        </div>



        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
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



        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Advance  Online booking %</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input id="AdvanceAmount" value="0" name="AdvanceAmount" type="number" class="form-control" placeholder="Percentage of advance" value="<?php echo $cateringdetail[0][11]; ?>">
            </div>
        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6" hidden>
            <label class="col-form-label ">Latitude:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input id="latitude" name="latitude" class="form-control" type="text">
            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6" hidden>
            <label class="col-form-label ">longitude</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input id="longitude" name="longitude" class="form-control" type="text">
            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Address</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <textarea readonly id="address" name="address" class="form-control"> <?php echo $cateringdetail[0][9]; ?> </textarea>
            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">City</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input readonly id="city" name="city" class="form-control" type="text" value="<?php echo $cateringdetail[0][8]; ?>">
            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Country</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input readonly id="country" name="country" class="form-control" type="text" value="<?php echo $cateringdetail[0][7]; ?>">
            </div>
        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
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
        <div class="col-sm-12   col-12 col-md-12 col-lg-12" id="map" style="height: 80vh"></div>
      
        <div class="col-sm-12   col-12 col-md-12 col-lg-12 form-inline">


            <button id="Expire" type="button" class="  btn btn-danger col-sm-6   col-6 col-md-6 col-lg-6" ><span class="fas fa-window-close "></span>  Delete</button>
            <button id="submiteditcatering" type="button" class="btn btn-primary col-sm-6   col-6 col-md-6 col-lg-6" value="Submit"><i class="fas fa-check "></i>Submit</button>

        </div>
    </form>
</div>







<script src="../../mapRadius/js/gmaps-lat-lng-radius.js"></script>



<script type="text/javascript" src="../../webdesign/JSfile/JSFunction.js"></script>
<script>


    $(document).ready(function()
    {
        latitude="<?php  echo $cateringdetail[0][4];?>";
        longitude="<?php echo $cateringdetail[0][3];?>";
        $.ajax({
        url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initMap",
        dataType: "script",
        cache: false
        });



    });

    $(document).ready(function ()
    {

        $("#Expire").click(function ()
        {
            if (!confirm('Are you sure you want to Delete Food & Catering Branch in you company  ?'))
                return  false;
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
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    if($.trim(data)!='')
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
            if(NumberRange("AdvanceAmount","Please Enter Advance  Online booking payment with percentage  min 0 and max 100",0,100))
            {
                state=true;
            }
            if(state)
                return false;
            if (!confirm('Are you sure you want to Save Food & Catering Branch information  ?'))
                return  false;
            var formdata = new FormData($("#formcatering")[0]);

            formdata.append("option","EditCatering");
            $.ajax({
                url:"cateringServer/cateringServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    if($.trim(data)!='')
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


<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>