<?php
include_once ("../../../../connection/connect.php");


if($_POST['option']=="ViewOrders")
{

    $hallid=$_POST['hallid'];
    $daytime='';
    $packagetype='';
    $searching="";
    if($_POST['daytime']=="Morning")
    {
        $daytime='AND(p.dayTime="Morning")';
    }
    else if($_POST['daytime']=="Afternoon")
    {
        $daytime='AND(p.dayTime="Afternoon")';
    }
    else if($_POST['daytime']=="Evening")
    {
        $daytime='AND(p.dayTime="Evening")';
    }
    else
    {
        $daytime='';
    }

    if($_POST['packagetype']=="All")
    {
        $packagetype="";
    }
    else if($_POST['packagetype']==1)
    {
        $packagetype='AND(p.isFood=1)';
    }
    else
    {
        $packagetype='AND(p.isFood=0)';
    }

    if($_POST['searching']=="All")
    {
        $searching='';
    }
    else
    {
        $searching='AND(od.status_hall = "'.trim($_POST['searching']).'")';
    }





    $data = array();
    $sql = 'SELECT p.id,p.isFood,package_name,pd.selectedDate,p.dayTime,pd.id,od.id FROM packages as p INNER JOIN packageDate as pd
on (p.id=pd.package_id) INNER join orderDetail as od 
on (pd.id=od.packageDate_id)
WHERE
(ISNULL(p.expire))AND (ISNULL(pd.expire))
AND(p.hall_id='.$hallid.')
'.$daytime.' '.$packagetype.'  '.$searching.'
';
    $ViewPackages = queryReceive($sql);
    //echo $sql;


    for ($i = 0; $i < count($ViewPackages); $i++) {
        $packagename = 'Seating';
        if ($ViewPackages[$i][1] == 1)
            $packagename = $ViewPackages[$i][2];
        $StartDaytime = '';
        $EndDaytime = "";
        if ($ViewPackages[$i][3] == "Morning") {

            $StartDaytime = "9H";
            $EndDaytime = "12H";
        } else if ($ViewPackages[$i][3] == "Afternoon") {
            $StartDaytime = "12H";
            $EndDaytime = "18H";
        } else {

            $StartDaytime = "18H";
            $EndDaytime = "20H";
        }

        $date = new DateTime($ViewPackages[$i][3]);
        $date->add(new DateInterval('PT' . $StartDaytime));
        $start = date_format($date, "Y-m-d H:i:s");

        $new = new DateTime($ViewPackages[$i][3]);
        $new->add(new DateInterval('PT' . $EndDaytime));
        $end = date_format($new, "Y-m-d H:i:s");


        $data[] = array(
            'id' => $ViewPackages[$i][6],
            'title' => 'Oid# ' . $ViewPackages[$i][6]. "PN>".$packagename,
            'start' => $start,
            'end' => $end
        );
    }

   echo json_encode($data);
}
else if($_POST['option']=="orderCustomerGo")
{
    $orderid=$_POST['id'];
    $sql='SELECT od.person_id FROM orderDetail as od 
WHERE od.id='.$orderid.'';
    $customerdetail=queryReceive($sql);

    $_SESSION['order']=$orderid;
    $_SESSION['customer']=$customerdetail[0][0];
}