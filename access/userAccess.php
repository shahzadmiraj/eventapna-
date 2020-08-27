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

function RedirectOtherwiseOnlyAccessUserOfCateringBranch($ValidationUserJobTitleString,$redirect,$IdNames)
{
    $Isredirect=false;
    RedirectOtherwiseOnlyAccessUsersWho($ValidationUserJobTitleString,$redirect);
    if(isset($_GET[$IdNames])&&(isset($_GET['token'])))
    {
        $sql='SELECT  `company_id` FROM `user` WHERE id='.$_COOKIE['userid'].' and ISNULL(expire)';
        $companyId=queryReceive($sql);

        $Companyinfo=RedirectOtherwiseOrCateringignoreUsers($redirect,$IdNames);
        if(count($companyId)==1&& count($Companyinfo)==1)
        {
            if($companyId[0][0]!=$Companyinfo[0][0])
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


function RedirectOtherwiseOnlyAccessUserOfDish($ValidationUserJobTitleString,$redirect)
{
    $Isredirect=false;
    RedirectOtherwiseOnlyAccessUsersWho($ValidationUserJobTitleString,$redirect);
    if(isset($_GET['Did'])&&(isset($_GET['Dtoken'])))
    {
        $sql='SELECT  `company_id` FROM `user` WHERE id='.$_COOKIE['userid'].' and ISNULL(expire)';
        $companyId=queryReceive($sql);
        $id=$_GET['Did'];
        $token=$_GET['Dtoken'];
        $sql='SELECT u.company_id FROM user as u WHERE u.id=(SELECT  d.user_id FROM dish as d WHERE (d.id='.$id.')AND (ISNULL(d.expire))AND(d.token="'.$token.'")  LIMIT 1 )';
        $Companyinfo=queryReceive($sql);
        if(count($companyId)==1&& count($Companyinfo)==1)
        {
            if($companyId[0][0]!=$Companyinfo[0][0])
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
function RedirectOtherwiseOrHallignoreUsers($redirect,$IdNames)
{

    if(isset($_GET[$IdNames])&&(isset($_GET['token'])))
    {
        $id=$_GET[$IdNames];
        $token=$_GET['token'];
        $sql='SELECT `company_id` FROM `hall` WHERE (id='.$id.')AND (ISNULL(expire))AND (token="'.$token.'")';
        $Companyinfo=queryReceive($sql);
        if(count($Companyinfo)==1)
        {
            return $Companyinfo;
        }
    }
    header("location:".$redirect);
    exit();

}

function RedirectOtherwiseOrCateringignoreUsers($redirect,$IdNames)
{
    if(isset($_GET[$IdNames])&&(isset($_GET['token'])))
    {
        $id=$_GET[$IdNames];
        $token=$_GET['token'];
        $sql='SELECT  c.company_id FROM catering as c WHERE (c.id='.$id.')AND (ISNULL(c.expire))AND(c.token="'.$token.'")';
        $Companyinfo=queryReceive($sql);
        if(count($Companyinfo)==1)
        {
            return $Companyinfo;
        }
    }
    header("location:".$redirect);
    exit();

}
function RedirectOtherwiseOnlyAccessUserOfHall($ValidationUserJobTitleString,$redirect,$IdNames)
{
    $Isredirect=false;
    RedirectOtherwiseOnlyAccessUsersWho($ValidationUserJobTitleString,$redirect);
    if(isset($_GET[$IdNames])&&(isset($_GET['token'])))
    {
        $sql='SELECT  `company_id` FROM `user` WHERE id='.$_COOKIE['userid'].' and ISNULL(expire)';
        $companyId=queryReceive($sql);
        $Companyinfo=RedirectOtherwiseOrHallignoreUsers($redirect,$IdNames);
        if(count($companyId)==1&& count($Companyinfo)==1)
        {
            if($companyId[0][0]!=$Companyinfo[0][0])
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



function RedirectOtherwiseOnlyAccessUserOfOrderBooked($ValidationUserJobTitleString,$redirect)
{

    $Isredirect=false;
    RedirectOtherwiseOnlyAccessUsersWho($ValidationUserJobTitleString,$redirect);
    if(isset($_GET['pid'])&&(isset($_GET['token'])))
    {
        $sql='SELECT  `company_id` FROM `user` WHERE id='.$_COOKIE['userid'].' and ISNULL(expire)';
        $companyId=queryReceive($sql);
        $id=$_GET['pid'];
        $token=$_GET['token'];

        $sql='SELECT  `catering_id`, `hall_id` FROM `BookingProcess` WHERE (id='.$id.')AND(token="'.$token.'")';
         $HallOrCatering=queryReceive($sql);
          if(count($HallOrCatering)==1)
          {

              if (empty($HallOrCatering[0][0])) {
                  //hall
                  $sql = 'SELECT `company_id` FROM `hall` WHERE (id=' . $HallOrCatering[0][1] . ')AND (ISNULL(expire))';
              } else {
                  //catering
                  $sql = 'SELECT  c.company_id FROM catering as c WHERE (c.id=' . $HallOrCatering[0][0] . ')AND (ISNULL(c.expire))';
              }
              $Companyinfo = queryReceive($sql);
              if (count($companyId) == 1 && count($Companyinfo) == 1) {
                  if ($companyId[0][0] != $Companyinfo[0][0]) {
                      $Isredirect = true;
                  }
              } else {
                  $Isredirect = true;
              }
          }else {
              $Isredirect = true;
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

