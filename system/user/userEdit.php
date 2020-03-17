<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../connection/connect.php");



if(!isset($_GET['id']))
{

    header("location:../../company/companyRegister/companyEdit.php");
}
$id=base64url_decode($_GET['id']);

if((!is_numeric($id))||$id=="")
{
    header("location:../../company/companyRegister/companyEdit.php");
}
if(isset($_GET['action']))
{

    if($_GET['action']=="expire")
    {
        $date=date('Y-m-d H:i:s');
        $sql='UPDATE `user` SET `isExpire`="'.$date.'" WHERE id='.$_SESSION['tempid'].'';
    }
    else
    {
        $sql='UPDATE `user` SET `isExpire`=NULL WHERE id='.$_SESSION['tempid'].'';

    }
    querySend($sql);
    header("location:../../company/companyRegister/companyEdit.php");
}
$userid=$id;
$sql='SELECT  `username`, `password`, `person_id`, `isExpire`, `usertype` FROM `user` WHERE id='.$userid.'';
$userdetail=queryReceive($sql);
$customerId=$userdetail[0][2];
$sql = "SELECT `name`, `cnic`, `id`, `date`, `image` FROM `person` WHERE id=".$customerId."";
$person=queryReceive($sql);
$sql = "SELECT a.id, a.address_city, a.address_town, a.address_street_no, a.address_house_no, a.person_id FROM address as a inner JOIN person p ON a.person_id=p.id
WHERE a.person_id=$customerId
ORDER by a.person_id;";
$address=queryReceive($sql);
$sql="SELECT n.number, n.id, n.is_number_active, n.person_id FROM number as n inner JOIN person as p ON p.id=n.person_id
WHERE p.id=$customerId
order BY n.id";
$numbers=queryReceive($sql);
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
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <style>
    </style>
</head>
<body >
<?php
include_once ("../../webdesign/header/header.php");
?>
<div class="jumbotron  shadow" style="background-image: url(https://jumpcloud.com/wp-content/uploads/2017/01/function-of-identity-as-a-service.jpg);background-size:100% 100%;background-repeat: no-repeat">

    <div class="card-body text-center" style="opacity: 0.7 ;background: #fdfdff;">
        <h3 ><i class="fas fa-user fa-4x"></i> Edit <?php echo $person[0][0]; ?>  User </h3>
        <p>Edit Exiting user  </p>
        <a href="../../company/companyRegister/companyEdit.php" class="col-6 btn btn-info"> <i class="fas fa-city mr-2"></i>Edit Company</a>

    </div>

</div>

