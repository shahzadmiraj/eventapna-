<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include  ("../../connection/connect.php");
include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfOrderBooked("Owner,Employee","../../index.php");
include_once ("packages/EditPackageFunction.php");

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$userid=$_COOKIE['userid'];


$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);

$companyid=$userdetail[0][0];
$hallid=$processInformation[0][3];
$orderid=$processInformation[0][5];

$sql='select od.id,od.hall_id,od.catering_id,p.isFood,od.user_id,1,1,1,1,1,od.person_id,od.total_amount,od.total_person,od.status_hall,od.destination_date,od.booking_date,od.destination_time,od.status_catering,1,od.describe,p.describe,p.id,p.price,od.discount,od.extracharges,od.packageDate_id FROM orderDetail as od  INNER join packageDate as pd
on (od.packageDate_id=pd.id)
INNER join packages as p 
on (p.id=pd.package_id)
where 
(od.id='.$orderid.')';


$detailorder=queryReceive($sql);


$sql='SELECT c.id, c.name,c.image FROM catering as c WHERE c.company_id=(SELECT h.company_id from hall as h where h.id='.$detailorder[0][1].') AND (ISNULL(c.expire))';
$cateringids=queryReceive($sql);


$sql='SELECT sum(ei.price) FROM hall_extra_items as hei  INNER JOIN Extra_Item as ei
on(hei.Extra_Item_id=ei.id)
WHERE (hei.orderDetail_id='.$orderid.') AND(ISNULL(hei.expire)) ';
$priceDetailOfExtraItem=queryReceive($sql);

$Query='pid='.$pid."&token=".$token;



$sql='SELECT sum(amount) FROM `payment` WHERE IsReturn=0 AND orderDetail_id='.$orderid;
$PaidAmount=queryReceive($sql);

$sql='SELECT `id`, `isFood`, `price`, `describe`, `dayTime`, `package_name`, `MinimumGuest` FROM `Order_Package_History` WHERE (ISNULL(ExpireUserDate))AND(orderDetail_id='.$orderid.') LIMIT 1';
$DetailOfPackages=queryReceive($sql);


?>
<!DOCTYPE html>
<head>

    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Edit Hall Order</title>
    <meta name="description" content="Edit Hall Order  page,Edit Order Hall,Edit Marquee Order,Edit Order Marquee,Edit  Dera Order only company user can used this
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Edit Hall Order  page,Add Hall Order,Insert Marquee Order,New Add Marquee Order,Add New Dera Order page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">

    <style>

    </style>
</head>
<body>
<?php

include_once ("../../webdesign/header/header.php");
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
$whichActive = 2;
$imageCustomer = "../../images/customerimage/";
$PageName="Hall Order info";
include_once("../../webdesign/orderWizard/wizardOrder.php");
?>



