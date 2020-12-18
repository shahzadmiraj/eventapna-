<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
include_once ('dishesFunctions.php');
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





$sql='SELECT `id`,`cateringPackages_id` FROM `cateringPackageControl` WHERE (catering_id='.$cateringid.')AND(ISNULL(expire))
GROUP by (cateringPackages_id)
';
$dishDealPackageDetail=queryReceive($sql);

include('../companyDashboard/includes/startHeader.php'); //html
?>

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
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <!--<link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
    <script src="../webdesign/JSfile/JSFunction.js"></script>

    <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->

    <!-- Custom fonts for this template-->
    <link href="<?php echo $Root;?>companyDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <!-- Custom styles for this template-->
    <link href="<?php echo $Root;?>companyDashboard/css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
include('../companyDashboard/includes/endHeader.php');
include('../companyDashboard/includes/navbar.php');
?>


<?php
$ExtraButtonHandleOnTop ='';
if($processInformation[0][4]==0) {
    $ExtraButtonHandleOnTop = '
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
    </div>';
}
    ?>




<?php
$whichActive = 4;
$imageCustomer = "../images/customerimage/";
$PageName="Catering Dishes";
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
        <h3>Selected Menu</h3>
        <hr>


        <div id="showSelectedDishes" class="form-inline badge-light "  >

            <?php
            $sql='SELECT dd.id, dd.describe, dd.expire, dd.quantity, dd.orderDetail_id, dd.user_id, dd.dishWithAttribute_id, dd.active, dd.price, dd.expireUser ,(SELECT (SELECT d.name FROM dish as d WHERE d.id=dwa.dish_id) FROM dishWithAttribute as dwa WHERE dwa.id= dd.dishWithAttribute_id),dd.token,dd.image  FROM dish_detail as dd WHERE (ISNULL(dd.expire))AND (dd.orderDetail_id='.$order.')';
            $detailDishes=queryReceive($sql);


            $display="";

            for($i=0;$i<count($detailDishes);$i++)
            {

                $image='../images/systemImage/imageNotFound.png';
                if(file_exists('../images/users/'.$detailDishes[$i][11])&&($detailDishes[$i][11]!=""))
                {
                    $image= '../images/users/'.$detailDishes[$i][11];
                }

                $sql = 'SELECT d.id FROM dish as d   INNER JOIN dishWithAttribute as dwa
on (d.id=dwa.dish_id)
Where  (dwa.id=' . $detailDishes[$i][6] . ')';
                $DishDetail = queryReceive($sql);
                $display .= '<div id="RemoveAlreadySelected'.$detailDishes[$i][0].'" class="card col-md-4" >
                    <img class="card-img-top " src="'.$image.'" alt="Card image" style="width: 100%;height: 40vh" >
                    <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-concierge-bell mr-1"></i>Dish : '.$detailDishes[$i][10].'</h5>
                   </div>
                 ';
                $sql = 'SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id=' . $detailDishes[$i][6] . ')';
                $AttributeDetail = queryReceive($sql);
                if (count($AttributeDetail) > 0)
                {
                    $display .= ' 
 <table class="table table-striped">
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
      <td>' . $AttributeDetail[$k][2] . '</td>
   </tr>';
                }


                if (count($AttributeDetail) > 0) {
                    $display .= '</tbody>
</table>';
                }
                $display .= '

                       
                    <ul class="list-group list-group-flush">
                     <li class="list-group-item"> Already booked</li>
                     <li class="list-group-item"> Dish  id : ' . $DishDetail[0][0] . '</li>
                     <li class="list-group-item"> Price : ' . $detailDishes[$i][8] . '</i></li>
                     <li class="list-group-item"> Quantity : '.$detailDishes[$i][3].'</i></li>
                     <li class="list-group-item"> Total : '.($detailDishes[$i][8]*$detailDishes[$i][3]).'</i></li>
                    
                    </ul>

                    
                              <input type="number" hidden  name="AlreadyDishes[]" value="' . $detailDishes[$i][0] . '"> 
                   
                          <button type="button"  data-dishdetailid="' . $detailDishes[$i][0] . '" class="btn btn-danger AlreadyDishes  form-control"><i class="far fa-trash-alt"></i> Delete</button>
                </div>';
            }
            echo $display;



            //show Selected Deal
           echo GetAllShowOfSelectedDeals($order);

            ?>