<div class="container-fluid">

    <form id="changeImage" class="col-12" style="margin-top: -50px">

        <?php
        echo '<input name="customerid" hidden value="'.$customerId.'">';
        ?>
        <input name="image" hidden value="<?php echo $person[0][4] ?>">
        <div class=" form-group row justify-content-center">
            <img src="<?php
            if((file_exists('../../images/users/'.$person[0][4]))&&($person[0][4]!=""))
            {
                echo '../../images/users/'.$person[0][4];
            }
            else
            {
                echo "https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png";
            }

                ?> " style="height: 30vh" alt="image is not set">

        </div>
        <div class="form-group row justify-content-center">
            <label class="form-check-label">Change user image:</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera"></i></span>
                </div>
                <input name="image" id="submitImage" type="file"  class="form-control float-right btn-warning col-9">
            </div>
        </div>

    </form>

    <form class="col-12 card shadow p-4 mb-3" id="authorchanging">
        <?php
        echo '<input type="hidden" name="PreviousUsername" value="'.$userdetail[0][0].'">
        <input type="hidden" name="Previouspassword" value="'.$userdetail[0][1].'">
        <input type="hidden" name="Previoustype" value="'.$userdetail[0][4].'">
        
        '
        ?>
        <h3 align="center"> Create LogIn form</h3>
        <input hidden name="userid" value="<?php echo $userid;?>">
        <div class="form-group row">
            <label for="username" class="col-form-label ">User Name</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" id="username" name="username" class="form-control" value="<?php echo $userdetail[0][0];?>">
            </div>


        </div>
        <div class="form-group row">
            <label for="password" class="col-form-label">Password</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="text" id="password" name="password" class="form-control" value="<?php echo $userdetail[0][1];?>">
            </div>



        </div>
        <div class="form-group row">
            <label for="password1" class="col-form-label ">Confirm Password</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                </div>
                <input type="text" id="password1" name="password1" class="form-control" value="<?php echo $userdetail[0][1];?>">
            </div>

        </div>


        <div class="form-group row">
            <label for="usertype" class="col-form-label">Type of User:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-award"></i></span>
                </div>
                <select name="usertype" class="form-control">

                    <?php

                    if($userdetail[0][4]=="Owner")
                    {
                        echo ' <option value="Owner">Owner (Company And Order Management)</option>
                    <option value="Manager">Manager (Order Management)</option>
                    <option value="Viewer">Viewer (Order Viewer)</option>';
                    }
                    else if($userdetail[0][4]=="Manager")
                    {
                        echo '
                    <option value="Manager">Manager (Order Management)</option>
                    <option value="Owner">Owner (Company And Order Management)</option>
                    <option value="Viewer">Viewer (Order Viewer)</option>';
                    }
                    else if($userdetail[0][4]=="Viewer")
                    {

                        echo '
                    <option value="Viewer">Viewer (Order Viewer)</option>   
                    <option value="Manager">Manager (Order Management)</option>
                    <option value="Owner">Owner (Company And Order Management)</option>
                    ';
                    }




                    ?>

                </select>
            </div>
        </div>

        <div class="col-12 row justify-content-center">



            <?php
            if($userdetail[0][3]=="")
            {
                echo '<a href="?action=expire" class="btn btn-danger col-6">Expire</a>';

            }
            else
            {
                echo '<a href="?action=active" class="btn btn-warning col-6">Active</a>';
            }

            ?>
            <input id="authorbtn" type="button" class="float-right btn btn-primary col-6" value="Save">





        </div>
    </form>

    <form id="form" class="card container-fluid" >
        <?php
        echo '<input id="customerId" type="number" hidden value="'.$customerId.'">';
        ?>
        <div class="col-12" id="number_records">
            <?php
            for($i=0;$i<count($numbers);$i++)
            {
                echo '
        <div class="form-group row" id="Each_number_row_'.$numbers[$i][1].'">
                <label  class="col-3 col-form-label" for="number_'.$numbers[$i][1].'"><i class="fas fa-phone-volume"></i>Phone no:</label>
                <input  class=" numberchange  allnumber form-control col-7" type="text" name="number[]" value="'.$numbers[$i][0].'" id="number_'.$numbers[$i][1].'" data-columne="number" data-columneid='.$numbers[$i][1].'>
                <input class="form-control btn btn-danger col-2 remove_number " id="remove_numbers_'.$numbers[$i][1].'" data-removenumber="'.$numbers[$i][1].'" value="-">
            </div>';
            }
            ?>

        </div>
        <div class="form-group row" >
            <label for="newNumber" class="col-form-label">New Number</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone-volume"></i></span>
                </div>
                <input id="newNumber"  name="newNumber"class="form-control" >
                <input type="button" value="+" class="col-2 btn-success form-control" id="newadd">


            </div>





        </div>
        <div class="form-group row">
            <label for="name" class="col-form-label"> Name:</label>



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-address-book"></i></span>
                </div>

                <?php
                echo'<input type="text" id="name"  name="name" class=" personchange form-control" value="'.$person[0][0].'" data-columne="name">';
                ?>
            </div>



        </div>
        <div class="form-group row">
            <label for="cnic" class="col-form-label"> CNIC:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-id-card"></i></span>
                </div>


                <?php
                echo '
            <input type="number" id="cnic" name="cnic" class=" personchange form-control col-9" value="'.$person[0][1].'" data-columne="cnic">';
                ?>


            </div>



        </div>

        <h3 align="center"><i class="fas fa-map-marker-alt"></i> Address (optional)</h3>
        <div class="form-group row">
            <label for="city" class="col-form-label"> City:</label>


            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-city"></i></span>
                </div>

                <?php
                echo '<input  type="text"  id="city" name="city" class=" addresschange form-control" value="'.$address[0][1].'" data-columne="address_city">';
                ?>


            </div>




        </div>

        <div class="form-group row">
            <label for="area" class="col-form-label"> Area/ Block:</label>





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-road"></i></span>
                </div>

                <?php
                echo '<input  type="text" id="area" name="area" class=" addresschange form-control " value="'.$address[0][2].'" data-columne="address_town">';
                ?>


            </div>



        </div>

        <div class="form-group row">
            <label for="streetNo" class="col-form-label">Street No :</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-street-view"></i></span>
                </div>

                <?php
                echo '     <input type="number"  id="streetNo" name="streetNo" class=" addresschange form-control " value="'.$address[0][3].'" data-columne="address_street_no">';
                ?>
            </div>
        </div>

        <div class="form-group row">
            <label for="houseNo" class="col-form-label">House No:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                </div>

                <?php
                echo '<input type="number" id="houseNo" name="houseNo" class=" addresschange form-control" value="'.$address[0][4].'" data-columne="address_house_no">';
                ?>
            </div>


        </div>
        <div class="col-12 shadow">
            <h4 align="center">Customer personality</h4>
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

    <div class="form-group row justify-content-center">
        <button class="col-6 form-control btn btn-danger" id="Doneform"><i class="fas fa-check "></i>Done</button>
    </div>
