<?php
include_once ('../../../../connection/connect.php');




$id=$_GET['h'];
$token=$_GET['token'];
$sql='SELECT `name`,`image` FROM `hall` WHERE (id='.$id.')AND(token="'.$token.'")AND(ISNULL(expire))';
$halldetail=queryReceive($sql);

$sql='SELECT `id`, `name` FROM `Extra_item_type` WHERE  ISNULL(expire)AND(hall_id='.$id.')';
$ExtraType=queryReceive($sql);
?>
<!DOCTYPE html>
<head>
    <?php
    include('../../../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Manage Extra Item Hall</title>
    <meta name="description" content="Hall Manage Extra Item page,Manage Extra Item Hall,Manage Extra Item Marquee,Manage Extra Item Add Marquee,Manage Extra Item New Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Hall Manage Extra Item page,Add Manage Extra Item Hall Marquee,Marquee,Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../../../../bootstrap.min.css">
    <script src="../../../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../../bootstrap.min.js"></script>
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
//include_once ("../../../../webdesign/header/header.php");

?>

<?php
$HeadingImage=$halldetail[0][1];
$HeadingName=$halldetail[0][0];
$Source='../../../../images/hall/';
$pageName='Extra items';
include_once ("../../../ClientSide/Company/Box.php");
?>



<div class="container">





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

//include_once ("../../../../webdesign/footer/footer.php");
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
