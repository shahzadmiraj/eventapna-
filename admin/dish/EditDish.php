<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../connection/connect.php");

$dishID=$_GET['dishid'];
$sql='SELECT d.name,(SELECT dt.name FROM systemDishType as dt WHERE dt.id=d.systemDishType_id), d.image, d.systemDishType_id, d.isExpire FROM systemDish as d WHERE d.id='.$dishID.'';
$dishDetail=queryReceive($sql);
$sql='SELECT `name`, `id`, `systemDish_id`, `isExpire` FROM `SystemAttribute` WHERE ISNULL(isExpire) AND (systemDish_id='.$dishID.')';
$attributes=queryReceive($sql);
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
<div class="container"  style="margin-top:100px">

        <div class="col-12 shadow card p-4">
            <input id="dishid" type="number" hidden value="<?php echo $dishID; ?>">
            <div class="form-group row">
                <span class="font-weight-bold text-center form-control"> Edit Dish in System</span>
            </div>

            <div class="form-group row">
                <img style="height: 30vh " src="<?php

                if(file_exists('../../images/dishImages/'.$dishDetail[0][2])&&($dishDetail[0][2]!=""))
                {
                    echo '../../images/dishImages/'.$dishDetail[0][2];
                }
                else
                {
                    echo 'https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';
                }


                ?>"   class="form-control" alt="Image is not set" >
            </div>
            <div class="form-group row">
                <label class="col-4 col-form-label">Dish Name</label>
                <input data-column="name"  value="<?php echo $dishDetail[0][0]; ?>" class="dishchange col-8 form-control" type="text">
            </div>
            <form id="formImage">
            <div class="form-group row">
                <label class="col-4 col-form-label"> Changes images</label>
                <input id="dishImage"  name="image"  class="col-8 form-control" type="file">
                <input type="text" hidden name="imagepath" value="<?php echo $dishDetail[0][2]; ?>">
            </div>
            </form>
            <div class="form-group row">
                <label class="col-4 col-form-label">Dish Type</label>
                <select data-column="systemDishType_id" class="dishchange col-8 form-control">

                    <?php
                    echo '<option value="'.$dishDetail[0][3].'">'.$dishDetail[0][1].'</option>';

                    $sql='SELECT `id`, `name` FROM `systemDishType` WHERE id!='.$dishDetail[0][3].'' ;
                    $dish_type=queryReceive($sql);
                    //print_r($dish_type);

                    for($i=0;$i<count($dish_type);$i++)
                    {
                        echo '<option value="'.$dish_type[$i][0].'">'.$dish_type[$i][1].'</option>';
                    }

                    ?>
                </select>
            </div>

            <div class="col-12  card mb-3 p-4" id="existAttributes">
                <h4 align="center">Exist Attributes</h4>

                <?php
                for($i=0;$i<count($attributes);$i++)
                {
                    echo ' <div class="form-group row " id="delete_'.$attributes[$i][1].'">
                    <label class="col-4 col-form-label">Attribute Name</label>
                    <input data-attributeid="'.$attributes[$i][1].'" value="'.$attributes[$i][0].'" class="changeAttributes col-6 form-control" type="text">
                    <input data-attributeid="'.$attributes[$i][1].'" type="button" class="RemoveAttribute col-2 form-control btn-secondary" value="-">
                </div>';
                }

                ?>



            </div>
            <h4 align="center">New attribute</h4>
            <div class="form-group row">
                <label class="col-4 col-form-label">Attribute Name</label>
                <input id="attributetext" class="col-6 form-control" type="text">
                <input id="addAttribute" type="button" class="col-2 form-control btn-primary" value="+">
            </div>

            <form id="formAttribute">
            <div class="col-12" id="attributeHere">

            </div>
            </form>

            <div class="form-group row">

                <?php
                    if($dishDetail[0][4]=="")
                    {
                        echo '<input id="RemoveDish" type="button" class=" col-4 form-control btn-danger" value="Hide dish">';
                    }
                    else
                    {

                        echo '<input id="RemoveDish" type="button" class=" col-4 form-control btn-primary " value="Show dish">';
                    }
                ?>

                <input id="submit" type="button" value="Submit" class="col-8 form-control btn-success">
            </div>


        </div>



</div>



<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>
    //window.history.back();



    $(document).ready(function ()
    {
        var dishid=$("#dishid").val();
        $("#RemoveDish").click(function ()
        {
            var value=$(this).val();

            $.ajax({
                url:"dishServer.php",
                method:"POST",
                data:{value:value,dishid:dishid,option:"ExpireDish"},
                dataType:"text",
                success:function (data)
                {
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

        var rows=0;

        $("#addAttribute").click(function ()
        {
            var text=$("#attributetext").val();
            $("#attributeHere").append('<div class="col-12 form-group row" id="removeid_'+rows+'">\n' +
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


        $("#submit").click(function (e)
        {
            e.preventDefault();
            var dishid=$("#dishid").val();
            var formdata=new FormData($("#formAttribute")[0]);
            formdata.append("option","attributesCreate");
            formdata.append("dishid",dishid);
            $.ajax({
                url:"dishServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,
                success:function (data)
                {
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

        $(document).on("change",'.changeAttributes',function () {
           var attributeid=$(this).data("attributeid");
           var text=$(this).val();
           $.ajax({
              url:"dishServer.php",
               method: "POST",
               data: {attributeid:attributeid,text:text,option:"changeAttributes"},
               dataType:"text",
               success:function (data)
               {
                   if(data!='')
                   {
                       alert(data);
                   }

               }
           });
        });



        $(document).on("click",'.RemoveAttribute',function () {
            var attributeid=$(this).data("attributeid");
            $.ajax({
                url:"dishServer.php",
                method: "POST",
                data: {attributeid:attributeid,option:"RemoveAttribute"},
                dataType:"text",
                success:function (data)
                {
                    if(data!='')
                    {
                        alert(data);
                    }
                    else
                    {
                        $("#delete_"+attributeid).remove();
                    }

                }
            });
        });


        $(document).on("change",'.dishchange',function () {
            var dishid=$("#dishid").val();
            var column=$(this).data("column");
            var text=$(this).val();
            $.ajax({
                url:"dishServer.php",
                method: "POST",
                data: {dishid:dishid,column:column,text:text,option:"dishchanges"},
                dataType:"text",
                success:function (data)
                {
                    if(data!='')
                    {
                        alert(data);
                    }

                }
            });
        });

        $("#dishImage").change(function ()
        {
           var formData=new FormData($("#formImage")[0]);
           formData.append("dishId",dishid);
           formData.append("option","changeImage");
            $.ajax({
                url:"dishServer.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function (data)
                {
                    if(data!='')
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
