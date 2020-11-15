<?php


/*function hallOrderExist($hallid, $destination_date, $dayTime, $orderid)
{
    $sql='SELECT h.max_guests,h.noOfPartitions FROM hall as h WHERE h.id='.$hallid.'';
    $halldetal=queryReceive($sql);
    //hall max gues and max patition
    $MaxGuestMaxPartition=array();
    $MaxGuestMaxPartition["TotalGuest"]=$halldetal[0][0];
    $MaxGuestMaxPartition["TotalPatition"]=$halldetal[0][1];


    if($dayTime="Morning")
        $dayTime="09:00:00";
    else  if($dayTime="Afternoon")
        $dayTime="12:00:00";
    else
        $dayTime="18:00:00";

    if($orderid=="No")
    {
        $sql='SELECT sum(od.total_person),count(od.id) FROM orderDetail as od WHERE (od.destination_date="'.$destination_date.'")AND(od.status_hall="Running")
AND(od.hall_id='.$hallid.')AND(od.destination_time="'.$dayTime.'")';
    }
    else
    {
        $sql='SELECT sum(od.total_person),count(od.id) FROM orderDetail as od WHERE (od.destination_date="'.$destination_date.'")AND(od.status_hall="Running")
AND(od.hall_id='.$hallid.')AND(od.destination_time="'.$dayTime.'")AND(od.id!='.$orderid.')';
    }
    $resultRunning=queryReceive($sql);
    if(count($resultRunning)>0)
    {
        $MaxGuestMaxPartition["RemainingGuest"]=$MaxGuestMaxPartition["TotalGuest"]-$resultRunning[0][0];
        $MaxGuestMaxPartition["RemainingPatition"]=$MaxGuestMaxPartition["TotalPatition"]-$resultRunning[0][1];
    }

    return $MaxGuestMaxPartition;
}*/
?>