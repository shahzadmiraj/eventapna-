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

function SortDistanceCatering($lat,$lon,$country,$cateringNamePredict)
{
    // $sql="SELECT h.id,l.latitude,l.longitude FROM hall as h INNER join location as l on (h.location_id=l.id) WHERE (ISNULL(h.expire))AND(ISNULL(l.expire))";
    $sql='SELECT c.id,cl.latitude,cl.longitude,cl.radius,c.name FROM catering as c INNER join cateringLocation as cl 
on (c.id=cl.catering_id)
WHERE 
(ISNULL(c.expire))AND(ISNULL(cl.expire))AND(cl.country="'.$country.'")AND(c.name like "%'.(trim($cateringNamePredict)).'%")';
    $data=queryReceive($sql);
    $placeid=array();
    $distance=array();
    for($i=0;$i<count($data);$i++)
    {
        $placeid[$i]=$data[$i][0];
        $distance[$i]= distance($data[$i][1], $data[$i][2], $lat, $lon, "K");
        $distance[$i]=round($distance[$i], 2);
        $data[$i][5]=$distance[$i];
    }

    array_multisort($distance, SORT_ASC, $placeid, SORT_ASC, $data);
    return $data;
}


function ShowAllCateringDishes($latitude,$longitude,$country,$cateringNamePredict,$DishNamePredict)
{
    $catring=SortDistanceCatering($latitude,$longitude,$country,$cateringNamePredict);
    $display='';
    for($i=0;$i<count($catring);$i++)
    {
        if($catring[$i][3]>=$catring[$i][5])
        {

            $display .= showCateringsdishesSeperate($catring[$i][0], $catring[$i][3], $catring[$i][4], $catring[$i][5],$DishNamePredict);
        }
    }
    return $display;
}
function showCateringsdishesSeperate($cateringid,$radius,$cateringname,$CurrentDistance,$DishNamePredict)
{


    $sql='SELECT d.name,d.image,dwa.price,dwa.id FROM dish as d INNER join dishWithAttribute as dwa
on (d.id=dwa.dish_id)
WHERE
(ISNULL(d.expire))AND(ISNULL(dwa.expire))
AND
(d.catering_id='.$cateringid.')AND(d.name like "%'.$DishNamePredict.'%")';


    $AllDishes=queryReceive($sql);
    //print_r($sql);

    $display="";
    for($i=0;$i<count($AllDishes);$i++)
    {
        $dishimage='';
        if((file_exists('../../../../images/dishImages/'.$AllDishes[$i][1])AND($AllDishes[$i][1]!="")))
        {
            $dishimage='../../../../images/dishImages/'.$AllDishes[$i][1];
        }else
        {
            $dishimage='https://static1.bigstockphoto.com/3/1/1/large1500/113342513.jpg';
        }


        $sql='SELECT a.name,a.quantity FROM attribute as a 
WHERE (a.dishWithAttribute_id='.$AllDishes[$i][3].')AND
(ISNULL(a.expire))';
        $Attributes=queryReceive($sql);

        $display.='

<div class="block ">

    <div class="top">
        <ul>
            <li><span class="converse">'.$cateringname.'</span></li>
            <li><a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i>'.$CurrentDistance.'<span class="text-danger  m-1">/</span>'.$radius.'Km</a></li>
        </ul>
    </div>

    <div class="middle">
        <img src="'.$dishimage.'" alt="pic" />
    </div>

    <div class="bottom">
        <div class="heading">'.$AllDishes[$i][0].' <span class="m-1"> id#'.$AllDishes[$i][3].'</span></div>
        <div class="info"><p>';

for($j=0;$j<count($Attributes);$j++)
{
    $display.=$Attributes[$j][0].' : '.$Attributes[$j][1].' / ';
}

        $display.= '</p></div>
        <div class="price">'.$AllDishes[$i][2].'<span class="old-price ml-3"><i class="far fa-money-bill-alt"></i>'.($AllDishes[$i][2]+200).'</span></div>
        <div class="style"><a href="cateringClient.php?c='.$cateringid.'" class="btn btn-primary">Visit Branch>></a></div>
    </div>

</div>';

    }


return $display;





}
