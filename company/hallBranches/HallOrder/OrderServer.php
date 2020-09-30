<?php
include_once ('../../../connection/connect.php');

function ShowSubmitButton($isShowButton)
{
    if($isShowButton)
    {
        return '<input hidden type="text" id="packageAvalable" value="Yes">';
    }

    return '<input hidden type="text" id="packageAvalable" value="No">';
}


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

 if($_POST['option']=="checkpackages1")
{
    $orderid="No";
    if(isset($_POST['orderid']))
    {
        $orderid=$_POST['orderid'];
    }
    $guests=$_POST['guests'];
    $date=$_POST['date'];
    $time=$_POST['time'];
    $perheadwith=$_POST['perheadwith'];
    $hallid=$_POST['hallid'];
    $isShowButton=true;


    $sql='SELECT distinct p.id,p.package_name,p.price,p.describe,p.isFood,p.MinimumGuest,pd.id,pd.selectedDate FROM packages as p INNER join 	packageDate as pd
on (p.id=pd.package_id) inner join packageControl as pc 
on (pc.package_id=p.id)
WHERE 
(ISNULL(p.expire))AND(ISNULL(pd.expire))
AND(p.dayTime="'.$time.'")AND(pd.selectedDate="'.$date.'")AND(p.isFood='.$perheadwith.')AND(pc.hall_id='.$hallid.')AND(ISNULL(pc.expire))
';
    $detailpackage=queryReceive($sql);

    $display='<h3 align="center">Packages Detail </h3>';
    for ($i=0;$i<count($detailpackage);$i++)
    {
        $display.='<div class="checkclasshas custom-control custom-radio form-group  ">
                <input type="radio" data-describe="'.$detailpackage[$i][0].'" value="'.$detailpackage[$i][6].'" class="changeradio custom-control-input" id="defaultUnchecked'.$i.'" name="defaultExampleRadios">
                <label class="custom-control-label" for="defaultUnchecked'.$i.'">'.$detailpackage[$i][1].'  package with price='.$detailpackage[$i][2].'and Minimum Guest must be ='.$detailpackage[$i][5].'</label>
                    </div>
                <input hidden id="selectpricefix'.$detailpackage[$i][6].'" type="number" value="'.$detailpackage[$i][2].'">
                <input hidden id="describe'.$detailpackage[$i][6].'" type="text" value="'.$detailpackage[$i][3].'">';
    }


    $MaxGuestMaxPartition=hallOrderExist($hallid, $date, $time, $orderid);


    if($time=="Morning")
    {
        $time="09:00:00";
    }
    else if($time=="Afternoon")
    {

        $time="12:00:00";
    }
    else
    {
        $time="18:00:00";
    }

    if($orderid=="No")
    {

        $sql='SELECT od.id,od.total_person FROM orderDetail as od WHERE (od.destination_date= "'.$date.'") AND (od.destination_time="'.$time.'") AND (od.status_hall="Running") AND (od.hall_id='.$hallid.')';
    }
    else
    {

        $sql='SELECT od.id,od.total_person FROM orderDetail as od WHERE (od.destination_date= "'.$date.'") AND (od.destination_time="'.$time.'") AND (od.status_hall="Running") AND (od.hall_id='.$hallid.')AND(od.id!='.$orderid.')';
    }
    $detailhalls=queryReceive($sql);
    if(count($detailhalls)>0)
    {
        $display.='<h4 class="btn btn-danger">Already '.count($detailhalls).' function has booked</h4>';
        for ($i=0;$i<count($detailhalls);$i++)
        {
            $display.='<p>'.($i+1).' function booked with '.$detailhalls[$i][1].' Guests</p>';
        }
    }

    if($MaxGuestMaxPartition["RemainingGuest"]<=$guests)
    {
        $display.='<p class="btn-danger col-12">Note:- Hall Total Arrangement : '.$MaxGuestMaxPartition["TotalGuest"].' / Remaining Arrangement : '.$MaxGuestMaxPartition["RemainingGuest"].' Now you are booking arrangement  of  '.$guests.' guest So Over Arrangement is not allow...   </p>';
        $isShowButton=false;
    }
    if($MaxGuestMaxPartition["RemainingPatition"]<=0)
    {
        $display.='<p class="btn-danger col-12">Hall Total Function Arrangement  : '.$MaxGuestMaxPartition["TotalPatition"].' / Remainning Fuction arrangement : '.$MaxGuestMaxPartition["RemainingPatition"].'  ,So Over Patition is not allow...   </p>';
        $isShowButton=false;
    }
    if(count($detailpackage)==0)
    {
        $display.='<p class="btn-danger col-12"> Not Fount Any Package </p>';
        $isShowButton=false;
    }

    $display.=ShowSubmitButton($isShowButton);
    echo $display;


}