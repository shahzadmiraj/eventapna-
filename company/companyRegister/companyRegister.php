<?php


include_once ('../../connection/connect.php');
if(isset($_COOKIE['companyid']))
{
    header("location:companyEdit.php");
}

?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <style>

        form
        {
            margin: 5%;
            font-weight: bold;

        }

    </style>
</head>
<body>
<?php
include_once ("../../webdesign/header/header.php");
?>

<div class="jumbotron  shadow " style="background-image: url(https://i2.wp.com/findlawyer.com.ng/wp-content/uploads/2018/05/Pros-and-Cons-of-Working-at-Large-Companies.jpg?resize=1024%2C512&ssl=1);background-size:100% 115%;background-repeat: no-repeat;">

    <div class="text-center transparencyjumbo">
        <h1 class="text-center"><i class="fas fa-registered"></i> Free Company Register</h1>
    </div>
</div>


<div class="container">
    <div class="card">
<form>
    <div  class="form-group row">
    <label  class="form-check-label">Company Name</label>
<!--    <input id="companyName" class="form-control" type="text" name="companyName">-->

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text" ><i class="fas fa-building"></i>
                </span>
            </div>
            <input required placeholder="Your Company Name" id="companyName"  class="form-control" type="text" name="companyName">
        </div>


    </div>




    <div class="form-group row">
        <label for="username" class="col-form-label  ">User Name</label>
<!--        <input type="text" id="username" name="username" class="form-control ">-->

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input placeholder="User Name"  type="text" id="username" name="username" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="password" class="col-form-label ">Password</label>
<!--        <input type="text" id="password" name="password" class="form-control ">-->

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input placeholder="Password"  type="password" id="password" name="password" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label for="password1" class="col-form-label ">Confirm Password</label>


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input type="password" id="password1" name="password1" class="form-control" placeholder="Confirm password">
        </div>

    </div>
    <div class="form-group row">
        <label for="number" class="col-form-label">Phone no:</label>
<!--        <input type="number" id="number" class="allnumber form-control col-8" name="number[]"  >-->

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
            </div>
            <input  placeholder="Phone no"  id="number" type="number" class="form-control allnumber" name="number[]">
            <input type="button" class="col-3 btn-primary" id="Add_btn" value="+">
        </div>
    </div>
    <div class="col-12" id="number_records">


    </div>
    <div class="form-group row">
        <label for="name" class="col-form-label"> Name:</label>
<!--        <input type="text" id="name"  name="name" class="form-control " >-->


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-address-book"></i></span>
            </div>
            <input  placeholder="Your Name"  type="text" id="name"  name="name" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-form-label">Image:</label>


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-camera"></i></span>
            </div>
            <input type="file"  name="image"  class="form-control" >
        </div>



    </div>


    <div class="form-group row">
        <label for="cnic" class="col-form-label "> CNIC:</label>
<!--        <input type="number" id="cnic" name="cnic" class="form-control" >-->



        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-id-card"></i></span>
            </div>
            <input  placeholder="your CNIC" type="number" id="cnic" name="cnic" class="form-control">
        </div>
    </div>

    <h3 align="center"><i class="fas fa-map-marker-alt"></i> Address (optional)</h3>

    <div class="form-group row">
        <label for="city" class="col-form-label "> City:</label>
<!--        <input type="text" id="city" name="city" class="form-control " >-->


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-city"></i></span>
            </div>
            <input   placeholder="City"  type="text" id="city" name="city" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="area" class="col-form-label "> Area/ Block:</label>
<!--        <input type="text"  id="area" name="area" class="form-control ">-->


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-road"></i></span>
            </div>
            <input placeholder="Area/ Block"  type="text"  id="area" name="area" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="streetNo" class="col-form-label ">Street No :</label>
<!--        <input type="number" id="streetNo" name="streetNo" class="form-control">-->


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-street-view"></i></span>
            </div>
            <input placeholder="Street No"  type="number" id="streetNo" name="streetNo" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="houseNo" class="col-form-label ">House No:</label>
<!--        <input type="number" id="houseNo" name="houseNo" class="form-control">-->



        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-home"></i></span>
            </div>
            <input placeholder="House No"  type="number" id="houseNo" name="houseNo" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <button class="col-6 form-control btn btn-danger" id="cancelCustomer"><i class="fas fa-window-close"></i>Cancel</button>
        <button type="submit" class="col-6 form-control btn btn-primary" id="submit"><i class="fas fa-check "></i>Submit</button>
    </div>
</form>
    </div>
</div>

<!--
<div class="input-group mb-3 input-group-lg">
    <div class="input-group-prepend">
        <span class="input-group-text">Large</span>
    </div>
    <input type="text" class="form-control">
</div>-->

<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function ()
    {
        var number=0;
        $('.number_records').map(function () {
            number++;
        }).get().join();

        $("#Add_btn").click(function ()
        {
            if(number>1)
            {
                alert("no of numbers not more then 3");
                return false;
            }
            $("#number_records").append("<div class=\"form-group row\" id=\"Each_number_row_"+number+"\">\n" +
                "                <label for=\"number_"+number+"\" class=\"col-2 col-form-label\">Phone no:</label>\n" +
                "                <input id=\"number_"+number+"\" class=\"allnumber form-control col-8\" type=\"number\" name=\"number[]\">\n" +
                "                <input class=\"form-control btn btn-danger col-2 remove_number \" id=\"remove_numbers_"+number+"\" data-removenumber=\""+number+"\" value=\"-\">\n" +
                "            </div>");



            number++;
        });

        $(document).on("click",".remove_number",function () {
            var id=$(this).data("removenumber");
            $("#Each_number_row_"+id).remove();
            number--;
        });


        $("#submit").click(function (e)
        {
            e.preventDefault();

            if(!(($("#username").val().length>5) && ($("#username").length<19)))
            {
                alert("Username must be 6 to 18 letters");
                return false;
            }
            if(!(($("#password").val().length>5) && ($("#password").length<19)))
            {
                alert("password must be 6 to 18 letters");
                return false;
            }
            if($("#password1").val()!=($("#password").val()))
            {

                alert("password does not match");
                return false;
            }
            if($.trim($("#number").val())=="")
            {
                alert("number must be enter");
                return false;
            }
            if($.trim($("#name").val())=="")
            {

                alert("name must be enter");
                return false;
            }
            var formdata=new FormData($('form')[0]);
            formdata.append("option","createUser");
            $.ajax({
                url:"../companyServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();

                    if(data!="")
                    {
                        alert(data);
                        return false;
                    }
                    else
                    {

                        window.location.href='companydisplay.php';

                    }
                }
            });

        });


    });



</script>
</body>
</html>