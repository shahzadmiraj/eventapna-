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
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
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

<div class="container">




<form id="submitpackage" >





    <?php
    echo '<input hidden type="text" name="month"  value="'.$month.'">
                <input hidden type="text" name="daytime"  value="'.$daytime.'">
                    <input hidden type="text" name="hallid"  value="'.$hallid.'">
                    ';
    ?>


    <div class="form-group row">
        <lable class="col-form-label">Same as previous Packages</lable>




        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-hamburger"></i></span>
            </div>
            <select id="perivious"  name="perivious" class="form-control">
                <option value="none">None</option>
                <?php
                $sql='SELECT hp.package_name,hp.id,hp.price FROM company as c INNER join hall as h on(h.company_id=c.id) INNER join hallprice as hp on (hp.hall_id=h.id) WHERE ISNULL(c.expire) && ISNULL(h.expire) && ISNULL(hp.expire) &&(hp.isFood=1) &&(c.id='.$_COOKIE['companyid'].') GROUP BY(hp.package_name)';
                $packages=queryReceive($sql);
                for($i=0;$i<count($packages);$i++)
                {
                    echo '<option value="'.$packages[$i][1].'">'.$packages[$i][0].'    with Price  '.$packages[$i][2].'  </option>';


                }
                ?>
            </select>
        </div>

    </div>

<div id="shownonperivious">
            <div class="form-group row">
                <lable class="col-form-label">Packages Name</lable>


                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-hamburger"></i></span>
                    </div>
                    <input name="packagename" class="form-control" type="text" placeholder="chicken menu,mutton menu">

                </div>
            </div>

            <div class="form-group row">
                <lable class="col-form-label">Packages Rate per head</lable>

                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <input name="rate" class="form-control" type="number" placeholder="Price like 1000 per head">
                </div>
            </div>

            <div class="form-group row">
                <lable class="col-form-label">Packages Description</lable>

                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-comments"></i></span>
                    </div>
                    <textarea name="describe" class="form-control" placeholder="describe package information for client" ></textarea>

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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="submitformDishadd" class="btn btn-primary float-right">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
<?php
include_once ("../../webdesign/footer/footer.php");
?>

<script>
$(document).ready(function ()
{
    var numbers=0;
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

           text="<div id=\"dishtempid"+numbers+"\" class=\"col-4 alert-danger border m-1 form-group p-0\" style=\"height: 30vh;\" >\n" +
               "            <img src=\""+image+"\" class=\"col-12\" style=\"height: 15vh\">\n" +
               "            <p class=\"col-form-label\" class=\"form-control col-12\">"+dishname+"</p>\n" +
               "            <input    data-dishid=\""+numbers+"\" type=\"button\" value=\"Remove\" class=\"form-control col-12 touchdish btn btn-danger\">\n" +
               "            <input hidden type=\"text\"  name=\"dishname[]\"  value=\""+dishname+"\">\n" +
               "             <input hidden type=\"text\"  name=\"image[]\"  value=\""+image+"\">\n" +
               "        </div>";
           numbers++;
           $("#selectedmenu").append(text);

       }

   });
   $("#perivious").change(function ()
   {
       if($(this).val()!="none")
       {
           $("#shownonperivious").hide('slow');
       }
       else
       {

           $("#shownonperivious").show('slow');
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




});


</script>
</body>
</html>
