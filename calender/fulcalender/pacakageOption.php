<?php
include_once ("../../connection/connect.php");


if($_POST['option']=="ViewPackages")
{

    $hallid=$_POST['hallid'];
    $daytime='';
    $packagetype='';
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




    $data = array();
    $sql = 'SELECT p.id,p.isFood,package_name,pd.selectedDate,p.dayTime,pd.id FROM packages as p INNER JOIN packageDate as pd
on p.id=pd.package_id
WHERE
(ISNULL(p.expire))AND (ISNULL(pd.expire))
AND(p.hall_id='.$hallid.')
'.$daytime.' '.$packagetype.'
';
    $ViewPackages = queryReceive($sql);


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
            'id' => $ViewPackages[$i][0],
            'title' => 'Pid# ' . $ViewPackages[$i][0]."Did# ".$ViewPackages[$i][5]. "PN".$packagename,
            'start' => $start,
            'end' => $end
        );
    }

    echo json_encode($data);
}
else if($_POST['option']=="encordpackage")
{
    $id=$_POST['id'];
    echo base64url_encode($id);
}
else if($_POST['option']=='SpecificpackageView')
{
    $packageid=$_POST['packageid'];

    $sql = 'SELECT pd.id,p.isFood,package_name,pd.selectedDate,p.dayTime,pd.id FROM packages as p INNER JOIN packageDate as pd
on p.id=pd.package_id
WHERE
(ISNULL(p.expire))AND (ISNULL(pd.expire))
AND(p.id='.$packageid.')';
    $ViewPackages = queryReceive($sql);


    for ($i = 0; $i < count($ViewPackages); $i++)
    {
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
            'id' => $ViewPackages[$i][5],
            'title' =>"Did# ".$ViewPackages[$i][5].'Pid#' . $ViewPackages[$i][0],
            'start' => $start,
            'end' => $end
        );
    }

    echo json_encode($data);


}

else if($_POST['option']=="DelectEventdate")
{
    $id=$_POST['id'];
    $userid=$_POST['userid'];
    $sql='UPDATE packageDate as pd SET pd.expire="'.$timestamp.'",pd.expireUser='.$userid.'  WHERE pd.id='.$id.'';
    querySend($sql);
}
else if($_POST['option']=="InsertNewDate")
{
    $selectedDate=$_POST['selectedDate'];
    $Packageid=$_POST['Packageid'];
    $selectedDate=$_POST['selectedDate'];
    $userid=$_POST['userid'];
    $sql='SELECT active FROM `packageDate` WHERE (package_id='.$Packageid.')AND (ISNULL(expire))AND(selectedDate="'.$selectedDate.'")';
    $getpackageDetail=queryReceive($sql);
    if(count($getpackageDetail)>0)
        exit();
    $sql='INSERT INTO `packageDate`(`id`, `active`, `expire`, `package_id`, `user_id`, `expireUser`, `selectedDate`) VALUES (NULL,"'.$timestamp.'",NULL,'.$Packageid.','.$userid.',NULL,"'.$selectedDate.'")';
    querySend($sql);
}
else if($_POST['option']=="updateEdittable")
{
    $packageid=$_POST['Packageid'];

    $sql = 'SELECT pd.id,pd.selectedDate,(SELECT u.username FROM user as u WHERE u.id=pd.user_id),pd.active FROM packages as p INNER JOIN packageDate as pd
on p.id=pd.package_id
WHERE
(ISNULL(p.expire))AND (ISNULL(pd.expire))
AND(p.id='.$packageid.')';
    $ViewPackages = queryReceive($sql);
    $display='';
    for($i=0;$i<count($ViewPackages);$i++)
    {
        $display.='<tr>
            <td>'.$i.'</td>
            <td>'.$ViewPackages[$i][0].'</td>
            <td>'.$ViewPackages[$i][1].'</td>
            <td>'.$ViewPackages[$i][2].'</td>
            <td>'.$ViewPackages[$i][3].'</td>
        </tr>';
    }
    echo $display;
}
?>