<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");

include  ("../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfOrderBooked("Owner,Employee","../index.php");

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$pid=$_GET['pid'];
$token=$_GET['token'];
$sql='SELECT `id`, `token`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id` FROM `BookingProcess` WHERE (id='.$pid.')AND(token="'.$token.'")';
$processInformation=queryReceive($sql);
$customerId=$processInformation[0][7];
$hallid="No";
$cateringid='No';
$order="No";

if(!empty($processInformation[0][2]))
{
    $cateringid=$processInformation[0][2];
}
else if(!empty($processInformation[0][3]))
{
    $hallid=$processInformation[0][3];
}

if(!empty($processInformation[0][4]))
{
    $order=$processInformation[0][4];
}
$Isprocessing=$processInformation[0][4];

$sql = "SELECT `name`, `cnic`, `id`, 1, `image`, `address` FROM `person` WHERE id=".$customerId."";
$person=queryReceive($sql);

$sql="SELECT n.number, n.id,1, n.person_id FROM number as n inner JOIN person as p ON p.id=n.person_id
WHERE (p.id=$customerId)AND(ISNULL(n.expire))
order BY n.id";
$numbers=queryReceive($sql);
$userid=$_COOKIE['userid'];
$companyid=$userdetail[0][0];


include('../companyDashboard/includes/startHeader.php'); //html
?>
<?php
include('../webdesign/header/InsertHeaderTag.php');
?>
    <title>Preview Customer</title>
    <meta name="description" content="Edit Customer Order,Edit person,change customer book  for Order,Edit Client Registered, only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Edit Customer for Order in Event Apna,Preview Client Book,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
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

<?php
if($processInformation[0][5]=="") //Not Booked Order yet
{
    echo '<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Booking New Order</h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
        </div>
    </div>';

}
else
{
    echo '<div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Order</h1>
            <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
        </div>
    </div>';
}


if($processInformation[0][4]==0)
{

?>


<div class="container">
    <div class="row" >

        <div class="container">
            <ul class="pagination float-right">
                <!--<li class="page-item ">
                    <a class="page-link" href="#"  id="PreviouseWizard" >Previous</a>
                </li>-->
                <li class="page-item"><a class="page-link" href="#" id="CloseWizard">Close</a></li>
                <li class="page-item"><a class="page-link" href="#" id="NextWizard">Next</a></li>
            </ul>
        </div>
    </div>
</div>

<?php
}



$whichActive=1;
$imageCustomer="../images/customerimage/";

$PageName="Customer infomation";
include_once ("../webdesign/orderWizard/wizardOrder.php");
?>






    <?php
    echo '<input name="customerid" hidden value="'.$customerId.'">';
    ?>



<form id="formEditCustomer" class="container-fluid">

    <input hidden type="number" value="<?php echo $userid;?>" name="userid">

    <?php


    echo '<input id="customerId" type="number" name="customerid" hidden value="'.$customerId.'">';
    ?>
        <div id="number_records" class="row">
            <?php
            for($i=0;$i<count($numbers);$i++)
            {
                echo '
        <div class="col-sm-12   col-12 col-md- col-lg-4" id="Each_number_row_'.$numbers[$i][1].'">
                <label  class="col-form-label" for="number_'.$numbers[$i][1].'">Phone no:</label>
                
                
             <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
            </div>
             <input readonly class=" numberchange  allnumber form-control " type="text" name="number[]" value="'.$numbers[$i][0].'" id="number_'.$numbers[$i][1].'" data-columne="number" data-columneid='.$numbers[$i][1].'>
             <input class="form-control btn btn-danger remove_number col-2 " id="remove_numbers_'.$numbers[$i][1].'" data-removenumber="'.$numbers[$i][1].'"    data-userid="'.$userid.'" value="-">
            
            </div>
                        
            </div>';
            }
            ?>

        </div>
        <div class="col-sm-12   col-12 col-md-12 col-lg-12" >
            <label for="newNumber" class="col-form-label">New Number</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                </div>
                <input type="number" id="newNumber"  name="newNumber"class="form-control" placeholder="New number 092xxxxx" >
                <input type="button" value="+" class="col-2 btn-success form-control" id="newadd" data-userid="<?php echo $userid;?>">
            </div>



        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6">
            <label for="name" class="col-form-label"> Name:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <?php
                echo'<input type="text" id="name"  name="name" class="form-control" value="'.$person[0][0].'" data-columne="name">';
                ?>
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
            <label for="cnic" class="col-form-label "> CNIC:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-id-card"></i></span>
                </div>
                <?php
                echo '
            <input type="number" id="cnic" name="cnic" class="form-control " value="'.$person[0][1].'" data-columne="cnic">';
                ?>
            </div>



        </div>
    <div class="col-sm-12   col-12 col-md-6 col-lg-6">
        <label for="address" class="col-form-label">Address:</label>




        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fas fa-map-marker-alt"></i></span>
            </div>

            <?php
            echo '
             <textarea  id="address" name="address" class="form-control" placeholder="address" data-columne="address">'.$person[0][5].'</textarea>';
            ?>

        </div>
    </div>






        <div class="row col-sm-12   col-12 col-md-12 col-lg-12 ">

            <?php
            if($Isprocessing==0)
            {
                //order is in processing phase
                //  not this is customer back and reprocess
                echo '
                <a id="btnbackhistory" class="m-auto col-4 form-control btn btn-danger text-white">Close</a>
                     <a id="SkipBtn" class="m-auto col-4 form-control btn btn-success text-white">Skip>></a>
                <a  id="formcustomer"   class="col-4 form-control btn btn-primary text-white">  Next >></a>
             ';
            }
            else  if($Isprocessing==1)
            {
                // order hase been completed in order preview
                    echo '
            <a id="btnbackhistory"  class="m-auto col-6 form-control btn btn-danger text-white"><i class="fas fa-window-close"></i> Close</a>';

                echo '<a  id="formcustomer"   class=" col-6 form-control btn btn-primary text-white"><i class="fas fa-check "></i>  Save </a>   ';
            }






            ?>

        </div>



    <div class="col-12 shadow">
        <h4 align="center"><i class="fas fa-user-tag mr-2"></i>Customer personality</h4>
        <?php
        $sql='SELECT py.personality,py.rating FROM person as p INNER join orderDetail as od
on p.id=od.person_id
INNER JOIN payment as py
on od.id=py.orderDetail_id
WHERE
p.id='.$customerId.'';
        $personalitydetails=queryReceive($sql);
        for ($k=0;$k<count($personalitydetails);$k++)
        {
            echo '
            <p class=" mb-3 form-control">'.$personalitydetails[$k][0].' <span class="float-right border-danger border font-weight-bold">Rating: '.$personalitydetails[$k][1].' </span> </p>';
        }
        ?>

    </div>

</form>


<script>
 $(document).ready(function ()
 {
     /*$.getScript("../webdesign/JSfile/JSFunction.js");*/

    var customerid=$("#customerId").val();
     function numberAddValidation()
     {
         var value=$("#newNumber").val();
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

     $("#newadd").click(function ()
     {

            var userid=$(this).data("userid");
         var numberText=$('#newNumber').val();

         var state=false;

         if(validatePakistaniNumberByString("newNumber"))
             state=true;

         if(numberAddValidation().responseText==1)
         {
             state=true;
         }

         if(state)
             return false;
         $.ajax({
             url: "customerEditServer.php",
             data:{option:"addNumber",number:numberText,customerid:customerid,userid:userid},
             dataType:"text",
             method:"POST",

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
                     location.reload()
                 }
             }
         });
     });


     $(document).on("click",".remove_number",function ()
     {
         if (!confirm('Are you sure you want to Delete this number ?'))
             return  false;
         var userid=$(this).data("userid");
         var id=$(this).data("removenumber");
         $.ajax({
             url: "customerEditServer.php",
             data:{ id:id,option:"deleteNumber",userid:userid},
             dataType:"text",
             method:"POST",

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
                     $("#Each_number_row_"+id).remove();
                 }
             }
         });

     });
     $("#formcustomer").click(function ()
     {
         if (!confirm('Are you sure you want to Save this Information ?'))
             return  false;
        var formData=new  FormData($("#formEditCustomer")[0]);
        formData.append("option","EditCustomerform");
         $.ajax({
             url:"customerEditServer.php",
             method:"POST",
             data:formData,
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

                     if($Isprocessing==0)
                     {
                         //order is in processing phase
                         if($order=="No")
                         {
                             //order is process and not book yet
                             if($hallid!="No")
                             {
                                 //hall order is procesing  phase but not book yet
                                 echo 'location.replace("../company/hallBranches/hallorder.php?pid='.$pid.'&token='.$token.'");';
                             }
                             if($cateringid!="No")
                             {
                                 //catering order is procesing  phase but not book yet
                                 echo 'location.replace("../order/orderCreate.php?pid='.$pid.'&token='.$token.'");';
                             }
                         }
                         else
                         {
                             //order is process and order is already  booked
                             if($hallid!="No")
                             {
                                 //hall order is procesing  phase but order is booked
                                 echo 'location.replace("../company/hallBranches/EdithallOrder.php?pid='.$pid.'&token='.$token.'");';
                             }
                             if($cateringid!="No")
                             {
                                 //catering order is procesing  phase but order is booked
                                 echo 'location.replace("../order/orderEdit.php?pid='.$pid.'&token='.$token.'");';
                             }

                         }
                     }
                     else  if($Isprocessing==1)
                     {
                         // order hase been completed in order preview
                    echo 'window.history.back();';
                     }


                     ?>




                 }
             }
         });


     });
     $("#btnbackhistory").click(function (e) {
         e.preventDefault();
        window.history.back();
     });


     $("#SkipBtn,#NextWizard").click(function (e) {
         e.preventDefault();
         <?php
         //order is in processing phase
         if($order=="No")
         {
             //order is process and not book yet
             if($hallid!="No")
             {
                 //hall order is procesing  phase but not book yet
                 echo 'location.replace("../company/hallBranches/hallorder.php?pid='.$pid.'&token='.$token.'");';
             }
             if($cateringid!="No")
             {
                 //catering order is procesing  phase but not book yet
                 echo 'location.replace("../order/orderCreate.php?pid='.$pid.'&token='.$token.'");';
             }
         }
         else
         {
             //order is process and order is already  booked
             if($hallid!="No")
             {
                 //hall order is procesing  phase but order is booked
                 echo 'location.replace("../company/hallBranches/EdithallOrder.php?pid='.$pid.'&token='.$token.'");';
             }
             if($cateringid!="No")
             {
                 //catering order is procesing  phase but order is booked
                 echo 'location.replace("../order/orderEdit.php?pid='.$pid.'&token='.$token.'");';
             }

         }
         ?>
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