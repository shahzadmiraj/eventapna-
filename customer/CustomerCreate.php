<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
include  ("../access/userAccess.php");
if(isset($_GET['h']))
{
    //come from hall

    RedirectOtherwiseOnlyAccessUserOfHall("Owner,Employee","../index.php",'h');
}
else
{
    //come from catering

    RedirectOtherwiseOnlyAccessUserOfCateringBranch("Owner,Employee","../index.php","c");

}


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$companyid=$userdetail[0][0];

$hallid="No";
$cateringid='No';
if(isset($_GET['h']))
{
    $hallid=$_GET['h'];
}
if(isset($_GET['c']))
{
    $cateringid=$_GET['c'];
}
$userid=$_COOKIE['userid'];
include('../companyDashboard/includes/startHeader.php'); //html
?>

    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Add Customer</title>
    <meta name="description" content="Add Customer Order,insert person,New customer book  for Order,Client Register, only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Add Customer for Order in Event Apna,New Client Book,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script><!--
    <script type="text/javascript" src="../bootstrap.min.js"></script>-->
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <!--<link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
    <script src="../webdesign/JSfile/JSFunction.js"></script>

 <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->

    <!-- Custom fonts for this template-->
    <link href="<?php echo $Root;?>companyDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <!-- Custom styles for this template-->
    <link href="<?php echo $Root;?>companyDashboard/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom sweetalert for this template-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<?php
include('../companyDashboard/includes/endHeader.php');
include('../companyDashboard/includes/navbar.php');
?>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Booking New Order</h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
        </div>
    </div>

<div class="container">
    <div class="row" >

        <div class="container">
            <ul class="pagination float-right">
                <li class="page-item"><a  class="page-link " href="#" id="CloseWizard">Close</a></li>
            </ul>
        </div>
    </div>


    <div class="row">
        <div class="container">

            <div class="card " >
                <div class="row no-gutters">
                    <div class="col-4">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcRcYhl53h5jYneDJZBHrAJkQin91O6DYR2Gj-Ijaxt6mY39V2NN&usqp=CAU" class="card-img rounded" alt="..." style="height: 15vh">
                    </div>
                    <div class="col-8">
                        <div class="card-body">
                            <h6 class="card-text"><?php
                                if($cateringid!="No")
                                {
                                    $sql='SELECT name FROM catering WHERE id='.$cateringid.'';
                                    $cateringName=queryReceive($sql);

                                    echo "catering Name : ".$cateringName[0][0]."";
                                }
                                else if ($hallid!="No")
                                {
                                    $sql='SELECT name FROM hall WHERE id='.$hallid.'';
                                    $hallName=queryReceive($sql);
                                    echo "hall Name : ".$hallName[0][0]."";
                                }

                                ?></h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>




</div>
<?php



$whichActive=1;
$imageCustomer="../images/customerimage/";

$PageName="Customer infomation";
include_once ("../webdesign/orderWizard/wizardOrder.php");

?>




<div class="container "  >



    <form id="form" class="row">
        <input hidden name="userid" value="<?php echo $userid;?>">
        <input hidden name="companyid" value="<?php echo $companyid;?>">

        <input hidden name="cateringid" value="<?php echo $cateringid;?>">

        <input hidden name="hallid" value="<?php echo $hallid;?>">

        <input id="customer" hidden value="">
        <div class="col-sm-12   col-12 col-md-12 col-lg-12">
            <label for="number" class="col-form-label">Phone no:</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                </div>
                <input id="number" class="form-control" type="number"   placeholder="Phone no 033xxxxxxxx customer" >
                <input type="button" class="form-control btn-primary col-2" id="Add_btn" value="+">
            </div>

            <ul id="mynumberlist" class="container">
            </ul>




        </div>
        <div class="row" id="number_records">


        </div>
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label for="name" class="col-form-label">Name:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" id="name"  name="name"class="form-control" placeholder="customer name" >
            </div>


        </div>
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label for="name" class="col-form-label">Image:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input type="file"  name="image"  class="form-control"  >

            </div>



        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label for="cnic" class="col-form-label">CNIC:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-id-card"></i></span>
                </div>
                <input type="number" id="cnic" name="cnic" class="form-control" placeholder="customer cnic xxxxxxx" >
            </div>



        </div>
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label for="address" class="col-form-label">Address:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-map-marker-alt"></i></span>
                </div>

                <textarea id="address" name="address" class="form-control" placeholder="address"></textarea>
            </div>
        </div>


        <div class="form-group row m-auto col-12">
            <button id="cancelCustomer" type="button" class="col-5 form-control btn btn-danger "><i class="fas fa-window-close"></i>Cancel</button>
            <button type="button" class="col-5 form-control btn btn-primary" id="submit">Next >> </button>
        </div>
    </form>
