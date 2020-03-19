<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");



if((!isset($_GET['catering']))||(!isset($_GET['dish'])))
{
    header("location:../companyRegister/companyEdit.php");
}
$encoded=$_GET['catering'];
$id=base64url_decode($encoded);
$encodedPack=$_GET['dish'];
$packageid=base64url_decode($encodedPack);
if(((!is_numeric($id))||$id=="")||((!is_numeric($packageid))||$packageid==""))
{
    header("location:../companyRegister/companyEdit.php");
}

$cateringid=$id;
$dishID=$packageid;
$sql='SELECT d.name,(SELECT dt.name FROM dish_type as dt WHERE dt.id=d.dish_type_id), d.image,(SELECT u.username FROM user as u WHERE u.id=d.user_id),d.active,d.id FROM dish as d WHERE d.id='.$dishID.'';
$dishDetail=queryReceive($sql);

$sql='SELECT dwa.id, dwa.active, dwa.expire, dwa.price, dwa.dish_id,(SELECT u.username FROM user as u WHERE u.id=dwa.user_id)  FROM dishWithAttribute as dwa WHERE (ISNULL(dwa.expire)) AND (dwa.dish_id='.$dishDetail[0][5].')';
$dishWithAttribute=queryReceive($sql);
$userid=$_COOKIE['userid'];

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
        <h1 class="display-5 text-center"><i class="fas fa-utensils fa-3x mr-1"></i> Edit Dish</h1>
        <p class="lead">Edit dish such as chieken biryan,halwa ...</p>
    </div>
</div>
<div class="container card">

        <div class="col-12 shadow card-header p-4">
            <input id="dishid" type="number" hidden value="<?php echo $dishID; ?>">

            <div class="form-group row justify-content-center">
                <img style="height: 30vh " src="<?php
                if(file_exists('../../../images/dishImages/'.$dishDetail[0][2])&&($dishDetail[0][2]!=""))
                {
                    echo '../../../images/dishImages/'.$dishDetail[0][2];
                }
                else
                {
                    echo 'https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';
                }

                ?>"   class="col-8 " alt="Image is not set" >
            </div>
            <div class="form-group row">
                <label class="col-form-label">Dish Name</label>


                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-concierge-bell"></i></span>
                    </div>
                    <input data-column="name"  readonly   value="<?php echo $dishDetail[0][0]; ?>" class="dishchange form-control" type="text">
                </div>



            </div>
            <div class="form-group row">
                <label class="col-form-label">Dish Type</label>




                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-minus"></i>
                    </div>



                    <input data-column="dish_type" readonly  value="<?php echo $dishDetail[0][1]; ?>" class="dishchange form-control" type="text">

                </div>

            </div>



            <div class="form-group row">
                <label class="col-form-label">Dish Active Date:</label>


                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input  readonly    value="<?php echo $dishDetail[0][4]; ?>" class="form-control" type="text">
                </div>



            </div>



            <div class="form-group row">
                <label class="col-form-label">Dish Active User :</label>
                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user-plus"></i></span>
                    </div>
                    <input readonly     value="<?php echo $dishDetail[0][3]; ?>" class="form-control" type="text">
                </div>
            </div>


            <hr>
            <div class="m-auto form-inline">

                                <h6 class="col-8">Price control with combination of attribute</h6>


                <!-- Button trigger modal -->
                <button  type="button" class="btn btn-success float-right col-4" data-toggle="modal" data-target="#exampleModal">
                    + Add
                </button>

                <!-- Modal -->
                <form id="formaddprice">
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-concierge-bell"></i> Dish Name :<?php echo $dishDetail[0][0]; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body form">


                                <?php


                                $sql='SELECT name FROM attribute WHERE (ISNULL(expire))AND(dishWithAttribute_id='.$dishWithAttribute[0][0].')
