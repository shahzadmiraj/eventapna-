<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include  ("../../connection/connect.php");
if(isset($_SESSION['order']))
{
    header("location:EdithallOrder.php");
}
if(!isset($_SESSION['customer']))
{
    header("location:../../user/userDisplay.php");
}

$hallid=$_SESSION['branchtypeid'];
$personid=$_SESSION['customer'];
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
include_once ("../../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://cdn.flatworldsolutions.com/featured-images/outsource-outbound-call-center-services.jpg);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 ><i class="fas fa-cart-plus fa-2x"></i>Order Booking </h3>

    </div>

</div>
<form class="form container card">
    <input type="number" hidden name="hallid" value="<?php echo $hallid;?>">
    <input type="number" hidden name="personid" value="<?php echo $personid;?>">
    <input type="number" hidden name="userid" value="<?php echo $userid;?>">
<div class="form-group row">
    <label class="col-form-label">No of Guests</label>




    <div class="input-group mb-3 input-group-lg">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-users"></i></span>
        </div>
        <input id="guests" name="guests" type="number" class="form-control" placeholder="etc 250,300,....persons">
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

        <a id="btnbackhistory"  class=" col-5  btn btn-danger"  ><i class="fas fa-arrow-circle-left"></i>Edit customer</a>
        <button id="submitform" type="button" class=" col-4 btn btn-success" value="Submit"><i class="fas fa-check "></i>Submit</button>
    </div>

</form>
<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {

        $("#btnbackhistory").click(function (e) {
            e.preventDefault();
            window.history.back();
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
        $("#guests").change(function ()
        {
            valueChangeAuto();
        });
        function RemainingAmount()
        {
            var totalamount= $("#totalamount").val();
            var newDiscount=$("#Discount").val();
            var newcharges=$("#Charges").val();
            $("#remaining").val(totalamount+newcharges-newDiscount);
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

        $(".checkpackage").change(function ()
        {
            var date = $("#date").val();
            var month = new Date(date).getMonth();
            var time = $("#time").val();
            var perheadwith = $("#perheadwith").val();
            if (!checkpackage(date, time, perheadwith))
            {
                return false;
            }

            var formdata = new FormData;
            formdata.append("date",date);
            formdata.append("month", month);
            formdata.append("time", time);
            formdata.append("perheadwith", perheadwith);
            formdata.append("option", "checkpackages1");
            formdata.append("hallid",<?php echo $hallid;?>);
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
                    $("#groupofpackages").html(data);
                    valueChangeAuto();
                    $("#selectmenu").html("");
                    if($("#packageAvalable").val()=="Yes")
                        {
                                $("#submitform").show("slow");
                         }
                    else
                    {

                        $("#submitform").hide("slow");
                    }

                }


            });


        });




        $(document).on("click","input[type=radio]",function ()
        {

            var packageid=$("input[name='defaultExampleRadios']:checked").val();
            // if($("#perheadwith").val()!="1")
            //     return false;
            //multiples packages
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

                        window.location.href="../../order/PreviewOrder.php";
                    }


                }


            });




        });








    });




</script>
</body>
</html>
