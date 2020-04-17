


<?php


include_once ("connect.php");
include_once ("findDistance.php");
function hallAll()
{
    $hallIds=SortDistance(33.6844,73.0479,"Pakistan");
    $currentdate = date("Y-m-d");
    $maxDate = date('Y-m-d', strtotime($currentdate . ' +1 day'));
    $display='';
    for($i=0;$i<count($hallIds);$i++)
    {
  $sql='SELECT  h.id,h.image,h.name,h.max_guests,p.id,pd.selectedDate,p.isFood,p.price,p.dayTime,p.package_name,h.hallType,h.noOfPartitions,h.ownParking from hall as h INNER join location as l 
on (h.location_id=l.id)
inner join packages as p 
on (h.id=p.hall_id)
INNER join packageDate as pd 
on (p.id=pd.package_id)
WHERE
(ISNULL(h.expire))AND(ISNULL(p.expire))AND(ISNULL(pd.expire))
AND (h.id='.$hallIds[$i][0].' )';
        //echo $sql;
        //AND (pd.selectedDate BETWEEN "'.$currentdate.'" AND "'.$maxDate.'")

        $display.=showHalls($sql,$hallIds[$i][3]);
    }
    return $display;
}


function HallUserDesire($currentdate,$perHead,$dayTime,$latitude,$longitude)
{
    $time=$dayTime;
    if($dayTime=="09:00:00")
        $dayTime="Morning";
    else  if($dayTime=="12:00:00")
        $dayTime="Afternoon";
    else
        $dayTime="Evening";

    $hallIds=SortDistance($latitude,$longitude,"Pakistan");


    $monthsArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

    $date=date_create($currentdate);
     $CurrentMonthNo=(int) date_format($date,'m')-1;

    $display='';
    for($i=0;$i<count($hallIds);$i++)
    {

        $sql = 'SELECT h.id,h.image,h.name,h.max_guests,hp.id,hp.month,hp.isFood,hp.price,hp.dayTime,hp.package_name,h.hallType,h.noOfPartitions,h.ownParking FROM hall as h INNER join hallprice as hp
ON
(h.id=hp.hall_id)
left join orderDetail as od on (h.id=od.hall_id) 
WHERE
(hp.price>0)AND
  (h.id='.$hallIds[$i][0].')AND(hp.isFood='.$perHead.')AND
 ((od.hall_id IS NULL) or ((od.status_hall="Cancel")AND
(od.destination_date="'.$currentdate.'" ) AND od.destination_time="'.$time.'")) AND (ISNULL(h.expire)) AND
((ISNULL(hp.expire)) AND (hp.month="' . $monthsArray[$CurrentMonthNo] . '")AND (hp.month="' . $monthsArray[$CurrentMonthNo] . '")AND (hp.dayTime="'.$dayTime.'")) limit 20
';
        $display.=showHalls($sql,$hallIds[$i][3]);
    }
    return $display;
}



function showHalls($sql,$Distance)
{
    $halltype=array("Marquee","Hall","Deera /Open area");
    $display = '';
    $AllHalls=queryReceive($sql);

    //star calculate
    $sql='SELECT AVG(c.rating) FROM comments as c WHERE c.hall_id='.$AllHalls[0][0].' ';
    $star=queryReceive($sql);
    for ($i=0;$i<count($AllHalls);$i++)
    {

        $MaxGuestMaxPartition=hallOrderExist($AllHalls[$i][8],$AllHalls[$i][0],$AllHalls[$i][5]);

        if($MaxGuestMaxPartition[0]<0)
        {
            exit();
        }
        if($MaxGuestMaxPartition[1]<0)
        {
            exit();
        }
      /*  $display.='

       <a href="company/hallBranches/hallclient.php?hallDetail='.base64url_encode($AllHalls[$i][0]).'&package='.base64url_encode($AllHalls[$i][4]).'&date='.$AllHalls[$i][5].'&time='.$AllHalls[$i][8].'&distance='.$Distance.' " class="card m-2 shadow col-12 col-sm-6 col-md-5 col-xl-3">
        </a>';*/

            $display.='<div class="block desireHall" data-href="company/hallBranches/hallclient.php?h='.base64url_encode($AllHalls[$i][0]).'&p='.base64url_encode($AllHalls[$i][4]).'">

    <div class="top">
        <ul>';





        $display.='
            <li><span class="converse">'.$AllHalls[$i][2].'</span></li>
            <li><a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i></a>'.$Distance.'Km</li>
        </ul>
    </div>
    <div class="middle">
        <img src="';
        if(file_exists('images/hall/'.$AllHalls[$i][1]) &&($AllHalls[$i][1]!=""))
        {
            $display.="images/hall/".$AllHalls[$i][1];
        }
        else
        {
            $display.='https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg';

        }
        $display.='" alt="pic" />
    </div>

    <div class="bottom">
        <div class="heading">'.$AllHalls[$i][9].'<span class="float-right">';

        $givestars=5;
        if(count($star)>0)
        {
            $givestars =(int) $star[0][0] ;
        }
        for($s=0;$s<5;$s++)
        {
            if($givestars>$s)
            {

                $display.='<span class="fa fa-star checked"></span>';
            }
            else
            {
                $display.='<span class="fa fa-star"></span>';
            }
        }
       $display.= '</span></div>
        <div class="info">Max Guests '.$MaxGuestMaxPartition[0].'</div>
        <div class="style">Date:'.$AllHalls[$i][5].' /Time:'.$AllHalls[$i][8].'  /Type:'.$halltype[$AllHalls[$i][10]].'</div>
        <div class="price">$'.$AllHalls[$i][7].' <span class="old-price">$'.((int)$AllHalls[$i][7]+5000).'</span></div>
    </div>

</div>';
    }




    return $display;
}










?>
