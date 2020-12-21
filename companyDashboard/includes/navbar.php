<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */

$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetailNav=queryReceive($sql);
$companyidNav=$userdetailNav[0][0];

$sql='SELECT  c.name FROM company as c WHERE c.id='.$companyidNav.'';
$companydetailNav=queryReceive($sql);


$sql='SELECT `id`, `name`,`image`,`token` FROM `hall` WHERE ISNULL(expire) AND (company_id='.$companyidNav.')';
$hallsNav=queryReceive($sql);

$sql='SELECT `id`, `name`,`image`,`token` FROM `catering` WHERE ISNULL(expire) AND (company_id='.$companyidNav.')';
$cateringsNav=queryReceive($sql);

$sql='SELECT `id`, `username`,`image`, `jobTitle`,`token` FROM `user` WHERE (company_id='.$companyidNav.')AND(ISNULL(expire))';
$usersNav=queryReceive($sql);

?>


<!-- Sidebar -->
   <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo $Root; ?>index.php">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">EVENT <sup>APNA</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->

<li class="nav-item active">
  <a class="nav-link" href="<?php echo $Root; ?>index.php">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading company-->
<div class="sidebar-heading">
  Company
</div>


       <li class="nav-item">
           <a class="nav-link" href="<?php echo $Root; ?>company/ClientSide/Company/ClientCompany.php?c=<?php echo $companyidNav;?>">

               <i class="fab fa-chrome "></i>
               <span>Website</span></a>
       </li>


       <?php
       if (onlyAccessUsersWho("Owner"))
       {
       ?>
       <li class="nav-item">
           <a class="nav-link" href="<?php echo $Root; ?>user/RegisterCompanyUser.php">
               <i class="fas fa-id-card "></i>
               <span>+ Add User</span></a>
       </li>
           <li class="nav-item">
               <a class="nav-link" href="<?php echo $Root; ?>company/BankAccount/ManageBankInfo.php">
                   <i class="fas fa-university"></i>
                   <span>Account Bank Manage</span></a>
           </li>

       <?php
       }
       ?>



       <!-- Divider -->
       <hr class="sidebar-divider">
       <!-- Heading company-->
       <div class="sidebar-heading">
           Hall
       </div>