<!--

            <div class="card col-md-4" style="width: 18rem;"  id="removeSelectedRowFromTableCard">
                <img class="card-img-top " src="" alt="Card image" style="width: 100%" >
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-concierge-bell mr-1"></i>Deal:</h5>
                    <p class="card-text">Detail :</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Deal id:</li>
                    <li class="list-group-item text-danger"><i class="far fa-money-bill-alt"></i> Per Head Rate: </li>
                    <li class="list-group-item">Quantity: </li>
                    <li class="list-group-item">Total Amount: </li>
                   <li class="list-group-item">Already Selected</li>
                </ul>

                <input  hidden type="number" name="SelectedDealid[]" value="">

                <button  data-buttonid=""  class="addDealOncart btn btn-primary form-control mt-5">Add Deal</button>
            </div>

            -->

        </div>



        <div class="form-group row col-12 justify-content-center mt-5 ">



            <?php
            if($processInformation[0][4]==0)
            {
                //processing
                echo '
        
            <a id="cancelDish" type="button" class="col-4 btn btn-danger form-control text-white"><< Back </a>
             <button id="SkipBtn" class="col-4 form-control btn btn-success">Skip>></button>
            <button id="submit" type="submit" class="btn-primary form-control btn col-4"> Next >></button>';

            }
            else
            {

                echo '
        
            <a id="cancelDish" type="button" class="col-6 btn btn-danger form-control text-white"><i class="fas fa-arrow-left"></i>Edit order</a>
            <button id="submit" type="submit" class="btn-primary form-control btn col-6"><i class="fas fa-check "></i>Submit</button>';
            }
            ?>



        </div>

    </form>