<form class="container row m-auto" >
    <input type="hidden" name="userid" value="<?php echo $userid;?>">

    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">No of Guests</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-users"></i></span>
            </div>
            <input id="guests" name="guests" type="number" class="checkpackage form-control" value="<?php echo $detailorder[0][12]; ?>">
        </div>
    </div>
    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">Booked Date (Year,Month,Day)</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
            </div>
            <input   id="date" name="date" type="date" class="checkpackage form-control" value="<?php echo $detailorder[0][14]; ?>">
        </div>
    </div>
    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">Time</label>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-clock"></i></span>
            </div>
            <select id="time" name="time" class="checkpackage form-control">
                <?php

                ///////set time
                if($detailorder[0][16]=="09:00:00")
                {
                    //morning
                    echo '
            <option value="Morning">Morning</option>
            <option value="Afternoon">Afternoon</option>
            <option value="Evening">Evening</option>';

                }
                else if($detailorder[0][16]=="12:00:00")
                {
                    //afternoon
                    echo '

            <option value="Afternoon">Afternoon</option>
            <option value="Morning">Morning</option>
            <option value="Evening">Evening</option>';
                }
                else
                {
                    //evening
                    echo '
            <option value="Evening">Evening</option>
            <option value="Morning">Morning</option>
            <option value="Afternoon">Afternoon</option>';


                }
                ?>

            </select>
        </div>
    </div>
    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label ">Per Head With</label>


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-utensils"></i></span>
            </div>
            <select id="perheadwith" name="perheadwith" class="checkpackage form-control">

                <?php

                if($DetailOfPackages[0][1]==0)
                {
                    // only seating
                    echo '
            <option value="0">Only seating</option>
            <option value="1">Food + Seating</option>';
                }
                else
                {
                    //food and seating
                    echo '
            <option value="1">Food + Seating</option>
            <option value="0">Only seating</option>';
                }
                ?>

            </select>
        </div>




    </div>








    <?php

    if(count($cateringids)>0)
    {

        $display = '
                
                
    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6" id="cateringid">
        <label class="col-form-label ">Catereing Branch</label>


        <div  class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-utensils"></i></span>
            </div>
            <select  name="cateringid" class="form-control">
                ';
        if($detailorder[0][2]!="")
        {

            $sql = 'SELECT `id`, `name` FROM `catering` WHERE id=' . $detailorder[0][2] . '';

            $selectedcatering = queryReceive($sql);
            $display .= '
            <option value="' . $selectedcatering[0][0] . '">' . $selectedcatering[0][1] . '</option>';

            for ($i = 0; $i < count($cateringids); $i++) {

                if ($selectedcatering[0][0] != $cateringids[$i][0]) {
                    $display .= '
            <option value="' . $cateringids[$i][0] . '">' . $cateringids[$i][1] . '</option>';
                }

            }
        }
        else
        {

            for ($i = 0; $i < count($cateringids); $i++)
            {

                    $display .= '
            <option value="' . $cateringids[$i][0] . '">' . $cateringids[$i][1] . '</option>';

            }
        }
        $display .= '     


            </select>
        </div>




    </div>';
        echo $display;
}


     ?>






    <div id="groupofpackages" class="col-12 alert-warning shadow">


    </div>

    <div id="selectmenu" class="alert-info col-12 row  form-group container  m-auto" >

        <?php
        echo '<input  hidden id="selectpricefix'.$detailorder[0][25].'" type="number" value="'.$DetailOfPackages[0][2].'">
        <input hidden type="radio" checked value="'.$detailorder[0][25].'"  name="defaultExampleRadios">
        ';
         ShowFirstSelectedChoice($orderid,$detailorder[0][25]);

         echo "<h5>Detail of packages:".$DetailOfPackages[0][3]." <br> <span class=''>Per head without Extra Charges : ".$DetailOfPackages[0][2]."</span></h5>";
        ?>


    </div>


    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">Extra items Charges :</label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input readonly type="number" class="form-control"   id="extraamount" value="<?php echo $priceDetailOfExtraItem[0][0];?>">
        </div>
    </div>


    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">Total amount: (Extra item charges+ Per head rate)</label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input readonly id="totalamount" name="totalamount" type="number" class="form-control" value="<?php echo $detailorder[0][11]; ?>">
        </div>
    </div>


    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="form-check-label" for="Discount">Discount </label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input value="<?php echo $detailorder[0][23];?>" placeholder="Discount" id="Discount"  name="Discount" type="number" class="form-control"  >
        </div>

    </div>

    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="form-check-label" for="Charges">Extra Charges </label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input  value="<?php echo $detailorder[0][24];?>" placeholder="Extra Charges "  id="Charges" name="Charges" type="number" class="form-control"  >
        </div>

    </div>
    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="form-check-label" for="remaining">Paid Amount </label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input readonly  id="PaidAmount"  type="number" class="form-control"  value=<?php echo (int) ($PaidAmount[0][0]);?>>
        </div>
    </div>


    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="form-check-label" for="remaining">Remaining Amount </label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input placeholder="Remaining Amount " readonly  id="remaining" name="remaining" type="number" class="form-control" >
        </div>

    </div>






    <?php

        $status=array("Running","Delivered","Cancel","Clear");
        $display='
    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">Order status</label>
        
        
        
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-eye"></i></span>
            </div>';



       $display.=' <select id="orderStatus"  name="orderStatus" class=" form-control">
        <option value="'.$detailorder[0][13].'">'.$detailorder[0][13].'</option>';
        for($i=0;$i<count($status);$i++)
        {
            if($status[$i]!=$detailorder[0][13])
            {
                $display.='<option value="'.$status[$i].'">'.$status[$i].'</option>';
            }
        }
        $display.=' </select>
            
        </div>
 
      
    </div>';
       echo $display;


    ?>



    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label for="branchOrder" class="col-form-label">Hall Order in branch :</label>


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-eye"></i></span>
            </div>

            <select  id="branchOrder" name="branchOrder"   class="form-control checkpackage">
                <?php

                $sql='SELECT od.hall_id,(SELECT h.name FROM hall as h WHERE h.id=od.hall_id) FROM orderDetail as od WHERE od.id='.$orderid.'';
                $Branch=queryReceive($sql);
                echo '<option value='.$Branch[0][0].'>'.$Branch[0][1].'</option>';

                $sql='SELECT `id`, `name` FROM `hall` WHERE ISNULL(expire) && (id!='.$Branch[0][0].' )&& (company_id='.$companyid.')';
                $AllBranches=queryReceive($sql);

                for($i=0;$i<count($AllBranches);$i++)
                {
                    echo '<option value='.$AllBranches[$i][0].'>'.$AllBranches[$i][1].'</option>';
                }

                ?>
            </select>
        </div>


    </div>

    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">Describe /Comments</label>





        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comments"></i></span>
            </div>

            <textarea  name="describe" class="form-control"><?php echo $detailorder[0][19]; ?></textarea></textarea>

        </div>


    </div>



    <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
        <label class="col-form-label">Visited Date (Year,Month,Day)</label>



        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-business-time"></i></span>
            </div>
            <input readonly type="datetime" class="form-control" value="<?php echo $detailorder[0][15]; ?>">
        </div>
    </div>


    <div class="form-group row col-sm-12   col-12 col-md-12 col-lg-12 justify-content-center">


        <?php
        if($processInformation[0][4]==0)
        {
            //processing
            echo '
        <button id="cancel" type="button" class=" col-4 btn btn-danger" > << back</button>
         <button id="SkipBtn" class="col-4 form-control btn btn-success">Skip>></button>
        <button id="submitform" type="button" class=" col-4 btn btn-primary" >Next >> </button>';

        }
        else
        {

            echo '
        <button id="cancel" type="button" class=" col-4 btn btn-danger" ><i class="fas fa-arrow-circle-left"></i>back</button>
        <button id="submitform" type="button" class=" col-4 btn btn-success" ><i class="fas fa-check "></i>Save</button>';
        }
        ?>
    </div>

