<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");

include  ("../../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfDish("Owner","../../../index.php");

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);


$packageid=$_GET['Did'];
$packagetoken=$_GET['Dtoken'];


$dishID=$packageid;
$sql='SELECT d.name,(SELECT dt.name FROM dish_type as dt WHERE dt.id=d.dish_type_id), d.image,(SELECT u.username FROM user as u WHERE u.id=d.user_id),d.active,d.id FROM dish as d WHERE (d.id='.$dishID.')AND(ISNULL(d.expire))AND(d.token="'.$packagetoken.'")';
$dishDetail=queryReceive($sql);
//

$sql='SELECT dwa.id, dwa.active, dwa.expire, dwa.price, dwa.dish_id,(SELECT u.username FROM user as u WHERE u.id=dwa.user_id)  FROM dishWithAttribute as dwa WHERE (ISNULL(dwa.expire)) AND (dwa.dish_id='.$dishDetail[0][5].')';
$dishWithAttribute=queryReceive($sql);
$userid=$_COOKIE['userid'];

$companyid=$userdetail[0][0];
?>
<!DOCTYPE html>
<head>
    <?php
    include('../../../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Edit Dish </title>
    <meta name="description" content="Edit Dish ,Edit food,change dish only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Edit Dish Edit food,change dish Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script src="../../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../../webdesign/css/complete.css">

    <script src="../../../webdesign/JSfile/JSFunction.js"></script>
    <link rel="stylesheet" href="../../../Fractional-Star-Rating-jsRapStar/jsRapStar.css" />
    <link rel="stylesheet" href="../../../Fractional-Star-Rating-jsRapStar/index.css" />
    <script src="../../../Fractional-Star-Rating-jsRapStar/jsRapStar.js"></script>
    <style>
        .checked {
            color: orange;
        }
    </style>
</head>
<body>
<?php
include_once ("../../../webdesign/header/header.php");

?>
<div class="container ">


    <form id="EditPackageForm">
    <h1 align="center" class="text-muted">Dish Edit</h1>

        <div class="col-12 shadow card-header p-4">
            <input hidden name="companyid" value="<?php echo $companyid;?>">
            <input name="dishid" id="dishid" type="number" hidden value="<?php echo $dishID; ?>">
            <input name="userid" type="number" hidden value="<?php echo $userid; ?>">

            <div class="form-group row justify-content-center">
                <img style="height: 30vh " src="<?php
                if(file_exists('../../../images/dishImages/'.$dishDetail[0][2])&&($dishDetail[0][2]!=""))
                {
                    echo '../../../images/dishImages/'.$dishDetail[0][2];
                }
                else
                {

                    echo '../../../images/systemImage/imageNotFound.png';
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

            <div class="card">
            <lable  class="col-form-label">Select Catering branches for dish active</lable>


            <?php
            //
            $sql='SELECT `catering_id`,`id`,(SELECT catering.name from catering WHERE catering.id=dishControl.catering_id) FROM `dishControl` WHERE (ISNULL(expire))AND(dish_id='.$dishDetail[0][5].')';
            $Selective=queryReceive($sql);
            for($i=0;$i<count($Selective);$i++)
            {
                echo '  
              <div class="checkbox">
                <h4><input type="checkbox" checked  name="selected[]" value="'.$Selective[$i][1].'"> '.$Selective[$i][2].'</h4>
                </div>';
            }
            $Selective=array_column($Selective, 0);
            $List = implode(', ', $Selective);



            $sql='SELECT `id`, `name` FROM `catering` WHERE (ISNULL(expire))AND (company_id= '.$companyid.')AND( id NOT IN ('.$List.'))';
            $All=queryReceive($sql);
            for($i=0;$i<count($All);$i++)
            {
                echo '  
              <div class="checkbox">
                <h4><input type="checkbox"   name="active[]" value="'.$All[$i][0].'"> '.$All[$i][1].'</h4>
                </div>';
            }
            ?>

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
    </form>


            <hr>
            <div class="m-auto form-inline">

                                <h6 class="col-8">Price control with combination of attribute</h6>


                <!-- Button trigger modal -->
                <button  type="button" class="btn btn-success float-right col-4" data-toggle="modal" data-target="#exampleModal">
                    + Add Price
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
                <label class="col-form-label">Attribute name: '.$TypeOfAttribute[$i][0].' :</label>
                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text">  <i class="fa fa-calculator" aria-hidden="true"></i> </span>
                    </div>
                     
                                    <input hidden type="number" name="attribute[]" value="'.$TypeOfAttribute[$i][0].'">
                                    <input   type="number" name="quantity[]" class="Quantity form-control" placeholder="Quantity of product">
                </div>
            </div>
                               
                                ';
                                }

                                echo '
                               
                                   <div class="form-group row">
                <label class="col-form-label">Total price :</label>
                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <input  id="priceInDish" type="number" name="price" class="form-control" placeholder="Total price">
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

                        $display.='  <div class="card m-2">
                <div class="card-header text-danger">
                   <i class="fas fa-money-bill-alt"></i>Total price: '.$dishWithAttribute[$j][3].'
                </div>
                   <ul class="list-group list-group-flush">
                ';
                        $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishWithAttribute[$j][0].')';
                        $AttributeDetail=queryReceive($sql);


                        for($i=0;$i<count($AttributeDetail);$i++)
                        {
                            $display.=' <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i>Attribute Name : '.$AttributeDetail[$i][0].'  , Quantity : '.$AttributeDetail[$i][1].'</li>';
                        }

                        $display.='  
                     <li class="list-group-item"><i class="fas fa-user-plus"></i>'.$dishWithAttribute[$j][5].'</li>
                    <li class="list-group-item"><i class="far fa-calendar-alt"></i>'.$dishWithAttribute[$j][1].'</li>
                </ul>
                <div class="card-footer  m-auto">
                    <button  data-deleteid="'.$dishWithAttribute[$j][0].'" class="btn btn-danger deleteprice "><i class="far fa-trash-alt"></i>Delete Price </button>
                </div>
            </div>';

                    }





