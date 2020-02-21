<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");

    if (!isset($_COOKIE['companyid']))
    {
       header("location:../../user/userLogin.php");
    }
        if(!isset($_GET['catering']))
        {
            header("location:./../companyRegister/companyEdit.php");
        }
        $encoded=$_GET['catering'];
        $id=base64url_decode($encoded);

        if((!is_numeric($id))||$id=="")
        {
           header("location:../../companyRegister/companyEdit.php");
        }
        $cateringid=$id;
    if(isset($_GET['dishdetail']))
    {
        $encodedDishId=base64url_encode($_GET['dishid']);
        header("location:EditDish.php?dish=".$encodedDishId."&catering=".$encoded."");
    }
    $sql = 'SELECT  `name`, `expire`, `image`, `location_id` FROM `catering` WHERE id=' . $cateringid . '';
    $cateringdetail = queryReceive($sql);
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <style>

    </style>
</head>
<body>
<?php
include_once ("../../../webdesign/header/header.php");

?>




    <div class="jumbotron  shadow text-center " style="background-image: url(<?php
    if((file_exists('../../../images/catering/'.$cateringdetail[0][2])) &&($cateringdetail[0][2]!=""))
    {
        echo "'../../../images/catering/".$cateringdetail[0][2]."'";
    }
    else
    {
        echo "https://www.liberaldictionary.com/wp-content/uploads/2019/02/cater-4956.jpg";
    }



    ?>
            );background-size:100% 100%;background-repeat: no-repeat">

        <div class="card-body " style="opacity: 0.7 ;background: white;">
            <h1 class="display-5 text-center"><i class="fas fa-hamburger fa-3x"></i><?php echo $cateringdetail[0][0];?> Dishes info</h1>
            <p class="lead">Edit dishes information,dishes type,images and others </p>

            <h1 class="text-center"> <a href="../../companyRegister/companyEdit.php" class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>

        </div>
    </div>







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

        $sql='SELECT `id`, `name`, `isExpire` FROM `dish_type` WHERE catering_id='.$cateringid.'';
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
        <a  href="addDish.php?catering=<?php echo $encoded;?>" class="float-right btn btn-success col-4 form-control mt-4">Add dish +</a>
    </div>
    <hr>

    <div class="col-12 card shadow mb-2 p-4 ">

        <?php

        $sql='SELECT id,name FROM dish_type WHERE catering_id='.$cateringid.'';

        $dishTypes=queryReceive($sql);
        $Display='';
        $display='<div class="form-group row ">';
        for($j=0;$j<count($dishTypes);$j++)
        {


            $display.='<h4 class="col-12 newcolor" align="center">'.$dishTypes[$j][1].'</h4>';



            $sql = 'SELECT d.name, d.id, (SELECT dt.name from dish_type as dt WHERE dt.id=d.dish_type_id),(SELECT dt.isExpire from dish_type as dt WHERE dt.id=d.dish_type_id), d.isExpire,d.image FROM dish as d WHERE dish_type_id=' . $dishTypes[$j][0] . ' ';


            $Dishes = queryReceive($sql);




            for ($i = 0; $i < count($Dishes); $i++) {
                $display .= '<a href="?dishdetail=yes&dishid=' . $Dishes[$i][1]. '&catering='.$encoded.'" class="col-sm-12 col-md-6 col-xl-4 border">
              <img src="';

                if(file_exists('../../../images/dishImages/'.$Dishes[$i][5])&&($Dishes[$i][5]!=""))
                {
                    $display.='../../../images/dishImages/'.$Dishes[$i][5];
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
include_once ("../../../webdesign/footer/footer.php");
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
