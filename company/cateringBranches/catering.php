<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-27
 * Time: 17:29
 */
include_once ("../../connection/connect.php");
include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner","../../index.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$companyid=$userdetail[0][0];

$userid=$_COOKIE['userid'];

include('../../companyDashboard/includes/startHeader.php'); //html
?>

    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Add Catering</title>
    <meta name="description" content="Add Catering Branch ,New Catering Services,Food Services page, New Catering Services,Food Services Manage Extra Item Hall,Manage Extra Item Marquee, Order Manage Extra Item Add Marquee,Manage Extra Item New Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Add Catering Branch,Add Food  Company ,Food Branch Add ,Food branches Chagnes,Catering  system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

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
            <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-registered"></i>Add Catering Branch</h1>

        </div>
    </div>
<div class="container ">
    <form id="cateringform" class="row">

        <input type="hidden" name="userid" value="<?php echo $userid;?>">
        <input type="hidden" name="companyid" value="<?php echo $companyid;?>">

    <div class="col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">Catering Branch name:</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-utensils"></i></span>
            </div>
            <input id="namecatering" placeholder="Catering Branch name" name="namecatering" type="text" class="form-control">
        </div>
    </div>
    <div class="col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label ">Catering Branch Image:</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-camera"></i></span>
            </div>
            <input name="image" type="file" class="form-control">
        </div>
    </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Catering Manager :</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>

                <select name="cateringManager" class="form-control">
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



        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Advance  Online booking %</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input id="AdvanceAmount" value="0" name="AdvanceAmount" type="number" class="form-control" placeholder="Percentage of advance">
            </div>
        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Latitude:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input readonly id="latitude" name="latitude" class="form-control" type="text" placeholder="Latitude Set Map">
            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">longitude</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input  readonly id="longitude" name="longitude" class="form-control" type="text" placeholder="Longitude Set Map">
            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Address</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <textarea  readonly id="address" name="address" class="form-control"  placeholder="Address Set Map"></textarea>
            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">City</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input readonly id="city" name="city" class="form-control" type="text" placeholder="City Set Map">
            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Country</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input readonly id="country" name="country" class="form-control" type="text" placeholder="Country Set Map">
            </div>
        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label ">Target Radius / Online market show dishes with in  KM  </label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
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
        <div class="col-sm-12   col-12 col-md-12 col-lg-12" id="map" style="height: 80vh"></div>


        <div class="col-sm-12   col-12 col-md-12 col-lg-12 form-inline">
        <button  type="button" class="cancelform  btn btn-danger col-sm-6   col-6 col-md-6 col-lg-6" ><span class="fas fa-window-close "></span>  Cancel</button>
        <button  type="button" id="submitform" class="btn btn-primary  col-sm-6   col-6 col-md-6 col-lg-6" ><i class="fas fa-check "></i>  Submit</button>
    </div>
    </form>
</div>




<script src="../../mapRadius/js/gmaps-lat-lng-radius.js"></script>
<script>



    $(document).ready(function()
    {
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

            state=false;
            if(validationWithString("namecatering","Please Enter Branch Name"))
                state=true;
            if(validationWithString("address","Please select Address"))
                state=true;
            if(NumberRange("AdvanceAmount","Please Enter Advance  Online booking payment with percentage  min 0 and max 100",0,100))
            {
                state=true;
            }

            if(state)
                return false;

            if (!confirm('Are you sure you want to Add Food & Catering Branch in company ?'))
                return  false;
            var formdata=new FormData($("#cateringform")[0]);
            formdata.append("option","createCatering");
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



        $(".cancelform").click(function ()
        {
            window.history.back();
        });






    });

</script>
<?php
include('../../companyDashboard/includes/scripts.php');
include('../../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>