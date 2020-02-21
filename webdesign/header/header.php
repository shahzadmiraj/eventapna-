
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

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" style="background: #ee0979;  /* fallback for old browsers */
background: -webkit-linear-gradient(to right, #ff6a00, #ee0979);  /* Chrome 10-25, Safari 5.1-6 */
background: linear-gradient(to right, #ff6a00, #ee0979);/* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
">
    <div class="container">

        <h6 class="navbar-brand" href="#"><img src="/public_html/gmail.png" style="width: 70px">  <span class="navbar-text font-weight-bold text-white">Event Guru</span></h6>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
                <li class="nav-item ">
                    <a class="nav-link" href="/public_html/index.php?action=home"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>


                <?php
                if(isset($_COOKIE["userid"]))
                {
                    echo '
                <li class="nav-item active">
                    <a class="nav-link" href="/public_html/company/companyRegister/companydisplay.php"><i class="fas fa-building"></i> My Company<span class="sr-only">(current)</span></a>
                </li>
               
                
                ';

                }
                ?>

                <?php
                if(!isset($_COOKIE["userid"]))
                {
                    echo '
                <li class="nav-item ">
                    <a class="nav-link" href="/public_html/company/companyRegister/companyRegister.php"><i class="far fa-registered"></i> Company Register<span class="sr-only">(current)</span></a>
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
                    <a class="nav-link" href="/public_html/user/userLogin.php"><i class="fas fa-sign-in-alt"></i> Sign in</a>
                </li>';

                }
                ?>


                <?php
                if(isset($_SESSION["order"]))
                {
                    echo '
                <li class="nav-item">
                    <a class="nav-link" href="/public_html/order/PreviewOrder.php"><i class="fas fa-shopping-cart"></i> Order Preview</a>
                </li>';

                }


                if(isset($_SESSION['order']))
                {
                    echo '    <a class="nav-link" href="/public_html/user/userDisplay.php" ><i class="fas fa-grip-horizontal"></i> User Display</a>';
                }
                ?>



                <?php
                if(isset($_COOKIE["userid"]))
                {
                    echo '
                <li class="nav-item">
                    <a class="nav-link" href="/public_html/user/logout.php"><i class="fas fa-sign-out-alt"></i> Sign out</a>
                </li>
                
                <li class="nav-item active">
                    <a class="nav-link" href="/public_html/company/companyRegister/companyEdit.php"><i class="fas fa-globe-europe"></i> Edit Company</a>
                </li>
                
                
                ';

                }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="/public_html/user/userLogin.php?action=admin"><i class="fas fa-users-cog"></i>Admin</a>
                </li>
            </ul>

        </div>
    </div>


</nav>
<div style="margin-top: 80px">

</div>






<!--

<script>


</script>
</body>
</html>-->
