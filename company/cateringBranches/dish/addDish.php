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
$List = implode(', ', $listOfCatering);

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
include_once ("../../../webdesign/header/header.php");
?>

<div class="container card">
<h1 class="text-muted text-center">Add Dish</h1>
    <form>

        <input type="number" hidden name="userid" value="<?php echo $userid;?>">
        <input hidden name="companyid" value="<?php echo $companyid;?>">
        <div class="form-group row">
            <label class="col-form-label">Dish Name</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-concierge-bell"></i></span>
                </div>
                <input id="dishname" name="dishname" class="form-control" type="text" placeholder="Dish name etc chicken biryan">
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
                    <span class="input-group-text"><i class="fa fa-calculator" aria-hidden="true"></i></span>
                </div>
                <input id="attributetext" class="form-control" type="text" placeholder="etc rice,chieken ,... ">
                <input id="addAttribute" type="button" class="col-2 form-control btn-primary" value="+">
            </div>

            <ul id="myAttributelist" class="container">
            </ul>

        </div>
       <div class="card" id="attributeHere">

       </div>



        <div class="card" style="overflow-x: scroll"  id="addtable">


        </div>


        <div class="form-group row" id="singleprice">
            <label class="col-form-label">Dish Price</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                </div>
                <input   id="dishprice" name="dishprice" class="form-control" type="number" placeholder="Dish Price">
            </div>

        </div>



        <div class="form-group row">
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

        <div id="showdishtype" class="row" style="display: none">
            <label class="form-check-label">Other Dish Type</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar-minus"></i></span>
                </div>
                <input id="otherdishType" type="text" name="otherdishType" class="form-control" placeholder="add new dish type">
            </div>


        </div>

        <div class="form-group card">


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



        <div class="form-group row justify-content-center">
            <button id="cancel" type="button" class="col-5 form-control btn-danger btn" value="cancel"><span class="fas fa-window-close "></span>  Cancel</button>
            <button id="submit" type="button" value="Submit" class="col-5 form-control btn-primary btn"><i class="fas fa-check "></i>  Submit</button>
        </div>


    </form>


</div>




<?php
include_once ("../../../webdesign/footer/footer.php");
?>

<script>



    $(document).ready(function ()
    {

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
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
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
                text+=' <th scope="col"><i class="fa fa-calculator" aria-hidden="true">Attribute : </i>'+$(this).val()+'</th>\n';
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
            if(validation($("#attributetext"),"Please Enter Attribute Name"))
                return false;

            $("#attributeHere").append('<div class="form-group row" id="removeid_'+rows+'">\n' +
                '               <label class="col-4 col-form-label">Attribute Name</label>\n' +
                '               <input readonly data-removeid="'+rows+'" value="'+text+'" name="attribute[]" class="col-6 form-control nameofattribute" type="text">\n' +
                '               <input data-removeid="'+rows+'" type="button" class="col-2 form-control btn-danger removeattribute" value="-">\n' +
                '           </div>');
            $("#attributetext").val("");
            attributecount++;
            refreshTable();
            rows++;
        }) ;

        $(document).on('click','.removeattribute',function ()
        {
            var id=$(this).data("removeid");
            $("#removeid_"+id).remove();
            attributecount--;
            refreshTable();

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