<!-- Nav Item - Pages Collapse Menu -->

       <?php

       $displayNav='';
       for($iNav=0;$iNav<count($hallsNav);$iNav++)
       {
           
           


           $tokenNav=$hallsNav[$iNav][3];
           $hallEncordedNav=$hallsNav[$iNav][0];
           $QueryNav='h='.$hallEncordedNav.'&token='.$tokenNav;
           ?>
       
       
       <?php
       $displayNav.=' <li class="nav-item">
           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwoHallNav'.$iNav.'" aria-expanded="true" aria-controls="collapseTwo">
               <i class="fas fa-fw fa-cog"></i>
               <span>'.$hallsNav[$iNav][1].'</span>
           </a>
           <div id="collapseTwoHallNav'.$iNav.'" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Hall Branch</h6>
           ';

       //start link

           if (onlyAccessUsersWho("Owner,Employee")) 
           {
               $displayNav.= '      <a href="'.$Root.'customer/CustomerCreate.php?' . $QueryNav . '" class="collapse-item"><i class="fas fa-cart-plus"></i> Add Order</a>';
           }

           $displayNav.='               <a href="'.$Root.'order/FindOrder.php?order_status=Today_Orders&' . $QueryNav . '" class="collapse-item"><i class="fas fa-book-reader "></i> Next 24 Process Orders</a>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Running&' . $QueryNav . '" class="collapse-item"><i class="fas fa-cart-arrow-down "></i> Process Order</a>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Delivered&' . $QueryNav . '" class="collapse-item"><i class="fas fa-truck "></i> Delivered Orders</a>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Clear&'.$QueryNav . '" class="collapse-item"><i class="far fa-thumbs-up "></i> Clear Orders</a>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Cancel&'.$QueryNav.'" class="collapse-item"><i class="far fa-trash-alt "></i> Cancel Orders</a>
                                        <a href="'.$Root.'order/FindOrder.php?order_status=Draft&'.$QueryNav.'" class="collapse-item"><i class="fas fa-clock"></i> Draft Orders</a>
                       <a  href="'.$Root.'company/hallBranches/userDisplay/OrderCalender/OrderCalender.php?'. $QueryNav . '" class="collapse-item"><i class="far fa-calendar-alt "></i> Calender Orders</a>
                       <a  href="'.$Root.'company/ClientSide/Hall/HallClient.php?'.$QueryNav.'" class="collapse-item"><i class="fab fa-chrome "></i> Hall Website</a>';
           if (onlyAccessUsersWho("Owner"))
           {
               $displayNav.='  <a href="'.$Root.'company/hallBranches/hallInfo.php?' . $QueryNav . '" class="collapse-item"><i class="fas fa-cogs "></i> Setting</a>';
           }
           $displayNav.='<a href="'.$Root.'company/hallBranches/galleryhall.php?' . $QueryNav . '" class="collapse-item"><i class="fas fa-images "></i> Gallery</a>';


           //end link

           $displayNav.='   </div>
  </div>
</li>';

           ?>
           


           <?php
       }


       echo $displayNav;




       ?>



       <?php
       //access owner for hall
       if(onlyAccessUsersWho("Owner"))
       {
       ?>

       <li class="nav-item">
           <a class="nav-link" href="<?php echo $Root; ?>company/hallBranches/hallRegister.php">
               <i class="fas fa-place-of-worship"></i>
               <span>+ Add Hall</span></a>
       </li>



       <li class="nav-item">
           <a class="nav-link       <?php if(count($hallsNav)==0)
           {
               echo 'disabled';
           } ?>  " href="<?php echo $Root; ?>company/hallBranches/HallprizeLists.php">
               <i class="fas fa-clipboard-list"></i>
               <span>Manage Packages </span></a>
       </li>



       <li class="nav-item">
           <a class="nav-link   <?php if(count($hallsNav)==0)
           {
               echo 'disabled';
           } ?> " href="<?php echo $Root; ?>company/hallBranches/extraItems/Hallitem.php">
               <i class="fas fa-guitar"></i>
               <span>Extra Items Manage</span></a>
       </li>

<?php
       }
?>


<!--<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
    <i class="fas fa-fw fa-cog"></i>
    <span>Hall Branch</span>
  </a>
  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Custom Components:</h6>
      <a class="collapse-item" href="buttons.html">Buttons</a>
      <a class="collapse-item" href="cards.html">Cards</a>
    </div>
  </div>
</li>-->




<!--<li class="nav-item">
  <a class="nav-link" href="register.php">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Admin Profile</span></a>
</li>-->



<!-- Nav Item - Utilities Collapse Menu -->
<!--<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Utilities</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Custom Utilities:</h6>
      <a class="collapse-item" href="utilities-color.html">Colors</a>
      <a class="collapse-item" href="utilities-border.html">Borders</a>
      <a class="collapse-item" href="utilities-animation.html">Animations</a>
      <a class="collapse-item" href="utilities-other.html">Other</a>
    </div>
  </div>
</li>-->

<!-- Divider  Catering -->
<hr class="sidebar-divider">

<!-- Heading  Catering -->
<div class="sidebar-heading">
  Catering
