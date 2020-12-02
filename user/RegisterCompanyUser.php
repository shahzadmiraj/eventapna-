<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
include  ("../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner","../index.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$companyid=$userdetail[0][0];

include('../companyDashboard/includes/startHeader.php'); //html

?>

    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Company User Register</title>
    <meta name="description" content="Company User Register  page
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Company User Register page Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

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



<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><i class="fas fa-registered"></i> Add User</h1>
        <h4 id="error"></h4>
    </div>
</div>

<div class="container" >
    <form class="row" id="formLogin">
        <input type="hidden" name="Companyid" value="<?php echo $companyid;?>">

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">User Name</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input id="username" type="text" class="form-control" name="username" placeholder="Username">
            </div>
        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6 ">
            <label class="col-form-label">Email</label>
            <div class="input-group mb-3 input-group-lg ">
                <div class="input-group-prepend ">
                    <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                </div>
                <input id="Email" type="text" class="form-control" name="Email" placeholder="Email ">
            </div>
        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6" >
            <label class="col-form-label">Phone No:<small>03XXXXXXXXX | 03XX-XXXXXXXXX | +92XXXXXXXX </small></label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input id="PhoneNo" type="text" class="form-control" name="PhoneNo" placeholder="Phone No 03XXXXXXXX">
            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6"  >
            <label class="col-form-label">Image (Optional)</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera-retro"></i></span>
                </div>
                <input id="Image" type="file" class="form-control" name="image" >
            </div>
        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6 ">
            <label class="col-form-label">Job Status</label>
            <div class="input-group mb-3 input-group-lg ">
                <div class="input-group-prepend ">
                    <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                </div>
                <select  name="jobtitle" class="form-control">
                    <option value="Owner">Owner of company</option>
                    <option value="Employee">Working Employee At company</option>
                    <option value="Viewer">Viewer (Only View Orders of Company)</option>
                </select>
            </div>
        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Password</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input id="password" type="password" class="form-control" name="password" placeholder="Password">
            </div>
        </div>


            <p class="col-sm-12   col-12 col-md-12 col-lg-12 text-center">
                <input type="checkbox" name="checkbox" value="check" id="agree" class="form-check-inline" /> I have read and agree to the <a href="../Policy/TermsConditions.php">Terms and Conditions and Privacy Policy</a>
            </p>
        <div class="col-sm-12   col-12 col-md-12 col-lg-12 form-inline">
            <button  type="button" class="cancelform  btn btn-danger col-sm-6   col-6 col-md-6 col-lg-6" ><span class="fas fa-window-close "></span>  Cancel</button>

            <button id="login" type="button" class="btn btn-primary col-sm-6   col-6 col-md-6 col-lg-6 "  ><i class="fas fa-sign-in-alt"></i> Sign UP</button>
        </div>


    </form>
</div>

<script>

    $(document).ready(function ()
    {
        $.getScript("../webdesign/JSfile/JSFunction.js");


        $(".cancelform").click(function ()
        {
            window.history.back();
        });
        $('#login').click(function ()
        {


            var state=false;
            if(validateEmailByString("Email","Please enter valid Email"))
                state=true;
            if(password("password","please enter 4 to 15 letters password",4,8))
                state=true;

            if(validatePakistaniNumberByString("PhoneNo"))
                state=true;
            if(validationWithString("username","please enter username "))
                state=true;

            if($("#agree").prop("checked")==false)
            {
                alert("Please Accept Terms & Conditions");
                state=true;
            }

            if(state)
                return false;

            var formdata = new FormData($("#formLogin")[0]);
            formdata.append("option","RegisterUserofCompany");
            $.ajax({
                url: "userServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function () {
                    $('#pleaseWaitDialog').modal();
                },
                success: function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    if($.trim(data)!='')
                    {
                        $("#error").html(data);
                    }
                    else
                    {
                        alert("Please check Email for verification");
                        $("#formLogin")[0].reset();
                        $("#error").html("Please check Email for verification");
                    }

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
