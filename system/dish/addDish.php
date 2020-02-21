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
<div class="jumbotron  shadow text-center" style="background-image: url(<?php
if(file_exists('../'.$cateringdetail[0][2]) &&($cateringdetail[0][2]!=""))
{
    echo '../'.$cateringdetail[0][2];
}
else
{
    echo "https://www.hnfc.com.my/data1/images/slide2.jpg";
}
?>
        );background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-body " style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 text-center"><i class="fas fa-utensils fa-3x mr-1"></i><?php echo $cateringdetail[0][0];?> Edit Catering Branches</h1>
        <p class="lead">Edit dishes information,dishes type,images and others </p>
    </div>
</div>




<div class="container">

    <form>
    <div class="col-12 shadow card p-4">
    <div class="form-group row">
<!--        <a href="#" class="form-control col-3 btn-warning"> Previous</a>-->
        <span class="font-weight-bold text-center col-9 form-control"> Add Dish in System</span>
    </div>
        <div class="form-group row">
            <label class="col-4 col-form-label">Dish Name</label>
            <input name="dishname" class="col-8 form-control" type="text">
        </div>
        <div class="form-group row">
            <label class="col-4 col-form-label">Dish Image</label>
            <input  name="image" class="col-8 form-control" type="file">
        </div>
        <div class="form-group row">
            <label class="col-4 col-form-label">Attribute Name</label>
            <input id="attributetext" class="col-6 form-control" type="text">
            <input id="addAttribute" type="button" class="col-2 form-control btn-primary" value="+">
        </div>
       <div class="col-12" id="attributeHere">

       </div>
        <div class="form-group row">
            <label class="col-4 col-form-label">Dish Type</label>
            <select name="dishtype" class="col-8 form-control">
                <?php $sql='SELECT `id`, `name` FROM `dish_type` WHERE 1' ;
                $dish_type=queryReceive($sql);
                for($i=0;$i<count($dish_type);$i++)
                {
                    echo '<option value="'.$dish_type[$i][0].'">'.$dish_type[$i][1].'</option>';
                }

                ?>
            </select>
        </div>
        <div class="form-group row">
            <a href="/Catering/system/dish/dishesDetail.php" class="col-4 form-control btn-danger"> Cancel</a>
            <input id="submit" type="button" value="Submit" class="col-8 form-control btn-success">
        </div>


    </div>
    </form>


</div>




<?php
include_once ("../../webdesign/footer/footer.php");
?>

<script>
    //window.history.back();



    $(document).ready(function ()
    {
        var rows=0;
        $("#addAttribute").click(function ()
        {
            var text=$("#attributetext").val();
            $("#attributeHere").append('<div class="form-group row" id="removeid_'+rows+'">\n' +
                '               <label class="col-4 col-form-label">Attribute Name</label>\n' +
                '               <input value="'+text+'" name="attribute[]" class="col-6 form-control" type="text">\n' +
                '               <input data-removeid="'+rows+'" type="button" class="col-2 form-control btn-danger removeattribute" value="-">\n' +
                '           </div>');
            $("#attributetext").val("");
            rows++;

        }) ;

        $(document).on('click','.removeattribute',function ()
        {
            var id=$(this).data("removeid");
            $("#removeid_"+id).remove();

        });


        $("#submit").click(function (e) {
           e.preventDefault();
           var formdata=new FormData($("form")[0]);
            formdata.append("option","addDishsystem");//addDishsystem
             $.ajax({
              url:"dishServer.php",
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
                      window.location.href="dishesDetail.php";
                  }
              }
          });
        });



    });




</script>
</body>
</html>