</div>



       <?php

       $displayNav='';
       for($iNav=0;$iNav<count($cateringsNav);$iNav++)
       {



           $tokenNav=$cateringsNav[$iNav][3];
           $iNavdNav=$cateringsNav[$iNav][0];
           //  $CateringQuery='id='.$iNavdNav.'&token='.$tokenNav.'&c='.$iNavdNav;
           $QueryNav='c='.$iNavdNav.'&token='.$tokenNav;
           ?>


           <?php
           $displayNav.=' <li class="nav-item">
           <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwocateringNav'.$iNav.'" aria-expanded="true" aria-controls="collapseTwo">
               <i class="fas fa-fw fa-cog"></i>
               <span>'.$cateringsNav[$iNav][1].'</span>
           </a>
           <div id="collapseTwocateringNav'.$iNav.'" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                 <div class="bg-white py-2 collapse-inner rounded">
                 <h6 class="collapse-header">Catering Branch</h6>
           ';

           //start link

           if (onlyAccessUsersWho("Owner,Employee"))
           {
               $displayNav.= '      <a href="'.$Root.'customer/CustomerCreate.php?' . $QueryNav . '" class="collapse-item"><i class="fas fa-cart-plus"></i> Add Order</a>';
           }

           $displayNav.='               <a href="'.$Root.'order/FindOrder.php?order_status=Today_Orders&' . $QueryNav . '" class="collapse-item"><i class="fas fa-book-reader "></i> Next 24 Process Orders</a>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Running&' . $QueryNav . '" class="collapse-item"><i class="fas fa-cart-arrow-down "></i> Process Order</a>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Delivered&' . $QueryNav . '" class="collapse-item"><i class="fas fa-truck "></i> Delivered Orders</a>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Clear&'.$QueryNav . '" class="collapse-item"><i class="far fa-thumbs-up "></i> Clear Orders</a>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Cancel&'.$QueryNav.'" class="collapse-item"><i class="far fa-trash-alt "></i> Cancel Orders</a>
                         <a href="'.$Root.'order/FindOrder.php?order_status=Draft&'.$QueryNav.'" class="collapse-item"><i class="fas fa-clock"></i> Draft Orders</a>
                       <a  href="'.$Root.'company/cateringBranches/DisplauUser/Ordercalender/OrderCalender.?'. $QueryNav . '" class="collapse-item"><i class="far fa-calendar-alt "></i> Calender Orders</a>
                       <a  href="'.$Root.'company/ClientSide/Catering/cateringClient.php?'.$QueryNav.'" class="collapse-item"><i class="fab fa-chrome "></i> Website</a>';
           if (onlyAccessUsersWho("Owner"))
           {
               $displayNav.='  <a href="'.$Root.'company/cateringBranches/infoCatering.php?' . $QueryNav . '" class="collapse-item"><i class="fas fa-cogs "></i> Setting</a>';
           }
           $displayNav.='<a href="'.$Root.'company/cateringBranches/gallerycatering.php?' . $QueryNav . '" class="collapse-item"><i class="fas fa-images "></i> Gallery</a>';


           //end link



           $displayNav.='   </div>
  </div>
</li>';
           ?>



           <?php
       }





       echo $displayNav;




       ?>








       <?php
       //access owner for hall
       if(onlyAccessUsersWho("Owner"))
       {
           ?>

           <li class="nav-item">
               <a class="nav-link" href="<?php echo $Root; ?>company/cateringBranches/catering.php">
                   <i class="fas fa-utensils"></i>
                   <span>+ Add Catering</span></a>
           </li>



           <li class="nav-item">
               <a class="nav-link       <?php if(count($cateringsNav)==0)
               {
                   echo 'disabled';
               } ?>  " href="<?php echo $Root; ?>company/cateringBranches/dish/dishesInfo.php">
                   <i class="fas fa-hamburger"></i>
                   <span> Dishes Manage </span></a>
           </li>







           <?php
       }




       ?>





<!-- Nav Item - Pages Collapse Menu -->
<!--<li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-fw fa-folder"></i>
    <span>Pages</span>
  </a>
  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">Login Screens:</h6>
      <a class="collapse-item" href="login.html">Login</a>
      <a class="collapse-item" href="register.html">Register</a>
      <a class="collapse-item" href="forgot-password.html">Forgot Password</a>
      <div class="collapse-divider"></div>
      <h6 class="collapse-header">Other Pages:</h6>
      <a class="collapse-item" href="404.html">404 Page</a>
      <a class="collapse-item" href="blank.html">Blank Page</a>
    </div>
  </div>
