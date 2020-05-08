<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");

function ISnullvalidationofuser($email)
{
    $sql='SELECT `id` FROM `user` WHERE email="'.$email.'"';
    $result=queryReceive($sql);
    if(count($result)>0)
        return false;
    else
        return  true;
}


function validationOfUserInSession($id,$confirm)
{

    $state=false;
    global $connect,$timestamp;
    $sql='SELECT `id`, `username`, `password`, `active`, `expire`, `senderId`, `companyName`, `image`, `jobTitle`, `email`, `number`,`isMakeCompany`,`Companyid`  FROM `userSession` WHERE (id='.$id.')AND(senderId="'.$confirm.'")';
    $UserDetails=queryReceive($sql);
    if(count($UserDetails)==1)
    {
        if($UserDetails[0][4]=="")
        {
            if(ISnullvalidationofuser($UserDetails[0][9]))
            {
                $state=true;
                $companyid=$UserDetails[0][12];
                if(($UserDetails[0][11]==1)||($UserDetails[0][8]=="User"))
                {
                    $companyid='"NULL"';

                }
                $sql='INSERT INTO `user`(`id`, `username`, `password`, `company_id`, `active`, `image`, `expire`, `jobTitle`, `email`, `number`, `token`) VALUES (
NULL,"'.$UserDetails[0][1].'","'.$UserDetails[0][2].'",'.$companyid.',"'.$timestamp.'","'.$UserDetails[0][7].'",NULL,"'.$UserDetails[0][8].'","'.$UserDetails[0][9].'","'.$UserDetails[0][10].'","'.$UserDetails[0][5].'")';
                querySend($sql);
                $last=mysqli_insert_id($connect);
                //company registered
                if($UserDetails[0][11]==1)
                {
                    //create a company of that owner
                    $sql='INSERT INTO `company`(`id`, `name`, `expire`, `user_id`, `active`) VALUES (NULL,"'.$UserDetails[0][6].'",NULL,'.$last.',"'.$timestamp.'")';
                    querySend($sql);
                    $companyid= mysqli_insert_id($connect);
                    $sql='UPDATE user as u SET  u.company_id='.$companyid.' WHERE u.id='.$last.'';
                    querySend($sql);
                }

                $sql='UPDATE `userSession` SET `expire`="'.$timestamp.'" WHERE id='.$UserDetails[0][0].'';
                querySend($sql);

            }
        }
    }
    return $state;
}

$display='';
if((isset($_GET['id']))AND(isset($_GET['confirm'])))
{
    if(validationOfUserInSession($_GET['id'],$_GET['confirm']))
    {
        $display='<span class="alert-success">you have successfully registered</span>';
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
//include_once ("../webdesign/header/header.php");
?>
<div class="container">

    <div class="row ">
        <div class="col-md-4">
        </div>

        <div class="col-md-8  " style="background-color: rgba(219,188,219,0.58) !important;">
            <h1 class="mb-5 mt-5 text-white"><i class="fas fa-sign-out-alt"></i> Sign In</h1>
            <h4 id="error"> <?php echo $display; ?> </h4>
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
                    <button id="login" type="button" class="btn btn-warning form-control "  ><i class="fas fa-sign-in-alt"></i>  Sign In</button>
                </div>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        Forgot your password?  <a href="#"> Send Password</a>
                    </div>
                    <div class="d-flex justify-content-center links">
                       Dont have account?  <a href="RegisterLogin.php"><i class="fas fa-sign-out-alt"></i> Sign UP</a>
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

            var state=false;

            if(validationWithString("UserName","please enter username "))
                state=true;

            if(password("password","please enter 4 to 8 digits password",4,8))
                state=true;
            if(state)
                return false;

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

                 if(data=="back")
                 {
                     window.history.back();
                 }
                 else if(data=="companyUser")
                 {
                     location.replace("../company/companyRegister/companyAdminPanel.php");
                 }
                 else
                 {
                     $("#error").html(data);
                 }


                }
            });


        });
    });


</script>
</body>
</html>
