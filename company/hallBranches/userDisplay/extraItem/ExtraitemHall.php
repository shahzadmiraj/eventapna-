<?php
include_once ('../../../../connection/connect.php');


$hallid=$_SESSION['branchtypeid'];

$sql='SELECT `id`, `name` FROM `Extra_item_type` WHERE  ISNULL(expire)AND(hall_id='.$hallid.')';
$ExtraType=queryReceive($sql);
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../../../bootstrap.min.css">
    <script src="../../../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../../../webdesign/css/complete.css">


    <style>

    </style>


</head>
<body>

<?php
include_once ("../../../../webdesign/header/header.php");

?>

<div class="jumbotron jumbotron-fluid text-center" style="background-image: url(<?php
if((file_exists('../../images/hall/'.$halldetail[0][5]))&&($halldetail[0][5]!=""))
{
    echo "'../../images/hall/".$halldetail[0][5]."'";
}
else
{
    echo "https://www.pakvenues.com/system/halls/cover_images/000/000/048/original/Umar_Marriage_Hall_lahore.jpg?1566758537";
}
?>);background-repeat: no-repeat ;background-size: 100% 100%">
    <div class="container" style="background-color: white;opacity: 0.7">
        <h1 class="display-4"><i class="fas fa-clipboard-list fa-1x"></i>  </h1>
        <p class="lead">You can manage month wise prize list.Prize list consist of per head with food  and per head only seating .</p>
    </div>
</div>


<div class="container">

    <h2>What Extra Charges (optional)</h2>
    <hr>



        <?php
        $display='';
        for ($j=0;$j<count($ExtraType);$j++)
        {


            $display = '<h4  data-dishtype="'.$j.'" data-display="hide" class="col-md-12 text-center dishtypes badge-info">'.$ExtraType[$j][1].' </h4>
    <div id="dishtype'.$j.'"  class="row   " style="display: none">


';

            $sql='SELECT `id`,`image`, `price`,`name` FROM `Extra_Item` WHERE (ISNULL(expire))AND(Extra_item_type_id='.$ExtraType[$j][0].')';

            $Extraitem=queryReceive($sql);
            $image = "";
            for ($i = 0; $i < count($Extraitem); $i++) {
                $image = $Extraitem[$i][1];
                if ((file_exists('../../images/hallExtra/' . $image)) && ($image != ""))
                    $image = '../../images/hallExtra/' . $image;
                else
                    $image = 'https://static1.bigstockphoto.com/3/1/1/large1500/113342513.jpg';

                $display .= '
            
            <div class="col-md-4 mb-5 ">
            <div class="card h-100">
                <img src="' . $image . '" class="card-img-top" src="" alt="Image">
                <div class="card-body">
                    <h6 class="card-title">' . $Extraitem[$i][3] . '<span class="float-right text-danger">Amount ' . $Extraitem[$i][2] . '</span></h6>
                </div>
            </div>
            </div>
            
            ';
            }
            $display.=' </div>';
        }
        echo $display;
        ?>


</div>














<?php

include_once ("../../../../webdesign/footer/footer.php");
?>

<script>

$(document).ready(function () {

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
