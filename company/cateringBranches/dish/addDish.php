<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");
include  ("../../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner","../../../index.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$userid=$_COOKIE['userid'];
$companyid=$userdetail[0][0];

$sql='SELECT `id`, `name`, `token` FROM `catering` WHERE (ISNULL(expire))AND (company_id= '.$userdetail[0][0].')';
$CateringName=queryReceive($sql);
$listOfCatering=array_column($CateringName, 0);
$List = implode(',', $listOfCatering);


include('../../../companyDashboard/includes/startHeader.php'); //html
?>

    <?php
    include('../../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Add Dish </title>
    <meta name="description" content="Add Dish ,Add food,new dish only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Add Dish Add food,new dish Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script src="../../../jquery-3.3.1.js"></script>
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <!--<link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
    <script src="../../../webdesign/JSfile/JSFunction.js"></script>

    <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->

    <!-- Custom fonts for this template-->
    <link href="<?php echo $Root;?>companyDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <!-- Custom styles for this template-->
    <link href="<?php echo $Root;?>companyDashboard/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



<?php
include('../../../companyDashboard/includes/endHeader.php');
include('../../../companyDashboard/includes/navbar.php');

?>


    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Dish</h1>

        </div>
    </div>

<div class="container">

    <form class="row" id="AddDishForm">

        <input type="number" hidden name="userid" value="<?php echo $userid;?>">
        <input hidden name="companyid" value="<?php echo $companyid;?>">
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Dish Name</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-concierge-bell"></i></span>
                </div>
                <input id="dishname" name="dishname" class="form-control" type="text" placeholder="Dish name etc chicken biryan">
            </div>

        </div>
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Dish Image</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input  name="image" class="form-control" type="file">
            </div>


        </div>
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Attribute Name</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-calculator" aria-hidden="true"></i></span>
                </div>
                <input id="attributetext" class="form-control" type="text" placeholder="etc rice,chieken ,... ">
                <input id="addAttribute" type="button" class="col-2 form-control btn-primary" value="+">
            </div>

            <ul id="myAttributelist" class="container">
            </ul>

        </div>
       <div class="col-sm-12   col-12 col-md-12 col-lg-12" id="attributeHere">

       </div>



        <div class="col-sm-12   col-12 col-md-12 col-lg-12" style="overflow-x: scroll"  id="addtable">


        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6" id="singleprice">
            <label class="col-form-label">Dish Price</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                </div>
                <input   id="dishprice" name="dishprice" class="form-control" type="number" placeholder="Dish Price">
            </div>

        </div>



        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Dish Type</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-minus"></i></span>
                </div>
                <select id="dishtype" name="dishtype" class="form-control">
                    <?php


                    //dish type of catering
                    $sql='SELECT dt.id,dt.name FROM dishControl as dc INNER join  dish as d 
on(dc.dish_id=d.id) INNER join dish_type as dt 
on (d.dish_type_id=dt.id)
WHERE
(ISNULL(dc.expire)) AND(ISNULL(dt.expire))AND(dc.catering_id in('.$List.'))
GROUP by (dt.id)';

                    $dishTypeDetail=queryReceive($sql);


                    for($i=0;$i<count($dishTypeDetail);$i++)
                    {
                        echo '<option value="'.$dishTypeDetail[$i][0].'">'.$dishTypeDetail[$i][1].'</option>';
                    }
                    echo '<option value="others">others</option>'
                    ?>
                </select>
            </div>



        </div>

        <div id="showdishtype" class="col-sm-12   col-12 col-md-6 col-lg-6" style="display: none">
            <label class="form-check-label">Other Dish Type</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-minus"></i></span>
                </div>
                <input id="otherdishType" type="text" name="otherdishType" class="form-control" placeholder="add new dish type">
            </div>


        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">


            <lable  class="col-form-label">Select catering for dishes active</lable>


            <?php
            $sql='SELECT `id`, `name` FROM `catering` WHERE (ISNULL(expire))AND (company_id= '.$companyid.')';
            $allbranch=queryReceive($sql);
            for($i=0;$i<count($allbranch);$i++)
            {
                echo '  
              <div class="checkbox">
                <h4><input type="checkbox" checked  name="branchactive[]" value="'.$allbranch[$i][0].'"> '.$allbranch[$i][1].'</h4>
                </div>';
            }
            ?>

        </div>



        <div class="col-sm-12   col-12 col-md-12 col-lg-12 form-inline">
            <button id="cancel" type="button" class="col-sm-6   col-6 col-md-6 col-lg-6 btn-danger btn" value="cancel"><span class="fas fa-window-close "></span>  Cancel</button>
            <button id="submit" type="button" value="Submit" class="col-sm-6   col-6 col-md-6 col-lg-6 btn-primary btn"><i class="fas fa-check "></i>  Submit</button>
        </div>


    </form>


</div>





<script>



    $(document).ready(function ()
    {
        function  AddSwalFunction() {
            swal({
                html:true,
                title: "Add item",
                text: 'Item has been added',
                buttons: false,
                icon: "success",
                timer: 1500,
            });

        }

        function  RemoveSwalFunction() {
            swal({
                title: "Deleted",
                text: 'Item has been Deleted',
                buttons: false,
                icon: "error",
                timer: 1500,
                html: true
            });

        }

        $(document).on("keyup","#attributetext",function (e)
        {

            e.preventDefault();
            var value=$(this).val();
            if(value=="")
                return false;
            $.ajax({
                url:"dishServer.php",
                data:{value:value,option:"checkAttributeExistByKeyUp",company_id:"<?php echo $companyid;?>"},
                dataType:"text",
                method: "POST",
                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    $("#myAttributelist").html(data);
                }
            });
        });

        $(document).on("click",".rightAttribute",function (e)
        {

            e.preventDefault();
            var attributename=$(this).data("attributename");
            $("#attributetext").val($.trim(attributename));
        });

        var attributecount=0;
        var rowadded=0;
        function rowaddedfucntion()
        {
            var text= '   <tr id="deletePrice'+rowadded+'">\n' +
                '                    <th scope="row"><button data-deleterow="'+rowadded+'"  class="btn btn-danger deleteRow"><i class="fas fa-trash-alt"></i>Delete</button></th>\n' ;


            $(".nameofattribute").each( function() {
                text+= ' <td><input type="number" name="quantity[]" class="Quantity" placeholder="Quantity"></td>\n' ;
            });



            text+= ' <td><input type="number" name="price[]" class="Price" placeholder="Price"></td>\n' +
                '\n' +
                '                </tr>\n' ;
            rowadded++;


            $("#appendrow").append(text);

        }
        $(document).on('click',".deleteRow",function (e)
        {
            e.preventDefault();
            var id=$(this).data("deleterow");
            $("#deletePrice"+id).remove();
            RemoveSwalFunction();

        });


        function refreshTable()
        {
            if(attributecount==0)
            {
                $("#addtable").html("");
                $("#singleprice").show();
                return false;
            }

            $("#singleprice").hide();
            var text=' <div class="m-auto form-inline">\n' +
                '\n' +
                '                <h6 class="col-8">Price control with combination of attribute</h6>\n' +
                '                <button id="addCombination" class="btn btn-success float-right col-4 ">Add</button>\n' +
                '            </div>\n' +
                '\n' +
                '            <table class="table table-striped"   >\n' +
                '\n' +
                '                <thead id="headingrow">\n' +
                '\n' +
                '                <tr>\n' +
                '                    <th scope="col"><i class="fas fa-trash-alt"></i>Delete</th>\n' ;


            $(".nameofattribute").each( function() {
                text+=' <th scope="col"><i class="fa fa-calculator" aria-hidden="true">Item : </i>'+$(this).val()+'</th>\n';
            });

            text+=   ' <th scope="col"><i class="fas fa-money-bill-alt"></i>Total Price </th>\n' +
                '                </tr>\n' +
                '                </thead>\n' +
                '                <tbody id="appendrow">\n' +

                '                </tbody>\n' +
                '            </table>';

            $("#addtable").html(text);



            rowaddedfucntion();



        }

        $(document).on('click','#addCombination',function (e)
        {
            e.preventDefault();
            rowaddedfucntion();
            AddSwalFunction();
        });


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
            if(validation($("#attributetext"),"Please Enter item Name"))
                return false;

            $("#attributeHere").append('<div class="form-group row" id="removeid_'+rows+'">\n' +
                '               <label class="col-4 col-form-label">Item Name</label>\n' +
                '               <input readonly data-removeid="'+rows+'" value="'+text+'" name="attribute[]" class="col-6 form-control nameofattribute" type="text">\n' +
                '               <input data-removeid="'+rows+'" type="button" class="col-2 form-control btn-danger removeattribute" value="-">\n' +
                '           </div>');
            $("#attributetext").val("");
            attributecount++;
            refreshTable();
            rows++;

            AddSwalFunction();
        }) ;

        $(document).on('click','.removeattribute',function ()
        {
            var id=$(this).data("removeid");
            $("#removeid_"+id).remove();
            attributecount--;
            refreshTable();
            RemoveSwalFunction();

        });


        $("#submit").click(function (e)
        {

            var state=false;
           e.preventDefault();

            if(validationWithString("dishname","Please enter Dish Name "))
               state=true;


           var DishType=$("#dishtype");
           if(DishType.val()=="others")
           {
                   if(validationWithString("otherdishType","Please enter Dish Type "))
                   state=true;
           }
           if(attributecount==0)
           {
               if(validationWithString("dishprice","Please Enter Price"))
                   state=true;
           }


            if(validationClass("Quantity","Pleas enter Quantity in Attributes"))
                state=true;


            if(validationClass("Price","Pleas enter Quantity in Price"))
                state=true;


            if(state)
                return false;
            if (!confirm('Are you sure you want to Add  food dish in Food & Catering  Branches?'))
                return  false;
           var formdata=new FormData($("#AddDishForm")[0]);
            formdata.append("option","addDishsystem");//addDishsystem
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
                if($.trim(data)!='')
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
<?php

include('../../../companyDashboard/includes/scripts.php');
include('../../../companyDashboard/includes/footer.php');

?>
<?php
include_once ("../../../webdesign/footer/EndOfPage.php");
?>