<div class="container badge-light" >

    <h3>Deals !</h3>
    <hr>
    <div class="row">
        <?php
        $display='';
        $imageForDB='';
        for($i=0;$i<count($dishDealPackageDetail);$i++)
        {
            $imageForDB='';

            $sql = 'SELECT `id`, `packageName`, `description`, `image`, `token`, `PerHeadprice`, `activeDate`, `expireDate`, `activeUser`, `expireUser` FROM `cateringPackages` WHERE (id=' . $dishDealPackageDetail[$i][1] . ')';
            $dishDetail=queryReceive($sql);
            $image='';

            if(file_exists('../images/cateringPackage/'.$dishDetail[0][3])&&($dishDetail[0][3]!=""))
            {
                $image= '../images/cateringPackage/'.$dishDetail[0][3];
                $imageForDB=$dishDetail[0][3];
            }
            else
            {
                $image='../images/systemImage/imageNotFound.png';
            }

            $display .='<div class="card m-auto" style="width: 18rem;">
  <img class="card-img-top " src="'.$image.'" alt="Card image" style="width: 100%;height: 40vh" >
  <div class="card-body">
    <h5 class="card-title"><i class="fas fa-concierge-bell mr-1"></i>' . $dishDetail[0][1] . '</h5>
    <p class="card-text">'. $dishDetail[0][2].'</p>
  </div>
  <ul class="list-group list-group-flush">
  <li class="list-group-item">Deal id:'. $dishDetail[0][0] . '</li>
    <li class="list-group-item text-danger"><i class="far fa-money-bill-alt"></i> Per Head Rate:   ' . $dishDetail[0][5] . '</li>
      <li class="list-group-item">Quantity: <input type="number" id="DealQuantity'.$dishDetail[0][0].'" placeholder="Quantity"></li>
      
  </ul>';

            $display.='    
                                    <button data-dealid="'.$dishDetail[0][0].'" data-dealname="'. $dishDetail[0][2].'" data-dealdescription="'.$dishDetail[0][1].'" data-dealimage="'.$image.'" data-dealprice="'.$dishDetail[0][5].'"  data-dealimagrealfordb="'.$imageForDB.'"   class="addDealOncart btn btn-primary form-control mt-5">Add Deal</button>

                                </div>';


        }
        echo $display;
        ?>





    </div>




    <h4>Catering Dishes</h4>
    <hr>
    <?php
    $imageForDB='';
    $DisplayModelOfDishes="";
        $display='';
        for($i=0;$i<count($dishTypeDetail);$i++)
        {
            $imageForDB='';
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
                    $imageForDB=$dishDetail[$j][2];
                }
                else
                {
                    $image='../images/systemImage/imageNotFound.png';
                }
        $display.='<img class="card-img-top " src="'.$image.'" alt="Card image" style="height: 100px" >
        
            <div  class="card-body ">
            <i class="fas fa-concierge-bell mr-1"></i>' . $dishDetail[$j][0] . '<br>
            <span> Dish type id # ' . $dishDetail[$j][1] . '</span>
            <button type="button"  data-image="'.$dishDetail[$j][2].'" data-dishname="'. $dishDetail[$j][0] .'"  data-dishid="'. $dishDetail[$j][1] .'"  data-dishimagrealfordb="'.$imageForDB.'"  data-toggle="modal" data-target="#myModal"   class="adddish col-12 mb-0 btn btn-primary"><i class="fas fa-check "></i>  Select</button>
            </div>
       
        </div>';

                $DisplayModelOfDishes.=showPriceofAllDishes($image,$dishDetail[$j][1],$dishDetail[$j][0],$imageForDB);


            }
            $display.='</div>';



        }
        echo $display;
    ?>

</div>


<div class="container">
    <?php


echo $DisplayModelOfDishes;

    ?>
</div>











