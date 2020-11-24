<?php
$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetailCom=queryReceive($sql);
$companyidCom=$userdetailCom[0][0];

$sql='SELECT  c.name FROM company as c WHERE c.id='.$companyidCom.'';
$companydetailCom=queryReceive($sql);


$sql='SELECT `id`, `name`,`image`,`token` FROM `hall` WHERE ISNULL(expire) AND (company_id='.$companyidCom.')';
$hallsCom=queryReceive($sql);

$sql='SELECT `id`, `name`,`image`,`token` FROM `catering` WHERE ISNULL(expire) AND (company_id='.$companyidCom.')';
$cateringsCom=queryReceive($sql);

$sql='SELECT `id`, `username`,`image`, `jobTitle`,`token` FROM `user` WHERE (company_id='.$companyidCom.')AND(ISNULL(expire))';
$usersCom=queryReceive($sql);