<?php

function checkChangeOfMenuOfPackages($post)
{
    $order=$post['order'];
    $packageDateid=$post['packageDateid'];

    $sql='select  p.id,od.packageDate_id FROM orderDetail as od  INNER join packageDate as pd
on (od.packageDate_id=pd.id)
INNER join packages as p 
on (p.id=pd.package_id)
where 
(od.id='.$order.')';
    $Prviousorder=queryReceive($sql);


    $timestamp = date('Y-m-d H:i:s');
    $userid=$post['userid'];
    $sql='SELECT `package_id FROM `packageDate` WHERE  id='.$packageDateid;
    $packageid=queryReceive($sql);



    if($Prviousorder[0][0]==$packageid[0][0])
    {
        //check menu exist or not same packages

        //previous menu ids
         $sql='SELECT  `menu_id` FROM `hallChoiceSelect` WHERE (orderDetail_id='.$order.')AND (ISNULL(expire))';
         $previousMenuIdsResult=queryReceive($sql);
        $PrevoiusMenuIdsOneD = array_column($previousMenuIdsResult, 0);


        //current menu ids

        $MenuTypeInpackages=$post['MenuTypeInpackages'];
        $MenuTypeInpackagesArray=explode(",", $MenuTypeInpackages);
        $currentMenuids=array();

        for($i=0;$i<count($MenuTypeInpackagesArray);$i++)
        {
            if(isset($post["SelectOptionFromItem".$MenuTypeInpackagesArray[$i]]))
            {
                $currentMenuids[$i]=$post["SelectOptionFromItem".$MenuTypeInpackagesArray[$i]];
            }

        }


        //unique menu id remove
        $diffarrayMenuids=array_diff($PrevoiusMenuIdsOneD,$currentMenuids);


        //check if arrayinterceptmenuid exist in current then insert current menu id
        for($i=0;$i<count($diffarrayMenuids);$i++)
        {
            if(in_array($diffarrayMenuids[$i],$currentMenuids))
            {
                //insert new menu id
                $sql='INSERT INTO `hallChoiceSelect`(`id`, `expire`, `active`, `ActiveUser`, `ExpireUser`, `menu_id`, `orderDetail_id`) VALUES (NULL,NULL,"'.$timestamp.'",'.$userid.',NULL,'.$diffarrayMenuids[$i].','.$order.')';
                querySend($sql);
            }
            else
            {
                //expire
                $sql='UPDATE `hallChoiceSelect` SET `expire`="'.$timestamp.'",`ExpireUser`='.$userid.' WHERE (orderDetail_id='.$order.')AND (ISNULL(expire))AND(menu_id='.$diffarrayMenuids[$i].')';
                querySend($sql);
            }
        }





    }
    else
    {
        //different packages
        //expire all menu in orders
        $sql='UPDATE `hallChoiceSelect` SET `expire`="'.$timestamp.'",`ExpireUser`='.$userid.' WHERE (orderDetail_id='.$order.')AND (ISNULL(expire))';
        querySend($sql);
        //new insert
        $MenuTypeInpackages=$post['MenuTypeInpackages'];
        $MenuTypeInpackagesArray=explode(",", $MenuTypeInpackages);
        for($i=0;$i<count($MenuTypeInpackagesArray);$i++)
        {
            if(isset($post["SelectOptionFromItem".$MenuTypeInpackagesArray[$i]]))
            {
                $sql='INSERT INTO `hallChoiceSelect`(`id`, `expire`, `active`, `ActiveUser`, `ExpireUser`, `menu_id`, `orderDetail_id`) VALUES (NULL,NULL,"'.$timestamp.'",'.$userid.',NULL,'.$post["SelectOptionFromItem".$MenuTypeInpackagesArray[$i]].','.$order.')';
                querySend($sql);
            }

        }


    }

}