<script>



    $(document).ready(function ()
    {




        function addSwal() {
            swal({
                html:true,
                title: "Add item",
                text: 'Item has been added',
                buttons: false,
                icon: "success",
                timer: 1500,
            });

        }
        function removeSWAL() {
            swal({
                title: "Deleted",
                text: 'Item has been Deleted',
                buttons: false,
                icon: "error",
                timer: 1500,
                html: true
            });
        }

        $(document).on('click',".removeSelectedRowFromTableCard",function ()
        {
            var buttonid=$(this).data("buttonid");
            $("#removeSelectedRowFromTableCard"+buttonid).remove();
            removeSWAL();

        });


        var count=0;
        function TableOFBodyMenuAdd(id,image,item,Type,description,price,InputQuantity,dishtypeid,dealimagrealfordb)
        {
            var text= '<div class="card col-md-4" style="width: 18rem;" id="removeRowFromTableCard'+count+'">'+
            '<img class="card-img-top " src="'+image+'" alt="Card image" style="width: 100%" >'+
            '<div class="card-body">'+
            '<h5 class="card-title"><i class="fas fa-concierge-bell mr-1"></i>Deal:'+item+'</h5>'+
            '<p class="card-text">Detail :'+description+'</p>'+
            '</div>'+
            '<ul class="list-group list-group-flush">'+
            '<li class="list-group-item">Deal id:'+id+'</li>'+
            '<li class="list-group-item "> Per Head Rate: '+price+'</li>'+
            '<li class="list-group-item">Quantity: '+InputQuantity+'</li>'+
                '<li class="list-group-item">Total Amount: '+(Number(price)*Number(InputQuantity))+'</li>'+
            '</ul>'+
            ' <input hidden type="text" name="CreateDealImage[]" value="'+image+'">'+
            '<input  hidden type="text" name="CreateDealName[]" value="'+item+'">'+
            '<input  hidden  type="text" name="CreateDealDetail[]" value="'+description+'">'+
            '<input   hidden type="number" name="CreateDealid[]" value="'+id+'">'+
            '<input  hidden  type="number" name="CreateDealPrice[]" value="'+price+'">'+
            '<input  hidden  type="number" name="CreateDealQuantity[]" value="'+InputQuantity+'">'+
            '<button data-removerow="'+count+'"  data-dealid="'+id+'" data-dealname="'+item+'" data-dealdescription="'+description+'" data-dealimage="'+image+'" data-dealprice="'+price+'"  data-dealimagrealfordb="'+dealimagrealfordb+'"   class="removeRowFromTableCard btn btn-danger form-control mt-5"><i class="far fa-trash-alt"></i> Remove Deal</button>'+
            '</div>';
            count++;
            return text;
        }

        $(document).on("click",".removeRowFromTableCard",function ()
        {
            var removerow=$(this).data("removerow");
            $("#removeRowFromTableCard"+removerow).remove();
            removeSWAL();
        });


        $(document).on("click",".addDealOncart",function ()
        {
            var dealid=$(this).data("dealid");
            var dealname=$(this).data("dealname");
            var dealdescription=$(this).data("dealdescription");
            var dealimage=$(this).data("dealimage");
            var dealprice=$(this).data("dealprice");
            var DealQuantity=$("#DealQuantity"+dealid).val();
            var dealimagrealfordb=$(this).data("dealimagrealfordb");
            if(validationWithString("DealQuantity"+dealid,"Please Enter Quantity of Deal"))
                return false;
            var text=TableOFBodyMenuAdd(dealid,dealimage,dealname,"Deal",dealdescription,dealprice,DealQuantity,"",dealimagrealfordb);
            $("#showSelectedDishes").append(text);
            //CompleteCalculation();
            addSwal();
        });

        $(document).on("click",".AlreadyDishes",function ()
        {
            var dishdetailid=$(this).data("dishdetailid");
            swal({
                title: "Deleted",
                text: 'Dish has been Deleted from Selected Dishes Menu',
                buttons: false,
                icon: "error",
                timer: 1500,
                html: true
            });
            $("#RemoveAlreadySelected"+dishdetailid).remove();

        });



       var countofdish=0;

        $(document).on("click",".DishAddOnform",function ()
        {
            var image=$(this).data("image");
            var dishName=$(this).data("dishname");
            var dishid=$(this).data("dishid");
            var price=$(this).data("price");
            var quantity=$("#QuatityDish"+dishid).val();
            var DishOrDeal=$("#DishOrDeal"+dishid).val();
            var dishimagrealfordb=$(this).data("dishimagrealfordb");

            if(validationWithString("QuatityDish"+dishid,"Please Enter Quantity of Dishes"))
            {
                $("#QuatityDish"+dishid).removeClass("btn-danger");
                $("#QuatityDish"+dishid).val();
                return false;
            }
            swal({
                html:true,
                title: "Added",
                text: 'Dish has been added to Selected Dishes Menu',
                buttons: false,
                icon: "success",
                timer: 1500,
            });

            var formdata = new FormData;
            formdata.append("image",image);
            formdata.append("dishid", dishid);
            formdata.append("price", price);
            formdata.append("dishName",dishName);
            formdata.append("countofdish",countofdish);
            formdata.append("DishOrDeal",DishOrDeal);
            formdata.append("quantity",quantity);
            formdata.append("dishimagrealfordb",dishimagrealfordb);
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
           $("#DishesTypeModel"+dishid).modal("show");
           return false;
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

          var id=$(this).data("dishid");
          $("#remove"+id).remove();
           swal({
               title: "Deleted",
               text: 'Dish has been Deleted from Selected Dishes Menu',
               buttons: false,
               icon: "error",
               timer: 1500,
               html: true
           });
       });


        $("#cancelDish").click(function ()
        {

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
                    if($.trim(data)!='')
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
<?php
include('../companyDashboard/includes/scripts.php');
include('../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>