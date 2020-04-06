<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
if(!isset($_SESSION['branchtype']))
{
    header("location:../company/companyRegister/companydisplay.php");

}
if(!isset($_SESSION['customer']))
{
    header("location:../user/userDisplay.php");
}
$customerId="";
$customerId=$_SESSION['customer'];
$hallid="";
$cateringid='';

if(isset($_SESSION['typebranch']))
{
    if($_SESSION['typebranch']=="hall")
    {
        $hallid=$_SESSION['branchtypeid'];
    }
    else
    {
        $cateringid=$_SESSION['branchtypeid'];
    }
}

$sql = "SELECT `name`, `cnic`, `id`, 1, `image`, `address` FROM `person` WHERE id=".$customerId."";
$person=queryReceive($sql);

$sql="SELECT n.number, n.id,1, n.person_id FROM number as n inner JOIN person as p ON p.id=n.person_id
WHERE (p.id=$customerId)AND(ISNULL(n.expire))
order BY n.id";
$numbers=queryReceive($sql);
$userid=$_COOKIE['userid'];
$companyid=$_COOKIE['companyid'];
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
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <script src="../webdesign/JSfile/JSFunction.js"></script>
    <style>

    </style>
</head>
<body>
<?php
include_once ("../webdesign/header/header.php");
?>

<div class="jumbotron  shadow" style="background-image: url(https://www.livechatinc.com/wp-content/uploads/2017/01/customer-centric@2x.png);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-body text-center" style="opacity: 0.7 ;background: white;">
        <h3 ><i class="fas fa-user-edit"></i>Edit Customer info </h3>
    </div>

</div>

    <?php
    echo '<input name="customerid" hidden value="'.$customerId.'">';
    ?>



