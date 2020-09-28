<?php

function calculationOfHallOrder($order)
{
    $CurrentAmount=0;

    $sql='SELECT sum(ei.price) FROM hall_extra_items as hei  INNER JOIN Extra_Item as ei
on(hei.Extra_Item_id=ei.id)
WHERE (hei.orderDetail_id='.$order.') AND(ISNULL(hei.expire)) ';
    $priceDetailOfExtraItem=queryReceive($sql);//extra item chrages

    $sql='SELECT od.total_person,(select p.price FROM orderDetail as od  INNER join packageDate as pd
on (od.packageDate_id=pd.id)
INNER join packages as p 
on (p.id=pd.package_id)
where 
(od.id='.$order.')) FROM orderDetail as od WHERE od.id='.$order.'';
    $orderDetail=queryReceive($sql);   //order person and package per head


    $sql='SELECT sum(m.price) FROM hallChoiceSelect as hcs INNER join menu as m
on (hcs.menu_id=m.id)

WHERE (hcs.orderDetail_id='.$order.')AND (ISNULL(hcs.expire))'; //menu Prices
    $ExtraItemCharges=queryReceive($sql);

    $CurrentAmount=(int)$orderDetail[0][0]*(int)$orderDetail[0][1];
    $CurrentAmount+=(int)$priceDetailOfExtraItem[0][0];
    $CurrentAmount+=(int)$ExtraItemCharges[0][0];
    return $CurrentAmount;
}