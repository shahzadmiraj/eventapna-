<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");
if(!isset($_SESSION['order']))
{
    header("location:../../../user/userDisplay.php");
}
if($_SESSION['branchtype']!="hall")
{
    header("location:../../../user/userDisplay.php");
}
$userid=$_COOKIE['userid'];
$id=$_SESSION['branchtypeid'];
$hall=$id;
$order=$_SESSION['order'];
$sql='SELECT sum(ei.price) FROM hall_extra_items as hei  INNER JOIN Extra_Item as ei
on(hei.Extra_Item_id=ei.id)
WHERE (hei.orderDetail_id='.$order.') AND(ISNULL(hei.expire)) ';
$priceDetailOfExtraItem=queryReceive($sql);

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
<div class="jumbotron  shadow text-center " style="background-image: url(<?php
if((file_exists('../../../images/catering/'.$cateringdetail[0][2])) &&($cateringdetail[0][2]!=""))
{
    echo "'../../../images/catering/".$cateringdetail[0][2]."'";
}
else
{
    echo "https://www.liberaldictionary.com/wp-content/uploads/2019/02/cater-4956.jpg";
}



?>
    );background-size:100% 100%;background-repeat: no-repeat">
    <div class="card-body " style="opacity: 0.7 ;background: white;">
        <h5 class="display-5 text-center"><i class="fas fa-hamburger fa-3x"></i> Extra items Detail</h5>
        <p class="lead">Extra items information such as Sound system ,Dancing floor ,Fog light ,Snow system Price manager others </p>
    </div>
</div>



<form id="formitems" class="alert-light">

    <input hidden id="PreviousExtraFixAmount" type="text"  value="<?php echo  $priceDetailOfExtraItem[0][0]; ?>" name="PreviousExtraFixAmount">

    <input hidden id="orderid"  type="text" name="order" value="<?php echo $order;?>">
    <input hidden type="number" name="userid" value="<?php echo $userid;?>" >
    <div class="container card">
        <h4 class="m-auto">Selected Item of order   <span class="text-primary ml-5"><i class="far fa-money-bill-alt"></i>  <input  name="CurrentExtraAmount" readonly class="badge-light" type="number" id="AmountSet" value="<?php
          if(empty($priceDetailOfExtraItem[0][0]))
          {
              echo 0;
          }
          else
              {
                  echo $priceDetailOfExtraItem[0][0];
          }
            ?>"</span></h4>

        <hr>
        <div class="container form-inline " id="additems">
<!--
            <div id="jsid1" class="card mb-4 col-12 col-md-6 col-lg-4 col-xl-3 btn btn-primary">
                <img class="card-img-top img-fluid" src="//placehold.it/500x280" alt="Card image cap" style="height: 30vh">
                <div class="card-body ">
                    <h4 class="card-title">Name</h4>
                    <h6 class="float-right ">price</h6>
                    <button  data-jsid="1" class="btn btn-danger">Delete</button>
                    <input type="hidden" name="selecteditem[]" value="">
                </div>
            </div>
-->







            <?php
            $display='';


            $sql='SELECT hei.id,(SELECT ei.name from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),(SELECT ei.price from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),(SELECT ei.image from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),hei.active FROM hall_extra_items as hei  WHERE (ISNULL(hei.expire)) AND (hei.orderDetail_id='.$order.')';
            $kinds = queryReceive($sql);


            $orignalImage='';
            $imagespath='';
            for ($i = 0; $i < count($kinds); $i++)
            {

                if( file_exists('../../../images/hallExtra/'.$kinds[$i][3]) AND($kinds[$i][3]!=""))
                {
                    $orignalImage='../../../images/hallExtra/'.$kinds[$i][3];
                    $imagespath='
            <img class="card-img-top img-fluid" src="'.$orignalImage.'" alt="Card image cap"  style="height: 30vh">';
                }
                else
                {
                    $orignalImage='https://scx1.b-cdn.net/csz/news/800/2019/virtuallyrea.jpg';
                    $imagespath='
            <img  class="card-img-top img-fluid" src="'.$orignalImage.'" alt="Card image cap" style="height: 30vh">';
                }


                $display.='
        <div  id="Selected'.$kinds[$i][0].'"   class="card col-12 col-md-6 col-lg-4 col-xl-3 btn btn-primary">';


                $display.=$imagespath;
                $display.='   <div class="card-body ">
                <h4 class="card-title">'.$kinds[$i][1].'</h4>
              <h6 class="float-right "><i class="far fa-money-bill-alt"></i>'.$kinds[$i][2].'
</h6>
<button data-itemsid="'.$kinds[$i][0].'" data-amount="'.$kinds[$i][2].'"   class="deleteSelected btn btn-danger">Delete</button>
            </div>
        </div>
        <div class="w-100 d-none d-sm-block d-md-none"></div>';
            }

            echo $display;


            ?>





        </div>






        <div class="form-group row">
            <button id="cancel" class="btn btn-danger col-6">Cancel</button>
            <button id="btnsubmit" class="btn btn-primary col-6">Save</button>
        </div>
    </div>


</form>










