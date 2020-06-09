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


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$userid=$_COOKIE['userid'];
$sql='SELECT `id`, `name`, `token` FROM `hall` WHERE (ISNULL(expire))AND (company_id= '.$userdetail[0][0].')';
$HallName=queryReceive($sql);
$List=array();
$cateringid='';
$Active="All";
if(isset($_GET['id']))
{

    $id=$_GET['id'];
    $token=$_GET['token'];
    $cateringid=$id;
    $sql = 'SELECT  `name` FROM `hall` WHERE (id='.$id.')AND(token="'.$token.'")AND(ISNULL(expire))';
    $Halldetail = queryReceive($sql);
    if(count($Halldetail)<=0)
        exit();
    $List=$id;
    $Active=$id;

}
else
{

    $listOfCatering=array_column($HallName, 0);
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








<div class="container card">

    <h3 class="font-weight-bold">Extra items <a  href="CreateItem.php" class="float-right btn btn-success col-4 form-control"> + Add Extra item</a></h3>

    <ul class="nav nav-pills mb-3" >
        <li class="nav-item">
            <a class="nav-link <?php
            if($Active=="All")
            {
                echo "active";
            }

            ?>  "  data-cateringnumber="All"  href="?">All</a>
        </li>


        <?php


        $display="";
        for($i=0;$i<count($HallName);$i++)
        {
            $display.= '  
              
        <li class="nav-item">
            <a class="nav-link  ';

            if($Active==$HallName[$i][0])
                $display.="active";

            $display.='"   href="?id='.$HallName[$i][0].'&token='.$HallName[$i][2].'" >'.$HallName[$i][1].'</a>
        </li>';
        }
        echo $display;
        ?>

    </ul>

    <hr>
    <div class="col-12 form-group row font-weight-bold border">
        <label class="col-8  col-form-label "><i class="fas fa-sitemap"></i>Catergory</label>
        <label class="col-4  col-form-label ">Delete</label>
    </div>



        <?php
        $sql='SELECT EIT.id,EIT.name FROM ExtraItemControl as EIC INNER join  Extra_Item as EI 
on(EIC.Extra_Item_id=EI.id) INNER join Extra_item_type as EIT 
on (EI.Extra_item_type_id=EIT.id)
WHERE
(ISNULL(EIC.expire)) AND(ISNULL(EIT.expire))AND(EIC.hall_id in('.$List.'))
GROUP by (EIT.id)';
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

        <br>



        <?php

        $Display='';
        $display='';
        for($j=0;$j<count($Category);$j++)
        {

            $display.='<h4 data-dishtype="'.$j.'" data-display="hide"  class="dishtypes text-center btn-warning"><i class="fas fa-sitemap"></i>'.$Category[$j][1].'</h4>';



          //  $sql = 'SELECT d.name, d.id, (SELECT dt.name from dish_type as dt WHERE dt.id=d.dish_type_id),(SELECT dt.isExpire from dish_type as dt WHERE dt.id=d.dish_type_id), d.isExpire,d.image FROM dish as d WHERE dish_type_id=' . $Category[$j][0] . ' ';

            $sql='SELECT ex.id,ex.name,ex.price,ex.image,ex.active FROM Extra_Item as ex
 INNER join
 ExtraItemControl as EIC
 on(EIC.Extra_Item_id=ex.id)
 WHERE (ISNULL(ex.expire)) AND (ex.Extra_item_type_id='.$Category[$j][0].')AND(ISNULL(EIC.expire))AND(EIC.hall_id in('.$List.'))';
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
              Amount : '.$kinds[$i][2].' /Dish id# '.$kinds[$i][0].'
              
              <form id="changeActivationOfHall'.$kinds[$i][0].'" >
              
                 <input hidden name="companyid" value="'.$userdetail[0][0].'">

        <input hidden name="userid" value="'.$userid.'">

        <input hidden name="packageid" value="'.$kinds[$i][0].'">
              ';



                // start actavition of hall

                $sql = 'SELECT `hall_id`,`id`,(SELECT hall.name from hall WHERE hall.id=ExtraItemControl.hall_id) FROM `ExtraItemControl` WHERE (ISNULL(expire))AND(Extra_Item_id=' . $kinds[$i][0] . ')';
                $SelectiveHalls = queryReceive($sql);
                for ($K = 0; $K < count($SelectiveHalls); $K++) {
                    $display.= '  
              <div class="checkbox ">
                <h4><input class="changeActivationOfHall" data-formid="'.$kinds[$K][0].'" type="checkbox" checked  name="selectedHalls[]" value="' . $SelectiveHalls[$K][1] . '">  ' . $SelectiveHalls[$K][2] . '</h4>
                </div>';
                }
                $SelectiveHalls = array_column($SelectiveHalls, 0);
                $List = implode(', ', $SelectiveHalls);


                $sql = 'SELECT `id`, `name` FROM `hall` WHERE (ISNULL(expire))AND (company_id= ' . $userdetail[0][0] . ')AND( id NOT IN (' . $List . '))';
                $AllHalls = queryReceive($sql);
                for ($K = 0; $K < count($AllHalls); $K++) {
                    $display.= '  
              <div class="checkbox">
                <h4><input class="changeActivationOfHall" data-formid="'.$kinds[$K][0].'" type="checkbox"   name="hallactive[]" value="' . $AllHalls[$K][0] . '"> ' . $AllHalls[$K][1] . '</h4>
                </div>';
                }

                // end actavition of hall



                $display.='</form><button data-option="deleteItem" data-id='.$kinds[$i][0].' class="actionDelete btn btn-danger float-right"><i class="fas fa-minus-circle"></i> Delete</button>
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
//include_once ("../../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {

        function changeActivationOfHall(formid)
        {
            var formdata = new FormData($("#changeActivationOfHall"+formid)[0]);
            formdata.append("option","SubmitExtraItemHallSave");
            $.ajax({
                url:"hallitemsServer.php",
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
                }
            });
        }


        $(".changeActivationOfHall").change(function () {
            var formid=$(this).data("formid");
            changeActivationOfHall(formid);
        });


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
