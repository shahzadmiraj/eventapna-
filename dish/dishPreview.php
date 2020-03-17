<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-07
 * Time: 13:49
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
$dishDetailId='';
if(isset($_GET['dish']))
{
    $dishDetailId=base64url_decode($_GET['dish']);
    if(!is_numeric($dishDetailId))
    {
        exit();
    }
}
else
{
    exit();
}


$sql='SELECT `describe`, `price`, `quantity`, `dish_id` FROM `dish_detail` WHERE id='.$dishDetailId.'';

$dishDetailOfDetai=queryReceive($sql);

$dishId=$dishDetailOfDetai[0][3];


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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">

    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <style>

    </style>
</head>
<body>

<?php
include_once ("../webdesign/header/header.php");
?>


<div class="jumbotron  shadow" style="background-image: url(http://tongil.com.au/wp-content/uploads/2018/02/ingredients.jpg);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 class="text-dark"><i class="fas fa-file-word fa-3x mr-2 "></i>Dish Edit</h3>
    </div>

</div>

<div class="container">

<?php

$display='';
    $sql = 'SELECT d.id,d.name,d.image FROM dish as d WHERE d.id=' . $dishId . '';
    $dishDetail = queryReceive($sql);
    $display .= '
    <form class="col-12" id="form">

        <div class="card shadow-lg p-4 mb-4 border  col-12">';

$image='';


if(file_exists('../images/dishImages/'.$dishDetail[0][2])&&($dishDetail[0][2]!=""))
{
    $image= '../images/dishImages/'.$dishDetail[0][2];
}
else
{
    $image='https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';
}
$display.='<div class="row">
<div class="col-6 m-auto card-body">
<img src="'.$image.'" style="height: 20vh;width: 100%">
<p class="card-header">'.$dishDetail[0][1].'</p>
</div>
</div>';
            
            
            
            
            
            
            
           $display.='<input hidden id="dishDetailID" value="'.$dishDetailId.'">
            ';


            $sql = 'SELECT an.id,an.quantity,a.name FROM dish_detail as dd inner join attribute_name as an 
on dd.id=an.dish_detail_id
INNER join attribute as a 
on a.id=an.attribute_id
WHERE dd.id='.$dishDetailId.'';

            $attributeDetail = queryReceive($sql);
            for ($j = 0; $j < count($attributeDetail); $j++) {
            $display .= ' <div class="form-group row">
                <label  class="col-form-label">' . $attributeDetail[$j][2] . '</label>
           
               <div class="input-group mb-3 input-group-lg">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-sticky-note"></i></span>
    </div>
                <input data-attributeid="'. $attributeDetail[$j][0] .'" class=" attributeChange form-control" type="number" value="'. $attributeDetail[$j][1] .'">

</div>
           
           
           
           
            </div>';

            }
            $display .= ' <div class="form-group row">
                <label  class="col-form-label">each price</label>
           
           
                
                <div class="input-group mb-3 input-group-lg">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
    </div>
                <input data-column="price" class="dishDetailChange form-control" type="number" value="'.$dishDetailOfDetai[0][1].'">
</div>
           
           
           
           
            </div>
            <div class="form-group row">
                <label class="col-form-label">Quantity</label>
           
                <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-sort-amount-up"></i></span>
                </div>
                <input data-column="quantity" class="dishDetailChange form-control" type="number" value="'.$dishDetailOfDetai[0][2].'">
            
            </div> 
           
           
           
           
            </div>
            <div class="form-group row">
                <label class="col-form-label">describe</label>
            
            

                                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-comments"></i></span>
                    </div>
                <input  data-column="describe" class="dishDetailChange form-control" type="text" value="'.$dishDetailOfDetai[0][0].'"></input>
                </div>            
            
            
            
            </div>
            <div class="form-group row justify-content-center">';

            if(isset($_GET['option']))
            {
                if($_GET['option']=="Allselected")
                {
                    $display.='
                    <button id="cancel_dish" type="button"  class="cancelForm form-control btn col-5 btn-danger" value="dish cancel"><i class="fas fa-trash-alt"></i>Delete</button>
                    <a href="AllSelectedDishes.php?order='.$_GET['order'].'&option=PreviewOrder" class="submitForm form-control btn col-5 btn-primary"><i class="fas fa-check "></i>Done</a>
';
                }
            }
            else
             {

                $display .= '<button  id="ok" type="button" class="submitForm form-control btn col-5 btn-primary" value="ok"><i class="fas fa-check "></i>OK</button>
<button id="cancel_dish" type="button"  class="cancelForm form-control btn col-5 btn-danger" value="dish cancel"><i class="fas fa-trash-alt"></i>Delete</button>
                ';
            }
            $display.='</div>
        </div>

    </form>';

            echo $display;
            ?>

</div>



<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function () {
       $(document).on('change','.attributeChange',function () {
           var attributeid=$(this).data('attributeid');
           var  valueAttribute=$(this).val();

            $.ajax({
              url:"dishServer.php",
                data:{attributeid:attributeid,value:valueAttribute,option:"attributeChange"},
              method:"POST",
                dataType:"text",

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
              }
          });
       }) ;
       $(document).on('change','.dishDetailChange',function () {
           var dishDetailId=$("#dishDetailID").val();
           var columnName=$(this).data("column");
           var columnValue=$(this).val();

           $.ajax({
              url:"dishServer.php",
              data: {dishDetailId:dishDetailId,columnName:columnName,columnValue:columnValue,option:"dishDetailChange" },
               dataType: "text",
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
               }
           });
       });

       $('#cancel_dish').click(function ()
       {
           var dishDetailId=$("#dishDetailID").val();
           $.ajax({
               url:"dishServer.php",
               data: {dishDetailId:dishDetailId,option:"deleteDish" },
               dataType: "text",
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
                       window.location.href="AllSelectedDishes.php>";
                   }
               }
           });

       });
        $('#ok').click(function ()
        {
            window.location.href="AllSelectedDishes.php";
        });

    });

</script>
</body>
</html>

