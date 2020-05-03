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
<div class="container">

    <div class="row ">
        <div class="col-md-4">
        </div>

        <div class="col-md-8  " style="background-color: rgba(219,188,219,0.58) !important;">
            <h1 class="mb-5 mt-5 text-white"><i class="fas fa-key"></i> Reset Password</h1>
            <h4 id="error"> </h4>
            <form class="col-12" id="formLogin">




                <div class="form-group row">
                    <label class="col-form-label">Old Password</label>

                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="Oldpassword" type="password" class="form-control" name="Oldpassword" placeholder="Previous Password">

                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-form-label">New Password</label>

                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password1" type="password" class="form-control" name="password1" placeholder="New Password">

                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-form-label">Confirm Password</label>

                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password2" type="password" class="form-control" name="password2" placeholder="confirm Password">
                    </div>
                </div>


                <div class="row">
                    <button id="ResetPassword" type="submit" class="btn btn-warning form-control "  ><i class="fas fa-check "></i>  Reset Password</button>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Forgot your password?  <a href="#"> Send Password</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                         <a href="#"><i class="fas fa-sign-out-alt"></i> Sign Out</a>
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
                    $("#error").html(data);
                }
            });


        });
    });


</script>
</body>
</html>
