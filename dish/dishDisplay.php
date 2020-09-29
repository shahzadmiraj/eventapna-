<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");

include  ("../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfOrderBooked("Owner,Employee","../index.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$userid=$_COOKIE['userid'];


$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);

$order=$processInformation[0][5];


$sql='SELECT p.id,p.describe,p.isFood,od.catering_id FROM orderDetail as od INNER join packageDate as pd
on (od.packageDate_id=pd.id)
INNER join packages as p
on (p.id=pd.package_id)
WHERE
(od.id='.$order.')
';
$hallpackage=queryReceive($sql);
$sql='SELECT catering_id FROM `orderDetail` WHERE id='.$order.'';
$cateringresult=queryReceive($sql);
$cateringid=$cateringresult[0][0];

$sql='SELECT dt.id,dt.name FROM dishControl as dc INNER join  dish as d 
on(dc.dish_id=d.id) INNER join dish_type as dt 
on (d.dish_type_id=dt.id)
WHERE
(ISNULL(dc.expire)) AND(ISNULL(dt.expire))AND(dc.catering_id in('.$cateringid.'))
GROUP by (dt.id)';
$dishTypeDetail=queryReceive($sql);
?>
<!DOCTYPE html>
<head>
    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Select Food Dish Order</title>
    <meta name="description" content="Select Foods Dish Order,Choose Food dish for catering order, Select  Food dishes Order,Select Catering dish Order,Select  Catering Order, only company user can used this to get payment
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Select Food Dish Order Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <style>

    </style>
</head>
<body>

<?php
include_once ("../webdesign/header/header.php");
if($processInformation[0][4]==0)
{
    ?>
    <div class="container">
        <div class="row" >

            <div class="container">
                <ul class="pagination float-right">
                    <li class="page-item ">
                        <a class="page-link" href="#"  id="PreviouseWizard" >Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#" id="CloseWizard">Close</a></li>
                    <li class="page-item"><a class="page-link" href="#" id="NextWizard">Next</a></li>
                </ul>
            </div>
        </div>
    </div>
    <?php
}
?>


<?php

$whichActive = 4;
$imageCustomer = "../images/customerimage/";
$PageName="Catering Dishes Select";
include_once("../webdesign/orderWizard/wizardOrder.php");

?>


