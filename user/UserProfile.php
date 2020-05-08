<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");

$UserProfileId=$_GET['uid'];
$sql='SELECT `id`, `username`, (SELECT company.name FROM company WHERE company.id=user.`company_id`), `image`, `jobTitle`, `email`, `number`, `token` FROM `user` WHERE (id='.$UserProfileId.')AND(ISNULL(expire))';
$userdetail=queryReceive($sql);
$userid=$_COOKIE['userid'];

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

    <script type="text/javascript" src="../webdesign/JSfile/JSFunction.js"></script>

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
            <h1 class="mb-5 mt-5 text-white"><i class="fas fa-user"></i> User Profile</h1>
            <h4 id="error"> </h4>
            <form class="col-12" id="formLogin">
                <input type="hidden" name="profileUserid" value="<?php echo $userdetail[0][0];?>">

                <input type="hidden" name="CurrentUserid" value="<?php echo $userid;?>">

                <center>
                <img  src="
                <?php
                if(file_exists('../images/users/'.$userdetail[0][3])&&($userdetail[0][3]!=""))
                {
                    echo '../images/users/'.$userdetail[0][3];

                }
                else
                {
                    echo 'https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';
                }

                ?>

                       " class="card-img-top " style="width: 50%;height: 20vh">
                </center>
                <div class="form-group row">
                    <label class="col-form-label">Company Name</label>
                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-city mr-2"></i></span>
                        </div>
                        <input readonly id="CompanyName" type="text" class="form-control" name="CompanyName" placeholder="name of your company" value="<?php echo $userdetail[0][2]; ?>">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-form-label">User Name</label>
                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input id="username" type="text" class="form-control" name="username" placeholder="Username"  value="<?php echo $userdetail[0][1]; ?>">
                    </div>
                </div>


                <div class="form-group row ">
                    <label class="col-form-label">Email</label>
                    <div class="input-group mb-3 input-group-lg ">
                        <div class="input-group-prepend ">
                            <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                        </div>
                        <input readonly id="Email" type="text" class="form-control" name="Email" placeholder="Email "  value="<?php echo $userdetail[0][5]; ?>">
                    </div>
                </div>


                <div class="form-group row" >
                    <label class="col-form-label">Phone No;0923213315000,+92 1213315000,+9223432432432</label>
                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input  id="PhoneNo" type="text" class="form-control" name="PhoneNo" placeholder="Phone No 03XXXXXXXX"  value="<?php echo $userdetail[0][6]; ?>">
                    </div>
                </div>

                <div class="form-group row"  >
                    <label class="col-form-label">Image (Optional)</label>
                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-camera-retro"></i></span>
                        </div>
                        <input id="Image" type="file" class="form-control" name="image" >
                    </div>
                </div>

                <div class="form-group row ">
                    <label class="col-form-label">Job Status</label>
                    <div class="input-group mb-3 input-group-lg ">
                        <div class="input-group-prepend ">
                            <span class="input-group-text"><i class="fas fa-envelope-square"></i></span>
                        </div>
                        <select name="jobtitle" class="form-control">

                            <?php
                            if($userdetail[0][4]=="Owner")
                            {
                                echo '    <option value="Owner">Owner of company</option>
                            <option value="Employee">Working Employee At company</option>
                            <option value="Viewer">Viewer (Only View Orders of Company)</option>';
                            }
                            else if($userdetail[0][4]=="Employee")
                            {

                                echo '  
                            <option value="Employee">Working Employee At company</option>
                            <option value="Viewer">Viewer (Only View Orders of Company)</option>
                              <option value="Owner">Owner of company</option>';
                            }
                            else if($userdetail[0][4]=="Viewer")
                            {

                                echo '  
                              <option value="Viewer">Viewer (Only View Orders of Company)</option>  
                              <option value="Owner">Owner of company</option>
                            <option value="Employee">Working Employee At company</option>
                            ';
                            }
                                ?>"
                        </select>
                    </div>
                </div>






                <div class="card-footer">

                    <div class="row">
                        <button id="back" type="button" class="btn btn-secondary  col-6"  ><< Back </button>
                        <button id="Save" type="button" class="btn btn-success  col-6"  ><i class="fas fa-sign-in-alt"></i> Save </button>
                    </div>

                    <div class="d-flex justify-content-center links">
                        Change your password? <a href="ResetPassword.php" class="ml-2"> Reset Password</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="logout.php">Sign Out</a>
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

        $("#back").click(function () {
            window.history.back();
        });

        $('#Save').click(function ()
        {


            var state=false;

            if(validationWithString("PhoneNo","please enter phone no "))
                state=true;

            if(validationWithString("username","please enter username "))
                state=true;

            if(PhoneNumberCheck("PhoneNo"))
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
                    $("#preloader").show();
                },
                success: function (data) {
                    $("#preloader").hide();

                    if (data != '') {
                        $("#error").html(data);
                    } else
                    {
                       location.reload();
                    }

                }
            });


        });
    });


</script>
</body>
</html>





