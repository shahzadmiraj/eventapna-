<?php
include_once ('../../connection/connect.php');
include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfHall("Owner,Employee","../../index.php",'h');



$sql='SELECT `company_id`,`username`, `jobTitle` ,`id`  FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$id=$_GET['h'];
$token=$_GET['token'];
$hallid=$id;
$sql='SELECT `name`, `max_guests`, `noOfPartitions`, `ownParking`, `expire`, `image`, `hallType`, `location_id`,`AdvancePercentage`  FROM `hall` WHERE (id='.$hallid.')AND( token="'.$token.'")AND(ISNULL(expire))';
$halldetail=queryReceive($sql);

if(isset($_GET['action']))
{
    if($_GET['action']=="expire")
    {
        $date=date('Y-m-d H:i:s');
        $sql='UPDATE `hall` SET `expire`="'.$date.'" WHERE id='.$id.'';
    }
    else
    {
        $sql='UPDATE `hall` SET `expire`=NULL WHERE id='.$id.'';

    }
    querySend($sql);
   header("location:../companyRegister/companyAdminPanel.php");
}
$companyid='';
$companyid=$userdetail[0][0];
$sql='SELECT `id`, `longitude`, `expire`, `country`, `city`, `latitude`, `active`, `address` FROM `location` WHERE id='.$halldetail[0][7].'';
$location=queryReceive($sql);
?>
<!DOCTYPE html>
<head>
    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Hall Edit</title>
    <meta name="description" content="Hall Edit page,Edit Hall,Edit Marquee, Edit Marquee,Edit  Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Hall Edit page,Add Hall,Insert Marquee,New Add Marquee,Add New Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">

    <link rel="stylesheet" href="../../map/style.css">
    <style>

    </style>
</head>
<body>

<?php
include_once ("../../webdesign/header/header.php");

?>


<?php
$HeadingImage=$halldetail[0][5];
$HeadingName=$halldetail[0][0];
$Source='../../images/hall/';
$pageName='General Setting';
include_once ("../ClientSide/Company/Box.php");
?>



<div class="container card">
    <h1> Hall Setting </h1>
    <hr class="">
    <form class="" id="formhall" >

        <input type="number" hidden name="userid" value="<?php echo $userdetail[0][3]; ?>">
        <input type="text" hidden name="previousaddress" value="<?php echo $location[0][7]; ?>">
        <input type="text" hidden name="previousaddressid" value="<?php echo $location[0][0]; ?>">
        <input type="number" hidden name="hallid" value="<?php echo $hallid; ?>">

        <input type="text" hidden name="previousimage" value="<?php echo $halldetail[0][5]; ?>">
        <div class="form-group row">
            <label class="col-form-label ">Hall Branch Name:</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-place-of-worship"></i></span>
                </div>
                <input id="hallname"  name="hallname" type="text" class="form-control" value="<?php echo $halldetail[0][0]; ?>">
            </div>



        </div>

        <div class="form-group row">
            <label class="col-form-label">Hall Type:</label>




            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fab fa-accusoft"></i></span>
                </div>

                <select name="halltype" class="form-control">
                    <?php
                    $halltype=array("Marquee","Hall","Deera /Open area");

                    echo '<option value="'.$halldetail[0][6].'">'.$halltype[$halldetail[0][6]].'</option>';
                    for($i=0;$i<count($halltype);$i++)
                    {
                        if($i!=$halldetail[0][6])
                        {

                            echo '<option value="'.$i.'">'.$halltype[$i].'</option>';
                        }
                    }

                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label ">Hall Branch Image:</label>
            <!--        <input name="image" class="form-control col-8" type="file">-->





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera-retro"></i></span>
                </div>
                <input name="image" type="file" class="form-control">
            </div>

        </div>
        <div class="form-group row">
            <label class="col-form-label">Maximum Capacity of guests in hall:</label>
            <!--        <input name="capacity" class="form-control col-4" type="number" value="--><?php //echo $halldetail[0][1]; ?><!--">-->





            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-users"></i></span>
                </div>
                <input id="capacity" type="number" value="<?php echo $halldetail[0][1]; ?>" class="form-control" name="capacity">
            </div>


        </div>

        <div class="form-group row">
            <label class="col-form-label ">How Many function manage on same date and  same time (1 to 4):</label>
            <!--        <input name="partition" class="form-control col-4" type="number" value="--><?php //echo $halldetail[0][2]; ?><!--">-->



            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-columns"></i></span>
                </div>
                <input id="partitions" name="partition" type="number" class="form-control" value="<?php echo $halldetail[0][2]; ?>">
            </div>


        </div>

        <div class="form-group row">
            <label class="col-form-label">Hall Manager :</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                </div>

                <select name="currentManager" class="form-control">
                    <?php
                    $sql='SELECT `user_id`,(SELECT u.username FROM user as u WHERE u.id=BranchesJobStatus.user_id),id FROM `BranchesJobStatus` WHERE ISNULL(ExpireDate)AND (hall_id='.$hallid.')AND (WorkingStatus="Manager")';
                    $currentManager=queryReceive($sql);
                    echo '<option value="'.$currentManager[0][0].'">'.$currentManager[0][1].'</option>';

                    $sql='SELECT `id`,`username` FROM `user` WHERE ISNULL(expire)AND (company_id='.$userdetail[0][0].')AND ((jobTitle="Owner")OR (jobTitle="Employee"))AND(id!='.$currentManager[0][0].')';
                    $users=queryReceive($sql);
                    for($i=0;$i<count($users);$i++)
                    {
                        echo '<option value="'.$users[$i][0].'">'.$users[$i][1].'</option>';
                    }
                    ?>
                </select>
                <?php
                echo '<input hidden name="PreviousManagerId" value="'.$currentManager[0][0].'">
                <input hidden name="BranchesJobStatusManagerId" value="'.$currentManager[0][2].'">
                '
                ?>




            </div>


        </div>



        <div class="form-group row">
            <label class="col-form-label ">Advance  Online booking in percentage%</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input id="AdvanceAmount" value="<?php echo $halldetail[0][8]; ?>" name="AdvanceAmount" type="number" class="form-control" placeholder="Percentage of advance" >
            </div>
        </div>



        <div class="form-group row">
            <label class="col-form-label">Own Parking :</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-parking"></i></span>
                </div>
                <select name="parking" class="form-control">
                    <?php
                    if($halldetail[0][3]==1)
                    {
                        echo '<option value="1">Yes,we have  Own parking</option>
                                    <option value="0">No,we have not Own parking</option>'      ;
                    }
                    else
                    {

                        echo '
                                <option value="0">No,we have not Own parking</option>
                                <option value="1">Yes,we have  Own parking</option>
                                   '      ;
                    }
                    ?>
                </select>
            </div>
        </div>



        <h4   class="text-center"><i class="fas fa-map-marker-alt"></i> Hall Branch Address</h4>
        <hr>




        <div class="form-group row">

            <label for="" class="col-form-label">Address: </label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                </div>
                <input name="address"  value="<?php echo $location[0][7];?>" id="map-search" class="controls form-control" type="text" placeholder="Search Box" size="104">
            </div>
        </div>


        <div id="map-canvas" style="width:100%;height: 60vh"  ></div>
        <div hidden>
            <label  for="">Lat: <input name="latitude" id="latitude" type="number" class="latitude" value="<?php echo $location[0][5];?>"></label>
            <label  for="">Long: <input  name="longitude" id="longitude" type="number" class="longitude" value="<?php echo $location[0][1];?>"></label>
            <label  for="">City <input name="city" id="reg-input-city" type="text" class="reg-input-city" placeholder="City" value="<?php echo $location[0][4];?>"></label>
            <label  for="">country <input name="country" type="text" id="reg-input-country" placeholder="country" value="<?php echo $location[0][3];?>"></label>
        </div>

        <div class="form-group row mt-5">


            <?php
            if($halldetail[0][4]=="")
            {
                echo '<a href="?action=expire&h='.$hallid.'&token='.$token.'" class="btn btn-danger col-6">Expire</a>';

            }
            else
            {
                echo '<a href="?action=active&h='.$hallid.'&token='.$token.'" class="btn btn-warning col-6">Active</a>';
            }

            ?>

            <button id="submitedithall" type="button" class="rounded mx-auto d-block btn btn-primary col-6 " value="Submit"> <i class="fas fa-check "></i>Save</button>

        </div>


    </form>