<?php
if(count($hallpackage)>0)
{
    //show hall packages
    if ($hallpackage[0][2] == 1) {
        echo '<div id="selectmenu" class="container"  >
                  
                  </div>';
    }
}
?>




    <form  id="formid" method="post" action="<?php echo 'dishCreate.php?pid='.$pid.'&token='.$token.'' ?>" class="container alert-light ">
        <h1>Selecting Dishes </h1>
        <hr>
        <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <h4 class="mr-auto">Dish Deleted</h4>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                hello,you have successfully Deleted dish
            </div>
        </div>

        <div id="showSelectedDishes" class="form-inline badge-light "  >

            <?php
            $sql='SELECT dd.id, dd.describe, dd.expire, dd.quantity, dd.orderDetail_id, dd.user_id, dd.dishWithAttribute_id, dd.active, dd.price, dd.expireUser ,(SELECT (SELECT d.name FROM dish as d WHERE d.id=dwa.dish_id) FROM dishWithAttribute as dwa WHERE dwa.id= dd.dishWithAttribute_id),dd.token  FROM dish_detail as dd WHERE (ISNULL(dd.expire))AND (dd.orderDetail_id='.$order.')';
            $detailDishes=queryReceive($sql);
            $display="";

            for($i=0;$i<count($detailDishes);$i++)
            {


                $sql = 'SELECT d.id FROM dish as d   INNER JOIN dishWithAttribute as dwa
on (d.id=dwa.dish_id)
Where  (dwa.id=' . $detailDishes[$i][6] . ')';
                $DishDetail = queryReceive($sql);


                $display .= '<div id="RemoveAlreadySelected'.$detailDishes[$i][0].'" class="card col-md-4" >

                    <ul>
                    <li class="text-center h4 font-weight-bold"> <i class="fas fa-concierge-bell mr-1"></i>' . $detailDishes[$i][10] . '</li>
                   
                    <li> Dish Price Id : ' . $detailDishes[$i][6] . '</li>
                     <li> Dish  id : ' . $DishDetail[0][0] . '</li>
                       <li> Already booked with ' . $detailDishes[$i][3] . ' Quantity</li>
                    <li> <i class="fas fa-money-bill-alt text-danger float-right">Price : ' . $detailDishes[$i][8] . '</i><br></li>
                   
                    </ul>';


                $sql = 'SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id=' . $detailDishes[$i][6] . ')';
                $AttributeDetail = queryReceive($sql);
                if (count($AttributeDetail) > 0) {


                    $display .= ' <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Item name</th>
      <th scope="col">Quantity</th>
    </tr>
  </thead>
  <tbody>';

                }
                // special dish with attribute and quantity
                for ($k = 0; $k < count($AttributeDetail); $k++) {
                    $display .= ' 
    <tr>
      <th scope="row">' . ($k + 1) . '</th>
      <td>' . $AttributeDetail[$k][0] . '</td>
      <td>' . $AttributeDetail[$k][1] . '</td>
   </tr>';

                }


                if (count($AttributeDetail) > 0) {
                    $display .= '</tbody>
</table>';
                }
                $display .= '<div class="card-footer m-auto">
                              <input type="number" hidden  name="AlreadyDishes[]" value="' . $detailDishes[$i][0] . '"> 
                           
                          <button type="button"  data-dishdetailid="' . $detailDishes[$i][0] . '" class="btn btn-danger AlreadyDishes "><i class="far fa-trash-alt"></i>Delete</button>
                    </div>
                </div>';
            }
            echo $display;


            ?>
        </div>



        <div class="form-group row col-12 justify-content-center mt-5 ">



            <?php
            if($processInformation[0][4]==0)
            {
                //processing
                echo '
        
            <a id="cancelDish" type="button" class="col-4 btn btn-danger form-control"><< Back </a>
             <button id="SkipBtn" class="col-4 form-control btn btn-success">Skip>></button>
            <button id="submit" type="submit" class="btn-primary form-control btn col-4"> Next >></button>';

            }
            else
            {

                echo '
        
            <a id="cancelDish" type="button" class="col-6 btn btn-danger form-control"><i class="fas fa-arrow-left"></i>Edit order</a>
            <button id="submit" type="submit" class="btn-primary form-control btn col-6"><i class="fas fa-check "></i>Submit</button>';
            }
            ?>



        </div>

    </form>


<div class="container badge-light" >
    <h1>Catering Dishes</h1>
    <hr>
    <?php

        $display='';
        for($i=0;$i<count($dishTypeDetail);$i++)
        {
            $display.='<h4 data-dishtype="'.$i.'" data-display="hide" align="center " class="dishtypes col-12 btn-warning">Dish type '.($i+1).' :  <i class="fas fa-sitemap mr-1"></i> '.$dishTypeDetail[$i][1].'</h2>';


            $sql = 'SELECT d.name, d.id,d.image,d.dish_type_id FROM dish as d
 INNER join
 dishControl as dc
 on(dc.dish_id=d.id)
 WHERE (dish_type_id=' . $dishTypeDetail[$i][0] . ')AND(ISNULL(d.expire))AND(ISNULL(dc.expire))AND(dc.catering_id in('.$cateringid.')) ';


            $dishDetail=queryReceive($sql);
            //print_r($dishDetail);style="display: none"
            $display.='<div id="dishtype'.$i.'"  class="row"  style="display: none">';
            for ($j=0;$j<count($dishDetail);$j++)
            {
                $display .= ' 
         <div  class="card col-md-4" >';





                $image='';


                if(file_exists('../images/dishImages/'.$dishDetail[$j][2])&&($dishDetail[$j][2]!=""))
                {
                    $image= '../images/dishImages/'.$dishDetail[$j][2];
                }
                else
                {
                    $image='../images/systemImage/imageNotFound.png';
                }


        $display.='<img class="card-img-top " src="'.$image.'" alt="Card image" style="height: 100px" >
        
            <div  class="card-body ">
            <i class="fas fa-concierge-bell mr-1"></i>' . $dishDetail[$j][0] . '<br>
            <span> Dish id # ' . $dishDetail[$j][1] . '</span>
            <button type="button"  data-image="'.$dishDetail[$j][2].'" data-dishname="'. $dishDetail[$j][0] .'"  data-dishid="'. $dishDetail[$j][1] .'"   data-toggle="modal" data-target="#myModal"   class="adddish col-12 mb-0 btn btn-primary"><i class="fas fa-check "></i>  Select</button>
            </div>
       
        </div>';
            }
            $display.='</div>';
        }
        echo $display;
    ?>

