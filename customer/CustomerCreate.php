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
if(isset($_SESSION['customer']))
{
    header("location:customerEdit.php");
}
$userid=$_COOKIE['userid'];
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

    <style>

    </style>

</head>
<body>




<?php
include_once ("../webdesign/header/header.php");
?>
<div class="jumbotron  shadow" style="background-image: url(https://www.livechatinc.com/wp-content/uploads/2017/01/customer-centric@2x.png);background-size:100% 115%;background-repeat: no-repeat">

    <div class="card-body text-center" style="opacity: 0.7 ;background: white;">
        <h3 ><i class="fas fa-registered"></i>Register Customer </h3>
    </div>
</div>



<div class="container card">


<form id="form">
    <input hidden name="userid" value="<?php echo $userid;?>">

        <input id="customer" hidden value="">
    <div class="form-group row">
        <label for="number" class="col-form-label">Phone no:</label>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
            </div>
            <input id="number"class="allnumber form-control" type="number" name="number[]"  placeholder="Phone no 033xxxxxxxx customer" >
            <input type="button" class="form-control btn-primary col-2" id="Add_btn" value="+">


        </div>



    </div>
        <div class="col-12 border mb-3 " id="number_records">


        </div>
        <div class="form-group row">
        <label for="name" class="col-form-label">Name:</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" id="name"  name="name"class="form-control" placeholder="customer name" >
            </div>


        </div>
        <div class="form-group row">
            <label for="name" class="col-form-label">Image:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input type="file"  name="image"  class="form-control"  >

            </div>



        </div>

        <div class="form-group row">
        <label for="cnic" class="col-form-label">CNIC:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-id-card"></i></span>
                </div>
                <input type="number" id="cnic" name="cnic" class="form-control" placeholder="customer cnic xxxxxxx" >
            </div>



        </div>
        <div class="form-group row">
            <label for="address" class="col-form-label">Address:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-map-marker-alt"></i></span>
                </div>

            <textarea id="address" name="address" class="form-control" placeholder="address"></textarea>
            </div>
        </div>


        <div class="form-group row m-auto">
            <a href="../user/userDisplay.php" type="button" class="col-5 form-control btn btn-danger"><i class="fas fa-window-close"></i>Cancel</a>
            <button type="button" class="col-5 form-control btn btn-primary" id="submit"><i class="fas fa-check "></i>Submit</button>
        </div>
    </form>
</div>



<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>

   $(document).ready(function ()
   {

       $(document).on("change",".allnumber",function ()
       {
           //number exist
           var value=$(this).val();
           $.ajax({
               url:"customerBookingServer.php",
               data:{value:value,option:"customerExist"},
               dataType:"text",
               method: "POST",

               beforeSend: function() {
                   $("#preloader").show();
               },
               success:function (data)
               {
                   $("#preloader").hide();
                   if(data=="customerexist")
                   {
                           window.location.href="customerEdit.php";
                   }

               }
           });
       });


       $("#cancelCustomer").click(function (e)
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
           if(number>1)
           {
               alert("no of numbers not more then 3");
               return false;
           }
          $("#number_records").append("<div class=\"form-group row\" id=\"Each_number_row_"+number+"\">\n" +
              "                <label for=\"number_"+number+"\" class=\"col-2 col-form-label\">#</label>\n" +
              "                <input id=\"number_"+number+"\" class=\"allnumber form-control col-8\" type=\"number\" name=\"number[]\">\n" +
              "                <input class=\"form-control btn btn-danger col-2 remove_number \" id=\"remove_numbers_"+number+"\" data-removenumber=\""+number+"\" value=\"-\">\n" +
              "            </div>");
           number++;
       });

       $(document).on("click",".remove_number",function () {
          var id=$(this).data("removenumber");
          $("#Each_number_row_"+id).remove();
          number--;
       });

       $("#submit").click(function (e) {
           e.preventDefault();



           if($.trim($("#number").val())=="")
           {
               alert("number must be enter");
               return false;
           }
           if($.trim($("#name").val())=="")
           {

               alert("name must be enter");
               return false;
           }


           var formdata=new FormData($('form')[0]);
           formdata.append("option","customerCreate");
           $.ajax({
               url:"customerBookingServer.php",
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

                    if(data!="")
                    {
                        alert(data);
                        return false;
                    }
                    else
                    {
                        if("<?php echo $hallid;?>"=="")
                        {
                            //this is the oder of catering
                            window.location.href="../order/orderCreate.php";
                        }
                        else
                        {
                            //this is the order of hall
                            window.location.href="../company/hallBranches/hallorder.php";
                        }
                    }
               }
           });

       });
   });

</script>

</body>
</html>
