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
        $searching='AND(od.status_catering = "'.trim($_POST['searching']).'")';
    }





    $data = array();
    $sql = 'SELECT od.id,od.destination_date,od.destination_time FROM orderDetail as od WHERE 
(od.catering_id='.$cateringid.')  '.$searching.' ';
    $ViewOrders = queryReceive($sql);
    //echo $sql;


    for ($i = 0; $i < count($ViewOrders); $i++)
    {
        $date = new DateTime($ViewOrders[$i][1]);
        $time = new DateTime($ViewOrders[$i][2]);

        $merge = new DateTime($date->format('Y-m-d') .' ' .$time->format('H:i:s'));
        $start= $merge->format('Y-m-d H:i:s'); // Outputs '2017-03-14 13:37:42'

        $end = date("Y-m-d H:i:s",strtotime("+2 minutes", strtotime($merge->format('Y-m-d H:i:s'))));


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
    $sql='SELECT `id`, `token` FROM `BookingProcess`  
WHERE orderDetail_id=
'.$orderid;
    $customerdetail=queryReceive($sql);

    echo '?pid='.$customerdetail[0][0].'&token='.$customerdetail[0][1];
}

include_once("../../../../webdesign/footer/EndOfPage.php");
