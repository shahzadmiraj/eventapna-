<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");
include  ("../../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfOrderBooked("Owner,Employee","../../../index.php");

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'];
$userdetail=queryReceive($sql);
$userid=$_COOKIE['userid'];



$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);

$id=$processInformation[0][3];
$hall=$id;
$order=$processInformation[0][5];
$sql='SELECT sum(ei.price) FROM hall_extra_items as hei  INNER JOIN Extra_Item as ei
on(hei.Extra_Item_id=ei.id)
WHERE (hei.orderDetail_id='.$order.') AND(ISNULL(hei.expire)) ';
$priceDetailOfExtraItem=queryReceive($sql);



$sql='SELECT catering_id,status_catering FROM orderDetail WHERE id='.$order.'';
$StatusOrder=queryReceive($sql);


function ExtraItemShow($sql,$IsAlreadyBooked)
{
    $id="No";
    $ActionClass="AddItemOrder "." btn-primary";
    $ButtonValue="Select";
    if($IsAlreadyBooked=="Yes")
    {
        $id='Selected';
        $ActionClass="deleteSelected ". " btn-danger";
        $ButtonValue="Delete";
    }



    $display='';
    $kinds = queryReceive($sql);


    $orignalImage='';
    $imagespath='';
    $display.='<div class="row">';
    for ($i = 0; $i < count($kinds); $i++)
    {

        $img='https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled-1150x647.png';
        if( file_exists('../../../images/hallExtra/'.$kinds[$i][3]) AND($kinds[$i][3]!=""))
        {
            $img='../../../images/hallExtra/'.$kinds[$i][3];
        }


        $display.='
        <div id="'.$id.$kinds[$i][0].'"  class="card col-md-4">
        
        
              <img  class="card-img-top " src="'.$img.'" alt="Card image cap" style="height: 30vh">
        ';


        $display.=$imagespath;
        $display.='   <div class="card-body ">
              
                <h5 >'.$kinds[$i][1].'</h5>
                <h6 >ID#'.$kinds[$i][0].'</h6>
              <span class="text-danger "><i class="far fa-money-bill-alt"></i>Amount '.$kinds[$i][2].'</span>
            
                <button data-name="'.$kinds[$i][1].'" data-image="'.$img.'" data-amount="'.$kinds[$i][2].'" data-itemsid="'.$kinds[$i][0].'"   class="'.$ActionClass.' btn  col-12">'.$ButtonValue.'</button>
            </div>
            
        </div>
        <div class="w-100 d-none d-sm-block d-md-none"></div>';
    }
    $display.='</div>';
    return $display;
}

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

    <style>

    </style>
</head>
<body>


<?php

include_once ("../../../webdesign/header/header.php");
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
$whichActive = 3;
$imageCustomer = "../../../images/customerimage/";
$PageName="Hall Extra Item";
include_once("../../../webdesign/orderWizard/wizardOrder.php");
?>




<form id="formitems" class="alert-light">


    <input hidden id="PreviousExtraFixAmount" type="text"  value="<?php echo  $priceDetailOfExtraItem[0][0]; ?>" name="PreviousExtraFixAmount">

    <input hidden id="orderid"  type="text" name="order" value="<?php echo $order;?>">
    <input hidden type="number" name="userid" value="<?php echo $userid;?>" >
    <div class="container">
        <h4 class="row form-inline">Total   <span class="text-primary ml-5"> <input  name="CurrentExtraAmount" readonly class="badge-light" type="number" id="AmountSet" value="<?php
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
        <div class="row col-12 " id="additems">




            <?php
            $sql='SELECT hei.id,(SELECT ei.name from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),(SELECT ei.price from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),(SELECT ei.image from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),hei.active FROM hall_extra_items as hei  WHERE (ISNULL(hei.expire)) AND (hei.orderDetail_id='.$order.')';
            echo ExtraItemShow($sql,"Yes");
            ?>





        </div>







        <div class="form-group row mt-5">








            <?php
            if($processInformation[0][4]==0)
            {
                //processing
                echo '
        <button id="cancel"    class="btn btn-danger col-4"><< Back</button>
             <button id="SkipBtn" class="col-4 form-control btn btn-success">Skip>></button>
            <button id="btnsubmit"  class="btn btn-primary col-4">Next >></button>';

            }
            else
            {

                echo '
        <button id="cancel"    class="btn btn-danger col-6"> Cancel</button>
            <button id="btnsubmit"  class="btn btn-primary col-6"><i class="fas fa-check "></i> Save</button>';
            }
            ?>


        </div>
    </div>


