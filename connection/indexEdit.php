


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
(hp.price>0)AND
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
    for ($i=0;$i<count($AllHalls);$i++)
    {

        $display.='
        
       <a href="company/hallBranches/hallclient.php?hallDetail='.base64url_encode($AllHalls[$i][0]).'&package='.base64url_encode($AllHalls[$i][4]).'&date='.$AllHalls[$i][5].'&time='.$AllHalls[$i][8].'&distance='.$Distance.' " class="card m-2 shadow col-12 col-sm-6 col-md-5 col-xl-3">

            <!-- Card image -->
            <div class="view overlay card-img">
                <div class="container pictures">
                    <img class="img-fluid" src="';
        if(file_exists('images/hall/'.$AllHalls[$i][1]) &&($AllHalls[$i][1]!=""))
        {
            $display.="images/hall/".$AllHalls[$i][1];
        }
        else
        {
            $display.='https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg';

        }
        $display.='" alt="Snow" style="width:100%;height: 50vh;">
                    <h5 class="top-right btn-secondary font-weight-bold"> ';

        $display.=$Distance;

        $display.='   Km</h5>
                </div>
            </div>

            <!-- Card content -->
            <div class="card-header">

                <!-- Title -->
                <h4 class="card-title font-weight-bold text-center "> '.$AllHalls[$i][2].'</h4>
                <!-- Data -->

                
                <h3 class="text-right text-danger "><i class="far fa-money-bill-alt"></i><span class="font-weight-bold"> RS:'.$AllHalls[$i][7].' </span></h3>
                <h5><i class="fas fa-clock"></i> Time <span class="text-warning">'.$AllHalls[$i][8].'</span> </h5>
                <h5><i class="far fa-calendar-alt"></i> Month <span class="text-warning">'.$AllHalls[$i][5].'</span></h5>
                <h5><i class="fas fa-users"></i> Max Guests  <span class="text-warning">'.$AllHalls[$i][3].'</span></h5>
                <h5><i class="fab fa-accusoft"></i> Hall Type: <span class="text-warning">'.$halltype[$AllHalls[$i][10]].'</span></h5>';
        if( $AllHalls[$i][6]==0)
        {
            $display.='
                <h6><i class="material-icons">airline_seat_recline_normal</i> <span class="text-warning">with Seating</span></h6>';
        }
        else
        {
            $display.='
                <h6><i class="material-icons">fastfood</i> package name  <span class="text-warning">'.$AllHalls[$i][9].'</span></h6>';
        }


        $display.='</div>

        </a>';
    }




    return $display;
}
?>
