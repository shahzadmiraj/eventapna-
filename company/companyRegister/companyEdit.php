
<?php
//../cateringBranches/cateringEDIT.php?
//../../system/user/userEdit.php?
include_once ("../../connection/connect.php");
if(!isset($_COOKIE['companyid']))
{
    header("location:../../user/userLogin.php");
}

if(isset($_SESSION['order']))
{
    unset($_SESSION['order']);
}
if(isset($_SESSION['customer']))
{
    unset($_SESSION['customer']);
}
if(isset($_GET['action']))
{
    //$_SESSION['tempid']=$_GET['id'];

    $id=base64url_encode($_GET['id']);

    if($_GET['action']=="user")
    {
        //user
        header("location:../../system/user/userEdit.php?id=".$id."");
    }
    else if($_GET['action']=="hall")
    {
        //hall
        header("location:../hallBranches/daytimeAll.php?hall=".$id."");
    }
    else
    {
        //catering
        header("location:../cateringBranches/cateringEDIT.php?catering=".$id."");
    }

}

$companyid=$_COOKIE['companyid'];
$sql='SELECT `id`, `name`, `expire`, `user_id` FROM `company` WHERE id='.$companyid.'';
$companydetail=queryReceive($sql);
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
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <style>

        #hallbranches
        {

            width: 100%;/*
            height: 50vh;
            overflow: auto;*/
            background-size: 100% 100%;
            margin: auto;



        }
        #cateringbranches
        {
            width: 100%;
            /*height: 50vh;
            overflow: auto;*/
            background-size: 100% 100%;
            margin: auto;

        }
        #userbranches
        {

            width: 100%;
            /*height: 50vh;
            overflow: auto;*/
            background-size: 100% 100%;
            margin: auto;
        }

    </style>
</head>



<?php
include_once ("../../webdesign/header/header.php");
?>



<div class="jumbotron  shadow " style="background-image: url(https://www.hashmicro.com/blog/wp-content/uploads/2018/06/pudgedesign.png);background-size:100% 115%;background-repeat: no-repeat;">

    <div class="card-body text-center" style="opacity: 0.7 ;background: white;">
        <h1 class="display-5 "><i class="fas fa-city mr-2"></i><?php echo $companydetail[0][1];?><br>Edit your company</h1>
        <p>setting you company of hall branches,catering branches ,user informations ,packages edit</p>

        <h1 class="text-center"> <a href="../companyRegister/companydisplay.php" class="col-6 btn btn-warning "> <i class="fas fa-city mr-2"></i>My Company</a></h1>

    </div>
</div>



<div class="container">



                    <!--USERS-->
<div class="form-group row shadow m-auto  card" id="userbranches">

    <div class="col-12 row  ">
        <h2 align="center" class="col-7 "> <i class="fas fa-user  mr-1"></i> Users</h2>
        <a href="../../system/user/usercreate.php" class="btn btn-success col-5"><i class="fas fa-user-plus"></i> Add User</a>
    </div>
    <hr class="border border-white">
    <?php
    $sql='SELECT u.id, u.username, u.isExpire,(SELECT p.image FROM person as p WHERE p.id=u.person_id) FROM user as u WHERE u.company_id='.$companyid.'';
    $users=queryReceive($sql);
    $display='';
    for($i=0;$i<count($users);$i++)
    {
      $display.='
    <a href="?action=user&id='.$users[$i][0].'" class="col-sm-12 col-md-4 col-xl-3 m-2 ">
        <div class="card  col-12  rounded-circle shadow" style="height: 25vh"  >
            <img class="card-img-top  col-12 rounded-circle" src="';

      if(file_exists('../../images/users/'.$users[$i][3])&&($users[$i][3]!=""))
      {
          $display.='../../images/users/'.$users[$i][3];

      }
      else
          {
              $display.='https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';
          }

      $display.='" alt="Card image" >
        </div>
        <h4 align="center" ><i class="fas fa-user mr-1"></i> '.$users[$i][1].'</h4>';
      if($users[$i][2]!="")
      {
          $display.='
        <i>Expire</i>';
      }
    $display.='</a>';
        

    }
    echo $display;


    ?>
</div>




<div class="form-group row shadow card mt-2" id="hallbranches">

    <!--Hall Branches-->
    <div class="col-12 row">
        <h2 align="center" class=" col-6"> <i class="fas fa-place-of-worship mr-2"></i> Halls</h2>
        <a href="../hallBranches/hallRegister.php" class="btn btn-success col-6"><i class="fas fa-plus"></i><i class="fas fa-place-of-worship mr-2"></i>Add Hall</a>
    </div>
    <hr class="border border-white">
    <?php
    $sql='SELECT `id`, `name`, `expire`, `image` FROM `hall` WHERE (company_id='.$companyid.')AND(ISNULL(expire))';
    $halldetails=queryReceive($sql);
    $display='';
    for($i=0;$i<count($halldetails);$i++)
    {
        $display.='
    <a href="?action=hall&id='.$halldetails[$i][0].'" class="col-sm-12 col-md-4 col-xl-3 m-2">
        <div class="card  col-12  rounded-circle shadow" style="height: 25vh"  >
            <img class="card-img-top  col-12 rounded-circle" src="';

        if((file_exists('../../images/hall/'.$halldetails[$i][3]))&&($halldetails[$i][3]!=""))
        {
            $display.= "../../images/hall/".$halldetails[$i][3];
        }
        else
        {
            $display.='https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg';
        }

        $display.='" alt="Card image" >
        </div>
        <h4 align="center" ><i class="fas fa-place-of-worship mr-1"></i>'.$halldetails[$i][1].'</h4>';
        if($halldetails[$i][2]!="")
        {
            $display.='
        <i>Expire</i>';
        }
        $display.='</a>';


    }
    echo $display;


    ?>
</div>


<div class="form-group row shadow card mt-2" id="cateringbranches">

    <!--Catering Branches-->
    <div class="col-12   row">
        <h2 align="center" class="col-7"> <i class="fas fa-utensils"></i> Caterings</h2>
        <a href="../cateringBranches/catering.php" class="btn btn-success col-5"><i class="fas fa-plus"></i> <i class="fas fa-utensils"></i> Add Catering</a>
    </div>
    <hr class="border border-white">
    <?php
    $sql='SELECT `id`, `name`, `expire`, `image` FROM `catering` WHERE (company_id='.$companyid.')AND(ISNULL(expire))';
    $cateringdetails=queryReceive($sql);
    $display='';
    for($i=0;$i<count($cateringdetails);$i++)
    {
        $display.='
    <a href="?action=catering&id='.$cateringdetails[$i][0].'" class="col-sm-12 col-md-4 col-xl-3 m-2">
        <div class="card  col-12  rounded-circle shadow" style="height: 25vh"  >
            <img class="card-img-top  col-12 rounded-circle" src="';

        if((file_exists('../../images/catering/'.$cateringdetails[$i][3]))&&($cateringdetails[$i][3]!=""))
        {
            $display.= "../../images/catering/".$cateringdetails[$i][3];
        }

        else
        {
            $display.='https://www.liberaldictionary.com/wp-content/uploads/2019/02/cater-4956.jpg';
        }

        $display.='" alt="Card image" >
        </div>
        <h4 align="center"><i class="fas fa-utensils mr-1"></i>'.$cateringdetails[$i][1].'</h4>';
        if($cateringdetails[$i][2]!="")
        {
            $display.='
        <i>Expire</i>';
        }
        $display.='</a>';


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