<h1 class="text-center mt-3">Select Item</h1>
<hr>
    <div class="container card">

        <?php

        //$sql='SELECT id,name FROM dish_type WHERE catering_id='.$cateringid.'';
        $sql='SELECT `id`, `name` FROM `Extra_item_type` WHERE (hall_id='.$id.')&&(ISNULL(expire))';

        $Category=queryReceive($sql);
        $Display='';
        $display='<div class="form-group row ">';
        for($j=0;$j<count($Category);$j++)
        {

            $display.='<h4 class="col-12 newcolor" align="center">'.$Category[$j][1].'</h4>';



            //  $sql = 'SELECT d.name, d.id, (SELECT dt.name from dish_type as dt WHERE dt.id=d.dish_type_id),(SELECT dt.isExpire from dish_type as dt WHERE dt.id=d.dish_type_id), d.isExpire,d.image FROM dish as d WHERE dish_type_id=' . $Category[$j][0] . ' ';

            $sql='SELECT ex.id,ex.name,ex.price,ex.image,ex.active FROM Extra_Item as ex WHERE (ISNULL(ex.expire)) AND (ex.Extra_item_type_id='.$Category[$j][0].')';
            $kinds = queryReceive($sql);


            $orignalImage='';
            $imagespath='';
            $display.='<div class="container-fluid"><div class="card-deck">';
            for ($i = 0; $i < count($kinds); $i++)
            {

                if( file_exists('../../../images/hallExtra/'.$kinds[$i][3]) AND($kinds[$i][3]!=""))
                {
                    $orignalImage='../../../images/hallExtra/'.$kinds[$i][3];
                    $imagespath='
            <img class="card-img-top img-fluid" src="'.$orignalImage.'" alt="Card image cap"  style="height: 30vh">';
                }
                else
                {
                    $orignalImage='https://scx1.b-cdn.net/csz/news/800/2019/virtuallyrea.jpg';
                    $imagespath='
            <img  class="card-img-top img-fluid" src="'.$orignalImage.'" alt="Card image cap" style="height: 30vh">';
                }


                $display.='
        <div  data-name="'.$kinds[$i][1].'" data-image="'.$orignalImage.'" data-amount="'.$kinds[$i][2].'" data-itemsid="'.$kinds[$i][0].'" class="AddItemOrder card  mb-4 col-12 col-md-6 col-lg-4 col-xl-3 btn btn-primary ">';


$display.=$imagespath;
                $display.='   <div class="card-body ">
                <h4 class="card-title">'.$kinds[$i][1].'</h4>
              <h6 class="float-right "><i class="far fa-money-bill-alt"></i> '.$kinds[$i][2].'
</h6>
            </div>
        </div>
        <div class="w-100 d-none d-sm-block d-md-none"></div>';
            }
            $display.='</div></div>';

        }

        $display.='</div>';
        echo $display;


        ?>












</div>
<?php
include_once ("../../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {
        function SetAmount(settype,getamount)
        {
            var amount=parseInt($("#AmountSet").val());
            if(settype=="ADD")
            {
                $("#AmountSet").val(amount+getamount);
            }
            else
            {
                $("#AmountSet").val(amount-getamount);
            }

        }

        var javaid=0;
        $(document).on("click",".AddItemOrder",function (e)
        {
            e.preventDefault();
                var amount=$(this).data("amount");
            SetAmount("ADD",amount);
                var id=$(this).data("itemsid");
                var name=$(this).data("name");
                var image=$(this).data("image");
            var text='<div id="jsid'+javaid+'" class="card mb-4 col-12 col-md-6 col-lg-4 col-xl-3 btn btn-primary">\n' +
            '                <img class="card-img-top img-fluid" src="'+image+'" alt="Card image cap" style="height: 30vh">\n' +
            '                <div class="card-body ">\n' +
            '                    <h4 class="card-title">'+name+'</h4>\n' +
            '                    <h6 class="float-right ">'+amount+'</h6>\n' +
            '                    <button  data-amount="'+amount+'" data-jsid="'+javaid+'" class="btn btn-danger deleteitems">Delete</button>\n' +
            '                    <input type="hidden" name="selecteditem[]" value="'+id+'">\n' +
            '                </div>\n' +
            '            </div>';

            $("#additems").append(text);
            javaid++;
        });
        $(document).on("click",".deleteitems",function (e)
        {
            e.preventDefault();
            var id=$(this).data("jsid");
            var amount=$(this).data("amount");
            SetAmount("Minus",amount);
            $("#jsid"+id).remove();
        });

        $("#cancel").click(function (e)
        {
            e.preventDefault();
            window.history.back();
        });

        $(document).on("click",".deleteSelected",function (e)
        {
            e.preventDefault();
            var id=$(this).data("itemsid");
            var amount=$(this).data("amount");
            SetAmount("Minus",amount);
            var orderid=$("#orderid").val();

            var CurrentAmount=parseInt($("#AmountSet").val());
            var formdata=new FormData;
            formdata.append("option","deletedSelecteditems");
            formdata.append("CurrentAmount",CurrentAmount);
            formdata.append("orderid",orderid);
            formdata.append("id",id);
            $.ajax({
                url:"orderitemServer.php",
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
                       $("#Selected"+id).remove();
                    }
                }
            });

        });
        $("#btnsubmit").click(function (e)
        {
            e.preventDefault();
            var orderid=$("#orderid").val();
            var formdata=new FormData($('#formitems')[0]);
            formdata.append("option","additemsInOrder");
            $.ajax({
                url:"orderitemServer.php",
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
    });


</script>


</body>
</html>