</div>


<script>

    $(document).ready(function ()
    {
        $.getScript("../webdesign/JSfile/JSFunction.js");

        $(document).on("keyup","#number",function (e)
        {
            //number exist

            e.preventDefault();
            var value=$(this).val();
            if(value=="")
                return false;
            $.ajax({
                url:"customerBookingServer.php",
                data:{value:value,option:"checkExistByKeyUp",company_id:"<?php echo $companyid;?>"},
                dataType:"text",
                method: "POST",
                async:true,
                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    $("#mynumberlist").html(data);
                }
            });
        });

        function numberAddValidation()
        {
            var value=$("#number").val();
            return   $.ajax({
                url:"customerBookingServer.php",
                data:{value:value,option:"checkExistByChange",company_id:"<?php echo $companyid;?>"},
                dataType:"text",
                method: "POST",
                async:false,     //async:true, just give work fast not result
                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');

                    if($.trim(data)!='')
                    {
                        alert(value+"number is also exist so you cant add");
                        //$("#numberexterorNot").val(1);
                        return true;
                    }
                    else
                    {
                        // $("#numberexterorNot").val(0);
                        return false;
                    }

                }
            });

        }

        $(document).on("click",".rightNumber",function (e)
        {

            //location.replace("customerEdit.php");
            e.preventDefault();
            var id=$(this).data("number");
            $.ajax({
                url:"customerBookingServer.php",
                data:{option:"RightPerson",id:id,"cateringid":"<?php echo $cateringid;?>","hallid":"<?php echo $hallid;?>"},
                dataType:"text",
                method: "POST",
                async:true,
                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                  //  alert(data);
                    location.replace(data);
                }
            });

        });


        $("#cancelCustomer,#CloseWizard").click(function (e)
        {
            e.preventDefault();
            window.history.back();
        });
        var number=0;
        $('.number_records').map(function () {
            number++;
        }).get().join();

        $("#Add_btn").click(function ()
        {
            if(number>3)
            {
                alert("no of numbers not more then 3");
                return false;
            }
            if(validatePakistaniNumberByString("number"))
            {
                return  false;
            }
            //console.log(numberAddValidation().responseText);
            if(numberAddValidation().responseText==1)
            {
                return  false;
            }
            // if($("#numberexterorNot").val()==1)
            // {
            //     return false;
            // }
            var numbervalue=$.trim($("#number").val());
            $("#number").val("");

            $("#number_records").append("<div class=\"form-group row\" id=\"Each_number_row_"+number+"\">\n" +
                "                <label for=\"number_"+number+"\" class=\"col-2 col-form-label\">#</label>\n" +
                "                <input value='"+numbervalue+"' readonly id=\"number_"+number+"\" class=\"allnumber form-control col-8\" type=\"number\" name=\"number[]\">\n" +
                "                <input class=\"form-control btn btn-danger col-2 remove_number \" id=\"remove_numbers_"+number+"\" data-removenumber=\""+number+"\" value=\"-\">\n" +
                "            </div>");
            number++;


        });

        $(document).on("click",".remove_number",function () {
            var id=$(this).data("removenumber");
            $("#Each_number_row_"+id).remove();
            number--;
            swal({
                title: "Deleted",
                text: 'Item has been Deleted',
                buttons: false,
                icon: "error",
                timer: 1500,
                html: true
            });
        });

        $("#submit").click(function (e)
        {

            e.preventDefault();
            var state=false;

            var formdata=new FormData($('#form')[0]);
            if(number==0)
            {

                if(validatePakistaniNumberByString("number"))
                {
                    return  false;
                }
                else
                {
                    if(numberAddValidation().responseText==1)
                    {
                        state=false;
                        return  false;
                    }
                    formdata.append("number[]",$("#number").val());
                }
            }
            if(validationWithString("name","Please Enter Customer Name"))
                state=true;


            if(state)
                return false;

            formdata.append("option","customerCreate");
            $.ajax({
                url:"customerBookingServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,
                async:true,
                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {

                   // alert(data);
                    $('#pleaseWaitDialog').modal('hide');
                    location.replace(data);
                }
            });

        });
    });

</script>

<?php
include('../companyDashboard/includes/scripts.php');
include('../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>