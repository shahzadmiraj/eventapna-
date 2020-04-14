<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-07
 * Time: 11:31
 */

include_once ("../connection/connect.php");
if(!isset($_SESSION['branchtype']))
{
    header("location:../company/companyRegister/companydisplay.php");

}
if(!isset($_SESSION['order']))
{
    header("location:../user/userDisplay.php");
}
if(isset($_GET['action']))
{
    header("location:dishPreview.php?dish=".base64url_encode($_GET['action']));
}
$orderId=$_SESSION['order'];
$sql='SELECT SUM(dd.price*dd.quantity) FROM dish_detail as dd WHERE (ISNULL(dd.expire))AND(dd.orderDetail_id='.$orderId.')';
$ActiveTotalAmount=queryReceive($sql);
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
include_once ("../webdesign/header/header.php");
?>
<div class="jumbotron  shadow" style="background-image: url(https://qph.fs.quoracdn.net/main-qimg-b1822af85b86aabaa253ad7948880cb7);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 ><i class="fas fa-concierge-bell fa-3x"></i>Catering Order Detail</h3>
    </div>

</div>










    <div class="container alert-light">
        <h3>Catering Dishes Detail</h3>
        <hr>

        <span class="input-group-text">
        Active Total Amount:<?php echo $ActiveTotalAmount[0][0];?>
        <a href="dishDisplay.php" class="form-control btn-success btn float-right  "><i class="fas fa-concierge-bell"></i>dish Add +</a>
        </span>
        <hr>
    </div>


<div class="container card">
<h3>Current Active Dishes</h3>
<hr>
</div>




<div class="container form-inline badge-light">


    <?php
  $sql='SELECT dd.id, dd.describe, dd.expire, dd.quantity, dd.orderDetail_id, dd.user_id, dd.dishWithAttribute_id, dd.active, dd.price, dd.expireUser ,(SELECT (SELECT d.name FROM dish as d WHERE d.id=dwa.dish_id) FROM dishWithAttribute as dwa WHERE dwa.id= dd.dishWithAttribute_id)  FROM dish_detail as dd WHERE (ISNULL(dd.expire))AND (dd.orderDetail_id='.$orderId.')';
   $detailDishes=queryReceive($sql);
    for($i=0;$i<count($detailDishes);$i++)
    {


        ?>

        <a href="dishPreview.php?dish=<?php echo base64url_encode($detailDishes[$i][0]);?>" class="card m-2" >
            <div class="card-header">
                <h4><i class="fas fa-concierge-bell "></i><?php echo $detailDishes[$i][10];?></h4>
            </div>
            <ul class="list-group list-group-flush">


                <?
                $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$detailDishes[$i][6].')';
                $AttributeDetail=queryReceive($sql);

                // special dish with attribute and quantity
                for($j=0;$j<count($AttributeDetail);$j++)
                {
                    echo ' <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i>'.$AttributeDetail[$j][0].' :  '.$AttributeDetail[$j][1].'</li>';
                }
                ?>
            </ul>
            <p><i class="fas fa-comments"></i><?php echo $detailDishes[$i][1];?></p>
            <div class="card-footer ">
                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <label>Price:<?php echo $detailDishes[$i][8];?></label>
                </div>

                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-sort-amount-up"></i></span>
                    </div>
                    <label>Quantity:<?php echo $detailDishes[$i][3];?></label>
                </div>

                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend ">
                        <span class="input-group-text text-danger"> <i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <label>Total:<?php echo (int) $detailDishes[$i][3]*$detailDishes[$i][8];?></label>
                </div>


            </div>
        </a>

        <?php
    }
    ?>
</div>





<div class="container alert-danger mt-5">
    <h3><i class="fas fa-trash-alt"></i> Expired Dishes  <input   id="expireControl" class="btn btn-danger" value="Show"></h3>

    <hr>
</div>




<div class="container form-inline badge-light" id="ExpireDivDishes">


    <?php
    $sql='SELECT dd.id, dd.describe, dd.expire, dd.quantity, dd.orderDetail_id, dd.user_id, dd.dishWithAttribute_id, dd.active, dd.price, dd.expireUser ,(SELECT (SELECT d.name FROM dish as d WHERE d.id=dwa.dish_id) FROM dishWithAttribute as dwa WHERE dwa.id= dd.dishWithAttribute_id)  FROM dish_detail as dd WHERE (!ISNULL(dd.expire))AND (dd.orderDetail_id='.$orderId.')';
    $detailDishes=queryReceive($sql);
    for($i=0;$i<count($detailDishes);$i++)
    {


        ?>

        <a href="dishPreview.php?dish=<?php echo base64url_encode($detailDishes[$i][0]);?>" class="card alert-danger m-2" >
            <div class="card-header">
                <h4><i class="fas fa-concierge-bell"></i>  <?php echo $detailDishes[$i][10];?></h4>
            </div>
            <ul class="list-group list-group-flush">


                <?
                $sql='SELECT `name`, `id`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$detailDishes[$i][6].')';
                $AttributeDetail=queryReceive($sql);

                // special dish with attribute and quantity
                for($j=0;$j<count($AttributeDetail);$j++)
                {
                    echo ' <li class="list-group-item"><i class="fa fa-calculator" aria-hidden="true"></i>'.$AttributeDetail[$j][0].' :  '.$AttributeDetail[$j][1].'</li>';
                }
                ?>
            </ul>
            <p><i class="fas fa-comments"></i><?php echo $detailDishes[$i][1];?></p>
            <div class="card-footer ">
                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <label>Price:<?php echo $detailDishes[$i][8];?></label>
                </div>

                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-sort-amount-up"></i></span>
                    </div>
                    <label>Quantity:<?php echo $detailDishes[$i][3];?></label>
                </div>

                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend ">
                        <span class="input-group-text text-danger"><i class="fas fa-money-bill-alt"></i></span>
                    </div>
                    <label>Total:<?php echo (int) $detailDishes[$i][3]*$detailDishes[$i][8];?></label>
                </div>

                <div class="input-group mb-3 input-group-lg text-danger">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <label><?php echo $detailDishes[$i][2];?></label>
                </div>

            </div>
        </a>

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

        $("#expireControl").click(function ()
        {
            var value=$(this).val();
            if(value=="Show")
            {
                $("#ExpireDivDishes").show('slow');
                $(this).val("Hide");
            }
            else
            {

                $("#ExpireDivDishes").hide('slow');
                $(this).val("Show");
            }

        });
        $("#ExpireDivDishes").hide('slow');


        $(".dishdetail").click(function (e)
        {
            e.preventDefault();
            var id=$(this).data("id");
            var formdata=new FormData;
            formdata.append('option',"removeDish");
            formdata.append("dishId",id);
            $.ajax({
                url:"dishServer.php",
                data:formdata,
                method:"POST",
                contentType: false,
                processData: false,
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
                    else
                    {
                        location.reload();
                    }
                }
            });

        });


        $(".Redirect").click(function (e)
        {

            e.preventDefault();
            var id=$(this).data("id");
            window.location.href='dishPreview.php?dish='+id;

        });

    });

</script>
</body>
</html>
