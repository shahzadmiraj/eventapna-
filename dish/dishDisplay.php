<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
if(!isset($_SESSION['branchtype']))
{
    header("location:../company/companyRegister/companydisplay.php");

}
if(!isset($_SESSION['order']))
{
    header("location:../user/userDisplay.php");
}
$order=$_SESSION['order'];
$sql='SELECT od.hallprice_id,(SELECT hp.describe from hallprice as hp WHERE hp.id=od.hallprice_id),(SELECT hp.isFood from hallprice as hp WHERE hp.id=od.hallprice_id),od.catering_id FROM orderDetail as od
WHERE od.id='.$order.'';
$hallpackage=queryReceive($sql);
$cateringid=$hallpackage[0][3];
$sql='SELECT dt.id, dt.name FROM dish_type as dt WHERE ISNULL(expire) AND (dt.catering_id='.$cateringid.')';
$dishTypeDetail=queryReceive($sql);
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
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <style>

    </style>
</head>
<body>


<?php
include_once ("../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://maunewsonline.uitvconnect.com/wp-content/uploads/2017/10/indian-food.jpg);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 ><i class="fas fa-concierge-bell fa-3x"></i>Select Dishes </h3>
    </div>
</div>


<div id="selectmenu" class="form-inline badge-light "  >


</div>


    <form  id="formid" method="post" action="dishCreate.php" class="container alert-light ">
        <h1>Selecting Dishes </h1>
        <hr>

        <div id="showSelectedDishes" class="form-inline badge-light "  >


        </div>



        <div class="form-group row col-12 justify-content-center mt-5 ">

            <a href="../order/orderEdit.php" type="button" class="col-6 btn btn-danger form-control"><i class="fas fa-arrow-left"></i>Edit order</a>

            <button id="submit" type="submit" class="btn-success form-control btn col-6"><i class="fas fa-check "></i>Submit</button>
        </div>

    </form>


<div class="container badge-light" >
    <h1>Catering Dishes</h1>
    <hr>
    <?php

        $display='';
        for($i=0;$i<count($dishTypeDetail);$i++)
        {
            $display.='<h2 data-dishtype="'.$i.'" data-display="hide" align="center " class="dishtypes col-12 btn-warning"> '.$dishTypeDetail[$i][1].'</h2>';

            $sql='SELECT `name`, `id`, `image`, `dish_type_id` FROM `dish` WHERE (dish_type_id='.$dishTypeDetail[$i][0].') AND (ISNULL(expire)) AND(catering_id='.$cateringid.')';
            $dishDetail=queryReceive($sql);
            //print_r($dishDetail);
            $display.='<div id="dishtype'.$i.'"  class="row" style="display: none">';
            for ($j=0;$j<count($dishDetail);$j++)
            {
                $display .= ' 
         <div  class="col-5 m-2 m-sm-auto  shadow-lg p-3 bg-white rounded" >';





                $image='';


                if(file_exists('../images/dishImages/'.$dishDetail[$j][2])&&($dishDetail[$j][2]!=""))
                {
                    $image= '../images/dishImages/'.$dishDetail[$j][2];
                }
                else
                {
                    $image='https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';
                }


        $display.='<img class="card-img-top " src="'.$image.'" alt="Card image" style="height: 100px" >
        
            <p  class="font-weight-bold p-0 card-title col-12
            ">' . $dishDetail[$j][0] . '</p>
            <button type="button"  data-image="'.$dishDetail[$j][2].'" data-dishname="'. $dishDetail[$j][0] .'"  data-dishid="'. $dishDetail[$j][1] .'"   data-toggle="modal" data-target="#myModal"   class="adddish col-12 mb-0 btn btn-primary">Select</button>
       
        </div>';
            }
            $display.='</div>';
        }
        echo $display;
    ?>

</div>








<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content"  id="AddDishDetail"  >

        </div>

    </div>
</div>





<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>


    $(document).ready(function ()
    {



       var countofdish=0;

        $(document).on("click",".DishAddOnform",function ()
        {

            var image=$(this).data("image");
            var dishName=$(this).data("dishname");
            var dishid=$(this).data("dishid");
            var price=$(this).data("price");
            var formdata = new FormData;
            formdata.append("image",image);
            formdata.append("dishid", dishid);
            formdata.append("dishName",dishName);
            formdata.append("countofdish",countofdish);
            formdata.append("price",price);
            formdata.append("option", "AddDishOnForm");
            $.ajax({
                url: "DishDisplayServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
                    $("#showSelectedDishes").append(data);
                    countofdish++;
                }

            });


        });




        $(".adddish").click(function ()
       {
           var image=$(this).data("image");
           var dishName=$(this).data("dishname");
           var dishid=$(this).data("dishid");
           var formdata = new FormData;
           formdata.append("dishid", dishid);
           formdata.append("image",image);
           formdata.append("dishName",dishName);
           formdata.append("option", "showPriceofAllDishes");

           $.ajax({
               url: "DishDisplayServer.php",
               method: "POST",
               data: formdata,
               contentType: false,
               processData: false,

               beforeSend: function() {
                   $("#preloader").show();
               },
               success:function (data)
               {
                   $("#preloader").hide();
                   $("#AddDishDetail").html(data);
               }

           });
       });


       $(document).on('click','.remove',function () {
          var id=$(this).data("dishid");
          $("#remove"+id).remove();
       });


        $("#cancelDish").click(function () {
            window.history.back();
            return false;
        });


        $(document).on("click",".dishtypes",function () {
            var display=$(this).data("display");
            var IdDisplay=$(this).data("dishtype");
            if(display=="hide")
            {
                $("#dishtype"+IdDisplay).show('slow');
                $(this).data("display","show");
            }
            else
            {

                $("#dishtype"+IdDisplay).hide('slow');
                $(this).data("display","hide");
            }

        });


        function menushow(packageid,describe)
        {
            var formdata = new FormData;
            formdata.append("packageid", packageid);
            formdata.append("option", "viewmenu");

            $.ajax({
                url: "dishServer.php",
                method: "POST",
                data: formdata,
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
                        $("#selectmenu").html('<h1 align="center" class=\'col-12\'>Package Menu</h1>');
                        $("#selectmenu").append(data);
                        $("#selectmenu").append("<h3 align='center' class='col-12'>Menu Description</h3><p class='col-12'>" + describe + "</p>");
                    }
                }


            });
        }

        <?php

            if($hallpackage[0][2]==1)
            {
                echo 'menushow(' . $hallpackage[0][0] . ',' . $hallpackage[0][1] . ');';
            }

    ?>




    });


</script>
</body>
</html>
