<?php
//include_once('findHallOrderFunction.php');

function hallOrderExist($hallid, $destination_date, $dayTime, $orderid)
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
}
function IsAvailableOrderAgainCheck($orderid,$guests,$date,$time,$perheadwith,$hallid)
{
    $sql='SELECT distinct p.id,p.package_name,p.price,p.describe,p.isFood,p.MinimumGuest,pd.id,pd.selectedDate FROM packages as p INNER join 	packageDate as pd
on (p.id=pd.package_id) inner join packageControl as pc 
on (pc.package_id=p.id)
WHERE 
(ISNULL(p.expire))AND(ISNULL(pd.expire))
AND(p.dayTime="'.$time.'")AND(pd.selectedDate="'.$date.'")AND(p.isFood='.$perheadwith.')AND(pc.hall_id='.$hallid.')AND(ISNULL(pc.expire))
';
    $detailpackage=queryReceive($sql);

    $MaxGuestMaxPartition=hallOrderExist($hallid, $date, $time, $orderid);

    if($MaxGuestMaxPartition["RemainingGuest"]<=$guests)
    {
        return false;
    }
    if($MaxGuestMaxPartition["RemainingPatition"]<=0)
    {
        return false;
    }
    if(count($detailpackage)==0)
    {
        return false;
    }

    return  true;


}
?>