</div>








<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" >





        <!-- Modal content-->
        <div class="modal-content"  id="AddDishDetail"  >

        </div>

    </div>



</div>




<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>


    $(document).ready(function ()
    {

        $(document).on("click",".AlreadyDishes",function () {
            var dishdetailid=$(this).data("dishdetailid");
            $("#RemoveAlreadySelected"+dishdetailid).remove();
        });



       var countofdish=0;

        $(document).on("click",".DishAddOnform",function ()
        {
            $('.toast').toast('show');
            var image=$(this).data("image");
            var dishName=$(this).data("dishname");
            var dishid=$(this).data("dishid");
            var price=$(this).data("price");
            var formdata = new FormData;
            formdata.append("image",image);
            formdata.append("dishid", dishid);
            formdata.append("dishName",dishName);
            formdata.append("countofdish",countofdish);
            formdata.append("price",price);
            formdata.append("option", "AddDishOnForm");
            $.ajax({
                url: "DishDisplayServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    $("#showSelectedDishes").append(data);
                    countofdish++;
                }

            });


        });




        $(".adddish").click(function ()
       {
           var image=$(this).data("image");
           var dishName=$(this).data("dishname");
           var dishid=$(this).data("dishid");
           var formdata = new FormData;
           formdata.append("dishid", dishid);
           formdata.append("image",image);
           formdata.append("dishName",dishName);
           formdata.append("option", "showPriceofAllDishes");

           $.ajax({
               url: "DishDisplayServer.php",
               method: "POST",
               data: formdata,
               contentType: false,
               processData: false,

               beforeSend: function() {
                   $('#pleaseWaitDialog').modal();
               },
               success:function (data)
               {
                   $('#pleaseWaitDialog').modal('hide');
                   $("#AddDishDetail").html(data);
               }

           });
       });

       $(document).on('click','.remove',function ()
       {

           $('.toast').toast('show');
          var id=$(this).data("dishid");
          $("#remove"+id).remove();
       });


        $("#cancelDish").click(function () {

            <?php
            if($processInformation[0][4]==0)
            {
                //process is running

                if(!empty($processInformation[0][2]))
                {
                    // came from catering order

                    echo 'location.replace("../order/orderEdit.php?pid=' . $pid . '&token='.$token.'");';
                }
                else
                {
                    //came from hall order
                    echo 'location.replace("../company/hallBranches/EdithallOrder.php?pid=' . $pid . '&token='.$token.'");';
                }

            }
            else
            {
                echo "window.history.back();";
            }
            ?>



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


        function menushow(Orderid,PackageDescribe)
        {
            var formdata = new FormData;
            formdata.append("Orderid", Orderid);
            formdata.append("option", "viewmenu");
            $.ajax({
                url: "dishServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    if(data!="")
                    {
                        $("#selectmenu").html('<br><h4 align="center" class=\'col-12\'>Package Menu</h4>');
                        $("#selectmenu").append(data);
                        $("#selectmenu").append("<p  class='col-12'>Menu Description:" + PackageDescribe + "</p>");
                    }
                }
            });
        }

        <?php

            if(count($hallpackage)>0)
            {
                if ($hallpackage[0][2] == 1) {
                    echo 'menushow(' . $order. ',"' . $hallpackage[0][1] . '");';
                }
            }

    ?>

        $("#SkipBtn,#NextWizard").click(function (e) {
            e.preventDefault();
            <?php
            echo 'location.replace("../payment/getPayment.php?pid='.$pid.'&token='.$token.'");';
            ?>
        });


    });


</script>
</body>
</html>
