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


function ExtraItemShow($sql,$IsAlreadyBooked,$ShowRow)
{
    $id="No";
    $ActionClass="AddItemOrder "." btn-outline-primary";
    $ButtonValue="Select";
    if($IsAlreadyBooked=="Yes")
    {
        $id='Selected';
        $ActionClass="deleteSelected ". " btn-outline-danger";
        $ButtonValue="Delete";
    }



    $display='';
    $kinds = queryReceive($sql);
    if(count($kinds)==0)
        return false;


    $orignalImage='';
    $imagespath='';
    if($ShowRow=="ShowRow")
    $display.='<div class="row">';
    for ($i = 0; $i < count($kinds); $i++)
    {

        $img='../../../images/systemImage/imageNotFound.png';
        if( file_exists('../../../images/hallExtra/'.$kinds[$i][3]) AND($kinds[$i][3]!=""))
        {
            $img='../../../images/hallExtra/'.$kinds[$i][3];
        }


        $display.='
        <div id="'.$id.$kinds[$i][0].'"  class="card col-sm-12   col-12 col-md-4 col-lg-3 " style="width: 18rem;" >
        
        
              <img  class="card-img-top " src="'.$img.'" alt="Card image cap" style="height: 30vh">
        ';


        $display.=$imagespath;
        $display.='   <div class="card-body">
              
                <h5 >'.$kinds[$i][1].'</h5>
                <h6 >ID # '.$kinds[$i][0];


            if($IsAlreadyBooked=="Yes")
            {
                 $display.='<br>Already Selected';
            }


        $display.='</h6>
              <span class="text-danger "><i class="far fa-money-bill-alt"></i>Amount '.$kinds[$i][2].'</span>';
            if($IsAlreadyBooked=="Yes")
            {
                 $display.='<input type="number" hidden name="AlreadyExtraItemChargesIds[]" value="'.$kinds[$i][0].'">';
            }
        $display.=' <button data-name="'.$kinds[$i][1].'" data-image="'.$img.'" data-amount="'.$kinds[$i][2].'" data-itemsid="'.$kinds[$i][0].'"   class="'.$ActionClass.' btn  col-12">'.$ButtonValue.'</button>
            </div>
            
        </div>
        <div class="w-100 d-none d-sm-block d-md-none"></div>';
    }
    if($ShowRow=="ShowRow")
    $display.='</div>';
    return $display;
}
include('../../../companyDashboar1/includes/startHeader.php'); //html
?>

    <?php
    include('../../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Add Extra Item Hall order</title>
    <meta name="description" content="Add Extra Item Hall order page,Add Extra Item Hall order Extra Item Hall,Manage Extra Item Marquee,Manage Extra Item Add Marquee,Manage Extra Item New Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Add Extra Item Hall order page,Add order Extra Item Hall Marquee,Marquee,Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script src="../../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../bootstrap.min.js"></script>
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
include('../../../companyDashboar1/includes/endHeader.php');
include('../../../companyDashboar1/includes/navbar.php');

?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order Booked</h1>
            <a href="#" class="btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Order Preview</a>
        </div>
    </div>

<?php


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




<form id="formitems" style="background-color: rgba(255,255,245,1)">


    <input hidden id="PreviousExtraFixAmount" type="text"  value="<?php echo  $priceDetailOfExtraItem[0][0]; ?>" name="PreviousExtraFixAmount">

    <input hidden id="orderid"  type="text" name="order" value="<?php echo $order;?>">
    <input hidden type="number" name="userid" value="<?php echo $userid;?>" >
    <div class="container">

        <div class="form-inline" id="additems">

            <?php
            $sql='SELECT hei.id,(SELECT ei.name from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),(SELECT ei.price from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),(SELECT ei.image from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),hei.active FROM hall_extra_items as hei  WHERE (ISNULL(hei.expire)) AND (hei.orderDetail_id='.$order.')';
            echo ExtraItemShow($sql,"Yes","NoShow");
            ?>





        </div>
        <hr><br>

            <label class="row form-inline float-right badge-warning">Total   <span class="text-primary ml-5"> <input  style="border: none" name="CurrentExtraAmount" readonly class="badge-light form-inline" type="number" id="AmountSet" value="<?php
                    if(empty($priceDetailOfExtraItem[0][0]))
                    {
                        echo 0;
                    }
                    else
                    {
                        echo $priceDetailOfExtraItem[0][0];
                    }
                    ?>"</span>
            </label>










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










    <div class="container" style="background-color: rgba(212,210,210,0.06)">

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
        $display='';
        for($j=0;$j<count($Category);$j++)
        {

            $display.= '<h4 class="col-sm-12   col-12 col-md-12 col-lg-12 " align="center" style="background-color: rgba(212,210,210,0.42)">' .$Category[$j][1].'</h4>';





            $sql='SELECT ex.id,ex.name,ex.price,ex.image,ex.active FROM Extra_Item as ex
 INNER join
 ExtraItemControl as EIC
 on(EIC.Extra_Item_id=ex.id)
 WHERE (ISNULL(ex.expire)) AND (ex.Extra_item_type_id='.$Category[$j][0].')AND(ISNULL(EIC.expire))AND(EIC.hall_id in('.$id.'))';

            $display.=ExtraItemShow($sql,"No","ShowRow");

        }

        $display.='';
        echo $display;


        ?>













</div>


<script>

    $(document).ready(function ()
    {


        function SetAmount(settype,getamount)
        {
            var amount=Number($("#AmountSet").val());
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
            swal({
                html:true,
                title: "Add item",
                text: 'Item has been added to Hall Item Menu',
                buttons: false,
                icon: "success",
                timer: 1500,
            });
                var amount=$(this).data("amount");
            SetAmount("ADD",amount);
                var id=$(this).data("itemsid");
                var name=$(this).data("name");
                var image=$(this).data("image");
            var text='<div id="jsid'+javaid+'" class="card col-sm-12   col-12 col-md-4 col-lg-3" style="width: 18rem;">\n' +
            '                <img class="card-img-top" src="'+image+'" alt="Card image cap" style="height: 30vh">\n' +
            '                <div class="card-body ">\n' +

            '                <h5>\n' + name+ '        </h5>' +
                '<h6 >ID# '+id+'</h6>' +
                '    <span class="text-danger "><i class="far fa-money-bill-alt"></i>Amount '+amount+'</span>\n' +
                '        \n' +
            '                    <input type="hidden" name="selecteditem[]" value="'+id+'">\n' +
                '                    <button  data-amount="'+amount+'" data-jsid="'+javaid+'" class="btn btn-outline-danger deleteitems col-12">Delete</button>\n' +
            '                  </div>\n' +

            '            </div>';

            $("#additems").append(text);
            javaid++;
        });
        $(document).on("click",".deleteitems",function (e)
        {
            e.preventDefault();
            swal({
                title: "Deleted",
                text: 'Item has been Deleted from Hall Item Menu',
                buttons: false,
                icon: "error",
                timer: 1500,
                html: true
            });

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
            swal({
                title: "Deleted",
                text: 'Item has been Deleted from Hall Item Menu',
                buttons: false,
                icon: "error",
                timer: 1500,
                html: true
            });
            var id=$(this).data("itemsid");
            var amount=$(this).data("amount");
            SetAmount("Minus",amount);
            var CurrentAmount=Number($("#AmountSet").val());
            $("#Selected"+id).remove();
        });
        $("#btnsubmit").click(function (e)
        {
            if (!confirm('Are you sure you want to Save items?'))
                return  false;



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

                    if($.trim(data)!='')
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



<?php
include('../../../companyDashboar1/includes/scripts.php');
include('../../../companyDashboar1/includes/footer.php');
include_once ("../../../webdesign/footer/EndOfPage.php");
?>