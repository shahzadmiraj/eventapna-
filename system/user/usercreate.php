<?php

include_once ("../../connection/connect.php");
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



    <style>
    </style>
</head>
<body>
<?php
include_once ("../../webdesign/header/header.php");
?>



<div class="jumbotron  shadow" style="background-image: url(https://thumbs.dreamstime.com/z/helping-hand-people-join-up-connection-person-new-partner-member-hire-social-group-website-32301883.jpg);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-body text-center" style="opacity: 0.7 ;background: #fdfdff;">
        <h3 ><i class="fas fa-user-plus fa-4x"></i> Add User </h3>
        <p>add new user to access your company</p>
        <a href="../../company/companyRegister/companyEdit.php " class="col-6 btn btn-info"> <i class="fas fa-city mr-2"></i>Edit Company</a>

    </div>

</div>


    <form id="form" class="card container-fluid" >
        <div class="col-12 card shadow p-4 mb-3">
            <div class="form-group row">
                <label for="username" class="col-form-label">User Name</label>


                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" id="username" name="username" class="form-control" placeholder="User Name" >
                </div>


            </div>
            <div class="form-group row">
                <label for="password" class="col-form-label">Password</label>



                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" id="password" name="password" class="form-control" placeholder="Password">
                </div>


            </div>


            <div class="form-group row">
                <label for="usertype" class="col-form-label">Type of User:</label>
                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-award"></i></span>
                    </div>
                    <select name="usertype" class="form-control">
                        <option value="Owner">Owner (Company And Order Management)</option>
                        <option value="Manager">Manager (Order Management)</option>
                        <option value="Viewer">Viewer (Order Viewer)</option>
                    </select>
                </div>
            </div>




        </div>
        <input id="customer" hidden value="">
        <div class="form-group row">
            <label for="number" class="col-form-label">Phone no:</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                </div>
                <input id="number"class="allnumber form-control" name="number[]"  placeholder="Phone no 0323xxxxx">
                <input type="button" class="form-control btn-primary col-2" id="Add_btn" value="+">

            </div>



        </div>
        <div class="col-12" id="number_records">
            <p> extra numbers</p>
        </div>
        <div class="form-group row">
            <label for="name" class="col-form-label"> Name:</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                </div>
                <input type="text" id="name"  name="name"class="form-control"  placeholder="full name" >
            </div>


        </div>
        <div class="form-group row">
            <label for="name" class="col-form-label">Image:</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input type="file"  name="image"  class="form-control " >
            </div>



        </div>
        <div class="form-group row">
            <label for="cnic" class="col-form-label "> CNIC:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-id-card"></i></span>
                </div>
                <input type="number" id="cnic" name="cnic" class="form-control" placeholder="your CNIC" >
            </div>
        </div>


<h3 align="center"><i class="fas fa-map-marker-alt"></i> Address (optional)</h3>
        <div class="form-group row">
            <label for="city" class="col-form-label"> City:</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                </div>
                <input type="text" id="city" name="city" class="form-control " placeholder="City">
            </div>




        </div>

        <div class="form-group row">
            <label for="area" class="col-form-label "> Area/ Block:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-road"></i></span>
                </div>
                <input type="text"  id="area" name="area" class="form-control" placeholder="Area/ Block">
            </div>



        </div>

        <div class="form-group row">
            <label for="streetNo" class="col-form-label ">Street No :</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                </div>
                <input type="number" id="streetNo" name="streetNo" class="form-control" placeholder="Street No">
            </div>


        </div>

        <div class="form-group row">
            <label for="houseNo" class="col-form-label">House No:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                </div>
                <input type="number" id="houseNo" name="houseNo" class="form-control" placeholder="House No">
            </div>



        </div>

        <div class="form-group row justify-content-center">
        <button class="col-6 form-control btn btn-danger" id="cancelCustomer"><i class="fas fa-window-close"></i>Cancel</button>
        <button class="col-6 form-control btn btn-primary" id="submit"><i class="fas fa-check "></i>Submit</button>
        </div>
    </form>

<?php
include_once ("../../webdesign/footer/footer.php");
?>

<script>


    $(document).ready(function ()
    {
        $("#cancelCustomer").click(function () {
            window.history.back();
            return false;
        });
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
                "                <label for=\"number_"+number+"\" class=\"col-4 col-form-label\"><i class=\"fas fa-phone-volume\"></i>Phone no:</label>\n" +
                "                <input id=\"number_"+number+"\" class=\"allnumber form-control col-6\" type=\"number\" name=\"number[]\">\n" +
                "                <input class=\"form-control btn btn-danger col-2 remove_number \" id=\"remove_numbers_"+number+"\" data-removenumber=\""+number+"\" value=\"-\">\n" +
                "            </div>");
            number++;
        });

        $(document).on("click",".remove_number",function () {
            var id=$(this).data("removenumber");
            $("#Each_number_row_"+id).remove();
            number--;
        });

        $("#submit").click(function (e) {
            e.preventDefault();

            if(!(($("#username").val().length>5) && ($("#username").length<9)))
            {
                alert("Username must be 6 to 8 letters");
                return false;
            }
            if(!(($("#password").val().length>5) && ($("#password").length<9)))
            {
                alert("password must be 6 to 8 letters");
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
                url:"userServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,
                success:function (data)
                {

                    if(data!="")
                    {
                        alert(data);
                        return false;
                    }
                    else
                    {
                        window.history.back();

                    }
                }
            });

        });
    });

</script>

</body>
</html>
