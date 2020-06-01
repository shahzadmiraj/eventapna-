<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$companyid=$userdetail[0][0];
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script type="text/javascript" src="../webdesign/JSfile/JSFunction.js"></script>

    <link rel="stylesheet" type="text/css" href="../webdesign/css/complete.css">

<style>

</style>

</head>
<body>
<?php
//include_once ("../webdesign/header/header.php");
?>
<div class="container">

    <div class="row ">
        <div class="col-md-4">
        </div>

        <div class="col-md-8  " style="background-color: rgba(219,188,219,0.58) !important;">
            <h1 class="mb-5 mt-5 text-white"><i class="fas fa-sign-in-alt"></i>Sign Up in company</h1>
            <h4 id="error"></h4>
            <form class="col-12" id="formLogin">
                <input type="hidden" name="Companyid" value="<?php echo $companyid;?>">

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


                <div class="form-group row" >
                    <label class="col-form-label">Phone No</label>
                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input id="PhoneNo" type="text" class="form-control" name="PhoneNo" placeholder="Phone No 03XXXXXXXX">
                    </div>
                </div>

                <div class="form-group row"  >
                    <label class="col-form-label">Image (Optional)</label>
                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-camera-retro"></i></span>
                        </div>
                        <input id="Image" type="file" class="form-control" name="Image" >
                    </div>
                </div>

                <div class="form-group row ">
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


                <div class="form-group row">
                    <label class="col-form-label">Password</label>
                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">
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
<!--                        Already have a account<a href="userLogin.php">Sign In</a>-->
                    </div>
                </div>

            </form>
        </div>
    </div>


</div>




<?php
//include_once ("../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function ()
    {


        $('#login').click(function ()
        {


            var state=false;
            if(validateEmailByString("Email","Please enter valid Email"))
                state=true;
            if(password("password","please enter 4 to 8 digits password",4,8))
                state=true;
            if(validationWithString("PhoneNo","please enter phone no "))
                state=true;

            if(validationWithString("username","please enter username "))
                state=true;

            if($("#agree").prop("checked")==false)
            {
                alert("please checkbox fill ");
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
                    $("#preloader").show();
                },
                success: function (data)
                {
                    $("#preloader").hide();
                    if(data!="")
                    {
                        $("#formLogin")[0].reset();
                        $("#error").html(data);
                    }

                }
            });


        });
    });


</script>
</body>
</html>
