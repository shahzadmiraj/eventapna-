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
    $sql='SELECT c.id,cl.latitude,cl.longitude,cl.radius,c.name,1,c.token FROM catering as c INNER join cateringLocation as cl 
on (c.id=cl.catering_id) inner  join company as co 
on (co.id=c.company_id)
WHERE 
(ISNULL(c.expire))AND(ISNULL(cl.expire))AND(cl.country="'.$country.'")AND(c.name like "%'.(trim($cateringNamePredict)).'%")AND (co.name!="demo")';
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

            $display .= showCateringsdishesSeperate($catring[$i][0], $catring[$i][3], $catring[$i][4], $catring[$i][5],$DishNamePredict,$catring[$i][6]);
        }
    }
    return $display;
}
function showCateringsdishesSeperate($cateringid,$radius,$cateringname,$CurrentDistance,$DishNamePredict,$cateringToken)
{




$sql='SELECT d.name,d.image,dwa.price,dwa.id FROM dish as d INNER join dishWithAttribute as dwa on (d.id=dwa.dish_id) INNER JOIN 
dishControl as dc 
on (dc.dish_id=d.id)
WHERE (ISNULL(d.expire))AND(ISNULL(dwa.expire)) AND 
(ISNULL(dc.expire))AND(dc.catering_id='.$cateringid.')AND(d.name like "%'.$DishNamePredict.'%")';
    $AllDishes=queryReceive($sql);

    $display="";
    for($i=0;$i<count($AllDishes);$i++)
    {
        $dishimage='';
        if((file_exists('../../../images/dishImages/'.$AllDishes[$i][1])AND($AllDishes[$i][1]!="")))
        {
            $dishimage='../../../images/dishImages/'.$AllDishes[$i][1];
        }else
        {
            $dishimage='../../../images/systemImage/imageNotFound.png';
        }


        $sql='SELECT a.name,a.quantity FROM attribute as a 
WHERE (a.dishWithAttribute_id='.$AllDishes[$i][3].')AND
(ISNULL(a.expire))';
        $Attributes=queryReceive($sql);

        $display.='

<div class="block ">

    <div class="top">
    
        <ul>
            <li><a href="#"><i class="fas fa-street-view"></i>your distance :'.$CurrentDistance.'<span class="text-danger  m-1">/</span>branch services '.$radius.'Km</a></li>
        </ul>
    </div>

    <div class="middle">
        <img src="'.$dishimage.'" alt="pic" />
    </div>

    <div class="bottom">
        <div class="info">
      ';

        if(count($Attributes)>0)
        {
            $display.='  <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item Name </th>
                            <th scope="col">Quantity</th>
                        </tr>
                        </thead>
                        <tbody>';
        }





for($j=0;$j<count($Attributes);$j++)
{
    $display.= ' 
    <tr>
      <th scope="row">'.($j+1).'</th>
      <td>'.$Attributes[$j][0].'</td>
      <td>'.$Attributes[$j][1].'</td>
   </tr>';

}
        if(count($Attributes)>0)
        {
            $display.= ' </tbody>
                    </table>';
        }

        $display.= '

</div>
<ul class="list-group">
<li class="list-group-item"><i class="fas fa-concierge-bell"></i> Dish name : '.$AllDishes[$i][0].'</li>
<li class="list-group-item">id#'.$AllDishes[$i][3].'</li>
<li class="list-group-item">Branch Name:'.$cateringname.'</li>
<li class="list-group-item price"><i class="far fa-money-bill-alt"></i>Price :'.$AllDishes[$i][2].' <span class="old-price ml-3">'.((int)$AllDishes[$i][2]+20).'</span></li>
</ul>
      
    </div>
<a href="cateringClient.php?c='.$cateringid.'&token='.$cateringToken.'" class="btn btn-primary">Visit Branch>></a>
</div>';

    }


return $display;





}