</form>
<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {
        function valueChangeAuto()
        {
           // var extraAmount=$("#extraamount").val();
            var guests=$("#guests").val();
            var packageDated;
            var amount=0;
            var MenuChoicePrice=AllChoiceItemAmounCalculate();
            var AutoTotalAmount=0;
            if($("input[name='defaultExampleRadios']:checked"))
            {
                packageDated=$("input[name='defaultExampleRadios']:checked").val();
                amount=$("#selectpricefix"+packageDated).val();
                AutoTotalAmount=(Number(amount)+Number(MenuChoicePrice))*Number(guests);
            }
            AutoTotalAmount=AutoTotalAmount+Number($("#extraamount").val());
            $("#totalamount").val(AutoTotalAmount);
            RemainingAmount();
        }


        function RemainingAmount()
        {
            var totalamount= Number($("#totalamount").val());
            var newDiscount=Number($("#Discount").val());
            var newcharges=Number($("#Charges").val());
            var paidamount=Number($("#PaidAmount").val());
            $("#remaining").val(totalamount+newcharges-newDiscount-paidamount);
        }
        RemainingAmount();

        $("#Discount").change(function ()
        {
            RemainingAmount();
        });
        $("#Charges").change(function ()
        {
            RemainingAmount();
        });

        function barnches()
        {
            var perheadwith = $("#perheadwith").val();
            if(perheadwith==1)
            {
                $("#cateringid").show();
            }
            else
            {
                $("#cateringid").hide();
            }
        }
        $("#perheadwith").change(function ()
        {
            barnches();
        });
        barnches();
        $("#cancel,#PreviouseWizard").click(function ()
        {

            <?php
            if($processInformation[0][4]==0)
            {
                //process is running
                echo 'location.replace("../../customer/customerEdit.php?pid=' . $pid . '&token='.$token.'");';

            }
            else
            {
                echo "window.history.back();";
            }
            ?>

        });
        function checkpackage(date, time, perheadwith)
        {
            if ((date != "") && (time != "") && (perheadwith != "")) {
                return 1;
            }
            return 0;
        }
        function PackageAvailableCheckLimit()
        {
            var guests=$("#guests").val();
            var date = $("#date").val();
            var time = $("#time").val();
            var perheadwith = $("#perheadwith").val();
            var hallid = $("#branchOrder").val();
            $("#selectmenu").html("");
            if (!checkpackage(date, time, perheadwith))
            {
                return false;
            }
            var formdata = new FormData;
            formdata.append("date",date);
            formdata.append("guests",guests);
            formdata.append("time", time);
            formdata.append("perheadwith", perheadwith);
            formdata.append("option", "checkpackages1");
            formdata.append("orderid", "<?php echo $orderid;?>");
            formdata.append("hallid",hallid);
            $.ajax({
                url: "HallOrder/OrderServer.php",
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
                    $("#groupofpackages").html(data);
                    $("#selectmenu").html("");
                    if($("#packageAvalable").val()=="Yes")
                    {
                        $("#submitform").show("slow");
                        valueChangeAuto();
                    }
                    else
                    {

                        $("#submitform").hide("slow");

                    }

                }
            });
        }

        $(".checkpackage").change(function ()
        {

            PackageAvailableCheckLimit();
        });

        $("#orderStatus").change(function () {
                    var orderStatus=$(this).val();
                    if(orderStatus=="Running")
                        PackageAvailableCheckLimit();

        });

        function menushow(packageDateid,describe)
        {
            var formdata = new FormData;
            formdata.append("packageDateid", packageDateid);
            formdata.append("option", "viewmenu");
            $.ajax({
                url: "../companyServer.php",
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
                    $("#selectmenu").html(data);
                    if(describe!="")
                    {
                        $("#selectmenu").append("<h3 align='center' class='col-12'>package Description</h3><p class='col-12'>" + describe + "</p>");
                    }
                    valueChangeAuto();

                }
            });
        }



        function AllChoiceItemAmounCalculate()
        {
            var amount=0;
            if( $('#MenuTypeInpackages').length )         // use this if you are using id to check
            {

                var textMenuType=$('#MenuTypeInpackages').val();
                var arrayofitemType=textMenuType.split(',');
                for (var i = 0; i < arrayofitemType.length; i++)
                {
                    if( $('#'+arrayofitemType[i]).length )         // use this if you are using id to check
                    {
                        var EachPrice = Number($("#" + arrayofitemType[i]).children('option:selected').data('price'));
                        amount += EachPrice;
                    }
                }

            }
            return amount;

        }
        $(document).on("change",".MenuTypeOptionChanges",function () {
            valueChangeAuto();
        });

        $(document).on("click","input[type=radio]",function ()
        {

            var packageDateid=$("input[name='defaultExampleRadios']:checked").val();
            var describe=$("#describe"+packageDateid).val();
            valueChangeAuto();
            RemainingAmount();
            menushow(packageDateid,describe);
        });

        var packageDateid=<?php echo $detailorder[0][25]; ?>;

        $("#submitform").click(function ()
        {

            var date = $("#date").val();
            var time = $("#time").val();
            var perheadwith = $("#perheadwith").val();
            if (!checkpackage(date, time, perheadwith))
            {
                alert("Please select Date,Time and Per Head");
                return false;
            }
            if($(".checkclasshas")[0])
            {
                packageDateid=$("input[name='defaultExampleRadios']:checked").val();
                if(!packageDateid)
                {
                    alert("Please select Package From Package Detail");
                    return false;
                }
            }
            if (!confirm('Are you sure you want to Save Hall Order informatiom ?'))
                return  false;
            var formdata = new FormData($("form")[0]);
            formdata.append("perheadwith",perheadwith);
            formdata.append("packageDateid", packageDateid);
            formdata.append("order",<?php echo $orderid;  ?>);
            formdata.append("option", "Edithallorder");
            $.ajax({
                url: "HallOrder/OrderAddOrEdit.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function()
                {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    if($.trim(data)==="SameOrderBooked")
                    {
                        alert("Same Order Has been booked yet");
                        location.reload();
                    }
                    else if($.trim(data)!="")
                    {
                        alert(data);
                    }
                    else
                    {

                        <?php
                        if($processInformation[0][4]==0)
                        {


                                //not catering Order so payment collect
                                echo 'location.replace("orderInfo/orderItem.php?pid=' . $pid . '&token='.$token.'");';


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
            echo 'location.replace("orderInfo/orderItem.php?pid=' . $pid . '&token='.$token.'");';
            ?>
        });




    });


</script>
</body>
</html>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>