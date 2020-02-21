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
<div class="jumbotron  shadow text-center" style="background-image: url(https://shaadishopblog.files.wordpress.com/2015/10/indian-wedding-punjabi-jain-kunal-shveta-bride-groom-hotel-irvine-global-photography-lehenga-sherwani-sera-manohar-delhi-palace-indian-food.jpg?w=720&h=480);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-body " style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 text-center"><i class="fas fa-utensils fa-3x mr-1"></i> Add new Dish</h1>
        <p class="lead">Add new dish such as chieken biryan,halwa ...</p>
    </div>
</div>

<div class="container">

    <form>
        <input type="number" hidden name="cateringid" value="<?php echo $cateringid;?>">
        <div class="form-group row">
            <label class="col-form-label">Dish Name</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input name="dishname" class="form-control" type="text" placeholder="Dish name etc chicken biryan">
            </div>

        </div>
        <div class="form-group row">
            <label class="col-form-label">Dish Image</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input  name="image" class="form-control" type="file">
            </div>


        </div>
        <div class="form-group row">
            <label class="col-form-label">Attribute Name</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input id="attributetext" class="form-control" type="text" placeholder="etc rice,chieken ,... ">
                <input id="addAttribute" type="button" class="col-2 form-control btn-primary" value="+">
            </div>


        </div>
       <div class="col-12" id="attributeHere">

       </div>
        <div class="form-group row">
            <label class="col-form-label">Dish Type</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>

                <select id="dishtype" name="dishtype" class="form-control">
                    <?php

                    $sql='SELECT `id`, `name` FROM `dish_type` WHERE (ISNULL(isExpire))AND(catering_id='.$cateringid.')';
                    $dish_type=queryReceive($sql);

                    for($i=0;$i<count($dish_type);$i++)
                    {
                        echo '<option value="'.$dish_type[$i][0].'">'.$dish_type[$i][1].'</option>';
                    }
                    echo '<option value="others">others</option>'
                    ?>
                </select>
            </div>



        </div>

        <div id="showdishtype" class="row" style="display: none">
            <label class="form-check-label">Other Dish Type</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input type="text" name="otherdishType" class="form-control" placeholder="add new dish type">
            </div>


        </div>


        <div class="form-group row justify-content-center">
            <button id="cancel" type="button" class="col-5 form-control btn-danger btn" value="cancel"><span class="fas fa-window-close "></span>  Cancel</button>
            <button id="submit" type="button" value="Submit" class="col-5 form-control btn-success btn"><i class="fas fa-check "></i>  Submit</button>
        </div>


    </form>


</div>




<?php
include_once ("../../../webdesign/footer/footer.php");
?>

<script>



    $(document).ready(function ()
    {



        function checkdishType()
        {
            if($("#dishtype").val()!="others")
            {
                $("#showdishtype").hide('slow');

            }
            else
            {

                $("#showdishtype").show('slow');
            }
        }

        $("#dishtype").change(function ()
        {
            checkdishType();

        });
        checkdishType();

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
                     window.history.back();
                  }
              }
          });
        });
        $("#cancel").click(function (e)
        {
            window.history.back();
        });



    });




</script>
</body>
</html>
