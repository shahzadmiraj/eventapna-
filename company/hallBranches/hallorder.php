<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include  ("../../connection/connect.php");

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);

$hallid=$processInformation[0][3];
$personid=$processInformation[0][7];
$userid=$_COOKIE['userid'];


$sql='SELECT c.id, c.name,c.image FROM catering as c WHERE c.company_id=(SELECT h.company_id from hall as h where h.id='.$hallid.') AND (ISNULL(c.expire))';
$cateringids=queryReceive($sql);
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">


    <style>
        form
        {
            margin: 5%;
            font-weight: bold;


        }

    </style>
</head>
<body>

<?php
//include_once ("../../webdesign/header/header.php");
$whichActive = 2;
$imageCustomer = "../../images/customerimage/";

$PageName="Hall Order info";
include_once("../../webdesign/orderWizard/wizardOrder.php");
?>



<form class="form container card">


    <input  hidden name="pid" value="<?php echo $pid;?>">
    <input  hidden name="token" value="<?php echo $token;?>">

    <input type="number" hidden name="hallid" value="<?php echo $hallid;?>">
    <input type="number" hidden name="personid" value="<?php echo $personid;?>">
    <input type="number" hidden name="userid" value="<?php echo $userid;?>">
<div class="form-group row">
    <label class="col-form-label">No of Guests</label>




    <div class="input-group mb-3 input-group-lg">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-users"></i></span>
        </div>
        <input id="guests" name="guests" type="number" class="form-control checkpackage" placeholder="etc 250,300,....persons">
    </div>


</div>
<div class="form-group row">
    <label class="col-form-label">Date</label>





    <div class="input-group mb-3 input-group-lg">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
        </div>
        <input   id="date" name="date" type="date" class="checkpackage form-control">
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label">Time</label>
    <div class="input-group mb-3 input-group-lg">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-clock"></i></span>
        </div>
        <select id="time" name="time" class="checkpackage form-control">
            <option value="Morning">Morning</option>
            <option value="Afternoon">Afternoon</option>
            <option value="Evening">Evening</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <label class="col-form-label">Per Head With</label>

    <div class="input-group mb-3 input-group-lg">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-utensils"></i></span>
        </div>
        <select id="perheadwith" name="perheadwith" class="checkpackage form-control">
            <option value="0">Only seating</option>
            <option value="1">Food + Seating</option>
        </select>
    </div>
</div>







    <?php

    if(count($cateringids)>0)
    {

        $display = '
                
                
    <div class="form-group row" id="cateringid">
        <label class="col-form-label ">Catereing Branch</label>


        <div  class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-utensils"></i></span>
            </div>
            <select  name="cateringid" class="form-control">

                
                ';


        for ($i = 0; $i < count($cateringids); $i++)
        {
            $display .= '
            <option value="' . $cateringids[$i][0] . '">' . $cateringids[$i][1] . '</option>';

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

    <div id="selectmenu" class="alert-info  m-2 form-group row shadow" >


    </div>

<div class="form-group row">
    <label class="col-form-label">Auto Total amount:</label>
    <div class="input-group mb-3 input-group-lg">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
        </div>
        <input readonly id="totalamount" name="totalamount" type="number" class="form-control" placeholder="etc 10000,20000 total amount">
    </div>
</div>



    <div class="form-group row">
        <label class="form-check-label" for="Discount">Discount </label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input placeholder="Discount" id="Discount"  name="Discount" type="number" class="form-control"  >
        </div>

    </div>

    <div class="form-group row">
        <label class="form-check-label" for="Charges">Extra Charges </label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input  placeholder="Extra Charges "  id="Charges" name="Charges" type="number" class="form-control"  >
        </div>

    </div>



    <div class="form-group row">
        <label class="form-check-label" for="remaining">Remaining Amount </label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input placeholder="Remaining Amount " readonly  id="remaining" name="remaining" type="number" class="form-control" >
        </div>

    </div>

    <div class="form-group row">
        <label class="col-form-label">Describe /Comments</label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comments"></i></span>
            </div>
            <textarea  name="describe" class="form-control" placeholder="order comments /describe"></textarea>

        </div>
    </div>

    <div class="form-group row justify-content-center shadow">

        <a id="btnbackhistory"  data-href="../../customer/customerEdit.php?<?php echo 'pid='.$pid.'&token='.$token ?>"  class=" col-5  btn btn-danger"> << Back </a>
        <a id="submitform" data-href="orderInfo/orderItem.php?<?php echo 'pid='.$pid.'&token='.$token ?>" class=" col-4 btn btn-primary">  Next >> </a>
    </div>

</form>
<?php
//include_once ("../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {

        $("#btnbackhistory").click(function (e) {
            e.preventDefault();
            var direction=$(this).data("href");
            location.replace(direction);
        });

        $("#submitform").hide("slow");

        function valueChangeAuto()
        {
            var guests=$("#guests").val();
            var packageid;
            var amount;
            if($("input[name='defaultExampleRadios']:checked"))
            {
                packageid=$("input[name='defaultExampleRadios']:checked").val();
                amount=$("#selectpricefix"+packageid).val();
                $("#totalamount").val(parseInt(amount)*parseInt(guests));
            }
        }
        function RemainingAmount()
        {
            var totalamount= $("#totalamount").val();
            var newDiscount=$("#Discount").val();
            var newcharges=$("#Charges").val();
            $("#remaining").val(Number(totalamount)+Number(newcharges)-Number(newDiscount));
        }
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
            formdata.append("hallid","<?php echo $hallid;?>");
            $.ajax({
                url: "HallOrder/OrderServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
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




        $(document).on("click","input[type=radio]",function ()
        {

            var packageid=$("input[name='defaultExampleRadios']:checked").val();
            valueChangeAuto();
            var describe=$("#describe"+packageid).val();
            var formdata = new FormData;
            formdata.append("packageid", packageid);
            formdata.append("option", "viewmenu");
            $.ajax({
                url: "../companyServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
                    $("#selectmenu").html(data);
                    if(describe!="")
                    {
                        $("#selectmenu").append("<h3 align='center' class='col-12'>package Description</h3><p class='col-12'>" + describe + "</p>");
                    }
                }
            });
        });
        $("#submitform").click(function ()
        {
            var direction=$(this).data("href");

            var packageid='';
            if($(".checkclasshas")[0])
            {
                packageid=$("input[name='defaultExampleRadios']:checked").val();
                if(!packageid)
                {
                    alert("please select Package From Package Detail");
                    return false;
                }
            }
/*            var state=false;
            if(validationWithString("date","Please enter date"))
            {
                state=true;
            }
            if(validationWithString("time","Please enter DayTime"))
            {
                state=true;
            }
            if(validationWithString("perheadwith","Please Enter package type"))
            {
                state=true;
            }*/
            var formdata = new FormData($("form")[0]);
            formdata.append("packageid", packageid);
            formdata.append("option", "createOrderofHall");

            $.ajax({
                url: "../companyServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

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
                        location.replace(direction);
                    }


                }


            });




        });

    });




</script>
</body>
</html>
