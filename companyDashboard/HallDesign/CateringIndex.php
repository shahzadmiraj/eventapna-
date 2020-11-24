
<div class="row">



    <?php

    $displayNav='';
    for($iCom=0;$iCom<count($cateringsCom);$iCom++)
    {

        $img= "";

        if((file_exists('../images/catering/'.$cateringsCom[$iCom][2]))&&($cateringsCom[$iCom][2]!=""))
        {
            $img= "../images/catering/".$cateringsCom[$iCom][2];
        }
        else
        {
            $img='../images/systemImage/imageNotFound.png';
        }



        $tokenCom=$cateringsCom[$iCom][3];
        $CateringEncordedCom=$cateringsCom[$iCom][0];
        $QueryCom='c='.$CateringEncordedCom.'&token='.$tokenCom;
        ?>


        <?php
        $displayNav.='
                  <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                 <img src="'.$img.'" class="card-img-top" style="width: 200px">
                    <h6 class="m-0 font-weight-bold text-primary">'.$cateringsCom[$iCom][1].'</h6>
                </div>
                <div class="card-body">
                 
                 
           ';

        //start link

        if (onlyAccessUsersWho("Owner,Employee"))
        {
            $displayNav.= '<a href="'.$Root.'customer/CustomerCreate.php?' . $QueryCom . '" class="btn btn-primary btn-icon-split"> <span class="icon text-white-50"><i class="fas fa-cart-plus"></i></span> <span class="text">Add Order</span></a><div class="my-2"></div>';
        }

        $displayNav.='<a href="'.$Root.'order/FindOrder.php?order_status=Today_Orders&' . $QueryCom . '" class="btn btn-outline-dark btn-icon-split"><span class="icon text-white-50">  <i class="fas fa-flag"></i></span> <span class="text">Next 24 Process Orders</span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Running&' . $QueryCom . '" class="btn btn-warning btn-icon-split"><span class="icon text-white-50"> <i class="fas fa-exclamation-triangle"></i></span> <span class="text">Process Order</span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Delivered&' . $QueryCom . '" class="btn  btn-info  btn-icon-split"><span class="icon text-white-50"><i class="fas fa-info-circle"></i></span><span class="text"> Delivered Orders</span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Clear&'.$QueryCom . '" class="btn btn-success btn-icon-split"><span class="icon text-white-50">  <i class="fas fa-check"></i></span> <span class="text">Clear Orders</span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Cancel&'.$QueryCom.'" class="btn btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-trash"></i></span> <span class="text">Cancel Orders</span></a><div class="my-2"></div>
                       <a  href="'.$Root.'company/cateringBranches/DisplauUser/Ordercalender/OrderCalender.php?'. $QueryCom . '" class="btn btn-light btn-icon-split"><span class="icon text-white-50"><i class="far fa-calendar-alt "></i></span> <span class="text">Calender Orders</span></a><div class="my-2"></div>
                       <a  href="'.$Root.'company/ClientSide/Catering/cateringClient.php?'.$QueryCom.'" class="btn btn-outline-primary btn-icon-split"><span class="icon text-white-50"><i class="fab fa-chrome "></i></span> <span class="text">Website</span></a><div class="my-2"></div>';
        if (onlyAccessUsersWho("Owner"))
        {
            $displayNav.='  <a href="'.$Root.'company/cateringBranches/infoCatering.php?' . $QueryCom . '" class="btn btn-outline-info btn-icon-split"><span class="icon text-white-50"><i class="fas fa-cogs "></i></span> <span class="text">Setting</span></a><div class="my-2"></div>';
        }
        $displayNav.='<a href="'.$Root.'company/cateringBranches/gallerycatering.php?' . $QueryCom . '" class="btn btn-outline-warning btn-icon-split"><span class="icon text-white-50"><i class="fas fa-images "></i></span> <span class="text">Gallery</span></a><div class="my-2"></div>';


        //end link

        $displayNav.='     </div>
              </div>

            </div>';

        ?>



        <?php
    }


    echo $displayNav;




    ?>



</div>