</div>



<?php

include_once ("../../webdesign/footer/footer.php");
?>

<script src="../../webdesign/JSfile/JSFunction.js" type="text/javascript"></script>
<script src="../../map/constantMap.js"></script>
<script>

    $(document).ready(function ()
    {

        function NumberRange(Element,ShowMessage,Min,Max)
        {
            var state=true;
            Element=$("#"+Element);
            if((Element.val()>=Min)&&(Element.val()<=Max))
            {
                if(Element.hasClass("btn-danger"))
                {
                    Element.removeClass("btn-danger");
                }
                state=false;
            }
            else
            {
                alert(ShowMessage);
                if(!(Element.hasClass("btn-danger")))
                    Element.addClass("btn-danger");

            }
            return state;
        }

        $("#submitedithall").click(function (e)
        {

            e.preventDefault();
            var state=false;
            if(NumberRange("partitions","How Many function manage on same date and  same time (1 to 4)",0,4))
            {
                state=true;
            }
            if(NumberRange("capacity","Please Enter Valid capacity up to 50 and maximum 3000",50,3000))
            {
                state=true;
            }
            if(validationWithString("hallname","Please Enter Name of Hall"))
            {
                state=true;
            }
            if(validationWithString("map-search","Please Select Location of Hall"))
            {
                state=true;
            }

            if(NumberRange("AdvanceAmount","Please Enter Valid Advance online booking in % 0 to 100",0,100))
            {
                state=true;
            }
            if(state)
                return false;
            if (!confirm('Are you sure you want to Save Hall information ?'))
                return  false;
            var formdata=new FormData($("#formhall")[0]);
            formdata.append("option","halledit");
            $.ajax({
                url:"../companyServer.php",
                method:"POST",
                data:formdata,
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
                        return false;
                    }
                    else
                    {
                        window.history.back();
                    }

                }
            });


        });
    });


   $(document).ready(function()
    {
        latitude=<?php echo $location[0][5];?>;
        longitude=<?php echo $location[0][1];?>;
        $.ajax({
            url: "https://maps.googleapis.com/maps/api/js?key=AIzaSyDRXK_VS0xJAkaZAPrjSjrkIbMxgpC6M2k&libraries=places&callback=initialize",
            dataType: "script",
            cache: false
        });
    });
</script>
</body>
</html>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>