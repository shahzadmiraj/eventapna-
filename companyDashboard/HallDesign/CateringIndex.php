<?php

$ValueOfCateringNext24Process=array();
$ValueOfCateringProcess=array();
$ValueOfCateringDelivered=array();
$ValueOfCateringClear=array();
$ValueOfCateringCancel=array();
$ValueOfCateringDraft=array();
$ValueOfCateringTodayFunctionBooked=array();
$ValueOfCateringNames=array();
$ValueOfCateringTodayEarning=array();
?>




<div class="row">



    <?php

    $displayNav='';
    for($iCom=0;$iCom<count($cateringsCom);$iCom++)
    {

        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.catering_id='.$cateringsCom[$iCom][0].')AND(od.status_catering="Running")AND(od.destination_date="'.$CurrentDate.'")';
        $ValueOfCateringProcess[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.catering_id='.$cateringsCom[$iCom][0].')AND(od.status_catering="Running")AND(od.destination_date BETWEEN "'.$CurrentDate.'" AND "'.$NextDate.'" )';
        $ValueOfCateringNext24Process[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.catering_id='.$cateringsCom[$iCom][0].')AND(od.status_catering="Delivered")AND(od.destination_date="'.$CurrentDate.'")';
        $ValueOfCateringDelivered[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.catering_id='.$cateringsCom[$iCom][0].')AND(od.status_catering="Clear")AND(od.destination_date="'.$CurrentDate.'")';
        $ValueOfCateringClear[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.catering_id='.$cateringsCom[$iCom][0].')AND(od.status_catering="Cancel")AND(od.destination_date="'.$CurrentDate.'")';
        $ValueOfCateringCancel[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.catering_id='.$cateringsCom[$iCom][0].')AND(od.status_catering="Draft")AND(od.destination_date="'.$CurrentDate.'")';
        $ValueOfCateringDraft[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.catering_id='.$cateringsCom[$iCom][0].')AND(od.status_catering="Running")AND( date(od.booking_date)="'.$CurrentDate.'")';
        $ValueOfCateringTodayFunctionBooked[$iCom]=queryReceive($sql)[0][0];

        $sql='SELECT sum(od.total_amount- od.discount + od.extracharges) FROM orderDetail as od WHERE (od.catering_id='.$cateringsCom[$iCom][0].')AND(od.status_catering="Running")AND( date(od.booking_date)="'.$CurrentDate.'") AND(ISNULL(od.hall_id))';
        $ValueOfCateringTodayEarning[$iCom]=queryReceive($sql)[0][0];

        $ValueOfCateringNames[$iCom]=$cateringsCom[$iCom][1];


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
            $displayNav.= '<a href="'.$Root.'customer/CustomerCreate.php?' . $QueryCom . '" class="btn btn-primary btn-icon-split"> <span class="icon text-white-50"><i class="fas fa-cart-plus"></i></span> <span class="text">Add Order <button class="btn btn-circle border  border-warning  btn-light"> '.$ValueOfCateringTodayFunctionBooked[$iCom].'</button> </span></a><div class="my-2"></div>';
        }

        $displayNav.='<a href="'.$Root.'order/FindOrder.php?order_status=Today_Orders&' . $QueryCom . '" class="btn btn-outline-dark btn-icon-split"><span class="icon text-white-50">  <i class="fas fa-flag"></i></span> <span class="text">Next 24 Process Orders   <button class="btn btn-circle border  border-warning  btn-light"> '.$ValueOfCateringNext24Process[$iCom].'</button></span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Running&' . $QueryCom . '" class="btn btn-warning btn-icon-split"><span class="icon text-white-50"> <i class="fas fa-exclamation-triangle"></i></span> <span class="text">Process Order <button class="btn btn-circle border  border-warning  btn-light"> '.$ValueOfCateringProcess[$iCom].'</button></span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Delivered&' . $QueryCom . '" class="btn  btn-info  btn-icon-split"><span class="icon text-white-50"><i class="fas fa-info-circle"></i></span><span class="text"> Delivered Orders <button class="btn btn-circle border  border-warning  btn-light"> '.$ValueOfCateringDelivered[$iCom].'</button></span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Clear&'.$QueryCom . '" class="btn btn-success btn-icon-split"><span class="icon text-white-50">  <i class="fas fa-check"></i></span> <span class="text">Clear Orders <button class="btn btn-circle border  border-warning  btn-light"> '.$ValueOfCateringClear[$iCom].'</button></span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Cancel&'.$QueryCom.'" class="btn btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-trash"></i></span> <span class="text">Cancel Orders <button class="btn btn-circle border  border-warning  btn-light"> '.$ValueOfCateringCancel[$iCom].'</button></span></a><div class="my-2"></div>
                              <a href="'.$Root.'order/FindOrder.php?order_status=Draft&'.$QueryCom.'" class="btn btn-outline-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-clock"></i></span> <span class="text">Draft Orders <button class="btn btn-circle border  border-warning  btn-light"> '.$ValueOfCateringDraft[$iCom].'</button></span></a><div class="my-2"></div>
                       
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