echo $display;
                    ?>


           <!-- <div class="card" style="width: 18rem;">
                <div class="card-header text-danger">
                    <i class="fas fa-money-bill-alt"></i>  Price
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i> AttributeName:quantity</li>
                    <li class="list-group-item"><i class="fas fa-user-plus"></i> Name:</li>
                    <li class="list-group-item"><i class="far fa-calendar-alt"></i>Active Date:</li>
                </ul>
                <div class="card-footer  m-auto">
                    <button class="btn btn-danger "><i class="far fa-trash-alt"></i>Delete Price</button>
                </div>
            </div>-->

        </div>







        </div>


    <div class="row">
        <button id="deletedish" data-dishid="<?php echo $dishDetail[0][5]; ?>" class="btn btn-danger col-6"><i class="far fa-trash-alt"></i> Delete Dish</button>
        <button id="SubmitFormPackage"  type="button"  class="btn btn-primary col-6 m-auto">Submit</button>

    </div>

</div>




<?php
include_once ("../../../webdesign/footer/footer.php");
?>

<script>
    //window.history.back();
    var scores=3;
    $(document).ready(function(){
        $('#demo1').jsRapStar({
            onClick:function(score){
                $(this)[0].StarF.css({color:'red'});
                scores=score;
            }});
    });



    $(document).ready(function ()
    {


        $("#SubmitFormPackage").click(function ()
        {
            var formdata = new FormData($("#EditPackageForm")[0]);
            formdata.append("option","SubmitPackagesSave");
            $.ajax({
                url:"dishServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {

                    $('#pleaseWaitDialog').modal('hide');

                    window.history.back();
                }
            });
        });


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
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
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
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
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
            var state=false;
            if(validationWithString("priceInDish","Please Enter Dish Price"))
                state=true;
            if(validationClass("Quantity","Please Enter Quantity of Attribute"))
                state=true;

            if(state)
                return false;
            var formdata=new FormData($("#formaddprice")[0]);
            formdata.append("option","addnewDishprice");
            $.ajax({
                url:"dishServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
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
