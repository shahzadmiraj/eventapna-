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
    <title>User Register</title>
    <meta name="description" content="User Register  page
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="User Register page Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <style>


        body{
            background-image: url('https://i.pinimg.com/originals/cc/48/3b/cc483b945cf746255339655b2a5f25b3.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            font-family: 'Numans', sans-serif;
            width: 100%;
            height: 100%;
        }
        .input-group-prepend span{
            width: 50px;
            background-color: #FFC312;
            color: black;
            border:0 !important;
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
            <h1 class="mb-5 mt-5 text-white"><i class="fas fa-sign-in-alt"></i> Sign Up</h1>
            <h4  id="error"></h4>
            <form class="col-12" id="formLogin">
                <input type="hidden" name="option" value="localUser">
                <div class="form-group row">
                    <label class="col-form-label">User Name</label>
                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                </div>


                <div class="form-group row ">
                    <label class="col-form-label">Email</label>
                    <div class="input-group mb-3 input-group-lg ">
                        <div class="input-group-prepend ">
                            <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                        </div>
                        <input id="Email" type="text" class="form-control" name="Email" placeholder="Email ">
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-form-label">Password</label>

                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password1" type="password" class="form-control" name="password" placeholder="Password">

                    </div>
                </div>

                <p class="form-group">
                    <input type="checkbox" name="checkbox" value="check" id="agree" class="form-check-inline" /> I have read and agree to the <a href="#">Terms and Conditions and Privacy Policy</a>
                </p>

                <div class="row">
                    <button id="login" type="button" class="btn btn-warning form-control "  ><i class="fas fa-sign-in-alt"></i> Sign UP</button>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Already have a account<a href="userLogin.php">Sign In</a>
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


        $('#login').click(function ()
        {

            var formdata = new FormData($("#formLogin")[0]);
            formdata.append("option","LocatUserRegisters");
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
                        alert('We have sent an email with a confirmation link to your email address.');
                      /*  $("#exampleModal").reset();*/
                        $("#exampleModal").trigger("reset");
                    }

                }
            });


        });


    });


</script>
</body>
</html>




<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>