</form>










    <div class="container">

        <h1 class="text-center mt-3">Select Item</h1>
        <hr>
        <?php

        $sql='SELECT EIT.id,EIT.name FROM ExtraItemControl as EIC INNER join  Extra_Item as EI 
on(EIC.Extra_Item_id=EI.id) INNER join Extra_item_type as EIT 
on (EI.Extra_item_type_id=EIT.id)
WHERE
(ISNULL(EIC.expire)) AND(ISNULL(EIT.expire))AND(EIC.hall_id in('.$id.'))
GROUP by (EIT.id)';

        $Category=queryReceive($sql);
        $Display='';
        $display='<div class="row ">';
        for($j=0;$j<count($Category);$j++)
        {

            $display.='<h4 class="col-12 " align="center">'.$Category[$j][1].'</h4>';





            $sql='SELECT ex.id,ex.name,ex.price,ex.image,ex.active FROM Extra_Item as ex
 INNER join
 ExtraItemControl as EIC
 on(EIC.Extra_Item_id=ex.id)
 WHERE (ISNULL(ex.expire)) AND (ex.Extra_item_type_id='.$Category[$j][0].')AND(ISNULL(EIC.expire))AND(EIC.hall_id in('.$id.'))';

            $display.=ExtraItemShow($sql,"No");

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
            var text='<div id="jsid'+javaid+'" class="card col-md-4">\n' +
            '                <img class="card-img-top" src="'+image+'" alt="Card image cap" style="height: 30vh">\n' +
            '                <div class="card-body ">\n' +

            '                <h5>\n' + name+ '        </h5>' +
                '<h6 >ID# '+id+'</h6>' +
                '    <span class="text-danger "><i class="far fa-money-bill-alt"></i>Amount '+amount+'</span>\n' +
                '        \n' +
            '                    <input type="hidden" name="selecteditem[]" value="'+id+'">\n' +
                '                    <button  data-amount="'+amount+'" data-jsid="'+javaid+'" class="btn btn-danger deleteitems col-12">Delete</button>\n' +
            '                  </div>\n' +

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

        $("#cancel,#PreviouseWizard").click(function (e)
        {
            e.preventDefault();
            <?php
            if($processInformation[0][4]==0)
            {
                //process is running
                echo 'location.replace("../EdithallOrder.php?pid=' . $pid . '&token='.$token.'");';

            }
            else
            {
                echo "window.history.back();";
            }
            ?>

        });

        $(document).on("click",".deleteSelected",function (e)
        {
            e.preventDefault();
            var id=$(this).data("itemsid");
            var amount=$(this).data("amount");
            SetAmount("Minus",amount);
            var orderid="<?php echo $order;?>";

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
                        <?php
                        if($processInformation[0][4]==0)
                        {
                            //process is running
                                    if(($StatusOrder[0][0]!="")&&(($StatusOrder[0][1]=="Running")))
                                    {
                                        //catering order also book and select dishes
                                        echo 'location.replace("../../../dish/dishDisplay.php?pid=' . $pid . '&token='.$token.'");';
                                    }
                                    else
                                    {

                                        //not catering Order so payment collect
                                        echo 'location.replace("../../../payment/getPayment.php?pid=' . $pid . '&token='.$token.'");';
                                    }

                        }
                        else
                        {
                            echo "window.history.back();";
                        }
                        ?>

                    }
                }
            });

        });





        $("#SkipBtn,#NextWizard").click(function (e) {
            e.preventDefault();
            <?php
            if(($StatusOrder[0][0]!="")&&(($StatusOrder[0][1]=="Running")))
            {
                //catering order also book and select dishes
                echo 'location.replace("../../../dish/dishDisplay.php?pid=' . $pid . '&token='.$token.'");';
            }
            else
            {

                //not catering Order so payment collect
                echo 'location.replace("../../../payment/getPayment.php?pid=' . $pid . '&token='.$token.'");';
            }
            ?>
        });

    });


</script>


</body>
</html>
