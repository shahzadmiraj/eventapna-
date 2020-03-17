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
$sql='SELECT dt.id, dt.name FROM dish_type as dt WHERE ISNULL(dt.isExpire) AND (dt.catering_id='.$cateringid.')';
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


<div id="selectmenu" class="alert-info  m-2 form-group row shadow" >


</div>


    <form class="card-header container border mb-5 " id="formid" method="post" action="dishCreate.php">

        <div class="col-12" id="selected">
    <div class="form-group row">
        <label  class="text-center col-form-label col-8"><i class="fas fa-concierge-bell fa-2x col-12"></i>Dish Name</label>
        <label class="text-center col-form-label col-3" hidden> <i class="fas fa-sort-amount-up fa-2x col-12"></i>Types</label>
        <label class=" text-center col-form-label col-4"><i class="fas fa-trash-alt fa-2x col-12"></i>Delete</label>
    </div>



        </div>


        <div class="form-group row col-12 justify-content-center ">

        <?php
           /* if(isset($_GET['option']))
            {
                if($_GET['option']=="orderCreate")
                {
                    echo '<a href="../order/orderEdit.php?order='.$_GET['order'].'&customer='.$_GET['customer'].'&option=dishDisplay" class="col-5 form-control btn btn-danger"><i class="fas fa-arrow-left"></i>Edit Order</a>';
                }
                else if($_GET['option']=="orderEdit")
                {

                    echo '<button id="cancelDish" type="button" class="col-5 btn btn-danger form-control"><i class="fas fa-arrow-left"></i>Edit order</button>';
                }
            }
            else
            {
                echo '<button id="cancelDish" type="button" class="col-5 btn btn-danger form-control"><i class="fas fa-arrow-left"></i>Edit order</button>';
            }*/
           //10
        //13

        ?>

<!--            <button id="cancelDish" type="button" class="col-5 btn btn-danger form-control"><i class="fas fa-arrow-left"></i>Edit order</button>
-->
            <a href="../order/orderEdit.php" type="button" class="col-6 btn btn-danger form-control"><i class="fas fa-arrow-left"></i>Edit order</a>

            <button id="submit" type="submit" class="btn-success form-control btn col-6"><i class="fas fa-check "></i>Submit</button>
        </div>

    </form>


<div class="container">
    <?php

        $display='';
        for($i=0;$i<count($dishTypeDetail);$i++)
        {
            $display.='<h2 data-dishtype="'.$i.'" data-display="hide" align="center " class="dishtypes col-12 btn-warning"> '.$dishTypeDetail[$i][1].'</h2>';

            $sql='SELECT `name`, `id`, `image`, `dish_type_id` FROM `dish` WHERE (dish_type_id='.$dishTypeDetail[$i][0].') AND (ISNULL(isExpire)) AND(catering_id='.$cateringid.')';
            $dishDetail=queryReceive($sql);
            $display.='<div id="dishtype'.$i.'"  class="row" style="display: none">';
            for ($j=0;$j<count($dishDetail);$j++)
            {
                $display .= ' 
         <div  class="col-5 m-2 m-sm-auto  shadow-lg p-3 bg-white rounded" >';





                $image='';


                if(file_exists('../images/dishImages/'.$dishDetail[0][2])&&($dishDetail[0][2]!=""))
                {
                    $image= '../images/dishImages/'.$dishDetail[0][2];
                }
                else
                {
                    $image='https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';
                }


        $display.='<img class="card-img-top " src="'.$image.'" alt="Card image" style="height: 100px" >
        
            <p  class="font-weight-bold p-0 card-title col-12
            ">' . $dishDetail[$j][0] . '</p>
            <button type="button" data-dishname="'. $dishDetail[$j][0] .'" data-dishid="'. $dishDetail[$j][1] .'" class="add col-12 mb-0 btn btn-primary">Select</button>
       
        </div>';
            }
            $display.='</div>';
        }
        echo $display;
    ?>

</div>




<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function () {

       $(document).on('click','.add',function () {
           var dishName=$(this).data("dishname");
           var dishId=$(this).data("dishid");
           $('#selected').append('\n' +
               '            <div class="form-group row " id="dishid_'+dishId+'">\n' +
               '                <h2 class="col-8 border">'+dishName+'</h2>\n' +
               '                <input type="number" hidden value="1" name="types[]" class="form-control col-3">\n' +
               '                <input type="number" hidden name="dishid[]" value="'+dishId+'">\n' +
               '                <button  type="button" class="remove border-white form-control col-4 btn-danger" data-dishid="'+dishId+'"><i class="fas fa-trash-alt"></i></button>\n' +
               '            </div>');

       }) ;

       $(document).on('click','.remove',function () {
          var id=$(this).data("dishid");
          $("#dishid_"+id).remove();
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
