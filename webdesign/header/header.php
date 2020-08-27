
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

<div class="fixed-top  shadow">
<nav class="navbar navbar-expand-lg  navbar-light  font-weight-bold text-white  " style="background-color: #ff328c;" >
    <div class="container">

        <a class="navbar-brand  text-white" href="<?php echo $Root;?>index.php?action=home"><img src="<?php echo $Root;?>gmail.png" style="width: 70px">  <span class="navbar-text font-weight-bold text-white">EVENT APNA</span>
        </a>

        <button class="navbar-toggler  badge-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link text-white  " href="<?php echo $Root;?>index.php?action=home"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>
                <?php

                if(!isset($_COOKIE["userid"]))
                    {

                    echo '
                <li class="nav-item ">
                    <a class="nav-link text-white" href="'.$Root.'user/RegisterCompanyWithUSer.php"><i class="far fa-registered"></i> Company Register<span class="sr-only">(current)</span></a>
                </li>
                
                
                <li class="nav-item">
                    <a class="nav-link text-white" href="'.$Root.'user/userLogin.php"><i class="fas fa-sign-in-alt"></i> Sign in</a>
                </li>
                
                ';
                    }

                    echo' <li class="nav-item">
                    <a class="nav-link text-white" href="'.$Root.'contactUs/companyContact.php"><i class="far fa-envelope"></i> Contact us</a>
                </li>
                
                ';

                if(isset($_COOKIE["userid"]))
                {
                    echo '
                <li class="nav-item active">
                    <a class="nav-link text-white" href="'.$Root.'company/companyRegister/companyAdminPanel.php"><i class="fas fa-building"></i> My Company<span class="sr-only">(current)</span></a>
                </li>';

              echo' <li class="nav-item">
                    <a class="nav-link text-white" href="'.$Root.'user/logout.php"><i class="fas fa-sign-out-alt"></i> Sign out</a>
                </li>
                
                ';
                }





echo '<li class="nav-item">
                    <a class="nav-link text-white" href="'.$Root.'Policy/Policy.php"> <i class="fas fa-balance-scale"></i> Policy</a>
                </li>';

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







            </ul>

        </div>
    </div>


</nav>


</div>
<div style="margin-top: 70px">

</div>






<!--

<script>


</script>
</body>
</html>-->
