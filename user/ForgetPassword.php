<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");

?>
<!DOCTYPE html>
<head>
    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>User Forgot Password</title>
    <meta name="description" content="User Forgot Password  page
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="User Forgot Password page Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">



    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <script type="text/javascript" src="../webdesign/JSfile/JSFunction.js"></script>

    <link rel="stylesheet" href="../webdesign/css/complete.css">


    <style>


        body{
            background-image: url('https://i.pinimg.com/originals/cc/48/3b/cc483b945cf746255339655b2a5f25b3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Numans', sans-serif;
            width: 100%;
            height: 100%;
        }

    </style>
</head>
<body>
<?php
include_once ("../webdesign/header/header.php");
?>
<div class="container">

    <div class="row ">
        <div class="col-md-4">
        </div>

        <div class="col-md-8  " style="background-color: rgba(219,188,219,0.58) !important;">
            <h1 class="mb-5 mt-5 text-white"><i class="fas fa-sign-out-alt"></i> Forget password</h1>
            <h4 id="error"> </h4>
            <form class="col-12" id="formLogin">




                <div class="form-group row">
                    <label class="col-form-label">UserName</label>

                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input id="UserName" type="text" class="form-control" name="UserName" placeholder="Username">
                    </div>
                </div>
                    <h1 align="center" class="text-white">or</h1>



                <div class="form-group row ">
                    <label class="col-form-label">Email</label>
                    <div class="input-group mb-3 input-group-lg ">
                        <div class="input-group-prepend ">
                            <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                        </div>
                        <input  id="Email" type="text" class="form-control" name="Email" placeholder="Email " >
                    </div>
                </div>


                <div class="row">
                    <button id="sendForget" type="button" class="btn btn-warning form-control "  ><i class="fas fa-sign-in-alt"></i> Send Email</button>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        already have account?  <a href="userLogin.php"><i class="fas fa-sign-out-alt"></i> Sign in</a>
                    </div>
                </div>

            </form>
        </div>
    </div>


</div>




<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function ()
    {


        $("#sendForget").click(function ()
        {
            var state=false;
            if(validateEmailByString("Email"))
            state=true

            var formdata = new FormData;
            formdata.append("option", "sendForgetpasswordOrUsername");
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


    });


</script>
</body>
</html>

