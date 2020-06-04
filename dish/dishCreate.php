<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-06
 * Time: 16:48
 */
include_once ("../connection/connect.php");
$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);


$orderId=$processInformation[0][5];
$dishesName=$_POST['dishesName'];
$dishesid=$_POST['dishesid'];
$prices=$_POST['prices'];
$images=$_POST['images'];
$userid=$_COOKIE['userid'];


?>


<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">

    <script src="../webdesign/JSfile/JSFunction.js"></script>



    <style>

    </style>
</head>
<body>


<?php
//include_once ("../webdesign/header/header.php");

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

    <h4 align="center" class="alert-light">Total number of dishes<input readonly type="number" id="totalRemaing" class="btn font-weight-bold " value="<?php echo count($dishesid);?>"></h4>

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


                    <div class="m-auto card">
                        <?php

                        $image='';


                        if(file_exists('../images/dishImages/'.$images[$j])&&($images[$j]!=""))
                        {
                            $image= '../images/dishImages/'.$images[$j];
                        }
                        else
                        {
                            $image='https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';
                        }
                        ?>



                        <img src="<?php echo $image;?>" style="height: 20vh;width: 100%">
                        <h4 ><?php echo $dishesName[$j]; ?></h4>
                </div>


                <div class="form-group row">

                    <ul>
                <?
                $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishesid[$j].')';
                $AttributeDetail=queryReceive($sql);

                // special dish with attribute and quantity
                for($i=0;$i<count($AttributeDetail);$i++)
                {
                    echo ' <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i>'.$AttributeDetail[$i][0].' :  '.$AttributeDetail[$i][1].'</li>';
                }
                ?>

                    </ul>
                </div>


                <div class="form-group row">
                    <label class="col-form-label">each price</label>


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
                        <input id="quantity<?php echo $j; ?>" name="quantity" class="form-control" type="number" placeholder="how many dishes 1,2,3,...">

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
//include_once ("../webdesign/footer/footer.php");
?>

<script>
    $(document).ready(function ()
    {


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

    });

</script>
</body>
</html>