</div>

<?php
include_once ("../../webdesign/footer/footer.php");
?>


<script>
    $(document).ready(function ()
    {

        var customerid=$("#customerId").val();

        function execute_person_address(column,text,type)
        {
            $.ajax({
                url: "userServer.php",
                data:{columnname:column,value:text,edittype:type,option:"change",customerid:customerid},
                dataType:"text",
                method:"POST",
                success:function (data)
                {
                    if(data!='')
                    {
                        alert(data);
                    }
                }
            });
        }
        function execute_number(column,text,type,id)
        {
            $.ajax({
                url: "userServer.php",
                data:{columnname:column,value:text,edittype:type,id:id,option:"change",customerid:customerid},
                dataType:"text",
                method:"POST",
                success:function (data)
                {
                    if(data!='')
                    {
                        alert(data);
                    }
                }
            });
        }

        $(document).on('change','.addresschange',function () {
            //address change
            var column=$(this).data("columne");
            var text=$(this).val();
            execute_person_address(column,text,1);
        });

        $(document).on('change','.personchange',function () {
            //personchange change
            var column=$(this).data("columne");
            var text=$(this).val();
            execute_person_address(column,text,2);
        });


        $(document).on('change','.numberchange',function () {
            //numberchange change
            var column=$(this).data("columne");
            var id=$(this).data("columneid");
            var text=$(this).val();
            execute_number(column,text,3,id);
        });


        $("#newadd").click(function ()
        {

            var numberText=$('#newNumber').val();
            $.ajax({
                url: "userServer.php",
                data:{option:"addNumber",number:numberText,customerid:customerid},
                dataType:"text",
                method:"POST",
                success:function (data) {
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


        $(document).on("click",".remove_number",function () {
            var id=$(this).data("removenumber");
            $.ajax({
                url: "userServer.php",
                data:{ id:id,option:"deleteNumber"},
                dataType:"text",
                method:"POST",
                success:function (data) {
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

        $("#submitImage").change(function () {
            var formData=new  FormData($("#changeImage")[0]);
            formData.append("option","changeImage");
            $.ajax({
                url:"userServer.php",
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,
                success:function (data)
                {
                    if(data!='')
                    {
                        alert(data);
                    }
                    else
                    {
                        location.reload();
                    }
                }
            });


        });
        $("#authorbtn").click(function ()
        {

            if(!(($("#username").val().length>5) && ($("#username").length<19)))
            {
                alert("Username must be 6 to 18 letters")
                return false;
            }
            if(!(($("#password").val().length>5) && ($("#password").length<19)))
            {
                alert("password must be 6 to 18 letters")
                return false;
            }
            var formdata=new FormData($("#authorchanging")[0]);
            formdata.append("option","authorChange");
            $.ajax({
                url:"userServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,
                success:function (data)
                {
                    if(data!='')
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
        $("#Doneform").click(function () {
            window.history.back();
        });


    });
</script>
</body>
</html>
