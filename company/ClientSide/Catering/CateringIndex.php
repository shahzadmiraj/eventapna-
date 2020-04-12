<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-15
 * Time: 11:41
 */
include_once ("../../../connection/connect.php");


?>

<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <script src="../../../jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script type="text/javascript" src="../../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../../map/style.css">
    <link rel="stylesheet" href="../../../webdesign/css/card.css">

    <script src="../../../map/javascript.js"></script>


    <style>


        .checked {
            color: orange;
        }

    </style>
</head>
<body>
<div class="container table-light  m-auto ">
    <form method="get" action="" id="formseachHall" >


        <div class="text-white  text-center  row" >
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                </div>
                <input  name="Dishname" type="text" class="form-control py-0" id="Dishname" placeholder="Dish Name ">
            </div>
        </div>



        <div class="text-white  text-center  row" >
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                </div>
                <input  name="cateringname" type="text" class="form-control py-0" id="cateringname" placeholder="Catering Name ">
            </div>
        </div>



        <div class="form-group row">
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input  value="<?php

                if(isset($_GET['address']))
                {
                    echo $_GET['address'];
                }
                ?>" name="address" id="map-search" class="controls form-control" type="text" placeholder="Search Destination" size="104">
            </div>
        </div>


        <div id="map-canvas" style="width:100%;height: 60vh"  ></div>
        <div  hidden>
            <label  for="">Lat: <input name="latitude" id="latitude" type="text" class="latitude"></label>
            <label  for="">Long: <input  name="longitude" id="longitude" type="text" class="longitude"></label>
            <label  for="">City <input name="city" id="reg-input-city" type="text" class="reg-input-city" placeholder="City"></label>
            <label  for="">country <input name="country" type="text" id="reg-input-country" placeholder="country"></label>

        </div>


    </form>
</div>



<div class="container form-inline" id="SHowCatering">

</div>

<div class="container form-inline ">


</div>



<!--

<div class="block ">

    <div class="top">
        <ul>
            <li><a href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a></li>
            <li><span class="converse">Converse</span></li>
            <li><a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i>
                </a></li>
        </ul>
    </div>

    <div class="middle">
        <img src="https://www.converse.com/on/demandware.static/-/Sites-ConverseMaster/default/dw48f5fc3c/images/hi-res/M9621C_standard.png?sw=580&sh=580&sm=fit" alt="pic" />
    </div>

    <div class="bottom">
        <div class="heading">Chuck Taylor All Star Classic Colours</div>
        <div class="info">Classic red converse edition</div>
        <div class="style">Color: Red / Style: M9621C</div>
        <div class="price">$50.00 <span class="old-price">$75.00</span></div>
    </div>

</div>-->

<script>




    $(document).ready(function ()
    {
        $('.carousel').carousel({
            interval: 5000
        });



        $("#Dishname").click(function (e)
        {
            e.preventDefault();
            var date=$("#inlineFormInputGroupUsername2");
            var destination=$("#map-search");
            var latitude=$("#latitude");
            var longitude=$("#longitude");
            var turn=false;

            if(date.val()=="")
            {
                date.addClass("btn-danger");
                turn=true;
            }
            else
            {
                if(date.hasClass("btn-danger"))
                {
                    date.removeClass("btn-danger");
                }

            }
            if((destination.val()=="")||(latitude.val()=="")||(longitude.val()==""))
            {
                destination.addClass("btn-danger");
                turn=true;
            }
            else
            {

                if(destination.hasClass("btn-danger"))
                {
                    destination.removeClass("btn-danger");
                }
            }
            if(turn)
            {
                alert("Please submit Complete form");
                return false;
            }

            var formdata=new FormData($("#formseachHall")[0]);
            formdata.append("action","home");
            $.ajax({
                url:"index.php",
                method:"get",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
                    if(data!='')
                    {
                        alert(data);
                    }
                    else
                    {
                        window.history.back();
                    }
                }
            });
        });
        // $.ajax({
        //     url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initialize",
        //     dataType: "script",
        //     cache: false
        // });

        function showDishes()
        {
            var Dishname=$("#Dishname").val();
            var cateringname=$("#cateringname").val();
            var latitude=$("#latitude").val();
            var longitude=$("#longitude").val();
            var city=$("#reg-input-city").val();
            var country=$("#reg-input-country").val();
           /* if(latitude=="") {
                window.setTimeout(showDishes, 100);
            }*/
            var formdata=new FormData;
            formdata.append("Dishname",Dishname);
            formdata.append("cateringname",cateringname);
            formdata.append("latitude",latitude);
            formdata.append("longitude",longitude);
            formdata.append("city",city);
            formdata.append("country",country);
            formdata.append("option","ShowDishes");
            $.ajax({
                url:"CatServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                   // $("#preloader").show();
                },
                success:function (data)
                {
                    $("#SHowCatering").html(data);
                }
            });

        }
        showDishes();




    });


</script>

</body>
</html>

