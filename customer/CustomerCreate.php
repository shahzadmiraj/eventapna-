<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../connection/connect.php");
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
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script src="../webdesign/JSfile/JSFunction.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>




    <style>


        #mynumberlist {
            /* Remove default list styling */
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #mynumberlist li a {
            border: 1px solid #ddd; /* Add a border to all links */
            margin-top: -1px; /* Prevent double borders */
            background-color: #f6f6f6; /* Grey background color */
            padding: 12px; /* Add some padding */
            text-decoration: none; /* Remove default text underline */
            font-size: 18px; /* Increase the font-size */
            color: black; /* Add a black text color */
            display: block; /* Make it into a block element to fill the whole list */
        }

        #mynumberlist li a:hover:not(.header) {
            background-color: #eee; /* Add a hover effect to all links, except for headers */
        }
    </style>

</head>
<body>

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
//include_once ("../webdesign/header/header.php");



$whichActive=1;
$imageCustomer="../images/customerimage/";

$PageName="Customer infomation";
include_once ("../webdesign/orderWizard/wizardOrder.php");

?>




<div class="container "  >



    <form id="form">
        <input hidden name="userid" value="<?php echo $userid;?>">
        <input hidden name="companyid" value="<?php echo $companyid;?>">

        <input hidden name="cateringid" value="<?php echo $cateringid;?>">

        <input hidden name="hallid" value="<?php echo $hallid;?>">

        <input id="customer" hidden value="">
        <div class="form-group row">
            <label for="number" class="col-form-label">Phone no:</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                </div>
                <input id="number"class="form-control" type="number"   placeholder="Phone no 033xxxxxxxx customer" >
                <input type="button" class="form-control btn-primary col-2" id="Add_btn" value="+">
            </div>

            <ul id="mynumberlist" class="container">
            </ul>




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
            <button id="cancelCustomer" type="button" class="col-5 form-control btn btn-danger "><i class="fas fa-window-close"></i>Cancel</button>
            <button type="button" class="col-5 form-control btn btn-primary" id="submit">Next >> </button>
        </div>
    </form>
</div>


<?php
//include_once ("../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function ()
    {


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

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
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

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
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
            if(PhoneNumberCheck("number"))
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
        });

        $("#submit").click(function (e)
        {
            e.preventDefault();
            var state=false;

            var formdata=new FormData($('form')[0]);
            if(number==0)
            {

                if(PhoneNumberCheck("number"))
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

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {

                    $("#preloader").hide();
                    // alert(data);
                    location.replace(data);
                }
            });

        });
    });

</script>

</body>
</html>
