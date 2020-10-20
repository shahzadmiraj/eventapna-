<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-06
 * Time: 16:48
 */
include_once ("../connection/connect.php");

include  ("../access/userAccess.php");
    RedirectOtherwiseOnlyAccessUserOfOrderBooked("Owner,Employee","../index.php");

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);



$orderId=$processInformation[0][5];

$userid=$_COOKIE['userid'];
$timestamp = date('Y-m-d H:i:s');

//expired if alreaady exist
    $AlreadyDishesDishDetail=array();
    if(isset($_POST['AlreadyDishes']))
    $AlreadyDishesDishDetail=$_POST['AlreadyDishes'];
    $sql='SELECT  dd.id  FROM dish_detail as dd WHERE (ISNULL(dd.expire))AND (dd.orderDetail_id='.$orderId.')';
    $detailDishes=queryReceive($sql);
    $PreviousDishDetailIds=array_column($detailDishes, 0);
    $clean1 = array_diff($AlreadyDishesDishDetail, $PreviousDishDetailIds);
    $clean2 = array_diff($PreviousDishDetailIds, $AlreadyDishesDishDetail);
    $final_output = array_merge($clean1, $clean2);
    if(count($final_output)>0)
    {
        $List = implode(',', $final_output);
        $sql='UPDATE `dish_detail` SET `expire`="'.$timestamp.'",`expireUser`='.$userid.' WHERE id in ('.$List.')';
        querySend($sql);


        if($processInformation[0][3]=="")
        {
            $sql='SELECT sum(price) FROM `dish_detail` WHERE (orderDetail_id='.$orderId.')AND(ISNULL(expire))';
            $total=queryReceive($sql);
            $sql='UPDATE `orderDetail` SET `total_amount`='.(int)($total[0][0]).' WHERE id='.$orderId;
            querySend($sql);
        }
    }



    if((!isset($_POST['dishesid'])&&($processInformation[0][4]==0)))
    {
        header("location:../payment/getPayment.php?pid=$pid&token=$token");
        exit();
    }
    else if(!isset($_POST['dishesid']))
    {
        header("location:../order/PreviewOrder.php?pid=$pid&token=$token");
        exit();
    }
    /*else if(!isset($_POST['dishesid']))
    {
        echo   '<script>  window.history.back();</script>';
        exit();
    }*/

$dishesName=$_POST['dishesName'];
$dishesid=$_POST['dishesid'];
$prices=$_POST['prices'];
$images=$_POST['images'];

?>


<!DOCTYPE html>
<head>
    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Add Food Dish Order</title>
    <meta name="description" content="Add Foods Dish Order,Order Food dish services, New  Food dishes Order,insert Catering dish Order,Change  Catering Order, only company user can used this to get payment
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Add Food Dish Order Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">

    <script src="../webdesign/JSfile/JSFunction.js"></script>



    <style>
        .center {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 50%;
        }
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

$PageName="Catering Dishes Create";
include_once("../webdesign/orderWizard/wizardOrder.php");
?>

