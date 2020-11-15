
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

<!-- Load Facebook SDK for JavaScript -->
<!--<div id="fb-root"></div>-->
<!--<script>-->
<!--    window.fbAsyncInit = function() {-->
<!--        FB.init({-->
<!--            xfbml            : true,-->
<!--            version          : 'v8.0'-->
<!--        });-->
<!--    };-->
<!---->
<!--    (function(d, s, id) {-->
<!--        var js, fjs = d.getElementsByTagName(s)[0];-->
<!--        if (d.getElementById(id)) return;-->
<!--        js = d.createElement(s); js.id = id;-->
<!--        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';-->
<!--        fjs.parentNode.insertBefore(js, fjs);-->
<!--    }(document, 'script', 'facebook-jssdk'));</script>-->

<!-- Your Chat Plugin code -->
<!--<div class="fb-customerchat"-->
<!--     attribution=setup_tool-->
<!--     page_id="101873715022741"-->
<!--     theme_color="#fa3c4c">-->
<!--</div>-->






<div id="preloader">
    <div id="loader"></div>
</div>

<div id="ShowRefreshHeader" class="fixed-top  shadow">
<nav class="navbar navbar-expand-lg  navbar-light  font-weight-bold text-white  " style="background-color: #ff328c;" >
    <div class="container">

        <a class="navbar-brand  text-white" href="<?php echo $Root;?>index.php?action=home"><img src="<?php echo $Root;?>gmail.png" style="width: 40px">  <span class="navbar-text font-weight-bold text-white">EVENT APNA</span>
        </a>
        <button class="navbar-toggler  badge-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
        </button>


        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto w-100 justify-content-end">
                <li class="nav-item">
                    <a class="nav-link text-white" href="<?php echo $Root;?>index.php?action=home"><i class="fas fa-home"></i> Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item dropdown">
                    <a id="headerCardOrders" class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">  Order Card</a>
                    <div id="showheaderCardOrders" class="dropdown-menu " style="height: 70vh;overflow: auto">
                        <?php
                        if(isset($_COOKIE["userid"]))
                        {

                            $sql='SELECT `id`, `hall_id`, `catering_id`,`status_hall`,`packageDate_id`,`destination_date`, `booking_date`, `destination_time`, `status_catering`FROM `orderDetail` WHERE (user_id='.$_COOKIE["userid"].')';
                            $orderdetailHeader=queryReceive($sql);

                            $branchname='';
                            $branchtype='';
                            $textofheader='';

                            for($i=0;$i<count($orderdetailHeader);$i++)
                            {


                                $textofheader='Please Call owner for Activation of Order :phone number display on BILL<br>Booked Date:'.$orderdetailHeader[$i][5];
                                if($orderdetailHeader[$i][1]!='')
                                {
                                    //hall order
                                    $sql='SELECT `id`, `token`, (SELECT hall.name FROM hall WHERE hall.id=BookingProcess.hall_id), `IsProcessComplete`, `orderDetail_id` FROM `BookingProcess` WHERE orderDetail_id='.$orderdetailHeader[$i][0];
                                    $BookingProcess=queryReceive($sql);
                                    $branchname=$BookingProcess[0][2];
                                    $branchtyp='Hall ';
                                    $textofheader.='<br><span class="text-danger">Status:'.$orderdetailHeader[$i][3].'</span>';
                                }
                                else{
                                    //catering
                                    $sql='SELECT `id`, `token`,  (SELECT catering.name FROM catering WHERE catering.id=BookingProcess.catering_id), `IsProcessComplete`, `orderDetail_id` FROM `BookingProcess` WHERE orderDetail_id='.$orderdetailHeader[$i][0];
                                    $BookingProcess=queryReceive($sql);
                                    $branchname=$BookingProcess[0][2];
                                    $branchtyp='Catering ';
                                    $textofheader.='<br><span class="text-danger">Status:'.$orderdetailHeader[$i][8].'</span>';
                                }
                                echo '<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">'.$branchtyp.'  '.$branchname.'</h5>
    <h6 class="card-subtitle mb-2 text-muted">Order id '.$orderdetailHeader[$i][0].'</h6>
    <p class="card-text">'.$textofheader.'</p>
    
    
    <div class="row form-inline">
   <form  method="GET" action="'.$Root.'connection/printOrderDetail.php" class="col-6">
            <input type="text" hidden name="userdetail" value="'.$_COOKIE["userid"].'">
            <input type="number" hidden name="orderid" value="'.$orderdetailHeader[$i][0].'">
            <input type="text" hidden name="ViewOrDownload" value="View">
            <button type="submit"  class="card-link btn btn-outline-primary" ><i class="fa fa-print" aria-hidden="true"></i>View Bill</button>
        </form>

        <form  method="GET" action="'.$Root.'connection/printOrderDetail.php" class="col-6">
            <input type="text" hidden name="userdetail" value="'.$_COOKIE["userid"].'">
            <input type="number" hidden name="orderid" value="'.$orderdetailHeader[$i][0].'">
            <input type="text" hidden name="ViewOrDownload" value="Download">
            <button  type="submit" class="card-link btn btn-outline-secondary" ><i class="fas fa-cloud-download-alt"></i>Save Bill</button>
        </form>  
    </div>
  
   
  </div>
</div>';


                            }

                        }
                        ?>
                    </div>
                </li>

                    <li><a class="nav-link text-white" href="<?php echo $Root;?>BasicPage/aboutus.php#about">ABOUT</a></li>
                    <li><a  class="nav-link text-white" href="<?php echo $Root;?>BasicPage/aboutus.php#services">SERVICES</a></li>
                    <li><a class="nav-link text-white" href="<?php echo $Root;?>BasicPage/aboutus.php#Tutorial">TRAINING</a></li>
                    <!--<li><a href="#pricing">PRICING</a></li>-->
                    <!--<li><a href="#contact">CONTACT</a></li>-->

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
                ?>












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

<script>

</script>