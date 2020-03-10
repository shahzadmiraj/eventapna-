<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include  ("../../connection/connect.php");
if(!isset($_SESSION['order']))
{
    header("location:../../user/userDisplay.php");
}
if(!isset($_SESSION['customer']))
{
    header("location:../../customer/CustomerCreate.php");
}
$companyid=$_COOKIE['companyid'];
$userid=$_COOKIE['userid'];
//$hallid=$_SESSION['branchtypeid'];
$orderid=$_SESSION['order'];
$sql='SELECT `id`, `hall_id`, `catering_id`, (SELECT hp.isFood from hallprice as hp WHERE hp.id=orderDetail.hallprice_id),
 `user_id`, 1, 1, 1, 
 1, `address_id`, `person_id`, `total_amount`, 
 `total_person`, `status_hall`, `destination_date`, 
 `booking_date`, `destination_time`, `status_catering`, 
 1,`describe`,(SELECT hp.describe from hallprice as hp WHERE hp.id=orderDetail.hallprice_id),hallprice_id,(SELECT hp.price from hallprice as hp WHERE hp.id=orderDetail.hallprice_id) FROM `orderDetail` WHERE id='.$orderid.'';
$detailorder=queryReceive($sql);

$sql='SELECT c.id, c.name,c.image FROM catering as c WHERE c.company_id=(SELECT h.company_id from hall as h where h.id='.$detailorder[0][1].') AND (ISNULL(c.expire))';
$cateringids=queryReceive($sql);


$sql='SELECT sum(ei.price) FROM hall_extra_items as hei  INNER JOIN Extra_Item as ei
on(hei.Extra_Item_id=ei.id)
WHERE (hei.orderDetail_id='.$orderid.') AND(ISNULL(hei.expire)) ';
$priceDetailOfExtraItem=queryReceive($sql);

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
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <style>

    </style>
</head>
<body>


<?php
include_once ("../../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://cdn.flatworldsolutions.com/featured-images/outsource-outbound-call-center-services.jpg);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 ><i class="fas fa-cart-arrow-down fa-3x mr-2"></i>Edit order</h3>
    </div>

</div>

<div class="container table-light shadow">


    <div class="form-group form-inline">
        <h4 class="m-auto">Extra Items detail   <span class="text-primary ml-5"><i class="far fa-money-bill-alt"></i><?php echo $priceDetailOfExtraItem[0][0];?></span></h4>
        <a href="orderInfo/orderItem.php" class="btn btn-primary" >manage items</a>
    </div>
    <hr>

    <div class="container form-inline">

        <?php
        $display='';


        $sql='SELECT hei.id,(SELECT ei.name from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),(SELECT ei.price from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),(SELECT ei.image from Extra_Item as ei WHERE ei.id=hei.Extra_Item_id),hei.active FROM hall_extra_items as hei  WHERE (ISNULL(hei.expire)) AND (hei.orderDetail_id='.$orderid.')';
            $kinds = queryReceive($sql);


            $orignalImage='';
            $imagespath='';
            $display.='<div class="container-fluid"><div class="card-deck ">';
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
        <div  data-name="'.$kinds[$i][1].'" data-image="'.$orignalImage.'" data-amount="'.$kinds[$i][2].'" data-itemsid="'.$kinds[$i][0].'" class="AddItemOrder col-12 col-md-6 col-lg-4 col-xl-3  ">';


                $display.=$imagespath;
                $display.='   <div class="card-body ">
                <h4 class="card-title">'.$kinds[$i][1].'</h4>
              <h6 class="float-right "><i class="far fa-money-bill-alt"></i>'.$kinds[$i][2].'
</h6>
            </div>
        </div>
        <div class="w-100 d-none d-sm-block d-md-none"></div>';
            }
            $display.='</div></div>';

        echo $display;


        ?>



    </div>








