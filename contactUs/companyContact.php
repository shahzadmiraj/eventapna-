<?php
include_once ("../connection/connect.php");
$companyid=$_GET['c'];
$sql='SELECT `name` FROM `company` WHERE ISNULL(expire)AND(id='.$companyid.')';
$company=queryReceive($sql);

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
    <link rel="stylesheet" href="../webdesign/css/loader.css">
    <link rel="stylesheet" href="../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <script src="../webdesign/JSfile/JSFunction.js"></script>
    <style>

    </style>
</head>
<body>


<?php
//include_once ("../webdesign/header/header.php");
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
                    <a class="nav-link active" href="#">Company Service
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
$ExtraInformation="Contact by company page";
    $SenderAddress=array();
        $SenderName=array();
        $sql='SELECT `username`,`email` FROM `user` WHERE ISNULL(expire)AND(company_id='.$companyid.')AND(jobTitle="Owner")';
$users=queryReceive($sql);
for($i=0;$i<count($users);$i++)
{
    $SenderAddress=$users[$i][1];
        $SenderName=$users[$i][0];
}
$urlContactus="contactUs.php";
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
