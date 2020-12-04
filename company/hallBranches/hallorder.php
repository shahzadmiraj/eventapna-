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
include('../../companyDashboard/includes/startHeader.php'); //html
?>
        <?php
        include('../../webdesign/header/InsertHeaderTag.php');
        ?>
        <title>Add Hall Order</title>
        <meta name="description" content="Hall Order Register page,Add Order Hall,Insert Marquee Order,New Add Order Marquee,Add New  Dera Order only company user can used this
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
        <meta name="keywords" content="Hall Order Register page,Add Hall Order,Insert Marquee Order,New Add Marquee Order,Add New Dera Order page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <!--<link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
    <script src="../../webdesign/JSfile/JSFunction.js"></script>

    <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->

    <!-- Custom fonts for this template-->
    <link href="<?php echo $Root;?>companyDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <!-- Custom styles for this template-->
    <link href="<?php echo $Root;?>companyDashboard/css/sb-admin-2.min.css" rel="stylesheet">






    <?php
include('../../companyDashboard/includes/endHeader.php');
include('../../companyDashboard/includes/navbar.php');

    ?>

<?php
$ExtraButtonHandleOnTop='

<div class="container">


        <div class="row" >

            <div class="container">
                <ul class="pagination float-right">
                    <li class="page-item ">
                        <a class="page-link" href="#"  id="PreviouseWizard" >Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#" id="CloseWizard">Close</a></li>
                    <!--                <li class="page-item"><a class="page-link" href="#" id="NextWizard">Next</a></li>-->
                </ul>
            </div>
        </div>

    </div>
';

?>



    <?php
    $whichActive = 2;
    $imageCustomer = "../../images/customerimage/";
    $PageName="Hall Order";
    include_once("../../webdesign/orderWizard/wizardOrder.php");
    ?>



    <form class="container row" id="formOfNewHallOrder">


        <input  hidden name="pid" value="<?php echo $pid;?>">
        <input  hidden name="token" value="<?php echo $token;?>">

        <input type="number" hidden name="hallid" value="<?php echo $hallid;?>">
        <input type="number" hidden name="personid" value="<?php echo $personid;?>">
        <input type="number" hidden name="userid" value="<?php echo $userid;?>">
        <div class=" col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">No of Guests</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                </div>
                <input id="guests" name="guests" type="number" class="form-control checkpackage" placeholder="etc 250,300,....persons">
            </div>


        </div>
        <div class=" col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Booking Date (Year,Month,Day)</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input   id="date" name="date" type="date" class="checkpackage form-control"  min="<?php
                echo date('Y-m-d');
                ?>">
            </div>
        </div>
        <div class=" col-sm-12   col-12 col-md-6 col-lg-6">
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
        <div class=" col-sm-12   col-12 col-md-6 col-lg-6">
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
                
                
    <div class=" col-sm-12   col-12 col-md-6 col-lg-6" id="cateringid">
        <label class="col-form-label ">Catering Branch</label>


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

        <div id="selectmenu" class="row col-12 alert-info   container" >

            <!--        <div class=" row">-->
            <!--            <label class="col-form-label">Per Head With</label>-->
            <!---->
            <!--            <div class="input-group mb-3 input-group-lg">-->
            <!--                <div class="input-group-prepend">-->
            <!--                    <span class="input-group-text"><i class="fas fa-utensils"></i></span>-->
            <!--                </div>-->
            <!--                <select  name="perheadwith" class="checkpackage form-control">-->
            <!--                    <option value="0">Only seating</option>-->
            <!--                    <option value="1">Food + Seating</option>-->
            <!--                </select>-->
            <!--            </div>-->
            <!--        </div>-->




        </div>

        <div class=" col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Auto Total amount:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input readonly id="totalamount" name="totalamount" type="number" class="form-control" placeholder="etc 10000,20000 total amount">
            </div>
        </div>



        <div class=" col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label" for="Discount">Discount </label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input placeholder="Discount" id="Discount"  name="Discount" type="number" class="form-control"  >
            </div>

        </div>

        <div class=" col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label" for="Charges">Extra Charges </label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input  placeholder="Extra Charges "  id="Charges" name="Charges" type="number" class="form-control"  >
            </div>

        </div>



        <div class=" col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label" for="remaining">Remaining Amount </label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input placeholder="Remaining Amount " readonly  id="remaining" name="remaining" type="number" class="form-control" >
            </div>

        </div>

        <div class="col-sm-12   col-12 col-md-12 col-lg-12">
            <label class="col-form-label">Describe /Comments</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-comments"></i></span>
                </div>
                <textarea  name="describe" class="form-control" placeholder="Order Comments / Describe"></textarea>

            </div>
        </div>

        <div class=" col-12  justify-content-center ">
            <a id="btnbackhistory"  class="col-5  btn btn-danger text-white"> << Back </a>
            <a id="submitform" data-href="orderInfo/orderItem.php?<?php echo 'pid='.$pid.'&token='.$token ?>" class="col-4 btn btn-primary text-white">  Next >> </a>
        </div>

    </form>
    <script>
        $(document).ready(function ()
        {

            $("#btnbackhistory,#PreviouseWizard").click(function (e) {
                e.preventDefault();
                location.replace("<?php echo '../../customer/customerEdit.php?pid='.$pid.'&token='.$token.''; ?>");
            });

            $("#submitform").hide("slow");

            function valueChangeAuto()
            {
                var guests=$("#guests").val();
                var packageDated=0;
                var amount=0;
                var MenuChoicePrice=AllChoiceItemAmounCalculate();
                if($("input[name='defaultExampleRadios']:checked"))
                {
                    packageDated=$("input[name='defaultExampleRadios']:checked").val();
                    if( $('#selectpricefix'+packageDated).length )         // use this if you are using id to check
                    {
                        amount=$("#selectpricefix"+packageDated).val();
                    }

                    $("#totalamount").val((Number(amount)+Number(MenuChoicePrice))*Number(guests));
                }
                RemainingAmount();
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

            $(document).on("change",".MenuTypeOptionChanges",function ()
            {
                valueChangeAuto();
            });

            $(document).on("click","input[type=radio]",function ()
            {

                var packageDateid=$("input[name='defaultExampleRadios']:checked").val();
                valueChangeAuto();
                var describe=$("#describe"+packageDateid).val();
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
                            $("#selectmenu").append("<h3 align='center' class='col-12'>Package Description</h3><p class='col-12'>" + describe + "</p>");
                        }
                        valueChangeAuto();
                    }
                });
            });
            $("#submitform").click(function ()
            {
                if (!confirm('Are you sure you want to Save order information ?'))
                    return  false;
                var direction=$(this).data("href");

                var packageDateid='';
                if($(".checkclasshas")[0])
                {
                    packageDateid=$("input[name='defaultExampleRadios']:checked").val();
                    if(!packageDateid)
                    {
                        alert("please select Package From Package Detail");
                        return false;
                    }
                }

                var formdata = new FormData($("#formOfNewHallOrder")[0]);
                formdata.append("packageDateid", packageDateid);
                formdata.append("option", "createOrderofHall");

                $.ajax({
                    url: "HallOrder/OrderAddOrEdit.php",
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
                            location.replace(direction);
                        }


                    }


                });




            });

        });


    </script>

<?php
include('../../companyDashboard/includes/scripts.php');
include('../../companyDashboard/includes/footer.php');
include_once ("../../webdesign/footer/EndOfPage.php");
?>