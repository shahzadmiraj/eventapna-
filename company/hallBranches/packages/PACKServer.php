<?php
include_once ("../../../connection/connect.php");
if(isset($_POST['option']))
{
    if ($_POST['option'] == "jsonPackagesDetail")
    {


        $packagesid = $_POST['packagesid'];

        $sql = 'SELECT `id`, `month`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `hall_id`, `package_name` FROM `hallprice` WHERE id=' . $packagesid . '';
        $packageDetail = mysqli_query($connect, $sql);

        $sql = 'SELECT `id`, `dishname`, `image`, `expire`, `hallprice_id` FROM `menu` WHERE (hallprice_id=' . $packagesid . ') AND ISNULL(expire)';
        $menuDetail = mysqli_query($connect, $sql);

        $json_package = array();
        while ($row = mysqli_fetch_assoc($packageDetail)) {
            $json_package[] = $row;
        }
        $json_menu = array();
        while ($row = mysqli_fetch_assoc($menuDetail)) {
            $json_menu[] = $row;
        }
        $json = array($json_package, $json_menu);
        echo json_encode($json);

    }
    else if($_POST['option']=="PackDelete")
    {
        $id=$_POST['packageid'];
        $userid=$_POST['userid'];
        $sql='UPDATE `packages` SET expire="'.$timestamp.'",expireUser='.$userid.' WHERE id='.$id.'';
        querySend($sql);
    }




}