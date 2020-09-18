<?php
function distance($lat1, $lon1, $lat2, $lon2, $unit)
{
    if (($lat1 == $lat2) && ($lon1 == $lon2)) {
        return 0;
    }
    else {
        // echo $lat1.",".$lon1.",".$lat2.",".$lon2;
        $theta = $lon1 - $lon2;
        $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $miles = $dist * 60 * 1.1515;
        $unit = strtoupper($unit);

        if ($unit == "K") {
            return ($miles * 1.609344);
        } else if ($unit == "N") {
            return ($miles * 0.8684);
        } else {
            return $miles;
        }
    }
}

function SortDistanceHalls($lat,$lon,$country,$hallname)
{
/*    $sql='SELECT c.id,cl.latitude,cl.longitude,cl.radius,c.name FROM catering as c INNER join cateringLocation as cl
on (c.id=cl.catering_id)
WHERE
(ISNULL(c.expire))AND(ISNULL(cl.expire))AND(cl.country="'.$country.'")AND(c.name like "%'.(trim($hallname)).'%")';*/

$sql='SELECT h.id,l.latitude,l.longitude FROM hall as h INNER join location as l 
on (h.location_id=l.id) inner  join company as c 
on (c.id=h.company_id)
WHERE
(l.country="'.$country.'")AND (ISNULL(h.expire))AND (ISNULL(l.expire))AND (h.name like "%'.trim($hallname).'%")AND (c.name!="demo") ';
    $data=queryReceive($sql);
    $placeid=array();
    $distance=array();
    for($i=0;$i<count($data);$i++)
    {
        $placeid[$i]=$data[$i][0];
        $distance[$i]= distance($data[$i][1], $data[$i][2], $lat, $lon, "K");
        $distance[$i]=round($distance[$i], 2);
        $data[$i][3]=$distance[$i];
    }
    array_multisort($distance, SORT_ASC, $placeid, SORT_ASC, $data);
    return $data;
}


function ShowAllHallPackages($latitude,$longitude,$country,$hallname,$daytime,$date,$perhead)
{
    $halldetail=SortDistanceHalls($latitude,$longitude,$country,$hallname);

    $display='';
    for($i=0;$i<count($halldetail);$i++)
    {
            $display .= showCateringsdishesSeperate($halldetail[$i][0],$halldetail[$i][3],$daytime,$date,$perhead);
    }
    return $display;
}

function hallOrderExist($dayTime,$hallid,$destination_date)
{
    //hall max gues and max patition
    $MaxGuestMaxPartition=array();
    $sql='SELECT h.max_guests,h.noOfPartitions FROM hall as h WHERE h.id='.$hallid.'';
    $halldetal=queryReceive($sql);
  //  print_r($halldetal);

    $MaxGuestMaxPartition[0]=$halldetal[0][0];
    $MaxGuestMaxPartition[1]=$halldetal[0][1];
    $MaxGuestMaxPartition[2]=$halldetal[0][0];
    $MaxGuestMaxPartition[3]=$halldetal[0][1];
    if($dayTime="Morning")
        $dayTime="09:00:00";
    else  if($dayTime="Afternoon")
        $dayTime="12:00:00";
    else if($dayTime="Evening")
        $dayTime="18:00:00";
//hall max gues and max patition
    $maxGuest=(int)$MaxGuestMaxPartition[0];
    $Currentpatition=(int)$MaxGuestMaxPartition[1];

    //Running current  order book total person,count of order
    $sql='SELECT sum(od.total_person),count(od.id) FROM orderDetail as od WHERE (od.destination_date="'.$destination_date.'")AND(od.status_hall="Running")
AND(od.hall_id='.$hallid.')AND(od.destination_time="'.$dayTime.'")';
    $resultRunning=queryReceive($sql);


    //if booked order
    if(count($resultRunning)>0)
    {
        $maxGuest = $maxGuest -$resultRunning[0][0];
        $Currentpatition=$Currentpatition-$resultRunning[0][1];

    }

    $MaxGuestMaxPartition[0]=$maxGuest;
   $MaxGuestMaxPartition[1]=$Currentpatition;
    return $MaxGuestMaxPartition;
}


