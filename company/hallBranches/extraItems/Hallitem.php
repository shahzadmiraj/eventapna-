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
        <h1 class="display-5 text-center"><i class="fas fa-hamburger fa-3x"></i> Extra items Detail</h1>
        <p class="lead">Extra items information such as Sound system ,Dancing floor ,Fog light ,Snow system Price manager others </p>
        <h5 class="text-center"> <a href="../../companyRegister/companyEdit.php" class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h5>
    </div>
</div>







<div class="container">

    <h1 class="font-weight-bold">Extra item Catergories</h1>
    <hr>



    <h3 align="center"> Catergories information</h3>
    <div class="col-12 form-group row font-weight-bold border">
        <label class="col-9  col-form-label "><i class="fas fa-utensils mr-1"></i>Catergory</label>
        <label class="col-3  col-form-label ">Delete</label>
    </div>

    <div  class="col-12">


        <?php

     //   $sql='SELECT `id`, `name`, `isExpire` FROM `dish_type` WHERE catering_id='.$cateringid.'';
        $sql='SELECT `id`, `name` FROM `Extra_item_type` WHERE (hall_id='.$id.')&&(ISNULL(expire))';
        $Category=queryReceive($sql);
        $Display='';
        for($i=0;$i<count($Category);$i++)
        {
            $Display.= '<div class="form-group row  border " id="Delele_Dish_Type_'.$Category[$i][0].'">
            <input type=text" data-id="'.$Category[$i][0].'"   value="'.$Category[$i][1].'" class="changeCategory col-9  form-control ">
            <button data-option="deleteCategory"   data-id='.$Category[$i][0].'  class="actionDelete btn  col-3  form-control btn-danger" >Delete</button>
            ';

            $Display.= '</div>';


        }
        echo $Display;
        ?>



    </div>


    <div class="col-12 row mb-4">
        <h3 class="rounded mx-auto d-block m-4 col-6" align="center"> Extra items information</h3>
        <?php
        echo '        <a  href="CreateItem.php?hall='.$encoded.'" class="float-right btn btn-success col-4 form-control mt-4">Add Extra item +</a>
';
        ?>
    </div>
    <hr>

    <div class="col-12 card shadow mb-2 p-4 ">

        <?php

        //$sql='SELECT id,name FROM dish_type WHERE catering_id='.$cateringid.'';
        $sql='SELECT `id`, `name` FROM `Extra_item_type` WHERE (hall_id='.$id.')&&(ISNULL(expire))';

        $Category=queryReceive($sql);
        $Display='';
        $display='<div class="form-group row ">';
        for($j=0;$j<count($Category);$j++)
        {

            $display.='<h4 class="col-12 newcolor" align="center">'.$Category[$j][1].'</h4>';



          //  $sql = 'SELECT d.name, d.id, (SELECT dt.name from dish_type as dt WHERE dt.id=d.dish_type_id),(SELECT dt.isExpire from dish_type as dt WHERE dt.id=d.dish_type_id), d.isExpire,d.image FROM dish as d WHERE dish_type_id=' . $Category[$j][0] . ' ';

            $sql='SELECT ex.id,ex.name,ex.price,ex.image,ex.active FROM Extra_Item as ex WHERE (ISNULL(ex.expire)) AND (ex.Extra_item_type_id='.$Category[$j][0].')';
            $kinds = queryReceive($sql);



$display.='<div class="container-fluid"><div class="card-deck">';
            for ($i = 0; $i < count($kinds); $i++)
            {


    $display.='
        <div class="card mb-4 col-12 col-md-6 col-lg-4 col-xl-3">';

        if( file_exists('../../../images/hallExtra/'.$kinds[$i][3]) AND($kinds[$i][3]!=""))
        {
         $display.='
            <img class="card-img-top img-fluid" src="../../../images/hallExtra/'.$kinds[$i][3].'" alt="Card image cap"  >';
        }
        else
        {

            $display.='
            <img class="card-img-top img-fluid" src="https://scx1.b-cdn.net/csz/news/800/2019/virtuallyrea.jpg" alt="Card image cap">';
        }

      $display.='   <div class="card-body ">
                <h4 class="card-title">'.$kinds[$i][1].'</h4>
              <h6 class=" "><i class="far fa-money-bill-alt mr-3"></i><i>'.$kinds[$i][2].'    <button data-option="deleteItem" data-id='.$kinds[$i][0].' class="actionDelete btn btn-danger float-right">Delete</button>
</h6>
            </div>
        </div>
        <div class="w-100 d-none d-sm-block d-md-none"></div>';
            }
            $display.='</div></div>';

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


        $(document).on("change",".changeCategory",function ()
        {
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


    });

</script>


</body>
</html>
