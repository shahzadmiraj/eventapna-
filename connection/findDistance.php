<?php

/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
/*::                                                                         :*/
/*::  This routine calculates the distance between two points (given the     :*/
/*::  latitude/longitude of those points). It is being used to calculate     :*/
/*::  the distance between two locations using GeoDataSource(TM) Products    :*/
/*::                                                                         :*/
/*::  Definitions:                                                           :*/
/*::    South latitudes are negative, east longitudes are positive           :*/
/*::                                                                         :*/
/*::  Passed to function:                                                    :*/
/*::    lat1, lon1 = Latitude and Longitude of point 1 (in decimal degrees)  :*/
/*::    lat2, lon2 = Latitude and Longitude of point 2 (in decimal degrees)  :*/
/*::    unit = the unit you desire for results                               :*/
/*::           where: 'M' is statute miles (default)                         :*/
/*::                  'K' is kilometers                                      :*/
/*::                  'N' is nautical miles                                  :*/
/*::  Worldwide cities and other features databases with latitude longitude  :*/
/*::  are available at https://www.geodatasource.com                          :*/
/*::                                                                         :*/
/*::  For enquiries, please contact sales@geodatasource.com                  :*/
/*::                                                                         :*/
/*::  Official Web site: https://www.geodatasource.com                        :*/
/*::                                                                         :*/
/*::         GeoDataSource.com (C) All Rights Reserved 2018                  :*/
/*::                                                                         :*/
/*::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::*/
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
function SortDistance($lat,$lon,$country)
{

    $sql="SELECT h.id,l.latitude,l.longitude FROM hall as h INNER join location as l on (h.location_id=l.id) WHERE (ISNULL(h.expire))AND(ISNULL(l.expire))";

    $data=queryReceive($sql);
//    $data=array(
//        array(1,13.232,134.34),
//
//        array(2,23.232,234.34),
//
//        array(3,31.5204,74.3587),
//
//        array(4,43.232,44.34),
//
//    );

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

/*echo distance(31.5204, 74.3587, 33.6844, 73.0479, "M") . " Miles<br>";
echo distance(31.5204, 74.3587, 33.6844, 73.0479, "K") . " Kilometers<br>";
echo distance(31.5204, 74.3587, 33.6844, 73.0479, "N") . " Nautical Miles<br>";*/

?>