function showCateringsdishesSeperate($hallid,$CurrentDistance,$daytime,$date,$perhead)
{
/*
    $daytime= "Morning";
    $date="2020-04-30";
    $perhead=0;*/
    $maxDate = date('Y-m-d', strtotime($date . ' +20 day'));
    $halltype=array("Marquee","Hall","Deera /Open area");
    $sql='SELECT  h.id,h.image,h.name,h.max_guests,p.id,pd.selectedDate,p.isFood,p.price,p.dayTime,p.package_name,h.hallType,h.noOfPartitions,h.ownParking,pd.id,pd.token from hall as h INNER join location as l 
on (h.location_id=l.id)
inner  join packageControl as pc 
on (pc.hall_id=h.id)
inner join packages as p 
on (pc.package_id=p.id)
INNER join packageDate as pd 
on (p.id=pd.package_id)
WHERE
(ISNULL(h.expire))AND(ISNULL(p.expire))AND(ISNULL(pd.expire))
AND (h.id='.$hallid.' )
AND(p.dayTime ="'.trim($daytime).'")AND(pd.selectedDate >= CAST("'.$date.'" AS DATE ))  AND(pd.selectedDate <= CAST("'.$maxDate.'" AS DATE ))AND(p.isFood='.$perhead.')
';

    $display = '';
    $AllHalls=queryReceive($sql);

    //print_r($sql);


    for ($i=0;$i<count($AllHalls);$i++)
    {
        //star calculate
        $sql='SELECT AVG(c.rating) FROM comments as c WHERE (c.hall_id='.$AllHalls[$i][0].')AND(c.PackOrDishId='.$AllHalls[$i][6].') ';
        $star=queryReceive($sql);

        $MaxGuestMaxPartition=hallOrderExist($AllHalls[$i][5], $AllHalls[$i][0], $AllHalls[$i][8]);

        if($MaxGuestMaxPartition[0]<=0)
        {
            exit();
        }
        if($MaxGuestMaxPartition[1]<=0)
        {
            exit();
        }
        /*  $display.='

         <a href="company/hallBranches/hallclient.php?hallDetail='.base64url_encode($AllHalls[$i][0]).'&package='.base64url_encode($AllHalls[$i][4]).'&date='.$AllHalls[$i][5].'&time='.$AllHalls[$i][8].'&distance='.$Distance.' " class="card m-2 shadow col-12 col-sm-6 col-md-5 col-xl-3">
          </a>';*/

        $display.='<div class="block">

    <div class="top">
        <ul>';





        $display.='
            <li><a href="#"><i class="fas fa-street-view"></i></a>'.$CurrentDistance.'Km</li>
            <li></li>
        </ul>
    </div>
    <div class="middle">
        <img src="';
        if(file_exists('../../../images/hall/'.$AllHalls[$i][1]) &&($AllHalls[$i][1]!=""))
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
        if(count($star)>3)
        {
            $givestars =(int) $star[$i][0] ;
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
        <div class="style">Date:'.$AllHalls[$i][5].' /Time:'.$AllHalls[$i][8].'  /Type:'.$halltype[$AllHalls[$i][10]].' /Hall Name :'.$AllHalls[$i][2].'</div>
        <div class="price font-weight-bold"> <i class="far fa-money-bill-alt"></i> :'.$AllHalls[$i][7].' <span class="old-price">'.((int)$AllHalls[$i][7]+5000).'</span></div>
        <div class="style"><a href="company/ClientSide/Hall/ClientHallPackage.php?pdid='.$AllHalls[$i][13].'&pdtoken='.$AllHalls[$i][14].'" class="btn btn-primary">Visit And Booking >></a></div>
    </div>

</div>';
    }




    return $display;





}

function HallSearching($latitude,$longitude,$country,$hallname,$daytime,$date,$perhead)
{
    //$hallname=$_POST['hallname'];
    //$daytime=$_POST['daytime'];
    //$date=$_POST['date'];
   // $perhead=$_POST['perhead'];
   // $latitude=$_POST['latitude'];
    //$longitude=$_POST['longitude'];
    //$city=$_POST['city'];
    //$country=$_POST['country'];


    $result=ShowAllHallPackages($latitude,$longitude,$country,$hallname,$daytime,$date,$perhead);
    if($result=="")
    {
        echo '<h1 class="btn-danger m-5 ">Not Found</h1>';
    }
    else
    {
        echo $result;
    }
}


