<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");


include  ("../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner,User,Employee,Viewer","../index.php");
$userid=$_COOKIE['userid'];

include('../companyDashboard/includes/startHeader.php'); //html
?>

    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Reset Password</title>
    <meta name="description" content="User Reset password  page
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="User Reset password page Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">



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

<?php
include('../companyDashboard/includes/endHeader.php');
include('../companyDashboard/includes/navbar.php');
?>

<div class="container">
    <h1 class="mb-5 mt-5 "><i class="fas fa-key"></i> Reset Password</h1>
    <h4 id="error"> </h4>
    <form class="row" id="formLogin">




        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Old Password</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input id="Oldpassword" type="password" class="form-control" name="Oldpassword" placeholder="Previous Password">

            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">New Password</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input id="password1" type="password" class="form-control" name="password1" placeholder="New Password">

            </div>
        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Confirm Password</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input id="password2" type="password" class="form-control" name="password2" placeholder="confirm Password">
            </div>
        </div>



        <div class="card-footer col-sm-12   col-12 col-md-12 col-lg-12">
            <div class="d-flex justify-content-center links">
                Forgot your password?  <button id="passwordresend"  type="button" class="btn-light"> Send Password</button>
            </div>
            <div class="d-flex justify-content-center links">
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
            </div>
        </div>
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <button id="ResetPassword" type="button" class="btn btn-warning form-control "  ><i class="fas fa-check "></i>  Reset Password</button>
        </div>

    </form>




</div>


<script>
    $(document).ready(function ()
    {
        $("#passwordresend").click(function ()
        {

            var formdata = new FormData;
            formdata.append("option", "resentPAssword");
            formdata.append("userid", "<?php echo $userid;?>");
            $.ajax({
                url: "userServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#pleaseWaitDialog').modal();
                },
                success: function (data) {
                    $('#pleaseWaitDialog').modal('hide');
                    $("#error").html(data);
                }
            });

        });


        $('#ResetPassword').click(function ()
        {

            var state=false;
            if(password("Oldpassword","please enter 4 to 15 letters password",4,15))
                state=true;
            if(password("password1","please enter 4 to 15 letters password",4,15))
                state=true;

            if(password("password2","please enter 4 to 15 letters password",4,15))
                state=true;
            if(matchesTwoIdBySting("password1","password2","Please new password not match"))
                state=true;

            if(state)
                return false;
            var formdata = new FormData($("#formLogin")[0]);
            formdata.append("option", "ResetPassword");
            formdata.append("userid", "<?php echo $userid;?>");
            $.ajax({
                url: "userServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#pleaseWaitDialog').modal();
                },
                success: function (data) {
                    $('#pleaseWaitDialog').modal('hide');
                    $("#formLogin")[0].reset();
                    $("#error").html(data);
                }
            });


        });
    });


</script>
<?php
include('../companyDashboard/includes/scripts.php');
include('../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>