</li>-->

<!-- Nav Item - Charts -->
<!--<li class="nav-item">
  <a class="nav-link" href="charts.html">
    <i class="fas fa-fw fa-chart-area"></i>
    <span>Charts</span></a>
</li>-->

<!-- Nav Item - Tables -->
<li class="nav-item">
  <a class="nav-link" href="<?php echo $Root; ?>company/cateringBranches/packagesCatering/packagecaters.php">
    <i class="fas fa-fw fa-table"></i>
    <span>Manage Cater Deal</span></a>
</li>



       <!-- Divider -->
       <hr class="sidebar-divider">

       <!-- Heading company-->
       <div class="sidebar-heading">
           User
       </div>


       <?php


       $ActiveUseridNav=$_COOKIE['userid'];
       $ActiveQueryUser="sdasda";
       $ActiveNameNav="dsa";
       $displayNav='';
       for($iNav=0;$iNav<count($usersNav);$iNav++)
       {

           $img= "";

           if((file_exists($Root.'images/hall/'.$usersNav[$iNav][2]))&&($usersNav[$iNav][2]!=""))
           {
               $img= $Root."images/hall/".$usersNav[$iNav][2];
           }
           else
           {
               $img=$Root.'images/systemImage/imageNotFound.png';
           }


           $tokenCom=$usersNav[$iNav][4];
           $EncordedCom=$usersNav[$iNav][0];
           $QueryCom='uid='.$EncordedCom.'&token='.$tokenCom;
           if($ActiveUseridNav==$usersNav[$iNav][0])
           {
               $ActiveQueryUser=$QueryCom;
               $ActiveNameNav=$usersNav[$iNav][1];

           }


           ?>


           <?php
           $displayNav.='
              
          
                 <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagesUserProvile'.$iNav.'" aria-expanded="true" aria-controls="collapsePages">
    <i class="fas fa-user"></i>
    <span>'.$usersNav[$iNav][1].'</span>
  </a>
  <div id="collapsePagesUserProvile'.$iNav.'" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <h6 class="collapse-header">User Management</h6>
    
                 
           ';

           //start link




           $displayNav.='<a href="'.$Root.'user/UserProfile.php?' . $QueryCom . '" class="collapse-item"><i class="fas fa-id-card "></i> User Profile</a>';


           //end link

           $displayNav.=' </div>
  </div>
</li>';

           ?>



           <?php
       }


       echo $displayNav;




       ?>
       
       
       
       
       


<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>






</ul>
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Search -->
<!--          <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
              <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
              <div class="input-group-append">
                <button class="btn btn-primary" type="button">
                  <i class="fas fa-search fa-sm"></i>
                </button>
              </div>
            </div>
          </form>
-->

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="<?php echo $Root; ?>images/systemImage/imageNotFound.png" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="<?php echo $Root; ?>images/systemImage/imageNotFound.png" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="<?php echo $Root; ?>images/systemImage/imageNotFound.png" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                  
                    <?php
                     echo $ActiveNameNav;
                    ?>
                  
                </span>
                <img class="img-profile rounded-circle" src="<?php echo $Root; ?>images/systemImage/imageNotFound.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo $Root; ?>user/UserProfile.php?<?php
                echo $ActiveQueryUser;
                ?>">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="<?php echo $Root; ?>user/UserProfile.php?<?php
                echo $ActiveQueryUser;
                ?>">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="<?php echo $Root; ?>user/UserProfile.php?<?php
                echo $ActiveQueryUser;
                ?>">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo $Root; ?>user/logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->


  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  
  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

          <form action="logout.php" method="POST"> 
          
            <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>

          </form>


        </div>
      </div>
    </div>
  </div>