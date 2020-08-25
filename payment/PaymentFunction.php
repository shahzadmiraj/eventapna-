<?php

$sql='SELECT sum(py.amount) FROM payment as py WHERE (py.IsReturn=0)AND(py.orderDetail_id='.$orderId.')';
$totalReceivedPayment=queryReceive($sql);

