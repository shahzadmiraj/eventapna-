<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */

include  ("../../connection/connect.php");


$sql='SELECT `company_id` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$companyid=queryReceive($sql);

if(!isset($_COOKIE['companyid']))
{
    header("location:../../user/userLogin.php");
}

$companyid=$_COOKIE['companyid'];


if(isset($_SESSION['order']))
{
    unset($_SESSION['order']);
}
if(isset($_SESSION['customer']))
{
    unset($_SESSION['customer']);
}
if(isset($_SESSION['branchtype']))
{
    unset($_SESSION['branchtype']);
    unset($_SESSION['branchtypeid']);
}
if(isset($_GET['branchtype']))
{
    if($_GET['branchtype']=="hall")
    {
        $_SESSION['branchtype']="hall";
    }
    else
    {
        $_SESSION['branchtype']="catering";
    }
    $_SESSION['branchtypeid']=$_GET['branchtypeid'];
    header("location:../../user/userDisplay.php");
}



$sql='SELECT  c.name FROM company as c WHERE c.id='.$companyid.'';
$companydetail=queryReceive($sql);


$sql='SELECT `id`, `name`,`image` FROM `hall` WHERE ISNULL(expire) AND (company_id='.$companyid.')';
$halls=queryReceive($sql);

$sql='SELECT `id`, `name`,`image` FROM `catering` WHERE ISNULL(expire) AND (company_id='.$companyid.')';
$caterings=queryReceive($sql);

if((count($halls)==0)AND(count($caterings)==0))
{
    header("location:companyEdit.php");
}

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
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">

    <style>

        #hallbranches
        {

            width: 100%;/*
            height: 50vh;
            overflow: auto;*/
            background-size: 100% 100%;
        }
        #cateringbranches
        {
            width: 100%;
         /*   height: 50vh;
            overflow: auto;*/
            background-size: 100% 100%;


        }

    </style>
</head>
<body>

<?php
include_once ("../../webdesign/header/header.php");

?>

<div class="jumbotron  shadow " style="background-image: url(https://i2.wp.com/findlawyer.com.ng/wp-content/uploads/2018/05/Pros-and-Cons-of-Working-at-Large-Companies.jpg?resize=1024%2C512&ssl=1);background-size:100% 115%;background-repeat: no-repeat;">

    <div class="card-body text-center" style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 "><i class="fas fa-city mr-2"></i><?php echo $companydetail[0][0];?></h1>
        <p>check your orders of hall and as well as catering</p>
        <?php
         if($_COOKIE['usertype']=='Owner')
         {
             echo ' <h1 class="text-center"> <a href="companyEdit.php" class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>
                ';
         }
        ?>
    </div>
</div>

<div class="container card">

<h1 class="text-center"><i class="fas fa-place-of-worship"></i>Hall Branches</h1>
<hr class="border border-white">
<div class="col-12 m-1 mb-5 form-group row " id="hallbranches" >
<?php
$display='';
for ($i=0;$i<count($halls);$i++)
{
  $display.= '
    <a  href="?branchtype=hall&branchtypeid='.$halls[$i][0].'"
     class="col-sm-12 col-md-4 col-xl-3 m-2 shadow btn btn-light" >
        <img class="card-img-top  col-12 p-0" src="';

    if((file_exists('../../images/hall/'.$halls[$i][2]))&&($halls[$i][2]!=""))
    {
        $display.= "../../images/hall/".$halls[$i][2];
    }
  else
  {
      $display.='https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg';
  }


  $display.='" alt="Card image" style="height: 25vh" >
   
    <h4 align="center" class="alert-dark"><i class="fas fa-place-of-worship mr-1"></i>'.$halls[$i][1].'</h4>
    </a>';
}
echo $display;
?>

</div>

<h2 class="text-center"><i class="fas fa-utensils mr-2"></i>Catering Branches</h2>
<hr class="border border-white">
<div class="col-12 m-1 mb-5 form-group row  " id="cateringbranches" >


    <?php
    $display='';
    for ($i=0;$i<count($caterings);$i++)
    {
        $display.= '
    <a href="?branchtype=catering&branchtypeid='.$caterings[$i][0].'" class="col-sm-12 col-md-4 col-xl-3 m-2 border btn btn-light">
   
        <img class="card-img-top  col-12  p-0" src="';

        if((file_exists('../../images/catering/'.$caterings[$i][2]))&&($caterings[$i][2]!=""))
        {
            $display.= "../../images/catering/".$caterings[$i][2];
        }
        else
        {
            $display.='https://www.liberaldictionary.com/wp-content/uploads/2019/02/cater-4956.jpg';
        }

        $display.='" alt="Card image" style="height: 25vh ;background-size:150% 140%;">
    
    <h4 align="center" class="alert-dark"><i class="fas fa-utensils mr-2"></i>'.$caterings[$i][1].'</h4>
    </a>';
    }
    echo $display;
    ?>

</div>




</div>

<?php
include_once ("../../webdesign/footer/footer.php");
?>
<script>

</script>
</body>
</html>
