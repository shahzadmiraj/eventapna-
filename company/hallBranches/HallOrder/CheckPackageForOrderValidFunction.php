<?php
include_once('findHallOrderFunction.php');
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