<?php
//Owner,User(localUser),Employee,Viewer
function checkCompanyAuth($redirect)
{
    if(!isset($_COOKIE['userid']))
    {
        header("location:".$redirect);
        exit();
    }
}
function onlyAccessUsersWho($ValidationUserJobTitleString)
{
    $ValidationUserJobTitle=explode(',',$ValidationUserJobTitleString);
    $sql='SELECT `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].' and ISNULL(expire)';
    $Jobtile=queryReceive($sql);
    if(in_array($Jobtile[0][0],$ValidationUserJobTitle))
    {
        return true;
    }
    return false;
}
function RedirectOtherwiseOnlyAccessUsersWho($ValidationUserJobTitleString,$redirect)
{
    checkCompanyAuth($redirect);
    if(!onlyAccessUsersWho($ValidationUserJobTitleString))
    {
        header("location:".$redirect);
        exit();
    }
}


function RedirectOtherwiseOnlyAccessUserOfPackagesDate($ValidationUserJobTitleString,$redirect)
{
    $Isredirect=false;
    RedirectOtherwiseOnlyAccessUsersWho($ValidationUserJobTitleString,$redirect);
    if(isset($_GET['pdid'])&&(isset($_GET['pdtoken'])))
    {
        $sql='SELECT  `company_id` FROM `user` WHERE id='.$_COOKIE['userid'].' and ISNULL(expire)';
        $companyId=queryReceive($sql);
        $pdid=$_GET['pdid'];
        $pdtoken=$_GET['pdtoken'];
        $sql='SELECT u.company_id FROM user as u WHERE u.id=(SELECT pd.user_id from packageDate as pd WHERE (pd.id='.$pdid.') and (pd.token="'.$pdtoken.'") AND (ISNULL(pd.expire)) LIMIT 1 )';
        $PackCompany=queryReceive($sql);
        if(count($companyId)==1&& count($PackCompany)==1)
        {
                if($companyId[0][0]!=$PackCompany[0][0])
                {
                    $Isredirect=true;
                }
        }
        else
        {
            $Isredirect=true;
        }

    }
    else
    {
        $Isredirect=true;
    }



    if($Isredirect)
    {
        header("location:".$redirect);
        exit();
    }
}