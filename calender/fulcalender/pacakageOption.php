<?php
include_once ("../../connection/connect.php");


if($_POST['option']=="ViewPackages")
{

    $hallnumber=$_POST['hallnumber'];
    $daytime='';
    $packagetype='';
    $companyid=$_POST['companyid'];
    $List="";
    if($hallnumber=="All")
    {
        $sql='SELECT `id` FROM `hall` WHERE (ISNULL(expire))AND (company_id= '.$companyid.')';

        $AllHalls=queryReceive($sql);
        $hallOneD = array_column($AllHalls, 0);
        $List = implode(',', $hallOneD);

    }
    else
    {
        $List=$hallnumber;
    }

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

    $sql='SELECT  `package_id`  FROM `packageControl` WHERE ISNULL(expire)AND(company_id='.$companyid.')AND(hall_id IN('.$List.'))';
    $packagesSql=queryReceive($sql);
    //echo $sql;
    $packagesList = array_column($packagesSql, 0);

    $listOfPackageSql='';
    $packagesStringList = implode(',', $packagesList);
    if(count($packagesSql)==0)
    {
        exit();
    }
    else
    {
        $listOfPackageSql='AND(p.id in ('.$packagesStringList.') )';
    }



    $data = array();
    $sql = 'SELECT p.id,p.isFood,package_name,pd.selectedDate,p.dayTime,pd.id FROM packages as p INNER JOIN packageDate as pd
on p.id=pd.package_id
WHERE
(ISNULL(p.expire)) AND (ISNULL(pd.expire)) '.$listOfPackageSql.'
'.$daytime.' '.$packagetype.' 
';
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
    $sql='SELECT `id`,`token` FROM `packageDate` WHERE id='.$id.'';
    $Packagedetail=queryReceive($sql);
    echo 'pdid='.$Packagedetail[0][0].'&pdtoken='.$Packagedetail[0][1];

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
    $token=uniqueToken("packageDate");
    $sql='INSERT INTO `packageDate`(`id`, `active`, `expire`, `package_id`, `user_id`, `expireUser`, `selectedDate`,`token`) VALUES (NULL,"'.$timestamp.'",NULL,'.$Packageid.','.$userid.',NULL,"'.$selectedDate.'","'.$token.'")';
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
else if($_POST['option']=="PackagesShowsOnTable")
{

    if(!isset($_POST['PackID']))
    {
        echo '<h4 class="btn-danger">Package not found !!!</h4>';
        exit();
    }
    $PackID=$_POST['PackID'];
    $PackUnique =array_unique($PackID);
    $List = implode(', ', $PackUnique);
    $sql = 'SELECT p.id,p.package_name,p.isFood FROM packages as p INNER join packageDate as pd 
on (p.id=pd.package_id)
WHERE 
(ISNULL(p.expire))AND(ISNULL(pd.expire))AND (pd.id in ('.$List.'))
                      group by (p.id)';
    $ViewPackages = queryReceive($sql);

    $display='<table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">id</th>
                <th scope="col">Package Name</th>
                <th scope="col">Type</th>
            </tr>
            </thead>
            <tbody>';

    $Packagetype="";
    for($i=0;$i<count($ViewPackages);$i++)
    {

        $Packagetype="Seating";
        if($ViewPackages[$i][2]==1)
            $Packagetype="Food";

        $display.='
            <tr>
                <th scope="row">'.($i+1).'</th>
                <th scope="col">'.$ViewPackages[$i][0].'</th>
                <td>'.$ViewPackages[$i][1].'</td>
                <td>'.$Packagetype.'</td>
            </tr>';
    }

  $display.='  </tbody>
        </table>';
    echo $display;
}
?>