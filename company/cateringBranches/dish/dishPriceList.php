<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");
if(!isset($_SESSION['branchtype']))
{
    header("location:../../companyRegister/companydisplay.php");
}
$cateringid=$_SESSION['branchtypeid'];
$sql='SELECT dt.id, dt.name FROM dish_type as dt WHERE ISNULL(expire) AND (dt.catering_id='.$cateringid.')';
$dishTypeDetail=queryReceive($sql);
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script src="../../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <style>

    </style>
</head>
<body>


<?php
include_once ("../../../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://maunewsonline.uitvconnect.com/wp-content/uploads/2017/10/indian-food.jpg);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 ><i class="fas fa-list-ol fa-3x"></i>Price List of Dishes </h3>
    </div>
</div>



<div class="container badge-light" >
    <h4>Catering Dishes Price list</h4>
    <hr>
    <?php

    $display='';
    for($i=0;$i<count($dishTypeDetail);$i++)
    {
        $display.='<h2 data-dishtype="'.$i.'" data-display="hide" align="center " class="dishtypes col-12 btn-warning"><i class="fas fa-sitemap mr-1"></i> '.$dishTypeDetail[$i][1].'</h2>';

        $sql='SELECT `name`, `id`, `image`, `dish_type_id` FROM `dish` WHERE (dish_type_id='.$dishTypeDetail[$i][0].') AND (ISNULL(expire)) AND(catering_id='.$cateringid.')';
        $dishDetail=queryReceive($sql);
        //print_r($dishDetail);
        $display.='<div id="dishtype'.$i.'"  class="row" style="display: none">';
        for ($j=0;$j<count($dishDetail);$j++)
        {
            $display .= ' 
         <div  class="col-5 m-2 m-sm-auto  shadow-lg p-3 bg-white rounded" >';



            $image='';


            if(file_exists('../../../images/dishImages/'.$dishDetail[$j][2])&&($dishDetail[$j][2]!=""))
            {
                $image= '../../../images/dishImages/'.$dishDetail[$j][2];
            }
            else
            {
                $image='https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';
            }


            $display.='<img class="card-img-top " src="'.$image.'" alt="Card image" style="height: 100px" >
        
            <p  class="font-weight-bold p-0 card-title col-12
            "><i class="fas fa-concierge-bell mr-1"></i>' . $dishDetail[$j][0] . '</p>
            <button type="button"  data-image="'.$dishDetail[$j][2].'" data-dishname="'. $dishDetail[$j][0] .'"  data-dishid="'. $dishDetail[$j][1] .'"   data-toggle="modal" data-target="#myModal"   class="adddish col-12 mb-0 btn btn-primary"><i class="fas fa-check "></i>  Show Price</button>
       
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
include_once ("../../../webdesign/footer/footer.php");
?>
<script>


    $(document).ready(function ()
    {







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
                    $("#AddDishDetail").html(data);
                }

            });
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




    });


</script>
</body>
</html>
