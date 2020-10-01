<?php
include_once ("../connection/connect.php");



$show="showAsAdminEmail"; //developer
if(isset($_GET['c'])) {
    $show="showAsCompanyEmail"; //company
    $companyid = $_GET['c'];
    $sql = 'SELECT `name` FROM `company` WHERE ISNULL(expire)AND(id=' . $companyid . ')';
    $company = queryReceive($sql);
}

$ExtraInformation="Contact by company page";
$SenderAddress=array();
$SenderName=array();

?>

<!DOCTYPE html>
<head>

    <?php
    include('../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Contact us</title>
    <meta name="description" content="Contact us page, only company user can used this to get payment
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Contact us page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">

    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <script src="../webdesign/JSfile/JSFunction.js"></script>
    <style>

    </style>
</head>
<body>


<?php
include_once ("../webdesign/header/header.php");

if($show=="showAsCompanyEmail")
{


?>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <div class="container">
        <a class="navbar-brand" href="#"><?php echo $company[0][0]; ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link active" href="#">Contact us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../company/ClientSide/Company/ClientCompany.php?c=<?php echo $companyid;?>">Company Service
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php

$HeadingImage="";
$HeadingName=$company[0][0];
$Source='';
$pageName="You  are contacting company";
include_once ("../company/ClientSide/Company/Box.php");
?>

    <?php
            $sql='SELECT `username`,`email` FROM `user` WHERE ISNULL(expire)AND(company_id='.$companyid.')AND(jobTitle="Owner")';
    $users=queryReceive($sql);
    $SenderAddress = array_column($users, 1);//email
    $SenderName=array_column($users,0); //name
}
else
{
    $SenderAddress[0]="group.of.shaheen@gmail.com";
        $SenderName[1]="Event Apna";
        echo '<h3 class="text-muted text-center">Event Apna Contact us:<br>you are contacting to Admin of Website Developer</h3><hr>';


}

$ExtraInformation.="";
if(isset($_COOKIE['userid']))
{

    $sql='SELECT `id`, `username`,`company_id`,`active`,`jobTitle`, `email`, `number`FROM `user` WHERE id='.$_COOKIE['userid'].'';
    $userInfo=queryReceive($sql);
    $ExtraInformation='userid='.$userInfo[0][0].',username='.$userInfo[0][1].',company_id='.$userInfo[0][2].',active='.$userInfo[0][3].',jobTitle='.$userInfo[0][4].',email='.$userInfo[0][5].',number='.$userInfo[0][6];
}

$SenderAddressList = implode(', ', $SenderAddress);
$SenderNameList = implode(', ', $SenderName);
$urlContactus="contactServer.php";
include_once ("contactUs.php");
?>






<?php
include_once ("../webdesign/footer/footer.php");
?>
<script>

    $(document).ready(function ()
    {





    });
</script>
</body>
</html>
<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>