GROUP by name';
                                $TypeOfAttribute=queryReceive($sql);
                                echo '<input hidden name="dishid" value="'.$dishDetail[0][5].'">
                                <input hidden name="userid" value="'.$userid.'">
                                
                                ';


                                for($i=0;$i<count($TypeOfAttribute);$i++)
                                {
                                    echo '
                             
                               
                                            <div class="form-group row">
                <label class="col-form-label">'.$TypeOfAttribute[$i][0].'</label>
                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text">  <i class="fa fa-calculator" aria-hidden="true"></i> </span>
                    </div>
                     
                                    <input hidden type="number" name="attribute[]" value="'.$TypeOfAttribute[$i][0].'">
                                    <input type="number" name="quantity[]" class="form-control">
                </div>
            </div>
                                
                                
                                
                                
                                ';
                                }

                                echo '
                               
                                   <div class="form-group row">
                <label class="col-form-label">Price :</label>
                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <input type="number" name="price" class="form-control">
                </div>
            </div>
                                
                                
                                
                                ';


                                ?>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button id="addCombination" type="button" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>




                <div class="row">



                    <?php


                    $display='';

                    for($j=0;$j<count($dishWithAttribute);$j++)
                    {

                        $display.='  <div class="card" style="width: 18rem;">
                <div class="card-header text-danger">
                   <i class="fas fa-money-bill-alt"></i> '.$dishWithAttribute[$j][3].'
                </div>
                   <ul class="list-group list-group-flush">
                ';
                        $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishWithAttribute[$j][0].')';
                        $AttributeDetail=queryReceive($sql);


                        for($i=0;$i<count($AttributeDetail);$i++)
                        {
                            $display.=' <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i>'.$AttributeDetail[$i][0].':'.$AttributeDetail[$i][1].'</li>';
                        }

                        $display.='  
                     <li class="list-group-item"><i class="fas fa-user-plus"></i>'.$dishWithAttribute[$j][5].'</li>
                    <li class="list-group-item"><i class="far fa-calendar-alt"></i>'.$dishWithAttribute[$j][1].'</li>
                </ul>
                <div class="card-footer  m-auto">
                    <button  data-deleteid="'.$dishWithAttribute[$j][0].'" class="btn btn-danger deleteprice "><i class="far fa-trash-alt"></i>Delete</button>
                </div>
            </div>';

                    }





echo $display;
                    ?>


            <div class="card" style="width: 18rem;">
                <div class="card-header text-danger">
                    <i class="fas fa-money-bill-alt"></i>  Price
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i> AttributeName:quantity</li>
                    <li class="list-group-item"><i class="fas fa-user-plus"></i> Name:</li>
                    <li class="list-group-item"><i class="far fa-calendar-alt"></i>Active Date:</li>
                </ul>
                <div class="card-footer  m-auto">
                    <button class="btn btn-danger "><i class="far fa-trash-alt"></i>Delete</button>
                </div>
            </div>

        </div>




            <div class="form-group row">

              <button id="deletedish" data-dishid="<?php echo $dishDetail[0][5]; ?>" class="btn btn-danger"><i class="far fa-trash-alt"></i> Delete Dish</button>
            </div>


        </div>



</div>


<?php
include_once ("../../../webdesign/footer/footer.php");
?>

<script>
    //window.history.back();



    $(document).ready(function ()
    {




        $(".deleteprice").click(function (e)
        {
            e.preventDefault();

            var dishid=$(this).data("deleteid");
            $.ajax({
                url:"dishServer.php",
                method:"POST",
                data:{dishid:dishid,option:"ExpireDishPrice"},
                dataType:"text",

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
                        location.reload();
                    }
                }
            });

        });


        $("#deletedish").click(function (e)
        {
            e.preventDefault();
            var dishid=$(this).data("dishid");
            $.ajax({
                url:"dishServer.php",
                method:"POST",
                data:{dishid:dishid,option:"ExpireDish"},
                dataType:"text",

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


        var rows=0;

      /*  $("#addAttribute").click(function ()
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

        });*/


        $("#addCombination").click(function (e)
        {
            e.preventDefault();
            var formdata=new FormData($("#formaddprice")[0]);
            formdata.append("option","addnewDishprice");
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

                        location.reload();
                    }
                }
            });
        });

/*
        $(document).on("change",'.changeAttributes',function () {
           var attributeid=$(this).data("attributeid");
           var text=$(this).val();
           $.ajax({
              url:"dishServer.php",
               method: "POST",
               data: {attributeid:attributeid,text:text,option:"changeAttributes"},
               dataType:"text",

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
                        location.reload();
                    }
                }
            });




        });
*/


    });




</script>
</body>
</html>
