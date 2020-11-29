<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");
include  ("../../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner","../../../index.php");



$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$sql='SELECT `id`, `name` FROM `hall` WHERE (ISNULL(expire))AND (company_id= '.$userdetail[0][0].')';
$Names=queryReceive($sql);
$listOfCatering=array_column($Names, 0);
$List = implode(', ', $listOfCatering);
$userid=$_COOKIE['userid'];



include('../../../companyDashboard/includes/startHeader.php'); //html
?>

    <?php
    include('../../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Add Extra Item Hall</title>
    <meta name="description" content=" Add Hall Manage Extra Item page,Add Manage Extra Item Hall,Manage Extra Item Marquee,Manage Extra Item Add Marquee,Manage Extra Item New Dera only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Add Hall Manage Extra Item page,Add Manage Extra Item Hall Marquee,Marquee,Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="<?php echo $Root;?>bootstrap.min.css">
    <script src="<?php echo $Root;?>jquery-3.3.1.js"></script>

    <link rel="stylesheet" href="<?php echo $Root;?>webdesign/css/loader.css">
    <!--<link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
    <script src="<?php echo $Root;?>webdesign/JSfile/JSFunction.js"></script>

    <!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
       <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
       <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->

    <!-- Custom fonts for this template-->
    <link href="<?php echo $Root;?>companyDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo $Root;?>webdesign/css/loader.css">
    <!-- Custom styles for this template-->
    <link href="<?php echo $Root;?>companyDashboard/css/sb-admin-2.min.css" rel="stylesheet">

<?php
include('../../../companyDashboard/includes/endHeader.php');
include('../../../companyDashboard/includes/navbar.php');
?>

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Extra Hall Item </h1>
            <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
        </div>
    </div>

    <form class="container row" id="AddExtraHallItem">
        <input hidden name="userid" value="<?php echo $userid;?>">
        <input hidden name="companyid" value="<?php echo $userdetail[0][0];?>">
        <div class="col-sm-12   col-12 col-md-6 col-lg-6">

            <label for="name" class="col-form-label">Name item </label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-drum"></i></span>
                </div>
                <input id="name" type="text" name="name" class="form-control " placeholder="name of extra item">
            </div>

        </div>



        <div class="col-sm-12   col-12 col-md-6 col-lg-6">

            <label for="image" class="col-form-label">Image Item </label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera-retro"></i></span>
                </div>
                <input  type="file" name="image" class="form-control ">
            </div>

        </div>

        <div class="col-sm-12   col-12 col-md-6 col-lg-6">

            <label for="Price" class="col-form-label"> Price</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input id="Price" type="number" name="Price" class="form-control " placeholder="Price of extra item">
            </div>

        </div>



        <div class="col-sm-12   col-12 col-md-6 col-lg-6">

            <label for="typeofitem" class="col-form-label"> Type of item</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-sitemap"></i></span>
                </div>
                <select  name="typeofitem" id="typeofitem" class="form-control">

                    <?php
                    //dish type of catering
                    $sql='SELECT EIT.id,EIT.name FROM ExtraItemControl as EIC INNER join  Extra_Item as EI 
on(EIC.Extra_Item_id=EI.id) INNER join Extra_item_type as EIT 
on (EI.Extra_item_type_id=EIT.id)
WHERE
(ISNULL(EIC.expire)) AND(ISNULL(EIT.expire))AND(EIC.hall_id in('.$List.'))
GROUP by (EIT.id)';

                    $typeDetail=queryReceive($sql);


                    for($i=0;$i<count($typeDetail);$i++)
                    {
                        echo '<option value="'.$typeDetail[$i][0].'">'.$typeDetail[$i][1].'</option>';
                    }

                    ?>
                    <option value="other">other</option>

                </select>
            </div>

        </div>




        <div class="col-sm-12   col-12 col-md-6 col-lg-6" id="showType">

            <label for="otherTypeName" class="col-form-label">Other Type name</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                </div>
                <input id="otherTypeName" type="text" name="otherTypeName" class="form-control " placeholder="other  type name">
            </div>
        </div>


        <div class="col-sm-12   col-12 col-md-6 col-lg-6">


            <lable  class="col-form-label">Select hall for Extra item active</lable>


            <?php
            for($i=0;$i<count($Names);$i++)
            {
                echo '  
              <div class="checkbox">
                <h4><input type="checkbox" checked  name="branchactive[]" value="'.$Names[$i][0].'"> '.$Names[$i][1].'</h4>
                </div>';



            }
            ?>

        </div>


        <div class="form-inline col-sm-12   col-12 col-md-12 col-lg-12 mt-5">

            <button id="Back"  class="btn btn-danger col-sm-6  col-6 col-md-6 col-lg-6"><i class="fas fa-arrow-left"></i> Cancel</button>
            <button type="button" id="submit" class="btn btn-primary col-sm-6  col-6 col-md-6 col-lg-6"><i class="fas fa-check "></i> Submit</button>

        </div>
    </form>




<script>
    $(document).ready(function ()
    {
        function Show()
        {
            var value=$("#typeofitem").val();
            if(value=="other")
            {
                $("#showType").show();
            }
            else
            {

                $("#showType").hide();
            }

        }
        Show();

        $("#typeofitem").change(function ()
        {
            Show();
        });

        $("#Back").click(function (e)
        {
            e.preventDefault();
            window.history.back();
        });

        $("#submit").click(function (e)
        {


            e.preventDefault();
            var state=false;


            if(validationWithString("name","Please Enter Item name"))
                state=true;

            if(validationWithString("Price","Please Enter Item Price"))
                state=true;

            if($("#typeofitem").val()=="other")
            {
                if(validationWithString("otherTypeName","Please Enter Item type"))
                    state=true;
            }


            if(state)
                return false;
            if (!confirm('Are you sure you want to Save information of items?'))
                return  false;
            var formdata=new FormData($('#AddExtraHallItem')[0]);
            formdata.append('option',"addItem");
            $.ajax({
                url:"hallitemsServer.php",
                data:formdata,
                method:"POST",
                contentType: false,
                processData: false,
                dataType:"text",

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
                        window.history.back();
                    }
                }
            });

        });

    });

</script>

<?php
include('../../../companyDashboard/includes/scripts.php');
include('../../../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../../../webdesign/footer/EndOfPage.php");
?>