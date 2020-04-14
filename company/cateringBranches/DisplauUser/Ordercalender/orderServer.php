<?php
include_once ("../../../../connection/connect.php");


if($_POST['option']=="ViewCateringOrder")
{

    $cateringid=$_POST['cateringid'];
    $searching="";

    if($_POST['searching']=="All")
    {
        $searching='';
    }
    else
    {
        $searching='AND(od.catering_id = "'.trim($_POST['searching']).'")';
    }





    $data = array();
    $sql = 'SELECT od.id,od.destination_date,od.destination_time FROM orderDetail as od WHERE 
(od.status_catering='.$cateringid.')  '.$searching.' ';
    $ViewOrders = queryReceive($sql);
    //echo $sql;


    for ($i = 0; $i < count($ViewOrders); $i++) {
        $date = new DateTime($ViewOrders[$i][1]);
        $date->add(new DateInterval('PT' . $ViewOrders[$i][2]));
        $start = date_format($date, "Y-m-d H:i:s");
        $end = date("Y-m-d H:i:s",strtotime("+15 minutes", strtotime($start)));


        $data[] = array(
            'id' => $ViewOrders[$i][0],
            'title' => 'Oid#' . $ViewOrders[$i][0],
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