<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../connection/connect.php");
include  ("../../access/userAccess.php");

RedirectOtherwiseOnlyAccessUsersWho("Owner","../../index.php");
$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$userid=$_COOKIE['userid'];


include('../../companyDashboard/includes/startHeader.php'); //html
?>

<?php
include('../../webdesign/header/InsertHeaderTag.php');
?>
    <title>Manage Bank Account</title>
    <meta name="description" content="Add Account,Add photo Catering,Insert picture Catering,New video Food,insert Picture Food  only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Add Account,Add Food Order,Insert Food Video,New Add Food Order,Add New Food Order page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="<?php echo $Root;?>bootstrap.min.css">
    <script src="<?php echo $Root;?>jquery-3.3.1.js"></script><!--
    <script type="text/javascript" src="../bootstrap.min.js"></script>-->
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
include('../../companyDashboard/includes/endHeader.php');
include('../../companyDashboard/includes/navbar.php');
?>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Bank Account</h1>

            <button type="button" class="btn btn-primary d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#exampleModalCenter">
                Add Bank Account
            </button>
        </div>
    </div>




<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Account Holder Name</th>
            <th scope="col">Bank Name</th>
            <th scope="col">Account no / IBAN</th>
            <th scope="col">Delete</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $sql='SELECT `id`, `BankName`, `BankIBAN`, `BankOwnerName` FROM `Bankinfo` WHERE company_id='.$userdetail[0][0].' AND(ISNULL(UserIdExpire))';
        $Resultofbanks=queryReceive($sql);
        for($i=0;$i<count($Resultofbanks);$i++)
        {
            echo ' <tr>
            <th scope="row">'.($i+1).'</th>
            <td>'.$Resultofbanks[$i][3].'</td>
            <td>'.$Resultofbanks[$i][1].'</td>
            <td>'.$Resultofbanks[$i][2].'</td>
            <td><button data-idnumberofbank="'.$Resultofbanks[$i][0].'" class="btn btn-danger removeBankAccount">X</button></td>
        </tr>';
        }
        ?>
        </tbody>
    </table>


</div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"> Add Bank Account</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body container">
                    <form id="FormOfAddBank" class="row">

                        <input type="text" hidden name="option" value="AddNewBank">

                        <input type="number" hidden name="userid" value="<?php echo $userid;?>">

                        <input type="number" hidden name="companyid" value="<?php echo $userdetail[0][0];?>">
                        <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
                            <lable for="Account_Holder_Name" class="col-form-label  sr-only">Account Holder Name</lable>
                            <input id="Account_Holder_Name" type="text" name="Account_Holder_Name" class="form-control " placeholder="Account Holder Name">
                        </div>
                        <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
                            <lable for="Bank_Name" class="col-form-label sr-only">Bank Name</lable>
                            <input id="Bank_Name" type="text" name="Bank_Name" class="form-control " placeholder="Bank Name ">
                        </div>
                        <div class="form-group col-sm-12   col-12 col-md-12 col-lg-12">
                            <lable for="IBAN" class="col-form-label sr-only">Account no / IBAN</lable>
                            <input id="IBAN" type="text" name="IBAN" class="form-control " placeholder="Account no / IBAN ">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="submitNewAccount" type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>








    <script>

        $(document).ready(function ()
        {

            $("#submitNewAccount").click(function ()
            {

                if(validationWithString("Account_Holder_Name","please enter Account Holder Name "))
                    return false;
                if(validationWithString("Bank_Name","please enter bank Name"))
                    return false;
                if(validationWithString("IBAN","please enter IBAN "))
                    return false;

                var formData=new FormData($("#FormOfAddBank")[0]);
                $.ajax({
                    url:"ManageBankServer.php",
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
                        if($.trim(data)!=='')
                        {
                            alert(data);
                        }
                        else
                        location.reload();

                    }
                });
            });



            $(document).on("click",".removeBankAccount",function ()
            {

                var idnumberofbank=$(this).data("idnumberofbank");
                var formData=new FormData;
                formData.append("option","RemoveBankAccount");
                formData.append("idnumberofbank",idnumberofbank);
                formData.append("userid","<?php echo $userid;?>");

                $.ajax({
                    url:"ManageBankServer.php",
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
                        if($.trim(data)!=='')
                        {
                            alert(data);
                        }
                        else
                        location.reload();

                    }
                });
            });
        });



    </script>

<?php
include('../../companyDashboard/includes/scripts.php');
include('../../companyDashboard/includes/footer.php');
?>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>