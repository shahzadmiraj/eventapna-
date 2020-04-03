<?php
include_once ("../../connection/connect.php");

$data = array();

$sql='SELECT p.id,p.isFood,package_name,pd.selectedDate,p.dayTime,pd.id FROM packages as p INNER JOIN packageDate as pd
on p.id=pd.package_id
WHERE
(ISNULL(p.expire))AND (ISNULL(pd.expire))

';
$ViewPackages=queryReceive($sql);



for ($i=0;$i<count($ViewPackages);$i++)
{
    $packagename='Seating';
    if($ViewPackages[$i][3]==1)
        $packagename=$ViewPackages[$i][2];
    $StartDaytime='';
        $EndDaytime="";
        if($ViewPackages[$i][3]=="Morning")
        {

            $StartDaytime="9H";
            $EndDaytime="12H";
        }
        else if($ViewPackages[$i][3]=="Afternoon")
        {
            $StartDaytime="12H";
            $EndDaytime="18H";
        }
        else
        {

            $StartDaytime="18H";
            $EndDaytime="20H";
        }

    $date = new DateTime($ViewPackages[$i][3]);
    $date->add(new DateInterval('PT'.$StartDaytime));
     $start=date_format($date,"Y-m-d H:i:s");

    $new = new DateTime($ViewPackages[$i][3]);
    $new->add(new DateInterval('PT'.$EndDaytime));
    $end=date_format($new,"Y-m-d H:i:s");

    $data[] = array(
        'id'   => $ViewPackages[$i][0],
        'title'   => '# '.$ViewPackages[$i][5]." ".$packagename,
        'start'   => $start,
        'end'   => $end
    );
}

echo json_encode($data);

?>