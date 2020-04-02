<?php
include_once ("../../connection/connect.php");
if(!isset($_GET['hall']))
{

    header("location:../companyRegister/companyEdit.php");
}
$encoded=$_GET['hall'];
$id=base64url_decode($encoded);

if((!is_numeric($id))||$id=="")
{
    header("location:../companyRegister/companyEdit.php");
}

$hallname=$_GET['hallname'];
$month=$_GET['month'];
$daytime=$_GET['daytime'];
$hallid=$id;
$companyid=$_COOKIE['companyid'];

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


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="../../calender/customDatepicker/styles.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="../../calender/customDatepicker/multidatespicker.js" type="text/javascript"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>


    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <script type="text/javascript" src="../../webdesign/JSfile/JSFunction.js"></script>

    <style>

        form
        {
            margin: 5%;


        }
        #selectedmenu
        {
            background: #F09819;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #EDDE5D, #F09819);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #EDDE5D, #F09819); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
        #selectmenu
        {
            background: #9796f0;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #fbc7d4, #9796f0);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #fbc7d4, #9796f0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
    </style>
</head>
<body>
<?php
include_once ("../../webdesign/header/header.php");

?>

<div class="jumbotron  shadow" style="background-image: url(https://thumbs.dreamstime.com/z/spicy-dishes-dinner-menu-icon-design-grilled-chicken-curry-sauce-vegetable-stew-pasta-pesto-sauce-ham-curry-84629311.jpg);background-size:100% 115%;background-repeat: no-repeat;">

    <div class="card-body text-center" style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 "><i class="fas fa-plus-square"></i>Add new Package</h1>
        <ol class="list-unstyled">
            <li><i class="fas fa-place-of-worship"></i>Hall name:<?php echo $hallname;?></li>
            <li><i class="fas fa-table"></i>Month:<?php echo $month?></li>
            <li><i class="far fa-clock"></i>Daytime:<?php echo $daytime;?></li>
        </ol>
    </div>
</div>










<div class="container card">







    <div class="form-group row ">
        <lable for="rate" class="col-form-label">Select Dates:</lable>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
            </div>



                <textarea placeholder="Select Dates of active pakages" type="text" id="selectedValues" class="date-values form-control" readonly></textarea>
                <div id="parent" class="container card border-danger p-3" style="display:none;">
                    <div class="row header-row">
                        <div class="col-xs previous">
                            <button type="button" id="previous" onclick="previous()">
                                <i class="fa fa-arrow-left" aria-hidden="true"></i>
                            </button>
                        </div>
                        <div class="card-header month-selected col-sm" id="monthAndYear">
                        </div>
                        <div class="col-sm">
                            <select class="form-control col-xs-6" name="month" id="month" onchange="change()"></select>
                        </div>
                        <div class="col-sm">
                            <select class="form-control col-xs-6" name="year" id="year" onchange="change()"></select>
                        </div>
                        <div class="col-xs next">
                            <button type="button" id="next" onclick="next()">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                    <table id="calendar" class="container">
                        <thead>
                        <tr>
                            <th>Sun</th>
                            <th>Mon</th>
                            <th>Tue</th>
                            <th>Wed</th>
                            <th>Thu</th>
                            <th>Fri</th>
                            <th>Sat</th>
                        </tr>
                        </thead>
                        <tbody id="calendarBody" ></tbody>
                    </table>
                </div>
            </div>





        </div>
    </div>


<div class="container card">



<form id="submitpackage" >






    <?php
    echo '<input hidden type="text" name="month"  value="'.$month.'">
                <input hidden type="text" name="daytime"  value="'.$daytime.'">
                    <input hidden type="text" name="hallid"  value="'.$hallid.'">
                    ';
    ?>


    <div id="shownonperivious">
        <div class="form-group row">
            <lable for="packagename" class="col-form-label">Packages Name</lable>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-hamburger"></i></span>
                </div>
                <input id="packagename" name="packagename" class="form-control" type="text" placeholder="chicken menu,mutton menu">

            </div>
        </div>

        <div class="form-group row">
            <lable for="rate" class="col-form-label">Packages Rate per head</lable>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                </div>
                <input id="rate" name="rate" class="form-control" type="number" placeholder="Price like 1000 per head">
            </div>
        </div>

        <div class="form-group row">
            <lable for="describe" class="col-form-label">Package Daytime:</lable>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>
                <select id="Daytime" name="Daytime" class="form-control" placeholder="Daytime" >
                    <option value="Morning">Morning</option>
                    <option value="Afternoon">Afternoon</option>
                    <option value="Evening">Evening</option>

                </select>

            </div>
        </div>

        <div class="form-group row">
            <lable for="describe" class="col-form-label">Packages Description</lable>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>
                <textarea id="describe" name="describe" class="form-control" placeholder="describe package information for client" ></textarea>

            </div>
        </div>




        <h3  align="center"><i class="fas fa-thumbs-up"></i> Selected Menu of Your Package</h3>

        <div id="selectedmenu" class="row form-group m-0" style="overflow:auto;width: 100% ;height: 40vh">

        </div>

    </div>



    <div class="col-12 mt-2 row">
        <button id="btncancel" type="button" value="Cancel" class="btn btn-danger col-5 float-right"><span class="fas fa-window-close "></span>Cancel</button>
        <button id="btnsubmit" type="button" value="Submit" class="btn btn-primary col-5 float-right"><i class="fas fa-check "></i>Submit</button>
    </div>
</form>
</div>

<div class="container ">

    <hr class="border">
    <h3  align="center" class="mt-5"><i class="far fa-hand-pointer mr-2"></i>Select Dishes</h3>



    <!-- Button trigger modal -->



    <div class="form-group row">
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-search"></i></span>
            </div>
            <input id="searchdish" class="form-control" type="text" placeholder="Search dish">
            <button type="button" class="btn btn-primary float-right col-4" data-toggle="modal" data-target="#exampleModal">
                ADD dish
            </button>
        </div>
    </div>

    <div id="selectmenu" class="border m-2 p-0  row"  style="overflow:auto;width: 100% ;height: 50vh" >

        <?php


        $sql = 'SELECT `name`, `id`, `image` FROM `systemDish` WHERE ISNULL(isExpire)';
       echo dishesOfPakage($sql);

        ?>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formDishaddss">
                        <div class="form-group row">
                            <div class="input-group mb-3 input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-hamburger"></i></span>
                                </div>
                                <input id="dishnameadd" name="dishname" class="form-control" type="text" placeholder="Dish Name Enter">
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="input-group mb-3 input-group-lg">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                                </div>
                                <input  name="image" class="form-control" type="file">
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary " data-dismiss="modal">Close</button>
                    <button type="button" id="submitformDishadd" class="btn btn-primary float-right">Save changes</button>
                </div>
            </div>
        </div>
    </div>











</div>
<?php
include_once ("../../webdesign/footer/footer.php");
?>

<script type="text/javascript">
$(document).ready(function ()
{
    var numbers=0;

    function Addmenu(dishname,image)
    {
       var text="<div id=\"dishtempid"+numbers+"\" class=\"col-4 alert-danger border m-1 form-group p-0\" style=\"height: 30vh;\" >\n" +
            "            <img src=\""+image+"\" class=\"col-12\" style=\"height: 15vh\">\n" +
            "            <p class=\"col-form-label\" class=\"form-control col-12\">"+dishname+"</p>\n" +
            "            <input    data-dishid=\""+numbers+"\" type=\"button\" value=\"Remove\" class=\"form-control col-12 touchdish btn btn-danger\">\n" +
            "            <input hidden type=\"text\"  name=\"dishname[]\"  value=\""+dishname+"\">\n" +
            "             <input hidden type=\"text\"  name=\"image[]\"  value=\""+image+"\">\n" +
            "        </div>";
        numbers++;
        return text;
    }

   $(document).on("click",".touchdish",function ()
   {
       var text='';
       var value=$(this).val();
       var id=$(this).data("dishid");
       var image=$(this).data("image");
       var dishname=$(this).data("dishname");
       if(value=="Remove")
       {

           $("#dishtempid"+id).remove();
       }
       else
       {

           text=Addmenu(dishname,image);
           $("#selectedmenu").append(text);

       }

   });
   $("#perivious").change(function ()
   {
       var  packagename=$("#packagename");
       var rate=$("#rate");
       var describe=$("#describe");
       var formdata=new FormData;
       if($(this).val()!="none")
       {
           formdata.append("option","jsonPackagesDetail");
           formdata.append("packagesid",$(this).val());
           $.ajax({
               url:"packages/PACKServer.php",
               method:"POST",
               data:formdata,
               contentType: false,
               processData: false,

               beforeSend: function() {
                   $("#preloader").show();
               },
               success:function (data)
               {

                   $("#selectedmenu").html("");
                   var text;
                  var obj=JSON.parse(data);
                   packagename.val(obj[0][0].package_name);
                   rate.val(obj[0][0].price);
                   describe.val(obj[0][0].describe);
                   $.each( obj[1], function( key, value )
                   {
                     //  console.log(value.id);
                        text=Addmenu(value.dishname,value.image);
                       $("#selectedmenu").append(text);
                   });


                  $("#preloader").hide();
               }
           });


           //$("#shownonperivious").hide('slow');
       }
       else
       {
           packagename.val("");
           rate.val("");
           describe.val("");
           $("#selectedmenu").html("");

        //   $("#shownonperivious").show('slow');
       }

   });
   $("#btnsubmit").click(function ()
   {
       var formdata=new FormData($('#submitpackage')[0]);
       formdata.append("option","CreatePackage");
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
   $("#btncancel").click(function () {
       window.history.back();
   });
    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    });

    $("#submitformDishadd").click(function (e)
    {
        e.preventDefault();
        if($.trim($("#dishnameadd").val()).length==0)
        {
            alert("please enter dish name");
            return false;
        }
        var formdata = new FormData($("form")[1]);
        formdata.append("option","formDishadd");
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
                $("#selectmenu").html(data);
                $("form")[1].reset();
                $('#exampleModal').modal('toggle');

            }
        });
    });
    $("#searchdish").keyup(function () {
       var dishname=$(this).val();

        var formdata=new FormData();
        formdata.append("option","dishpredict");
        formdata.append("dishname",dishname);
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
                $("#selectmenu").html(data);
            }
        });




    });

$(document).ready(function () {

    $("#month").change(function () {
            if(($.trim($("#year").val())!=""))
            {
                $("#calendarBody").show();
            }
    });

    $("#year").change(function () {
        if(($.trim($("#month").val())!=""))
        {
            $("#calendarBody").show();
        }
    });

    function checkmonthyear()
    {
        validationWithString("month","Please select month");
        validationWithString("year","Please select year");
        if(($.trim($("#month").val())=="")||($.trim($("#year").val())==""))
        {
            $("#calendarBody").hide();
        }
        else
        {
            $("#calendarBody").show();
        }
    }

    $("#next").click(function ()
    {

        checkmonthyear();

    });
    $("#previous").click(function ()
    {


        checkmonthyear();
    });




});


});


</script>
</body>
</html>
