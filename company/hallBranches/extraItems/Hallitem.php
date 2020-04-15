<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");
//$encoded=$_GET['hall'];
//$id=base64url_decode($encoded);


if(!isset($_GET['hall']))
{

    header("location:../../companyRegister/companyEdit.php");
}
$encoded=$_GET['hall'];
$id=base64url_decode($encoded);

if((!is_numeric($id))||$id=="")
{
    header("location:../../companyRegister/companyEdit.php");
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
include_once ("../../../webdesign/header/header.php");

?>
<div class="jumbotron  shadow text-center " style="background-image: url(<?php

    echo "https://media.istockphoto.com/photos/photo-studio-with-lighting-equipment-and-digital-camera-picture-id639474056";




?>
    );background-size:100% 100%;background-repeat: no-repeat">
    <div class="card-body " style="opacity: 0.7 ;background: white;">
        <h1 class="text-center"><i class="fas fa-sitemap fa-1x"></i> Extra items Detail</h1>
        <p class="lead">Extra items information such as Sound system ,Dancing floor ,Fog light ,Snow system Price manager others </p>
        <h6>You can add fog light ,smog ,dancing floor and extra items with sperate charges</h6>
        <h5 class="text-center"> <a href="../../companyRegister/companyEdit.php" class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h5>
    </div>
</div>







<div class="container card">

    <h3 class="font-weight-bold">Extra item Catergories</h3>
    <hr>



    <h3 align="center"> Catergories information</h3>
    <div class="col-12 form-group row font-weight-bold border">
        <label class="col-8  col-form-label "><i class="fas fa-sitemap"></i>Catergory</label>
        <label class="col-4  col-form-label ">Delete</label>
    </div>



        <?php

     //   $sql='SELECT `id`, `name`, `isExpire` FROM `dish_type` WHERE catering_id='.$cateringid.'';
        $sql='SELECT `id`, `name` FROM `Extra_item_type` WHERE (hall_id='.$id.')&&(ISNULL(expire))';
        $Category=queryReceive($sql);
        $Display='';
        for($i=0;$i<count($Category);$i++)
        {
            $Display.= '<div class="form-group row  border " id="Delele_Dish_Type_'.$Category[$i][0].'">
            <input type=text" data-id="'.$Category[$i][0].'"   value="'.$Category[$i][1].'" class="changeCategory col-9  form-control ">
            <button data-option="deleteCategory"   data-id='.$Category[$i][0].'  class="actionDelete btn  col-3  form-control btn-outline-danger" ><i class="fas fa-minus-circle"></i> Delete</button>
            ';

            $Display.= '</div>';


        }
        echo $Display;
        ?>

</div>




    <div class="container badge-light mt-5">

        <div class="text-left">
            <h4 > Extra items information</h4>
        </div>
        <div class="text-right">

            <?php
            echo '        <a  href="CreateItem.php?hall='.$encoded.'" class="btn btn-success"><i class="fas fa-plus"></i> Add Extra item</a>
';
            ?>
        </div>

        <hr>
        <br>



        <?php

        //$sql='SELECT id,name FROM dish_type WHERE catering_id='.$cateringid.'';
        $sql='SELECT `id`, `name` FROM `Extra_item_type` WHERE (hall_id='.$id.')&&(ISNULL(expire))';

        $Category=queryReceive($sql);
        $Display='';
        $display='';
        for($j=0;$j<count($Category);$j++)
        {

            $display.='<h4 data-dishtype="'.$j.'" data-display="hide"  class="dishtypes text-center btn-warning"><i class="fas fa-sitemap"></i>'.$Category[$j][1].'</h4>';



          //  $sql = 'SELECT d.name, d.id, (SELECT dt.name from dish_type as dt WHERE dt.id=d.dish_type_id),(SELECT dt.isExpire from dish_type as dt WHERE dt.id=d.dish_type_id), d.isExpire,d.image FROM dish as d WHERE dish_type_id=' . $Category[$j][0] . ' ';

            $sql='SELECT ex.id,ex.name,ex.price,ex.image,ex.active FROM Extra_Item as ex WHERE (ISNULL(ex.expire)) AND (ex.Extra_item_type_id='.$Category[$j][0].')';
            $kinds = queryReceive($sql);



$display.='<div id="dishtype'.$j.'" class="row" style="display: none">';
            for ($i = 0; $i < count($kinds); $i++)
            {


    $display.='
        <div class="col-md-4 col-xl-3 m-2 card">
       
        ';

        if( file_exists('../../../images/hallExtra/'.$kinds[$i][3]) AND($kinds[$i][3]!=""))
        {
         $display.='
            <img class="card-img-top img-fluid" src="../../../images/hallExtra/'.$kinds[$i][3].'" alt="Card image cap"  style="height: 20vh">';
        }
        else
        {

            $display.='
            <img class="card-img-top img-fluid" src="https://scx1.b-cdn.net/csz/news/800/2019/virtuallyrea.jpg" alt="Card image cap" style="height: 20vh">';
        }

      $display.='   <div class="card-footer ">
   <h5 class="card-title" ><i class="fas fa-drum mr-1"></i>'.$kinds[$i][1].'</h5>   
              
              
              <p>
              <span class="float-left text-danger">
              <i class="far fa-money-bill-alt mr-3"></i>Amount:'.$kinds[$i][2].' 
                </span>
               <button data-option="deleteItem" data-id='.$kinds[$i][0].' class="actionDelete btn btn-danger float-right"><i class="fas fa-minus-circle"></i> Delete</button>
                </p>
           
            </div>
        </div>';
            }
            $display.='</div>';

        }
        echo $display;


        ?>


</div>



<!--
<div class="container ">
    <h1 class="text-center">kkiiji</h1>
    <div class="row">



        <div class="col-md-4 m-1">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-footer">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick examplet.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>







    </div>
</div>-->



<?php
include_once ("../../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {


        $(document).on("change",".changeCategory",function ()
        {
            if(validation($(this),"Please enter Catergory Name"))
                return false;

            var id=$(this).data("id");
            var value=$(this).val();

            $.ajax({
                url:"hallitemsServer.php",
                data:{id:id,value:value,option:"changeCategory"},
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

        $(document).on("click",".actionDelete",function ()
        {
            var id=$(this).data("id");
            var action=$(this).data("option");
            $.ajax({
                url:"hallitemsServer.php",
                data:{option:action,id:id},
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
