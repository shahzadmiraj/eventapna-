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
    $sql='SELECT `package_id` FROM `packageDate` WHERE  `id`='.$packageDateid;
    $packageid=queryReceive($sql);



    if($Prviousorder[0][0]==$packageid[0][0])
    {
        //check menu exist or not same packages

        //previous menu ids
         $sql='SELECT  `menu_id` FROM `hallChoiceSelect` WHERE (orderDetail_id='.$order.')AND (ISNULL(expire))';
         $previousMenuIdsResult=queryReceive($sql);
        $PrevoiusMenuIdsOneD=array();
        if(count($previousMenuIdsResult)>0)
        $PrevoiusMenuIdsOneD = array_column($previousMenuIdsResult, 0);


        //current menu ids
        $MenuTypeInpackages=array();

        if(isset($post['MenuTypeInpackages']))
        $MenuTypeInpackages=$post['MenuTypeInpackages'];
        $MenuTypeInpackagesArray=explode(",", $MenuTypeInpackages);
        $currentMenuids=array();

        for($i=0;$i<count($MenuTypeInpackagesArray);$i++)
        {
            if(isset($post["SelectOptionFromItem".$MenuTypeInpackagesArray[$i]]))
            {
                if($post["SelectOptionFromItem".$MenuTypeInpackagesArray[$i]]!="Default")
                {
                    $currentMenuids[$i] = $post["SelectOptionFromItem" . $MenuTypeInpackagesArray[$i]];
                }
            }

        }


        //unique menu id remove

        $clean1 = array_diff($PrevoiusMenuIdsOneD, $currentMenuids);
        $clean2 = array_diff($currentMenuids, $PrevoiusMenuIdsOneD);
        $diffarrayMenuids = array_merge($clean1, $clean2);

       // $diffarrayMenuids=array_diff($arrayMerge);


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
                if($post["SelectOptionFromItem".$MenuTypeInpackagesArray[$i]]!="Default")
                {
                    $sql = 'INSERT INTO `hallChoiceSelect`(`id`, `expire`, `active`, `ActiveUser`, `ExpireUser`, `menu_id`, `orderDetail_id`) VALUES (NULL,NULL,"' . $timestamp . '",' . $userid . ',NULL,' . $post["SelectOptionFromItem" . $MenuTypeInpackagesArray[$i]] . ',' . $order . ')';
                    querySend($sql);
                }
            }

        }
        $sql='UPDATE `Order_Package_History` SET `ExpireUserId`='.$userid.',`ExpireUserDate`="'.$timestamp.'" WHERE (ISNULL(ExpireUserDate))AND(orderDetail_id='.$order.')';
        querySend($sql);

        $sql='SELECT `id`, `isFood`, `price`, `describe`, `dayTime`,`package_name`, `MinimumGuest` FROM `packages` WHERE id=(SELECT pd.package_id FROM packageDate as pd WHERE pd.id='.$packageDateid.' LIMIT 1)';
        $packageDetails=queryReceive($sql);
        $sql='INSERT INTO `Order_Package_History`(`id`, `isFood`, `price`, `describe`, `dayTime`, `package_name`, `MinimumGuest`, `packages_id`, `activeDate`, `ActiveUserId`, `orderDetail_id`, `ExpireUserId`, `ExpireUserDate`) 
VALUES (NULL,'.$packageDetails[0][1].','.$packageDetails[0][2].',"'.$packageDetails[0][3].'","'.$packageDetails[0][4].'","'.$packageDetails[0][5].'",'.$packageDetails[0][6].','.$packageDetails[0][0].',"'.$timestamp.'",'.$userid.','.$order.',NULL,NULL)';
        querySend($sql);

    }

}