


<?php


include_once ("connect.php");
include_once ("findDistance.php");
function hallAll()
{

    $hallIds=SortDistance(33.6844,73.0479,"Pakistan");


    $monthsArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $currentdate=date("Y/m/d");
    $maxDate = new DateTime('now');
    $maxDate->modify('+1 month'); // or you can use '-90 day' for deduct

    $NextMonthNo=$maxDate->format('m');
    $NextMonthNo=$NextMonthNo-1;
    $maxDate = $maxDate->format('Y-m-d');
    $CurrentMonthNo=date('m');
    $CurrentMonthNo=$CurrentMonthNo-1;

    $display='';
    for($i=0;$i<count($hallIds);$i++)
    {

        $sql = 'SELECT h.id,h.image,h.name,h.max_guests,hp.id,hp.month,hp.isFood,hp.price,hp.dayTime,hp.package_name,h.hallType FROM hall as h INNER join hallprice as hp
ON
(h.id=hp.hall_id)
left join orderDetail as od on (h.id=od.hall_id) 


WHERE
  (h.id='.$hallIds[$i][0].')AND
 ((od.hall_id IS NULL) or ((od.status_hall="Cancel")AND
(od.destination_date between "' . $currentdate . '" AND "' . $maxDate . '" ))) AND (ISNULL(h.expire)) AND
((ISNULL(hp.expire)) AND ((hp.month="' . $monthsArray[$CurrentMonthNo] . '")or (hp.month="' . $monthsArray[$NextMonthNo] . '"))) limit 20
';
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

        $sql = 'SELECT h.id,h.image,h.name,h.max_guests,hp.id,hp.month,hp.isFood,hp.price,hp.dayTime,hp.package_name,h.hallType FROM hall as h INNER join hallprice as hp
ON
(h.id=hp.hall_id)
left join orderDetail as od on (h.id=od.hall_id) 


WHERE
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
    for ($i=0;$i<count($AllHalls);$i++)
    {

        $display.='
        
       <a href="company/hallBranches/hallclient.php?hallid='.$AllHalls[$i][0].'&packageid='.$AllHalls[$i][4].'&date='.$AllHalls[$i][5].'&time='.$AllHalls[$i][8].'&distance='.$Distance.' " class="card-header transparencyjumbo col-sm-11 col-md-6 col-xl-4">

            <!-- Card image -->
            <div class="view overlay">
                <div class="container pictures">
                    <img src="';
        if(file_exists('images/hall/'.$AllHalls[$i][1]) &&($AllHalls[$i][1]!=""))
        {
            $display.="images/hall/".$AllHalls[$i][1];
        }
        else
        {
            $display.='https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg';

        }
        $display.='" alt="Snow" style="width:100%;height: 100%">
                    <h5 class="top-right text-white font-weight-bold"> ';

        $display.=$Distance;

        $display.='   Km</h5>
                </div>
            </div>

            <!-- Card content -->
            <div class="card-body">

                <!-- Title -->
                <h4 class="card-title font-weight-bold text-center"> '.$AllHalls[$i][2].'</h4>
                <!-- Data -->

                
                <h3 class="text-right"><i class="far fa-money-bill-alt"></i><span class="font-weight-bold"> RS:<i class="text-warning"> '.$AllHalls[$i][7].' </i></span></h3>
                <h4><i class="fas fa-clock"></i> Time <span class="text-warning">'.$AllHalls[$i][8].'</span> </h4>
                <h4><i class="far fa-calendar-alt"></i> Month <span class="text-warning">'.$AllHalls[$i][5].'</span></h4>
                <h4><i class="fas fa-users"></i> Max Guests  <span class="text-warning">'.$AllHalls[$i][3].'</span></h4>
                <h4><i class="fab fa-accusoft"></i> Hall Type: <span class="text-warning">'.$halltype[$AllHalls[$i][10]].'</span></h4>';
        if( $AllHalls[$i][6]==0)
        {
            $display.='
                <h4><i class="material-icons">airline_seat_recline_normal</i> <span class="text-warning">with Seating</span></h4>';
        }
        else
        {
            $display.='
                <h4><i class="material-icons">fastfood</i> package name  <span class="text-warning">'.$AllHalls[$i][9].'</span></h4>';
        }


        $display.='</div>

        </a>';
    }




    return $display;
}
?>
