<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");


if(isset($_COOKIE["companyid"])&(!isset($_GET['action'])))
{

    header('location:../company/companyRegister/companydisplay.php');
   exit();
}


?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <meta charset="utf-8">
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
<div class="container text-white font-weight-bold">

<div class="col-sm-12 col-xl-6 col-md-8 col-12 m-auto  card " style="background-color: rgba(219,188,219,0.58)  !important;">
    <h1 class="mb-5 mt-5 text-white"><i class="fas fa-sign-in-alt"></i> Sign in</h1>
    <form class="col-12" id="formLogin">
    <div class="form-group row">
        <label class="col-form-label">User Name</label>


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input id="username" type="text" class="form-control" name="username" placeholder="Username">
        </div>




    </div>
        <div class="form-group row">
            <label class="col-form-label">Password</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input id="password" type="password" class="form-control" name="password" placeholder="Password">

            </div>
        </div>

        <div class="row">
            <button id="login" type="button" class="btn btn-warning form-control "  value="Sign in"><i class="fas fa-sign-in-alt"></i> Sign in</button>
        </div>
    </form>
    <div class="card-footer">
        <div class="d-flex justify-content-center links">
            Don't have an account?<a href="#">Sign Up</a>
        </div>
        <div class="d-flex justify-content-center">
            <a href="#">Forgot your password?</a>
        </div>
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
               formdata.append("option", "login");
               $.ajax({
                   url: "userServer.php",
                   method: "POST",
                   data: formdata,
                   contentType: false,
                   processData: false,

                   beforeSend: function () {
                       $("#preloader").show();
                   },
                   success: function (data) {
                       $("#preloader").hide();

                       if (data != '') {
                           alert(data);
                       } else {
                           location.reload();
                       }

                   }
               });


       });
    });


</script>
</body>
</html>
