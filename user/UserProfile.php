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
if((!isset($_GET['uid']))||(!isset($_GET['token'])))
{
 header("location:../index.php");
}
$UserProfileId=$_GET['uid'];
$userToken=$_GET['token'];
$sql='SELECT `id`, `username`, (SELECT company.name FROM company WHERE company.id=user.`company_id`), `image`, `jobTitle`, `email`, `number`, `token` FROM `user` WHERE (id='.$UserProfileId.')AND(ISNULL(expire))AND(token="'.$userToken.'")AND(company_id=(SELECT `company_id` FROM `user` WHERE id='.$_COOKIE['userid'].' LIMIT 1))';
$userdetail=queryReceive($sql);
if(count($userdetail)==0)
{
    header("location:../index.php");
}
$userid=$_COOKIE['userid'];

include('../companyDashboard/includes/startHeader.php'); //html

?>

    <?php
    include('../webdesign/header/InsertHeaderTag.php');

    ?>
    <title>User Profile</title>
    <meta name="description" content="User profile page
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="User profile page Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


<link rel="stylesheet" type="text/css" href="<?php echo $Root;?>bootstrap.min.css">
<script src="<?php echo $Root;?>jquery-3.3.1.js"></script><!--
<script type="text/javascript" src="<?php /*echo $Root;*/?>bootstrap.min.js"></script>-->
<link rel="stylesheet" href="<?php echo $Root;?>webdesign/css/loader.css">
<!--<link rel="stylesheet" href="../webdesign/css/complete.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
<script src="<?php echo $Root;?>webdesign/JSfile/JSFunction.js"></script>

<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->

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
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">User Profile</h1>
        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>
</div>

<form class="container row" id="formLogin">
    <input type="hidden" name="profileUserid" value="<?php echo $userdetail[0][0];?>">
    <input type="hidden" name="changeByCurrentlyUserName" value="<?php echo $userdetail[0][1];?>">
    <input type="hidden" name="changeByCurrentlyEmail" value="<?php echo $userdetail[0][5];?>">

    <input type="hidden" name="CurrentUserid" value="<?php echo $userid;?>">

        <img  src="<?php
        if(file_exists('../images/users/'.$userdetail[0][3])&&($userdetail[0][3]!=""))
        {
            echo '../images/users/'.$userdetail[0][3];

        }
        else
        {
            echo '../images/systemImage/imageNotFound.png';
        }

        ?>" class="card-img-top col-sm-12   col-12 col-md-6 col-lg-6" style="width: 200px;height: 200px">
    <div class="col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">Company Name</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-city mr-2"></i></span>
            </div>
            <input readonly id="CompanyName" type="text" class="form-control" name="CompanyName" placeholder="name of your company" value="<?php echo $userdetail[0][2]; ?>">
        </div>
    </div>
    <div class="col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">Email</label>
        <div class="input-group mb-3 input-group-lg ">
            <div class="input-group-prepend ">
                <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
            </div>
            <input readonly id="Email" type="text" class="form-control" name="Email" placeholder="Email "  value="<?php echo $userdetail[0][5]; ?>">
        </div>
    </div>


    <div class="col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">User Name</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input id="username" type="text" class="form-control" name="username" placeholder="Username"  value="<?php echo $userdetail[0][1]; ?>">
        </div>
    </div>





    <div class="col-sm-12   col-12 col-md-6 col-lg-6" >
        <label class="col-form-label">Phone No:<small>03XXXXXXXXX | 03XX-XXXXXXXXX | +92XXXXXXXX </small></label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone"></i></span>
            </div>
            <input  id="PhoneNo" type="text" class="form-control" name="PhoneNo" placeholder="Phone No 03XXXXXXXX"  value="<?php echo $userdetail[0][6]; ?>">
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
            <select    name="jobtitle" class="form-control">



                <?php
                $sql='SELECT `jobTitle`FROM `user` WHERE id='.$userid;
                $userStatus=queryReceive($sql);
                if($userStatus[0][0]!="Owner")
                {

                    //Current user is not Owner then show Only his status
                    if ($userdetail[0][4] == "Employee") {

                        echo '  
                                            <option value="Employee">Working Employee At company</option>';
                    } else if ($userdetail[0][4] == "Viewer") {

                        echo '  
                                              <option value="Viewer">Viewer (Only View Orders of Company)</option>  
                                  
                                            ';
                    }

                }
                else {
                    //Current user is Owner then show ALL

                    if ($userdetail[0][4] == "Owner") {
                        echo '    <option value="Owner">Owner of company</option>
                            <option value="Employee">Working Employee At company</option>
                            <option value="Viewer">Viewer (Only View Orders of Company)</option>';
                    } else if ($userdetail[0][4] == "Employee") {

                        echo '  
                            <option value="Employee">Working Employee At company</option>
                            <option value="Viewer">Viewer (Only View Orders of Company)</option>
                              <option value="Owner">Owner of company</option>';
                    } else if ($userdetail[0][4] == "Viewer") {

                        echo '  
                              <option value="Viewer">Viewer (Only View Orders of Company)</option>  
                              <option value="Owner">Owner of company</option>
                            <option value="Employee">Working Employee At company</option>
                            ';
                    }
                }
                ?>"
            </select>
        </div>
    </div>


    <div class="form-inline col-sm-12   col-12 col-md-12 col-lg-12">
        <button id="back" type="button" class="btn btn-secondary col-sm-6  col-6 col-md-6 col-lg-6"  ><< Back </button>
        <button id="Save" type="button" class="btn btn-success col-sm-6   col-6 col-md-6 col-lg-6"  ><i class="fas fa-sign-in-alt"></i> Save </button>
    </div>


    <div class="card-footer container">



        <div class="d-flex justify-content-center links">
            Change your password? <a href="ResetPassword.php" class="ml-2"> Reset Password</a>
        </div>
        <div class="d-flex justify-content-center">
            <a href="logout.php">Sign Out</a>
        </div>

    </div>

</form>




<script>

    $(document).ready(function ()
    {

        $.getScript("../webdesign/JSfile/JSFunction.js");

        $("#back").click(function () {
            window.history.back();
        });

        $('#Save').click(function ()
        {


            var state=false;


            if(validatePakistaniNumberByString("PhoneNo"))
                state=true;

            if(validationWithString("username","please enter username "))
                state=true;


            if(state)
                return false;
            var formdata = new FormData($("#formLogin")[0]);
            formdata.append("option", "saveandChangeLogin");
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

                    if($.trim(data)!='')
                    {
                        alert(data);
                    }
                    location.reload();

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


