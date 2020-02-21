<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-27
 * Time: 17:29
 */
include_once ("../../connection/connect.php");

if(!isset($_COOKIE['companyid']))
{
    header("location:../../user/userLogin.php");
}
$companyid=$_COOKIE['companyid'];
$CateringBranches=1;
$sql='SELECT name,id FROM systemDishType WHERE ISNULL(isExpire)';
$dishType=queryReceive($sql);

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
        form
        {
            margin: 5%;

        }

        .jumbotron
        {
            background-color: rgba(253, 253, 255, 0.95);
        }

    </style>
</head>
<body>





<?php
include_once ("../../webdesign/header/header.php");

?>
<div class="jumbotron  shadow" style="background-image: url(https://www.hnfc.com.my/data1/images/slide2.jpg);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-body " style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 text-center"><i class="fas fa-registered"></i> Catering Branches</h1>
    <p class="lead">Free register catering branches and also get free software . Book your order easily</p>
       <h1 class="text-center"> <a href="../companyRegister/companyEdit.php " class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>

    </div>

</div>



<?php

$H=0;
for($M=0;$M<$CateringBranches;$M++)
{

    echo '<div  class=" jumbotron container card-body border shadow mb-4" id="removeform'.$M.'">';
    $M++;
    echo '<h1 align="center"><i class="fas fa-utensils"></i> <i class="fas fa-registered"></i>Catering Registeration '.$M.'</h1>';
    $M--;
    echo '<form id="formsubmit'.$M.'" >';


    ?>
    <div class="form-group row ">
        <label class="col-form-label">Catering Branch name:</label>
<!--        <input name="namecatering" type="text" class="form-control col-8">-->


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-utensils"></i></span>
            </div>
            <input placeholder="Catering Branch name" name="namecatering" type="text" class="form-control">
        </div>
    </div>
    <div class="form-group row">
        <label class="col-form-label ">Catering Branch Image:</label>
<!--        <input name="image" type="file" class="form-control col-8">-->


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-camera"></i></span>
            </div>
            <input name="image" type="file" class="form-control">
        </div>
    </div>

    <div class="col-5">
        <p> Map of address</p>
    </div>
    <h3 align="center"><i class="far fa-hand-pointer"></i> Select Dishes</h3>

    <div class="form-group row">
        <?php

        $display = '';
        for ($i = 0; $i < count($dishType); $i++)
        {
            $display = '<h1 align="center" class="col-12  card">' . $dishType[$i][0] . '</h1>';
            $sql = 'SELECT `name`, `id`, `image` FROM `systemDish` WHERE ISNULL(isExpire)AND
systemDishType_id=' . $dishType[$i][1] . '';
            $dishDetail = queryReceive($sql);
            for ($j = 0; $j < count($dishDetail); $j++)
            {
                $display .= '
    <div class="col-4 shadow border btn-outline-warning m-2">
    
    <input id="dishtypename' .$H. '"  hidden type="text" name="dishtypename[]" value="' . $dishType[$i][0] . '">
    <input id="dishid' .$H. '"  hidden type="number" name="dishid[]" value="' . $dishDetail[$j][1] . '">
    <input id="dishname' . $H . '" name="dishname[]" hidden value="' . $dishDetail[$j][0] . '">
    <input id="image' . $H. '" name="image[]" hidden value="' . $dishDetail[$j][2] . '">
    <img class="col-12" src="';




                $str2 = substr($dishDetail[$j][2], 3);
                if (file_exists($str2)&&($str2!=""))
                {
                    $display.= $str2;
                }
                else
                {
                    $display.= '../../gmail.png';

                }



                $display.='" style="height: 20vh" >
    <p class="col-12"> ' . $dishDetail[$j][0] . '</p>
    <input   data-dishshow="' .$H. '" type="button" class="selectdish form-control col-12 btn-danger" value="Remove">
    </div>';
                $H++;
            }

        }
        echo $display;


        ?>
    </div>
    <div class="form-group row mt-3">



        <button data-formid="<?php echo $M; ?>" type="button" class="cancelform  btn btn-outline-danger col-5 form-control " value="cancel" ><span class="fas fa-window-close "></span>  Cancel</button>
        <button data-formid="<?php echo $M; ?>" type="button" class="submitform btn btn-primary col-5  form-control" value="submit"><i class="fas fa-check "></i>  Submit</button>
    </div>
    </form>

    <?php
    echo '</div>';

}
?>





<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function () {

        var NoCatering="<?php echo $CateringBranches;?>";
        $(document).on("click",".selectdish",function ()
        {
            var id=$(this).data("dishshow");
            var value=$(this).val();
            if(value=="Remove")
            {
                $("#dishtypename"+id).attr("name","");
                $("#dishid"+id).attr("name","");

                $("#dishname"+id).attr("name","");
                $("#image"+id).attr("name","");
                $(this).val("Select");
                $(this).removeClass("btn-danger");
                $(this).addClass("btn-success");
            }
            else
            {

                $("#dishtypename"+id).attr("name","dishtypename[]");
                $("#dishid"+id).attr("name","dishid[]");
                $("#dishname"+id).attr("name","dishname[]");
                $("#image"+id).attr("name","image[]");
                $(this).val("Remove");
                $(this).removeClass("btn-success");
                $(this).addClass("btn-danger");
            }

        });



        $(".submitform").click(function () {
            var formid=$(this).data("formid");
            var formdata=new FormData($("#formsubmit"+formid)[0]);
            formdata.append("option","createCatering");
            formdata.append("companyid",<?php  echo $companyid;?>);
            $.ajax({
                url:"../companyServer.php",
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
                    if(data!="")
                    {
                        alert(data);
                        return false;
                    }
                    else
                    {
                        window.history.back();
                    }
                }
            });


        });
        $(".cancelform").click(function ()
        {
            window.history.back();
        });






    });

</script>
</body>
</html>
