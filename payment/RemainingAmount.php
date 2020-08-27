<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-18
 * Time: 10:45
 */


include_once ("../connection/connect.php");



if(isset($_GET['action']))
{
    $_SESSION['order']=$_GET['order'];
    $_SESSION['customer']=$_GET['customer'];
    header("location:../order/PreviewOrder.php");
}

$hallid="";
$cateringid='';

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
$hallorcater='';
if(!empty($hallid))
{
    $hallorcater="(od.hall_id=".$hallid.")";
}
else
{

    $hallorcater="(od.catering_id=".$cateringid.")";
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
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">

    <style>

    </style>
</head>
<body>

<?php
include_once ("../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://www.opengovguide.com/wp-content/uploads/2019/07/RM_Banner_Large.jpg);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-header text-center" style="opacity: 0.7 ;background: white;">
        <h3 class="text-dark"> <i class="fab fa-amazon-pay fa-2x"></i>Records managements</h3>
        <p>Check All orders remaining amount,total amount,Event Guru system calculated amount  </p>
        <button data-display="hide" id="searchBtn" class="btn-warning btn justify-content-center "><i class="fas fa-search"></i>Search Order</button>
    </div>

</div>

<div class="container">

    <form class="col-12 shadow mb-4  card " id="formId1" style="display: none">

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


<div  id="recordsAll1" style="overflow: paged-x;">





    <?php
    $sql="SELECT DISTINCT od.id, (SELECT p.name FROM person as p WHERE p.id=od.person_id), (SELECT sum(py.amount) FROM payment as py WHERE (py.IsReturn=0)AND(py.orderDetail_id=od.id)) ,od.total_amount,od.total_amount, (SELECT SUM(dd.price*dd.quantity) FROM dish_detail as dd WHERE dd.orderDetail_id=od.id),od.status_catering,od.status_hall,od.person_id FROM orderDetail as od LEFT join payment as py on od.id=py.orderDetail_id where ".$hallorcater."";

    echo showRemainings($sql);


    ?>
</div>
</div>
<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function () {



        $(document).on("click",".clickable-row",function ()
        {
            window.location = $(this).data("href");
        });

        $(document).on("change",'.changeColumn',function (e)
        {
            e.preventDefault();
            var formdata=new FormData($('#formId1')[0]);
            formdata.append("hallorcater","<?php echo $hallorcater;?>");
            $.ajax({
                url:"RemainingFinderServer.php",
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
                    $("#recordsAll1").html(data);

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