<form class="form mt-5" >
    <h3>Order information</h3>
    <hr>
    <input type="hidden" name="userid" value="<?php echo $userid;?>">

    <div class="form-group row">
        <label class="col-form-label">No of Guests</label>




        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-users"></i></span>
            </div>
            <input name="guests" type="number" class="form-control" value="<?php echo $detailorder[0][12]; ?>">
        </div>



    </div>
    <div class="form-group row">
        <label class="col-form-label">Date</label>





        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
            </div>
            <input   id="date" name="date" type="date" class="checkpackage form-control" value="<?php echo $detailorder[0][14]; ?>">
        </div>

    </div>
    <div class="form-group row">
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
    <div class="form-group row">
        <label class="col-form-label ">Per Head With</label>


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-utensils"></i></span>
            </div>
            <select id="perheadwith" name="perheadwith" class="checkpackage form-control">

                <?php

                if($detailorder[0][3]==0)
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
                
                
    <div class="form-group row" id="cateringid">
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

    <div id="selectmenu" class="alert-info  m-2 form-group row shadow" >


    </div>
    <div class="form-group row">
        <label class="col-form-label">Describe /Comments</label>





        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comments"></i></span>
            </div>

            <textarea  name="describe" class="form-control"><?php echo $detailorder[0][19]; ?></textarea></textarea>

        </div>


    </div>
    <div class="form-group row">
        <label class="col-form-label">Total amount:</label>


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
            </div>
            <input name="totalamount" type="number" class="form-control" value="<?php echo $detailorder[0][11]; ?>">
        </div>
    </div>


    <?php

        $status=array("Running","Deliever","Cancel","Clear");
        $display='
    <div class="form-group row">
        <label class="col-form-label">Order status</label>
        
        
        
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-eye"></i></span>
            </div>';



       $display.=' <select  name="orderStatus" class=" form-control">
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



    <div class="form-group row">
        <label for="branchOrder" class="col-form-label">Hall Order in branch :</label>


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="far fa-eye"></i></span>
            </div>

            <select  name="branchOrder"   class="form-control">
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



    <div class="form-group row">
        <label class="col-form-label">Booked date</label>



        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-business-time"></i></span>
            </div>
            <input readonly type="date" class="form-control" value="<?php echo $detailorder[0][15]; ?>">
        </div>
    </div>



    <div class="form-group row justify-content-center">
        <button id="cancel" type="button" class=" col-4 btn btn-danger" value="Cancel"><i class="fas fa-arrow-circle-left"></i>back</button>
        <button id="submitform" type="button" class=" col-4 btn btn-success" value="Save"><i class="fas fa-check "></i>Save</button>
    </div>

</form>
</div>
<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function () {

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
        $("#cancel").click(function ()
        {
            window.history.back();
        });
        function checkpackage(date, time, perheadwith)
        {
            if ((date != "") && (time != "") && (perheadwith != "")) {
                return 1;
            }
            return 0;

        }

        $(".checkpackage").change(function () {
            var date = $("#date").val();
            var month = new Date(date).getMonth();
            var time = $("#time").val();
            var perheadwith = $("#perheadwith").val();
            $("#selectmenu").html("");
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
            formdata.append("hallid",<?php echo $detailorder[0][1];?>);
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
                    if(perheadwith==1)
                    {
                        if (data == "")
                        {
                            $("#submitform").hide("slow");
                            $("#groupofpackages").html(data+"<h1 class='text-danger'>No Packages found:so order not submit</h1>");
                        } else {
                            $("#groupofpackages").html(data);
                            $("#submitform").show("slow");
                        }
                    }
                    else
                    {

                        $("#groupofpackages").html(data);
                        $("#submitform").show("slow");
                    }

                }


            });


        });

        function menushow(packageid,describe)
        {
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
                    $("#selectmenu").append("<h3 align='center' class='col-12'>Menu Description</h3><p class='col-12'>"+describe+"</p>");
                }


            });
        }

        menushow(<?php  echo $detailorder[0][21]; ?>,"<?php echo $detailorder[0][20]; ?>"+"<span class='btn-danger'> ....    with price is <?php echo $detailorder[0][22]; ?></span>");

        $(document).on("click","input[type=radio]",function ()
        {

            var packageid=$("input[name='defaultExampleRadios']:checked").val();
            if($("#perheadwith").val()!="1")
                return false;

            var describe=$("#describe"+packageid).val();
            menushow(packageid,describe);


        });

        var packageid=<?php echo $detailorder[0][21]; ?>;

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
                packageid=$("input[name='defaultExampleRadios']:checked").val();
                if(!packageid)
                {
                    alert("Please select Package From Package Detail");
                    return false;
                }
            }
            var formdata = new FormData($("form")[0]);
            formdata.append("perheadwith",perheadwith);
            formdata.append("packageid", packageid);
            formdata.append("order",<?php echo $orderid;  ?>);
            formdata.append("option", "Edithallorder");
            $.ajax({
                url: "../companyServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,

                beforeSend: function()
                {
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
