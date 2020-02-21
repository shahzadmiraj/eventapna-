<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");


if(isset($_GET['action']))
{
    $_SESSION['order']=$_GET['order'];
    $_SESSION['customer']=$_GET['customer'];
    header("location:PreviewOrder.php");
}

$hallid="";
$cateringid="";
$hallorcater="";
$order_info=$_GET['order_status'];
$order_status=$order_info;


if(isset($_SESSION['branchtype']))
{
    if($_SESSION['branchtype']=="hall")
    {
        $hallid=$_SESSION['branchtypeid'];
    }
    else
    {
        $cateringid=$_SESSION['branchtypeid'];
    }
}
$date=date('Y-m-d');
$description='';
if(!empty($hallid))
{
    $hallorcater="(od.hall_id=".$hallid.")";
    $description=$hallorcater;
    if($_GET['order_status']=="Today_Orders")
    {
        $hallorcater.="AND (od.destination_date='".$date."')";
        $order_status="Running";
    }
    $hallorcater.="AND (od.status_hall='".$order_status."')";
}
else
{

    $hallorcater="(od.catering_id=".$cateringid.")";
    $description=$hallorcater;
    if($_GET['order_status']=="Today_Orders")
    {
        $hallorcater.="AND (od.destination_date='".$date."')";
        $order_status="Running";
    }
    $hallorcater.="AND (od.status_catering='".$order_status."')";
}
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
    <link rel="stylesheet" href="../webdesign/css/complete.css">

    <link rel="stylesheet" href="../webdesign/css/loader.css">

    <style>
        .newcolor
        {
            background: #E0EAFC;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to left, #CFDEF3, #E0EAFC);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to left, #CFDEF3, #E0EAFC); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
    </style>
</head>
<body>

<?php
include_once ("../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://university.daraz.pk/pluginfile.php/26/course/section/10/Order%20Fulfilment-01.png);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 class="text-dark"> <i class="fas fa-search-plus fa-3x"></i>Find Orders</h3>
        <p> Check <?php echo $order_info." order and "?> all orders</p>
        <button data-display="hide" id="searchBtn" class="btn-warning btn justify-content-center "><i class="fas fa-search"></i>Search Order</button>
    </div>

</div>


<div class="container">

        <form class="col-12 shadow mb-4 newcolor card " id="formId1" style="display: none">

        <div class="form-group row">
            <label class="col-form-label"> Customer name</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input  name="p_name" type="text" class="changeColumn form-control" placeholder="or customer name etc ali,....">
            </div>



        </div>
        <div class="form-group row">
            <label class="col-form-label"> Customer CNIC</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-id-card"></i></span>
                </div>
                <input  name="p_cnic" type="number" class="changeColumn form-control" placeholder="or cnic 23212xxxxx">
            </div>

        </div>
            <div class="form-group row">
                <label class="col-form-label"> Customer ID</label>



                <div class="input-group mb-3 input-group-lg">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                    </div>
                    <input  name="p_id" type="number" class="changeColumn form-control" placeholder="customer ID 1,2,3,4,.....">
                </div>


            </div>
        <div class="form-group row">
            <label class="col-form-label"> Customer phone</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                </div>
                <input  name="n_number" type="text" class="changeColumn form-control" placeholder="number 03231xxxxxx">
            </div>


        </div>
        <div class="form-group row">
            <label class="col-form-label">Booking Date</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                </div>
                <input  name="od_booking_date" type="date" class="changeColumn form-control">
            </div>



        </div>
        <div class="form-group row">
            <label class="col-form-label"> Destination Date</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-business-time"></i></span>
                </div>
                <input  name="od_destination_date" type="date" class="changeColumn form-control">
            </div>


        </div>

        <div class="form-group row">
            <label class="col-form-label ">order status</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-eye"></i></span>
                </div>

                <select  name="<?php
                if($hallid=="")
                {
                    echo "od_status_catering";
                }
                else
                {
                    echo "od_status_hall";
                }
                ?>" class="changeColumn form-control">
                    <option value="None">None</option>
                    <?php
                    $OrderStatus=array("Running","Cancel","Delieved","Clear");
                    for($i=0;$i<count($OrderStatus);$i++)
                    {

                        echo '<option value='.$OrderStatus[$i].'>'.$OrderStatus[$i].'</option>';

                    }
                    ?>
                </select>
            </div>


        </div>

        <div class="form-group row justify-content-center">
            <button type="button" class="form-control btn-success col-6"><i class="fas fa-search"></i>Find</button>
        </div>

        </form>

        <div  id="recordsAll">



            <?php
            $sql='SELECT od.id,(SELECT p.name FROM person as p WHERE p.id=od.person_id),(SELECT p.image FROM person as p WHERE p.id=od.person_id),od.destination_date,od.destination_time,od.status_hall,od.status_catering,od.hall_id,od.catering_id,(SELECT hp.package_name FROM hallprice as hp WHERE hp.id=od.hallprice_id),od.person_id FROM orderDetail as od WHERE '.$hallorcater.' ';
            $orderdetail=queryReceive($sql);
            $display='';
            for ($i=0;$i<count($orderdetail);$i++)
            {
                $display.='
        <a href="?action=preview&order='.$orderdetail[$i][0].'&customer='.$orderdetail[$i][10].'';



                $display.='" class="col-12   row  shadow m-3 newcolor">
        <img src="';

                if(file_exists('../images/customerimage/'.$orderdetail[$i][2])&&($orderdetail[$i][2]!=""))
                {
                    $display.='../images/customerimage/'.$orderdetail[$i][2];

                }
                else
                {
                    $display.='https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';
                }




                $display.='"class="col-3 p-0">
        <div class="col-9">
            <label class="col-12">Order id:<i class="text-secondary">'.$orderdetail[$i][0].'</i> </label>
            <label class="col-12">Name: <i class="text-secondary">'.$orderdetail[$i][1].'</i></label>
            <label class="col-12">Date: <i class="text-secondary">'.$orderdetail[$i][3].'</i></label>
        </div>
        <label class="col-12">Time: <i class="text-secondary">';

                if(!empty($hallid))
                {
                    //if order is hall order timing
                    if ($orderdetail[$i][4] == "09:00:00")
                    {
                        $display .= "Morning";
                    } else if ($orderdetail[$i][4] == "12:00:00") {
                        $display .= "Afternoon";
                    } else
                     {
                        $display .= "18:00:00";
                    }
                }
                else
                {
                    //catering order
                    $display.=$orderdetail[$i][4];
                }

                $display.='</i></label>';

                if($orderdetail[$i][7]!="")
                {
                    //if order is hall

                    $display .= '<label class="col-12">Per Head:<i class="text-secondary">';
                    if ($orderdetail[$i][9] != "")
                    {
                        //hall is booked wth food+seaating
                        $display.=$orderdetail[$i][9].'   Food+Seating';
                    } else
                    {
                        //hall is book only seating
                        $display.='Only Seating';

                    }
                    $display.='</i> </label>';
                }


                if(($orderdetail[$i][6]!="")&&($orderdetail[$i][8]!=""))
                    {
                        //catering status
                        $display.='
        <label class="col-12">Catering Status:<i class="text-secondary">'.$orderdetail[$i][6].'</i> </label>';
                    }
                if(($orderdetail[$i][5]!="")&&($orderdetail[$i][7]!=""))
                    {
                        //hall status
                        $display.='
        <label class="col-12">Hall Status:<i class="text-secondary">'.$orderdetail[$i][5].'</i> </label>';
                    }
                $display.='</a>';

            }
            echo $display;
            ?>



        </div>

<!--    <a href="#" class="col-12  btn-outline-danger row  shadow m-3">-->
<!--        <img src="../gmail.png" class="col-3 p-0">-->
<!--        <div class="col-9">-->
<!--            <label class="col-12">order id:<i class="text-secondary">1</i> </label>-->
<!--            <label class="col-12">Name: <i class="text-secondary">shahzad miraj</i></label>-->
<!--            <label class="col-12">date: <i class="text-secondary">12:9:21</i></label>-->
<!--        </div>-->
<!--        <label class="col-12">time: <i class="text-secondary">1</i></label>-->
<!--        <label class="col-12">catering status:<i class="text-secondary">1</i> </label>-->
<!--        <label class="col-12">Hall status:<i class="text-secondary">1</i> </label>-->
<!--    </a>-->





</div>




<?php
include_once ("../webdesign/footer/footer.php");
?>

<script>

    $(document).ready(function () {

        $(document).on("change",'.changeColumn',function (e)
        {
                e.preventDefault();
                var formdata=new FormData($('#formId1')[0]);
                formdata.append("hallorcater","<?php echo $description;?>");
                $.ajax({
                    url:"FindOrderServer.php",
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
                        $("#recordsAll").html(data);
                    }
                });
        });


        $("#searchBtn").click(function () {
           var display=$(this).data("display");
           if(display=="hide")
           {
               $("#formId1").show('slow');
               $(this).data("display","show");
           }
           else
           {
               $("#formId1").hide('slow');

               $(this).data("display","hide");

           }

        });




    });





</script>
</body>
</html>
