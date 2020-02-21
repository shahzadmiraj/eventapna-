<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-10
 * Time: 11:50
 */

include_once ("../connection/connect.php");


if(isset($_POST["option"]))
{
    if($_POST['option']=="login")
    {
        $userName=$_POST['username'];
        $password=$_POST['password'];
        $sql='SELECT u.id,u.isOwner,u.company_id,(SELECT p.image FROM person as p WHERE p.id=u.person_id) FROM user as u WHERE (u.username="'.$userName.'")AND(u.password="'.$password.'")';
        $userDetail=queryReceive($sql);
        if(count($userDetail)==0)
        {
            echo "please user is not registerd";
        }
        else
        {


            setcookie('userid',$userDetail[0][0] , time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
            setcookie("isOwner",$userDetail[0][1],time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
            setcookie("username",$userName,time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
            setcookie("companyid",$userDetail[0][2],time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
            setcookie("userimage",$userDetail[0][3],time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);

        }
    }
}





?>