<form id="formEditCustomer">
<div class="container card" >
    <input hidden type="number" value="<?php echo $userid;?>" name="userid">
    <div class="form-group row col-12 justify-content-center ">
        <img src="<?php

        if(file_exists('../images/customerimage/'.$person[0][4])&&($person[0][4]!=""))
        {
            echo '../images/customerimage/'.$person[0][4];

        }
        else
        {
            echo 'https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';
        }


        ?> " style="height: 20vh;" class="img-thumbnail figure-img rounded-circle" alt="image is not set">


        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-camera"></i></span>
            </div>
            <input name="image"  type="file"  class="form-control">
        </div>

    </div>

    <?php


    echo '<input id="customerId" type="number" name="customerid" hidden value="'.$customerId.'">';
    ?>
        <div id="number_records">
            <?php
            for($i=0;$i<count($numbers);$i++)
            {
                echo '
        <div class="form-group row" id="Each_number_row_'.$numbers[$i][1].'">
                <label  class="col-form-label" for="number_'.$numbers[$i][1].'">Phone no:</label>
                
                
             <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
            </div>
             <input readonly class=" numberchange  allnumber form-control " type="text" name="number[]" value="'.$numbers[$i][0].'" id="number_'.$numbers[$i][1].'" data-columne="number" data-columneid='.$numbers[$i][1].'>
             <input class="form-control btn btn-danger remove_number col-3 " id="remove_numbers_'.$numbers[$i][1].'" data-removenumber="'.$numbers[$i][1].'"    data-userid="'.$userid.'" value="-">
            
            </div>
                        
            </div>';
            }
            ?>

        </div>
        <div class="form-group row" >
            <label for="newNumber" class="col-form-label">New Number</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-mobile-alt"></i></span>
                </div>
                <input type="number" id="newNumber"  name="newNumber"class="form-control" placeholder="New number 092xxxxx" >
                <input type="button" value="+" class="col-3 btn-success form-control" id="newadd" data-userid="<?php echo $userid;?>">
            </div>



        </div>


        <div class="form-group row">
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
        <div class="form-group row">
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
    <div class="form-group row">
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
        <div class="form-group row mb-3 p-4">

            <?php
        /*    if(isset($_GET['option']))
            {
                if($_GET['option']=="orderCreate")
                {
                    echo '
        <a href="CustomerCreate.php" class="col-6 form-control btn btn-danger" id="cancel">Not this customer</a>
        <a href="../order/orderCreate.php?customer='.$customerId.'" class="col-6 form-control btn btn-outline-primary" id="submit"><i class="fas fa-check "></i>Next</a>';
                }
                else if(($_GET['option']=="orderCreate") || ($_GET['option']=="CustomerCreate"))
                {

                    echo '
        <a href="CustomerCreate.php?option=customerEdit" class="col-6 form-control btn btn-danger" id="cancel">Not this customer</a>
        <a href="../order/orderCreate.php?customer='.$customerId.'&option=customerEdit" class="col-6 form-control btn btn-outline-primary" id="submit">Order Create</a>';
                }
                else if($_GET['option']=="customerAndOrderalreadyHave")
                {

                    echo '
        <a href="CustomerCreate.php" class="col-6 form-control btn btn-danger" id="cancel">Not this customer</a>
        <a href="../order/orderEdit.php?order='.$_GET['order'].'&customer='.$_GET['customer'].'&option=customerEdit" class="m-auto col-6 form-control btn btn-primary" id="submit">Edit order</a>';
                }
                else if($_GET['option']=="PreviewOrder")
                {
                    echo '<input type="button" id="btnbackhistory" class="m-auto col-6 form-control btn btn-primary" value="Done">';
                }
                else if($_GET['option']=="hallorder")
                {
                    echo '

                    <a href="../company/hallBranches/hallorder.php?customer='.$customerId.'&hallid='.$_GET['hallid'].'" class="btn btn-warning m-auto col-6"><i class="fas fa-check "></i>Done</a>';
                }
                else if($_GET['option']=="hallCustomer")
                {
                    echo '
                    <input type="button" id="btnbackhistory" class="m-auto col-6 form-control btn btn-danger" value="Not this Customer">
                    <a href="../company/hallBranches/hallorder.php" class="btn btn-success m-auto col-6"><i class="fas fa-check "></i>Done</a>';
                }
            }*/



            if(isset($_GET['action']))
            {
                echo '

            <a  id="btnbackhistory" class="m-auto col-6 form-control btn btn-danger"><i class="fas fa-window-close"></i> Back</a> 
            <a   id="formcustomer"  data-href="saveAndBack" class="m-auto col-6 form-control btn btn-danger"><i class="fas fa-check "></i> Save and Back</a>';

            }
            else if($_SESSION['branchtype']=="hall")
            {
                //hall

                if(!isset($_SESSION['order']))
                {
                    //16 new order of hall
                    echo '

                    <a  id="btnbackhistory" class="m-auto col-6 form-control btn btn-danger"><i class="fas fa-window-close"></i> Not this Customer</a> 
                    <a id="formcustomer" data-href="../company/hallBranches/hallorder.php" class="btn btn-success m-auto col-6"><i class="fas fa-check "></i>Create hall order</a>
                    
                    ';


                }
                else
                {


                }

            }
            else
            {
                //catering



                if(!isset($_SESSION['order']))
                {
                    //not order create
                    //7 go to create order of catering
                    echo '

            <a id="btnbackhistory"  class="m-auto col-6 form-control btn btn-danger"><i class="fas fa-window-close"></i> Not this Customer</a>
             <a  id="formcustomer"  data-href="../order/orderCreate.php" class=" col-6 form-control btn btn-outline-primary" id="submit"><i class="fas fa-check "></i> Order Create</a>   
                    
                     ';


                }
                else
                {
                    //order of catering is created

                    //15 oder of catering edit
                    echo '
            <a href="../user/userDisplay.php" class="m-auto col-6 form-control btn btn-danger"><i class="fas fa-window-close"></i> Not this Customer</a>
        <a id="formcustomer" data-href="../order/orderEdit.php" class="m-auto col-6 form-control btn btn-primary"><i class="fas fa-check "></i> Edit order</a>';
                }
            }

            //6 not this customer

            ?>

        </div>
</div>
</form>


    <?php
    include_once ("../webdesign/footer/footer.php");
    ?>

<script>
 $(document).ready(function ()
 {

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
                 $("#preloader").show();
             },
             success:function (data)
             {
                 $("#preloader").hide();

                 if(data!="")
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

         if(validationWithString("newNumber","Please Enter Customer NewNumber"))
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
                 $("#preloader").show();
             },
             success:function (data)
             {
                 $("#preloader").hide();
                 if(data!='')
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
         var userid=$(this).data("userid");
         var id=$(this).data("removenumber");
         $.ajax({
             url: "customerEditServer.php",
             data:{ id:id,option:"deleteNumber",userid:userid},
             dataType:"text",
             method:"POST",

             beforeSend: function() {
                 $("#preloader").show();
             },
             success:function (data)
             {
                 $("#preloader").hide();
                 if(data!='')
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
        var formData=new  FormData($("#formEditCustomer")[0]);
        var direction=$(this).data("href");
        formData.append("option","EditCustomerform");
         $.ajax({
             url:"customerEditServer.php",
             method:"POST",
             data:formData,
             contentType: false,
             processData: false,

             beforeSend: function() {
                 $("#preloader").show();
             },
             success:function (data)
             {
                 $("#preloader").hide();
                 if(data!='')
                 {
                     alert(data);
                 }
                 else
                 {
                     if(direction==="saveAndBack")
                     {
                         window.history.back();
                     }
                     else
                     {
                         location.href=direction;
                     }

                 }
             }
         });


     });
     $("#btnbackhistory").click(function (e) {
         e.preventDefault();
        window.history.back();
     });


 });
</script>
</body>
</html>
