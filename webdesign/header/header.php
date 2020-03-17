
<!--<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="../../jquery-3.3.1.js"></script>
    <link rel="stylesheet" type="text/css" href="/public_html/../bootstrap.min.css">

    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body >-->

<div id="preloader">
    <div id="loader"></div>
</div>

<div class="fixed-top">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark " style="background: #ee0979;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #ff6a00, #ee0979);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #ff6a00, #ee0979);/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">
    <div class="container">

        <a class="navbar-brand" href="<?php echo $Root;?>index.php?action=home"><img src="<?php echo $Root;?>gmail.png" style="width: 70px">  <span class="navbar-text font-weight-bold text-white">EVENT APNA</span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
                <li class="nav-item ">
                    <a class="nav-link" href="<?php echo $Root;?>index.php?action=home"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>


                <?php
                if(isset($_COOKIE["userid"]))
                {
                    echo '
                <li class="nav-item active">
                    <a class="nav-link" href="'.$Root.'company/companyRegister/companydisplay.php"><i class="fas fa-building"></i> My Company<span class="sr-only">(current)</span></a>
                </li>
               
                
                ';

                }
                ?>

                <?php
                if(!isset($_COOKIE["userid"]))
                {
                    echo '
                <li class="nav-item ">
                    <a class="nav-link" href="'.$Root.'company/companyRegister/companyRegister.php"><i class="far fa-registered"></i> Company Register<span class="sr-only">(current)</span></a>
                </li>';

                }
                ?>




                <!--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-shopping-cart"></i> Order Preview
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>-->

                <?php
                if(!isset($_COOKIE["userid"]))
                {
                    echo '
                <li class="nav-item">
                    <a class="nav-link" href="'.$Root.'user/userLogin.php"><i class="fas fa-sign-in-alt"></i> Sign in</a>
                </li>';

                }
                ?>


                <?php
                if(isset($_SESSION["order"]))
                {
                    echo '
                <li class="nav-item">
                    <a class="nav-link" href="'.$Root.'order/PreviewOrder.php"><i class="fas fa-shopping-cart"></i> Order Preview</a>
                </li>';

                }


                if(isset($_SESSION['order']))
                {
                    echo '    <a class="nav-link" href="'.$Root.'user/userDisplay.php" ><i class="fas fa-grip-horizontal"></i> User Display</a>';
                }
                ?>



                <?php
                if(isset($_COOKIE["userid"]))
                {
                    echo '
                <li class="nav-item">
                    <a class="nav-link" href="'.$Root.'user/logout.php"><i class="fas fa-sign-out-alt"></i> Sign out</a>
                </li>
                
                ';

                    if(isset($_COOKIE['usertype']))
                    {
                        if($_COOKIE['usertype']=="Owner")
                        {
                            echo '<li class="nav-item active">
                    <a class="nav-link" href="'.$Root.'company/companyRegister/companyEdit.php"><i class="fas fa-globe-europe"></i> Edit Company</a>
                </li>';
                        }
                    }

                }


                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $Root;?>user/userLogin.php?action=admin"><i class="fas fa-users-cog"></i>Admin</a>
                </li>
            </ul>

        </div>
    </div>


</nav>
   <!-- <div class="container-fluid badge-light form-inline ">

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-4 form-inline row m-auto">
        <img src="../../gmail.png" style="width: 50px">
        <label class="col-8 col-sm-6 col-md-6 col-lg-9 col-xl-8">hall/catering Name</label>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-4 form-inline row m-auto">
            <img src="../../gmail.png" style="width: 50px">
            <label class="col-8 col-sm-6 col-md-6 col-lg-9 col-xl-8">user Name</label>
        </div>

        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-4 form-inline row m-auto alert-primary">
            <img src="../../gmail.png" style="width: 50px">
            <label class="col-8 col-sm-6 col-md-6 col-lg-9 col-xl-8">Customer Name with order no 1</label>
        </div>


    </div>-->

    <div class="form-inline m-auto table-light " >


        <?php


        function PrintButton($name,$icon,$class,$tag)
        {

            return '
        <a href="'.$tag.'" style=" 
  padding: 10px -10px;
  border-radius: 10px 10px;" type="button" class="shadow  btn-rounded '.$class.'   m-auto text-white "><i class="'.$icon.'" aria-hidden="true"></i>'.$name.'</a>';

        }
        if(isset($_SESSION['branchtype']))
        {
            if($_SESSION['branchtype']=="hall")
            {
                $sql='SELECT h.name FROM hall as h WHERE h.id='. $_SESSION['branchtypeid'].'';
                $name=queryReceive($sql);
               echo PrintButton($name[0][0],"fas fa-place-of-worship pr-2","btn-warning",$Root.'user/userDisplay.php');
            }
            if($_SESSION['branchtype']=="catering")
            {
                $sql='SELECT name FROM catering  WHERE id='.$_SESSION['branchtypeid'].'';
                $name=queryReceive($sql);
                echo  PrintButton($name[0][0],"fas fa-utensils pr-2","btn-success",$Root.'user/userDisplay.php');
            }
        }

        if(isset($_GET['hall']))
        {
            $hall=base64url_decode($_GET['hall']);
            $sql='SELECT h.name FROM hall as h WHERE h.id='. $hall.'';
            $name=queryReceive($sql);
            echo   PrintButton($name[0][0],"fas fa-place-of-worship pr-2","btn-warning",$Root.'user/userDisplay.php');

        }
        if(isset($_GET['catering']))
        {
            $catering=base64url_decode($_GET['catering']);
            $sql='SELECT name FROM catering  WHERE id='.$catering.'';
            $name=queryReceive($sql);
            echo   PrintButton($name[0][0],"fas fa-utensils pr-2","btn-success",$Root.'user/userDisplay.php');

        }
        if((!isset($_SESSION['order']))&&(isset($_SESSION['customer'])))
        {
            $sql='SELECT name FROM person WHERE id='.$_SESSION['customer'].'';
            $name=queryReceive($sql);
            echo   PrintButton($name[0][0],"fa fa-user pr-2","btn-primary",$Root.'customer/customerEdit.php');
        }
        if((isset($_SESSION['order']))&& (isset($_SESSION['customer'])) )
        {
            $sql='SELECT name FROM person WHERE id='.$_SESSION['customer'].'';
            $name=queryReceive($sql);
            echo   PrintButton($name[0][0].' Order#'.$_SESSION['order'],"fa fa-shopping-cart pr-2","btn-primary",$Root.'order/PreviewOrder.php');
        }

        if((isset($_COOKIE['userid'])))
        {
            $sql='SELECT username FROM user WHERE id='.$_COOKIE['userid'].'';
            $name=queryReceive($sql);
            echo   PrintButton($name[0][0],"fa fa-user-circle pr-2","btn-info",$Root.'company/companyRegister/companydisplay.php');
        }

        ?>






    </div>

</div>
<div style="margin-top: 100px">

</div>






<!--

<script>


</script>
</body>
</html>-->
