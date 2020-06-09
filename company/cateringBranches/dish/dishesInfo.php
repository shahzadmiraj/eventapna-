<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$sql='SELECT `id`, `name`, `token` FROM `catering` WHERE (ISNULL(expire))AND (company_id= '.$userdetail[0][0].')';
$CateringName=queryReceive($sql);
$List=array();
$cateringid='';
$Active="All";
if(isset($_GET['id']))
{

    $id=$_GET['id'];
    $token=$_GET['token'];
    $cateringid=$id;
    $sql = 'SELECT  `name` FROM `catering` WHERE (id='.$id.')AND(token="'.$token.'")AND(ISNULL(expire))';
    $cateringdetail = queryReceive($sql);
    if(count($cateringdetail)<=0)
        exit();
    $List=$id;
    $Active=$id;

}
else
{

    $listOfCatering=array_column($CateringName, 0);
    $List = implode(', ', $listOfCatering);
}



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
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../../webdesign/css/complete.css">

    <script src="../../../webdesign/JSfile/JSFunction.js"></script>
    <style>

    </style>
</head>
<body>
<?php
//include_once ("../../../webdesign/header/header.php");

?>




<div class="container">
    <h1 class="text-muted text-center">Dish Manage</h1>

    <h3 class="font-weight-bold">Catering Dishes <a  href="addDish.php" class="float-right btn btn-success col-4 form-control">Add dish +</a></h3>

    <ul class="nav nav-pills mb-3" >
        <li class="nav-item">
            <a class="nav-link <?php
            if($Active=="All")
            {
                echo "active";
            }

                ?> cateringnumber "  data-cateringnumber="All"  href="?">All</a>
        </li>


        <?php


        $display="";
        for($i=0;$i<count($CateringName);$i++)
        {
            $display.= '  
              
        <li class="nav-item">
            <a class="nav-link cateringnumber ';

            if($Active==$CateringName[$i][0])
                $display.="active";

            $display.='" data-cateringnumber="'.$CateringName[$i][0].'"  href="?id='.$CateringName[$i][0].'&token='.$CateringName[$i][2].'" >'.$CateringName[$i][1].'</a>
        </li>';
        }
        echo $display;
        ?>

    </ul>
    <hr>



    <div  class="col-12 badge-light ">

        <div class="col-12 form-group row font-weight-bold border ">
            <label class="col-9  col-form-label "><i class="fas fa-utensils mr-1"></i>Name Dish type</label>
            <label class="col-3  col-form-label "><i class="far fa-trash-alt"></i>DELETE</label>
        </div>


        <?php


        //dish type of catering
        $sql='SELECT dt.id,dt.name FROM dishControl as dc INNER join  dish as d 
on(dc.dish_id=d.id) INNER join dish_type as dt 
on (d.dish_type_id=dt.id)
WHERE
(ISNULL(dc.expire)) AND(ISNULL(dt.expire))AND(dc.catering_id in('.$List.'))
GROUP by (dt.id)';

        $dishTypeDetail=queryReceive($sql);
        $Display='';
        for($i=0;$i<count($dishTypeDetail);$i++)
        {
            $Display.= '<div class="form-group row  border " id="Delele_Dish_Type_'.$dishTypeDetail[$i][0].'">
            <input data-dishtypeid="'.$dishTypeDetail[$i][0].'"   value="'.$dishTypeDetail[$i][1].'" class="changeDishType col-9  form-control ">';

            $Display.=' <input data-dishtypeid="'.$dishTypeDetail[$i][0].'"  class=" btn Delele_Dish_Type col-3  form-control btn-outline-danger " value="Disable"> ';

            $Display.= '</div>';


        }
        echo $Display;
        ?>



    </div>







</div>






<div class="container badge-light " >
    <h3>Catering Dishes</h3>
    <hr>
    <?php
    $display='';
    for($i=0;$i<count($dishTypeDetail);$i++)
    {
        $display.='<h2 data-dishtype="'.$i.'" data-display="hide" align="center " class="dishtypes col-12 btn-warning"><i class="fas fa-sitemap mr-1"></i> '.$dishTypeDetail[$i][1].'</h2>';

        $sql = 'SELECT d.name, d.id,d.image,(SELECT price FROM `dishWithAttribute` WHERE dish_id=d.id limit 1 ),d.token FROM dish as d WHERE (dish_type_id=' . $dishTypeDetail[$i][0] . ')AND((ISNULL(d.expire))) ';

      //  $sql='SELECT `name`, `id`, `image`, `dish_type_id` FROM `dish` WHERE (dish_type_id='.$dishTypeDetail[$i][0].') AND (ISNULL(expire)) AND(catering_id='.$cateringid.')';
        $dishDetail=queryReceive($sql);
        //print_r($dishDetail);
        $display.='<div id="dishtype'.$i.'"  class="row" style="display: none">';
        for ($j=0;$j<count($dishDetail);$j++)
        {
            $display .=' 
         <a    href="EditDish.php?Did='.$dishDetail[$j][1].'&Dtoken='.$dishDetail[$j][4].'"  class="col-md-4 card m-1" >';





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

<p>
<span class="float-left"><i class="fas fa-concierge-bell mr-1"></i>' . $dishDetail[$j][0] . '</span>

<span class="float-right text-danger"><i class="far fa-money-bill-alt"></i>' . $dishDetail[$j][3] . '</span>
</p>
       
        </a>';
        }
        $display.='</div>';
    }
    echo $display;
    ?>

</div>


<?php
//include_once ("../../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {


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

        $(document).on("change",".changeDishType",function ()
        {
            var id=$(this).data("dishtypeid");
            if(validation($(this),"Please Enter Dish Type"))
            return false;
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
