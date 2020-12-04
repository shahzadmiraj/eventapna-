
<?php
$CurrentDateTime = date('Y-m-d H:i:s');
$CurrentDate = date('Y-m-d', strtotime($CurrentDateTime)); // d.m.YYYY


$NextDateTime = date('Y-m-d H:i:s', strtotime($CurrentDateTime . ' +1 day'));
$NextDate = date('Y-m-d', strtotime($NextDateTime)); // d.m.YYYY

$ValueOfHallNext24Process=array();
$ValueOfHallProcess=array();
$ValueOfHallDelivered=array();
$ValueOfHallClear=array();
$ValueOfHallCancel=array();
$ValueOfHallDraft=array();
$ValueOfHallTodayFunctionBooked=array();
$ValueOfHallNames=array();
$ValueOfHallTodayEarning=array();


?>

<div class="row">



    <?php

    $displayNav='';


    for($iCom=0;$iCom<count($hallsCom);$iCom++)
    {


        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.hall_id='.$hallsCom[$iCom][0].')AND(od.status_hall="Running")AND(od.destination_date="'.$CurrentDate.'")';
        $ValueOfHallProcess[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.hall_id='.$hallsCom[$iCom][0].')AND(od.status_hall="Running")AND(od.destination_date BETWEEN "'.$CurrentDate.'" AND "'.$NextDate.'" )';
        $ValueOfHallNext24Process[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.hall_id='.$hallsCom[$iCom][0].')AND(od.status_hall="Delivered")AND(od.destination_date="'.$CurrentDate.'")';
        $ValueOfHallDelivered[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.hall_id='.$hallsCom[$iCom][0].')AND(od.status_hall="Clear")AND(od.destination_date="'.$CurrentDate.'")';
        $ValueOfHallClear[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.hall_id='.$hallsCom[$iCom][0].')AND(od.status_hall="Cancel")AND(od.destination_date="'.$CurrentDate.'")';
        $ValueOfHallCancel[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.hall_id='.$hallsCom[$iCom][0].')AND(od.status_hall="Draft")AND(od.destination_date="'.$CurrentDate.'")';
        $ValueOfHallDraft[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT COUNT(id) FROM orderDetail as od WHERE (od.hall_id='.$hallsCom[$iCom][0].')AND(od.status_hall="Running")AND( date(od.booking_date)="'.$CurrentDate.'")';
        $ValueOfHallTodayFunctionBooked[$iCom]=queryReceive($sql)[0][0];
        $sql='SELECT sum(od.total_amount- od.discount + od.extracharges) FROM orderDetail as od WHERE (od.hall_id='.$hallsCom[$iCom][0].')AND(od.status_hall="Running")AND( date(od.booking_date)="'.$CurrentDate.'")';
        $ValueOfHallTodayEarning[$iCom]=queryReceive($sql)[0][0];

        $ValueOfHallNames[$iCom]=$hallsCom[$iCom][1];

        $img= "";

        if((file_exists('../images/hall/'.$hallsCom[$iCom][2]))&&($hallsCom[$iCom][2]!=""))
        {
            $img= "../images/hall/".$hallsCom[$iCom][2];
        }
        else
        {
            $img='../images/systemImage/imageNotFound.png';
        }


        $tokenCom=$hallsCom[$iCom][3];
        $hallEncordedCom=$hallsCom[$iCom][0];
        $QueryCom='h='.$hallEncordedCom.'&token='.$tokenCom;
        ?>


        <?php
        $displayNav.='
                  <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                 <img src="'.$img.'" class="card-img-top" style="width: 200px">
                    <h6 class="m-0 font-weight-bold text-primary">'.$hallsCom[$iCom][1].'</h6>
                </div>
                <div class="card-body">
                 
                 
           ';

        //start link

        if (onlyAccessUsersWho("Owner,Employee"))
        {
            $displayNav.= '<a href="'.$Root.'customer/CustomerCreate.php?' . $QueryCom . '" class="btn btn-primary btn-icon-split"> <span class="icon text-white-50"><i class="fas fa-cart-plus"></i></span> <span class="text">Add Order</span></a><div class="my-2"></div>';
        }

        $displayNav.='<a href="'.$Root.'order/FindOrder.php?order_status=Today_Orders&' . $QueryCom . '" class="btn btn-outline-dark btn-icon-split"><span class="icon text-white-50">  <i class="fas fa-flag"></i></span> <span class="text">Next 24 Process Orders <button class="btn btn-circle border  border-warning  btn-light"> '.$ValueOfHallNext24Process[$iCom].'</button> </span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Running&' . $QueryCom . '" class="btn btn-warning btn-icon-split"><span class="icon text-white-50"> <i class="fas fa-exclamation-triangle"></i></span> <span class="text">Process Order <button class="btn btn-circle border  border-warning   btn-light"> '.$ValueOfHallProcess[$iCom].'</button></span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Delivered&' . $QueryCom . '" class="btn  btn-info  btn-icon-split"><span class="icon text-white-50"><i class="fas fa-info-circle"></i></span><span class="text"> Delivered Orders <button class="btn btn-circle border  border-warning   btn-light"> '.$ValueOfHallDelivered[$iCom].'</button></span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Clear&'.$QueryCom . '" class="btn btn-success btn-icon-split"><span class="icon text-white-50">  <i class="fas fa-check"></i></span> <span class="text">Clear Orders <button class="btn btn-circle border  border-warning   btn-light"> '.$ValueOfHallClear[$iCom].'</button></span></a><div class="my-2"></div>
                       <a href="'.$Root.'order/FindOrder.php?order_status=Cancel&'.$QueryCom.'" class="btn btn-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-trash"></i></span> <span class="text">Cancel Orders <button class="btn btn-circle border  border-warning   btn-light"> '.$ValueOfHallCancel[$iCom].'</button></span></a><div class="my-2"></div>
                             
                              <a href="'.$Root.'order/FindOrder.php?order_status=Draft&'.$QueryCom.'" class="btn btn-outline-danger btn-icon-split"><span class="icon text-white-50"><i class="fas fa-clock"></i></span> <span class="text">Draft Orders <button class="btn btn-circle border  border-warning   btn-light"> '.$ValueOfHallDraft[$iCom].'</button></span></a><div class="my-2"></div>
                       
                       <a  href="'.$Root.'company/hallBranches/userDisplay/OrderCalender/OrderCalender.php?'. $QueryCom . '" class="btn btn-light btn-icon-split"><span class="icon text-white-50"><i class="far fa-calendar-alt "></i></span> <span class="text">Calender Orders</span></a><div class="my-2"></div>
                       <a  href="'.$Root.'company/ClientSide/Hall/HallClient.php?'.$QueryCom.'" class="btn btn-outline-primary btn-icon-split"><span class="icon text-white-50"><i class="fab fa-chrome "></i></span> <span class="text">Hall Website</span></a><div class="my-2"></div>';
        if (onlyAccessUsersWho("Owner"))
        {
            $displayNav.='  <a href="'.$Root.'company/hallBranches/hallInfo.php?' . $QueryCom . '" class="btn btn-outline-info btn-icon-split"><span class="icon text-white-50"><i class="fas fa-cogs "></i></span> <span class="text">Setting</span></a><div class="my-2"></div>';
        }
        $displayNav.='<a href="'.$Root.'company/hallBranches/galleryhall.php?' . $QueryCom . '" class="btn btn-outline-warning btn-icon-split"><span class="icon text-white-50"><i class="fas fa-images "></i></span> <span class="text">Gallery</span></a><div class="my-2"></div>';


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