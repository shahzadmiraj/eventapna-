<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-07
 * Time: 13:49
 */
include_once ("../connection/connect.php");


$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);

$dishDetailId='';
if(isset($_GET['dish']))
{
    $dishDetailId=base64url_decode($_GET['dish']);
    if(!is_numeric($dishDetailId))
    {
        exit();
    }
}
else
{
    exit();
}

$orderid=$processInformation[0][5];
//$sql='SELECT `describe`, `price`, `quantity`, `dish_id` FROM `dish_detail` WHERE id='.$dishDetailId.'';
$sql='SELECT dd.id, dd.describe, dd.expire, dd.quantity, dd.orderDetail_id, dd.user_id, dd.dishWithAttribute_id, dd.active, dd.price, dd.expireUser ,(SELECT (SELECT d.name FROM dish as d WHERE d.id=dwa.dish_id) FROM dishWithAttribute as dwa WHERE dwa.id= dd.dishWithAttribute_id),(SELECT (SELECT d.image FROM dish as d WHERE d.id=dwa.dish_id) FROM dishWithAttribute as dwa WHERE dwa.id= dd.dishWithAttribute_id),(SELECT u.username FROM user as u WHERE u.id=dd.user_id),(SELECT u.username FROM user as u WHERE u.id=dd.expireUser)  FROM dish_detail as dd WHERE  (dd.id='.$dishDetailId.')';
$dishDetailOfDetai=queryReceive($sql);

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

    <style>

    </style>
</head>
<body>

<?php
//include_once ("../webdesign/header/header.php");
$whichActive = 6;
$imageCustomer = "../images/customerimage/";
$PageName="Catering Dish Preview";
include_once("../webdesign/orderWizard/wizardOrder.php");
?>



<div class="container card">
<?php

$image='';
if(file_exists('../images/dishImages/'.$dishDetailOfDetai[0][11])&&($dishDetailOfDetai[0][11]!=""))
{
    $image= '../images/dishImages/'.$dishDetailOfDetai[0][11];
}
else
{
    $image='https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';
}
?>
    <form id="form">

    <div class="row m-auto">
        <div class="card">
            <img src="<?php echo $image;?>" style="height: 20vh;width: 100%">
            <h2 ><?php echo $dishDetailOfDetai[0][10];?></h2>
        </div>
    </div>


        <div class="form-group row">


            <ul class="list-group list-group-flush">



                <?
                $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishDetailOfDetai[0][6].')';
                $AttributeDetail=queryReceive($sql);

                // special dish with attribute and quantity
                for($j=0;$j<count($AttributeDetail);$j++)
                {
                    echo ' <li class="list-group-item "><h2><i class="fa fa-calculator" aria-hidden="true"></i> '.$AttributeDetail[$j][0].' :  '.$AttributeDetail[$j][1].'</h2></li>';
                }
                ?>
            </ul>
        </div>

    <input hidden id="dishDetailID" value="<?php echo $dishDetailOfDetai[0][0];?>">

        <input hidden id="orderid" value="<?php echo $orderid;?>">


        <input hidden id="userid" value="<?php echo $userid;?>">

    <div class="form-group row">
        <label  class="col-form-label">Each price</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
            </div>
            <input readonly class="form-control" type="number" value="<?php echo $dishDetailOfDetai[0][8];?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-form-label">Quantity</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-sort-amount-up"></i></span>
            </div>
            <input readonly  class="form-control" type="number" value="<?php echo $dishDetailOfDetai[0][3];?>">
        </div>
    </div>

        <div class="form-group row">
            <label  class="col-form-label">Total Amount</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                </div>
                <input id="TotalDishesAmount" readonly class="form-control" type="number" value="<?php echo $dishDetailOfDetai[0][3]*$dishDetailOfDetai[0][8];?>">
            </div>
        </div>



    <div class="form-group row">
        <label class="col-form-label">Describe</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comments"></i></span>
            </div>
        <textarea readonly class="form-control"><?php echo $dishDetailOfDetai[0][1];?></textarea>
        </div>
    </div>

        <div class="form-group row">
            <label class="col-form-label">Active User:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input  readonly class="form-control" type="text" value="<?php echo $dishDetailOfDetai[0][12];?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-form-label">Active Date:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i> </span>
                </div>
                <input  readonly class="form-control" type="datetime" value="<?php echo $dishDetailOfDetai[0][7];?>">
            </div>
        </div>

        <?php
         if($dishDetailOfDetai[0][2])
         {
             ?>

             <div class="form-group row ">
                 <label class="col-form-label">Expire User:</label>
                 <div class="input-group mb-3 input-group-lg">
                     <div class="input-group-prepend">
                         <span class="input-group-text"><i class="fas fa-user"></i> </span>
                     </div>
                     <input  readonly class="form-control text-danger" type="text" value="<?php echo $dishDetailOfDetai[0][13];?>">
                 </div>
             </div>

             <div class="form-group row">
                 <label class="col-form-label">Expire Date:</label>
                 <div class="input-group mb-3 input-group-lg">
                     <div class="input-group-prepend">
                         <span class="input-group-text"><i class="far fa-calendar-alt"></i>   </span>
                     </div>
                     <input  readonly class="form-control text-danger" type="datetime" value="<?php echo $dishDetailOfDetai[0][2];?>">
                 </div>
             </div>
             <?php
         }
         else
         {
             echo ' <button id="cancel_dish"  type="button"  class="cancelForm form-control btn  btn-danger" value="dish cancel"><i class="fas fa-trash-alt"></i> Delete</button>';
         }
        ?>

</div>
</form>



<?php
//include_once ("../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function ()
    {
       $(document).on('change','.attributeChange',function () {
           var attributeid=$(this).data('attributeid');
           var  valueAttribute=$(this).val();

            $.ajax({
              url:"dishServer.php",
                data:{attributeid:attributeid,value:valueAttribute,option:"attributeChange"},
              method:"POST",
                dataType:"text",

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
              }
          });
       }) ;
       $(document).on('change','.dishDetailChange',function () {
           var dishDetailId=$("#dishDetailID").val();
           var columnName=$(this).data("column");
           var columnValue=$(this).val();

           $.ajax({
              url:"dishServer.php",
              data: {dishDetailId:dishDetailId,columnName:columnName,columnValue:columnValue,option:"dishDetailChange" },
               dataType: "text",
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
               }
           });
       });

       $('#cancel_dish').click(function ()
       {
           var orderid=$("#orderid").val();
           var dishDetailId=$("#dishDetailID").val();
           var userid=$("#userid").val();
           var totalDishesAmount=$('#TotalDishesAmount').val();
           $.ajax({
               url:"dishServer.php",
               data: {dishDetailId:dishDetailId,option:"deleteDish",userid:userid,totalDishesAmount:totalDishesAmount,orderid:orderid },
               dataType: "text",
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
                       window.history.back();
                   }
               }
           });

       });

    });

</script>
</body>
</html>

