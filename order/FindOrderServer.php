<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-08
 * Time: 01:51
 */

include_once ("../connection/connect.php");




$hallorcater=$_POST['hallorcater'];
$sql='SELECT     
DISTINCT
od.id,p.name,p.image,od.destination_date,od.destination_time,od.status_hall,od.status_catering,od.hall_id,od.catering_id,hp.package_name,p.id FROM orderDetail as od INNER JOIN person as p 
on (p.id=od.person_id)
left JOIN number as n
on (p.id=n.person_id)
left JOIN packageDate as pd
on (od.packageDate_id=pd.id)
left JOIN packages as hp
on (pd.package_id=hp.id)
WHERE

 ';


if(isset($_POST['p_name']))
{
    if($_POST['p_name']!='')
    $sql.=' (p.name LIKE "%'.$_POST["p_name"].'%") AND ';
}

if(isset($_POST['p_cnic']))
{
    if($_POST['p_cnic']!='')
    $sql.=' (p.cnic LIKE "%'.$_POST["p_cnic"].'%") AND ';
}
if(isset($_POST['p_id']))
{
    if($_POST['p_id']!='')
        $sql.=' (p.id ='.$_POST["p_id"].') AND ';
}
if(isset($_POST['n_number']))
{
    if($_POST['n_number']!='')
        $sql.=' (n.number LIKE "%'.$_POST["n_number"].'%") AND ';
}
if(isset($_POST['od_booking_date']))
{
    if($_POST['od_booking_date']!='')
    $sql.=' (od.booking_date = "'.$_POST["od_booking_date"].'") AND ';
}
if(isset($_POST['od_destination_date']))
{
    if($_POST['od_destination_date']!='')
    $sql.=' (od.destination_date ="'.$_POST["od_destination_date"].'") AND ';
}
if(isset($_POST['od_status_catering']))
{
    if($_POST['od_status_catering']!='None')
    $sql.=' (od.status_catering = "'.$_POST["od_status_catering"].'") AND ';
}

if(isset($_POST['od_status_hall']))
{
    if($_POST['od_status_hall']!='None')
        $sql.=' (od.status_hall = "'.$_POST["od_status_hall"].'") AND ';
}


$sql.=''.$hallorcater.' 
order by 
od.destination_date DESC';

$orderdetail=queryReceive($sql);
$display='';
for ($i=0;$i<count($orderdetail);$i++)
{
    $display.='
        <a href="?action=preview&order='.$orderdetail[$i][0].'&customer='.$orderdetail[$i][10].'" class="col-12   row  shadow m-3 newcolor">
        <img style="height:8vh" src="';

      if(file_exists('../images/customerimage/'.$orderdetail[$i][2])&&($orderdetail[$i][2]!=""))
      {
          $display.='../images/customerimage/'.$orderdetail[$i][2];

      }
      else
      {
          $display.='https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png';
      }





    $display.='"class="col-3 p-0">
        <div class="col-9">
            <label class="col-12">Order id:<i class="text-secondary">'.$orderdetail[$i][0].'</i> </label>
            <label class="col-12">Name: <i class="text-secondary">'.$orderdetail[$i][1].'</i></label>
            <label class="col-12">Date: <i class="text-secondary">'.$orderdetail[$i][3].'</i></label>
        </div>
        <label class="col-12">Time: <i class="text-secondary">';

    if(!empty($hallid))
    {
        //if order is hall order timing
        if ($orderdetail[$i][4] == "09:00:00")
        {
            $display .= "Morning";
        } else if ($orderdetail[$i][4] == "12:00:00") {
            $display .= "Afternoon";
        } else
        {
            $display .= "18:00:00";
        }
    }
    else
    {
        //catering order
        $display.=$orderdetail[$i][4];
    }

    $display.='</i></label>';

    if($orderdetail[$i][7]!="")
    {
        //if order is hall

        $display .= '<label class="col-12">Per Head:<i class="text-secondary">';
        if ($orderdetail[$i][9] != "")
        {
            //hall is booked wth food+seaating
            $display.=$orderdetail[$i][9].'   Food+Seating';
        } else
        {
            //hall is book only seating
            $display.='Only Seating';

        }
        $display.='</i> </label>';
    }


    if(($orderdetail[$i][6]!="")&&($orderdetail[$i][8]!=""))
    {
        //catering status
        $display.='
        <label class="col-12">Catering Status:<i class="text-secondary">'.$orderdetail[$i][6].'</i> </label>';
    }
    if(($orderdetail[$i][5]!="")&&($orderdetail[$i][7]!=""))
    {
        //hall status
        $display.='
        <label class="col-12">Hall Status:<i class="text-secondary">'.$orderdetail[$i][5].'</i> </label>';
    }
    $display.='</a>';

}
echo $display;




?>