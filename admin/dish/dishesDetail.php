<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <style>

    </style>
</head>
<body>


<?php
include_once ("../../webdesign/header/header.php");

?>
<div class="container">

    <h1 class="font-weight-bold">System Dish info </h1>
    <hr>



    <h3 align="center"> Dish Type information</h3>
    <div class="col-12 form-group row font-weight-bold border">
        <label class="col-9  col-form-label "><i class="fas fa-utensils mr-1"></i>Name Dish type</label>
        <label class="col-3  col-form-label ">Detail</label>
    </div>

    <div  class="col-12">


        <?php

        $sql='SELECT `id`, `name`, `isExpire` FROM `systemDishType` WHERE 1';
        $dishTypes=queryReceive($sql);
        $Display='';
        for($i=0;$i<count($dishTypes);$i++)
        {
            $Display.= '<div class="form-group row  border " id="Delele_Dish_Type_'.$dishTypes[$i][0].'">
            <input data-dishtypeid="'.$dishTypes[$i][0].'"   value="'.$dishTypes[$i][1].'" class="changeDishType col-9  form-control ">
            <input data-dishtypeid="'.$dishTypes[$i][0].'"  class=" btn Delele_Dish_Type col-3  form-control  ';

            if($dishTypes[$i][2]=="")
            {

                $Display.='btn-primary  ';
            }
            else
            {
                $Display.=' btn-danger ';
            }

            $Display.=' " value="';

            if($dishTypes[$i][2]=="")
            {

                $Display.='Disable';
            }
            else
            {
                $Display.='Enable';
            }




            $Display.= '"></div>';
        }
        echo $Display;
        ?>



    </div>


    <div class="col-12 row mb-4">
        <h3 class="rounded mx-auto d-block m-4 col-6" align="center"> Dish information</h3>
        <a  href="addDish.php" class="float-right btn btn-success col-4 form-control mt-4">Add dish +</a>
    </div>
    <hr>

    <div class="container card">

        <?php

        $sql='SELECT `id`, `name`, `isExpire` FROM `systemDishType` WHERE 1';

        $dishTypes=queryReceive($sql);
        $Display='';
        $display='<div class="form-group row " style="height: 50vh;overflow:auto">';
        for($j=0;$j<count($dishTypes);$j++)
        {


            $display.='<h4 class="col-12 newcolor" align="center">'.$dishTypes[$j][1].'</h4>';



            $sql='SELECT d.name, d.id, (SELECT dt.name from systemDishType as dt WHERE dt.id=d.systemDishType_id),(SELECT dt.isExpire from systemDishType as dt WHERE dt.id=d.systemDishType_id), d.isExpire,d.image FROM systemDish as d WHERE d.systemDishType_id='.$dishTypes[$j][0].' ';


            $Dishes = queryReceive($sql);




            for ($i = 0; $i < count($Dishes); $i++) {
                $display .= '<a href="EditDish.php?dishid=' . $Dishes[$i][1] . '" class="col-sm-12 col-md-6 col-xl-4 border">
              <img src="';

                if(file_exists('../../images/dishImages/'.$Dishes[$i][5])&&($Dishes[$i][5]!=""))
                {
                    $display.='../../images/dishImages/'.$Dishes[$i][5];
                }
                else
                {
                    $display.='https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';
                }




                $display.='" style="height: 20vh" class="col-12">  
            <p class="col-12 p-0" ><i class="fas fa-utensils mr-1"></i>' . $Dishes[$i][0] . '</p>
            <i class="col-12 ';


                if (($Dishes[$i][3] == "") && ($Dishes[$i][4] == "")) {
                    $display .= " text-primary ";
                } else {
                    $display .= "text-danger ";
                }

                $display .= '">';
                if ($Dishes[$i][3] != "") {
                    $display .= $Dishes[$i][2] . " Diable ";
                }
                if ($Dishes[$i][4] != "") {
                    $display .= " Dish Diable ";
                }

                $display .= '</i>
        </a>';
            }
        }
        $display.='</div>';
        echo $display;


        ?>



    </div>












</div>


<?php
include_once ("../../webdesign/footer/footer.php");
?>

<script>
$(document).ready(function ()
{






    $(document).on("change",".changeDishType",function ()
    {
        var id=$(this).data("dishtypeid");
        var value=$(this).val();
        $.ajax({
            url:"dishServer.php",
            data:{id:id,value:value,option:"changeDishType"},
            dataType:"text",
            method:"POST",
            beforeSend: function() {
                $("#preloader").show();
            },
            success:function (data)
            {
                $("#preloader").hide();
                if(data!="")
                {
                    alert(data);
                }
                else
                {
                    location.reload();
                }

            }

        });

    });

    $(document).on("click",".Delele_Dish_Type",function ()
    {
        var id=$(this).data("dishtypeid");
        var value=$(this).val();
        $.ajax({
            url:"dishServer.php",
            data:{value:value,id:id,option:"Delele_Dish_Type"},
            dataType:"text",
            method:"POST",

            beforeSend: function()
            {
                $("#preloader").show();
            },
            success:function (data)
            {
                $("#preloader").hide();
                if(data!="")
                {
                    alert(data);
                }
                else
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