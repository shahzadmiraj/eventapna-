<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");

if((isset($_GET['username']))&&(isset($_GET['password'])))
{
    $username=$_GET['username'];
    $password=$_GET['password'];
    if(($username="shahzad123")&&($password=="shahzad123"))
    {
        header("location:../admin/adminpage.php");
    }
}

if(isset($_COOKIE["companyid"])&(!isset($_GET['action'])))
{

    header('location:../company/companyRegister/companydisplay.php');
   exit();
}
$adminlogin='NoAdmin';
if(isset($_GET['action']))
{
    //admin buton
    if($_GET['action']=="admin")
    {
        $adminlogin="YesAdmin";
    }

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


    </style>
</head>
<body style="background-image: url(https://www.saracarboni.com/wp-content/uploads/2017/02/4-wedding-reception-1.jpg);background-size:100% 100%;">
<?php
include_once ("../webdesign/header/header.php");
?>
<div class="container">

    <div class="card-header"></div>
<div class="col-sm-12 col-xl-6 col-md-8 col-12 m-auto  card badge-dark" style="background-color: rgba(0,0,0,0.7) !important;">
    <h1 CLASS="mb-5 mt-5"><i class="fas fa-sign-in-alt"></i> Sign in</h1>
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

        <div class="form-group row">
            <button id="login" type="button" class="form-control btn btn-success"  value="Sign in"><i class="fas fa-sign-in-alt"></i> Sign in</button>
        </div>
    </form>
    </div>
</div>
<div class="card-header"></div>

<div class="card-header"></div>




<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function ()
    {


       $('#login').click(function ()
       {

           var admin="<?php echo $adminlogin;?>";

           if(admin=="YesAdmin")
           {
               var username=$("#username").val();
               var password=$("#password").val();
               window.location.href="?username="+username+"&password="+password;

           }
           else
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
           }

       });
    });


</script>
</body>
</html>