<div class="container">


    <ul class="list-group">
        <li class="text-center h5 list-group-item">Information of Dishes</li>
        <li class="list-group-item">Total number of dishes : <input readonly type="number" id="totalRemaing"  value="<?php echo count($dishesid);?>"></li>
        <li class="list-group-item">Total Amount : <input readonly type="number" id="AllTotalamount"  value="0"></li>
    </ul>
    <br>
    <hr>

    <input hidden type="number" id="orderIdindish" value="<?php echo $orderId;?>">

    <?php
    for($j=0;$j<count($dishesid);$j++)
    {


        ?>

        <form id="form_<?php echo $j; ?>">
            <input hidden type="number" name="orderid" value="<?php echo $orderId;?>">

            <input hidden type="number" name="userid" value="<?php echo $userid;?>">


            <input hidden type="number" name="dishId" value="<?php echo $dishesid[$j];?>">


            <div class="card shadow-lg p-4 mb-4 border  col-12">


                    <div class="card border-0">
                        <?php

                        $image='';

                        $sql='SELECT d.image FROM dish as d INNER JOIN dishWithAttribute as dwa
on (d.id=dwa.dish_id)
WHERE 
dwa.id='.$dishesid[$j].'';
                        $EachDishInfo=queryReceive($sql);

                        if(file_exists('../images/dishImages/'.$EachDishInfo[0][0])&&($EachDishInfo[0][0]!=""))
                        {
                            $image= '../images/dishImages/'.$EachDishInfo[0][0];
                        }
                        else
                        {
                            $image='../images/systemImage/imageNotFound.png';
                        }
                        ?>



                        <img  class="center" src="<?php echo $image;?>" style="height: 20vh;width: 40%" >

                        <div class="card-body">
                           <ul>
                               <li class="h5 text-center">Dish Name :<?php echo $dishesName[$j];?></li>
                               <li class="h5 text-center">Dish Price Id :<?php echo $dishesid[$j];?> </li>
                           </ul>
                        </div>
                </div>


                <div class="form-group row">

                <?
                $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishesid[$j].')';
                $AttributeDetail=queryReceive($sql);


                $display='';
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
                for($k=0;$k<count($AttributeDetail);$k++)
                {
                    $display.= ' 
    <tr>
      <th scope="row">'.($k+1).'</th>
      <td>'.$AttributeDetail[$k][0].'</td>
      <td>'.$AttributeDetail[$k][2].'</td>
   </tr>';

                }

                if (count($AttributeDetail) > 0) {
                    $display .= '</tbody>
</table>';
                }
                echo $display;

                ?>


                </div>


                <div class="form-group row">
                    <label class="col-form-label">Each price</label>


                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                        </div>
                        <input  readonly name="each_price" class="form-control" type="number" placeholder="etc one dish price 1000xx" value="<?php echo $prices[$j]; ?>">
                    </div>

                </div>

                <div class="form-group row">
                    <label class="col-form-label">Quantity</label>


                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-sort-amount-up"></i></span>
                        </div>
                        <input data-productprice="<?php echo $prices[$j];?>"  data-quantityid="<?php echo $j;?>"  id="quantity<?php echo $j; ?>" name="quantity" class="quantity form-control" type="number" placeholder="how many dishes 1,2,3,...">

                    </div>

                </div>

                <div class="form-group row">
                    <label class="col-form-label">Total Price</label>


                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-sort-amount-up"></i></span>
                        </div>
                        <input  id="TotalPrice<?php echo $j; ?>" readonly  class="EachTotalPrice form-control" type="number" >

                    </div>

                </div>


                <div class="form-group row">
                    <label class="col-form-label">describe</label>


                    <div class="input-group mb-3 input-group-lg">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-comments"></i></span>
                        </div>
                        <textarea name="describe" class="form-control" type="text" placeholder="important comments for dish"></textarea>
                    </div>


                </div>
                <div class="form-group row justify-content-center">
                    <button type="button" data-formid="<?php echo $j;?>" class="cancelForm form-control btn col-5 btn-danger" value="cancel"><i class="fas fa-trash-alt"></i>Cancel
                    </button>
                    <button type="button" data-formid="<?php echo $j;?>" class="submitForm form-control btn col-5 btn-primary" value="submit"><i class="fas fa-check "></i>Submit</button>
                </div>
            </div>

        </form>

        <?php
    }
    ?>


</div>




<?php
include_once ("../webdesign/footer/footer.php");
?>

<script>
    $(document).ready(function ()
    {
        $(document).on('keyup','.quantity',function ()
        {
            var Quantity=$(this).val();
            var id=$(this).data("quantityid");
            var productPrice=$(this).data("productprice");
            $("#TotalPrice"+id).val(Number(Quantity)*Number(productPrice))
            var Alltotalprice=0;
            $(".EachTotalPrice").each(function() {
                Alltotalprice=Alltotalprice+Number($(this).val());
            });
            $("#AllTotalamount").val(Alltotalprice);

        });

        $("#NextWizard").click(function (e) {
            e.preventDefault();
            <?php

            if($processInformation[0][4]==0)
            {
                //catering order also book and select dishes
                echo 'location.replace("../payment/getPayment.php?pid=' . $pid . '&token='.$token.'");';
            }
            ?>
        });



        $("#PreviouseWizard").click(function (e) {
            e.preventDefault();
            <?php

            if($processInformation[0][4]==0)
            {
                //catering order also book and select dishes
                echo 'location.replace("dishDisplay.php?pid=' . $pid . '&token='.$token.'");';
            }
            ?>
        });


       var totalitems= $("#totalRemaing").val();



       function redirect()
       {
           totalitems--;
            if(totalitems==0)
            {
                <?php
                if($processInformation[0][4]==0)
                {
                    //catering order also book and select dishes
                    echo 'location.replace("../payment/getPayment.php?pid=' . $pid . '&token='.$token.'");';
                }
                else
                {
                    echo 'location.replace("AllSelectedDishes.php?pid=' . $pid . '&token='.$token.'");';
                }
                ?>
            }
         $("#totalRemaing").val(totalitems);
       }

       $(document).on('click','.submitForm',function ()
       {
          var id=$(this).data("formid");

          var state=false;
          if(validationWithString("quantity"+id,"Please Enter Quantity of Dishes"))
              state=true;

          if(state)
              return false;
          var formdata=new FormData($("#form_"+id)[0]);
          formdata.append("option",'createDish');
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
                      $("#form_"+id).remove();
                      redirect();
                  }
               }
           });
       });
       $(document).on('click','.cancelForm',function () {
           var id=$(this).data("formid");
           $("#form_"+id).remove();
           redirect();
       });

    })


</script>
</body>
</html>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>