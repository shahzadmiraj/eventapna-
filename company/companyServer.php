<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-03
 * Time: 17:20
 */
include_once ("../connection/connect.php");


function createOnlyAllSeating($hallid,$daytime)
{
    $monthsArray=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    for($i=0;$i<count($monthsArray);$i++)
    {
        $sql='INSERT INTO `hallprice`(`id`, `month`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `hall_id`, `package_name`) VALUES (NULL,"'.$monthsArray[$i].'",0,0,NULL,"'.$daytime.'",NULL,'.$hallid.',NULL)';
        querySend($sql);
    }
}

if(isset($_POST['option']))
{
    if($_POST['option']=="createUser")
    {

        $username=chechIsEmpty($_POST['username']);
        $password=chechIsEmpty($_POST['password']);
        $sql='SELECT u.id FROM user as u WHERE  (u.username="'.$username.'")';
        $userExist=queryReceive($sql);
        if(count($userExist)!=0)
        {
            echo "user is already exist";
            exit();
        }
        $image='';

        if(!empty($_FILES['image']["name"]))
        {
            $image = "../images/users/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $image);//$dishimage is destination file location;
            if ($resultimage != "") {
                print_r($resultimage);
                exit();
            }

            $image = $_FILES['image']['name'];

        }

        $name = trim($_POST['name']);
        $numberArray = $_POST['number'];
        $cnic = $_POST['cnic'];
        $city = $_POST['city'];
        $area = $_POST['area'];
        $streetNo = chechIsEmpty($_POST['streetNo']);
        $houseNo = chechIsEmpty($_POST['houseNo']);
        $date = date('Y-m-d');
        $sql='INSERT INTO `person`(`name`, `cnic`, `id`, `date`, `image`,`active`) VALUES ("'.$name.'","'.$cnic.'",NULL,"'.$date.'","'.$image.'","'.$timestamp.'")';
        querySend($sql);
        $last_id = mysqli_insert_id($connect);
        $sql="INSERT INTO `address` (`id`, `address_street_no`, `address_house_no`, `person_id`, `address_city`, `address_town`) VALUES (NULL, '".$streetNo."', '".$houseNo."', '".$last_id."', '".$city."', '".$area."');";
        querySend($sql);
        for ($i=0;$i<count($numberArray);$i++)
        {

            $sql = "INSERT INTO `number`(`number`, `id`, `is_number_active`, `person_id`) VALUES ('".$numberArray[$i]."',NULL,1,$last_id)";
            querySend($sql);
        }
        $customerId = $last_id;
        $sql='INSERT INTO `user`(`id`, `username`, `password`, `person_id`, `isExpire`,`userType`, `company_id`,`active`) VALUES (NULL,"'.$username.'","'.$password.'",'.$customerId.',NULL,"Owner",NULL,"'.$timestamp.'")';
        querySend($sql);
        $userid = mysqli_insert_id($connect);

        $sql='INSERT INTO `company`(`id`, `name`, `expire`, `user_id`,`active`) VALUES (NULL,"'.$_POST['companyName'].'",NULL,'.$userid.',"'.$timestamp.'")';
        querySend($sql);
        $companyid=mysqli_insert_id($connect);

        $sql='UPDATE user as u SET u.company_id='.$companyid.' WHERE u.id='.$userid.'';
        querySend($sql);

        setcookie('userid',$userid , time() + (86400 * 30), "/");
        setcookie("usertype","Owner",time() + (86400 * 30), "/");
        setcookie("username",$username,time() + (86400 * 30), "/");
        setcookie("companyid",$companyid,time() + (86400 * 30), "/");
        setcookie("userimage",$image,time() + (86400 * 30), "/");
    }
    else if($_POST['option']=="createCatering")
    {
        $companyid=$_POST['companyid'];
        $namecatering=$_POST['namecatering'];
        $Cateringimage='';
        $sql='';
        if(!empty($_FILES['image']["name"]))
        {
            $Cateringimage = "../images/catering/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $Cateringimage);//$dishimage is destination file location;
            if ($resultimage != "") {
                print_r($resultimage);
                exit();
            }

            $Cateringimage =$_FILES['image']['name'];

        }
        $sql='INSERT INTO `catering`(`id`, `name`, `expire`, `image`, `location_id`, `company_id`,`active`) VALUES (NULL,"'.$namecatering.'",NULL,"'.$Cateringimage.'",NULL,'.$companyid.',"'.$timestamp.'")';
        querySend($sql);
        $cateringid=mysqli_insert_id($connect);
            if(!isset($_POST['dishtypename']))
            {
                exit();
            }
        $dishtypename=$_POST['dishtypename'];
        $dishtypeid='';
        $dishid=$_POST['dishid'];
        $dishname=$_POST['dishname'];
        $image=$_POST['image'];
        for($i=0;$i<count($dishtypename);$i++)
        {
            $sql='SELECT `id` FROM `dish_type` WHERE (name="'.$dishtypename[$i].'") AND (catering_id='.$cateringid.')';
            $detail=queryReceive($sql);
            if(count($detail)>0)
            {
                $dishtypeid=$detail[0][0];
            }
            else
            {
                $sql='INSERT INTO `dish_type`(`id`, `name`, `isExpire`, `catering_id`) VALUES (NULL,"'.$dishtypename[$i].'",NULL,'.$cateringid.')';
                querySend($sql);
                $dishtypeid=mysqli_insert_id($connect);
            }

            $sql='INSERT INTO `dish`(`name`, `id`, `image`, `dish_type_id`, `isExpire`, `catering_id`) VALUES ("'.$dishname[$i].'",NULL,"'.$image[$i].'",'.$dishtypeid.',NULL,'.$cateringid.')';
            querySend($sql);
            $idDishe=mysqli_insert_id($connect);
            $sql='SELECT `name` FROM `SystemAttribute` WHERE ISNULL(isExpire) AND (systemDish_id='.$dishid[$i].')';
            $detailAttributes=queryReceive($sql);
            for($j=0;$j<count($detailAttributes);$j++)
            {


                $sql='INSERT INTO `attribute`(`name`, `id`, `dish_id`, `isExpire`) VALUES ("'.$detailAttributes[$j][0].'",NULL,'.$idDishe.',NULL)';
                querySend($sql);
            }


        }
    }
    else if($_POST['option']=="CreateHall")
    {
        $timestamp = date('Y-m-d H:i:s');
        $companyid=$_POST['companyid'];
        $hallname=$_POST['hallname'];
        $hallimage='';
        if(!empty($_FILES['image']["name"]))
        {
            $hallimage = "../images/hall/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $hallimage);//$dishimage is destination file location;
            if ($resultimage != "")
            {
                print_r($resultimage);
                exit();
            }

            $hallimage =$_FILES['image']['name'];
        }
        $daytime='';
        $parking=0;

        if(isset($_POST['parking']))
        {
            $parking=1;

        }
        $halltype=$_POST['halltype'];
        $capacity=chechIsEmpty($_POST['capacity']);
        $partition=chechIsEmpty($_POST['partition']);
        $address=$_POST['address'];
        $latitude=$_POST['latitude'];
        $longitude=$_POST['longitude'];
        $city=$_POST['city'];
        $country=$_POST['country'];


        $sql='INSERT INTO `location`(`id`, `longitude`, `expire`, `country`, `city`, `latitude`, `active`, `address`) VALUES (NULL,'.$longitude.',NULL,"'.$country.'","'.$city.'","'.$latitude.'","'.$timestamp.'","'.$address.'")';
        querySend($sql);
        $addressid=mysqli_insert_id($connect);




        $sql='INSERT INTO `hall`(`id`, `name`, `max_guests`, `function_per_Day`, `noOfPartitions`, `ownParking`, `expire`, `image`, `hallType`, `location_id`, `company_id`,`active`) VALUES (NULL,"'.$hallname.'",'.$capacity.',"'.$daytime.'",'.$partition.','.$parking.',NULL,"'.$hallimage.'",'.$halltype.','.$addressid.','.$companyid.',"'.$timestamp.'")';
        querySend($sql);
        $hallid=mysqli_insert_id($connect);


        $daytimearray=array("Morning","Afternoon","Evening");
        for($i=0;$i<count($daytimearray);$i++)
        {
            createOnlyAllSeating($hallid,$daytimearray[$i]);
        }

    }
    else if($_POST['option']=='createOnlyseating')
    {
        $hallid=$_POST['hallid'];
        $daytime=$_POST['daytime'];
        createOnlyAllSeating($hallid,$daytime);

    }
    else if($_POST['option']=="CreatePackage")
    {
        /*if($_POST['perivious']!="none")
        {
            $packid=$_POST['perivious'];
            $month=$_POST['month'];
            $daytime=$_POST['daytime'];
            $hallid=$_POST['hallid'];

            $sql='SELECT `id`, `month`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `hall_id`, `package_name` FROM `hallprice` WHERE id='.$packid.'';
            $result=queryReceive($sql);
            $sql='INSERT INTO `hallprice`(`id`, `month`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `hall_id`, `package_name`) VALUES (NULL,"'.$month.'",1,'.$result[0][3].',"'.$result[0][4].'","'.$daytime.'",NULL,'.$hallid.',"'.$result[0][8].'")';
            querySend($sql);
            $last_id=mysqli_insert_id($connect);
            $sql='SELECT `id`, `dishname`, `image`, `expire`, `hallprice_id` FROM `menu` WHERE ISNULL(expire) &&(hallprice_id='.$packid.')';
            $result=queryReceive($sql);
            for($i=0;$i<count($result);$i++)
            {
                $sql='INSERT INTO `menu`(`id`, `dishname`, `image`, `expire`, `hallprice_id`) VALUES (NULL,"'.$result[$i][1].'","'.$result[$i][2].'",NULL,'.$last_id.')';
                querySend($sql);
            }
                exit();
        }*/


        $selectedDatesString=$_POST['selectedDates'];
        $selectedDates=explode (",", $selectedDatesString);
     /*   if(!isset($_POST['dishname']))
        {
            echo "Please Select Dishes ";
            exit();
        }*/
     $MinimumAmount=$_POST['MinimumAmount'];
        $PackagesType=$_POST['PackagesType'];
        $userid=$_POST['userid'];
        $daytime=$_POST['Daytime'];
        $hallid=$_POST['hallid'];
        $packagename=$_POST['packagename'];
        $rate=chechIsEmpty($_POST['rate']);
        $describe=$_POST['describe'];
        $sql='INSERT INTO `packages`(`id`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `hall_id`, `package_name`, `active`, `user_id`, `expireUser`, `minimumAmountBooking`) VALUES (NULL,'.$PackagesType.','.$rate.',"'.$describe.'","'.$daytime.'",NULL,'.$hallid.',"'.$packagename.'","'.$timestamp.'",'.$userid.',NULL,'.$MinimumAmount.')';
        querySend($sql);
        $id=mysqli_insert_id($connect);
        for ($i=0;$i<count($selectedDates);$i++)
        {
           $date=date('Y-m-d ',strtotime(trim($selectedDates[$i])));
            $sql = 'INSERT INTO `packageDate`(`id`, `active`, `expire`, `package_id`, `user_id`, `expireUser`, `selectedDate`) VALUES (NULL,"' . $timestamp . '",NULL,' . $id . ',' . $userid . ',NULL,"' .$date.'")';
            querySend($sql);
        }
            $dishnames=array();
            $image=array();
        if(isset($_POST['dishname']))
        {

            $dishnames=$_POST['dishname'];
            $image=$_POST['image'];
        }
        for ($i=0;($i<count($dishnames))&&($PackagesType==1);$i++)
        {
            $sql='INSERT INTO `menu`(`id`, `dishname`, `image`, `expire`, `package_id`) VALUES (NULL,"'.$dishnames[$i].'","'.$image[$i].'",NULL,'.$id.')';
            querySend($sql);
        }

    }
    else if($_POST['option']=="showdaytimelist")
    {



    }
    else if($_POST['option']=="changeSeating")
    {

        $timestamp = date('Y-m-d H:i:s');
        $packageid=$_POST['packageid'];
        $value=chechIsEmpty($_POST['value']);
        $sql='UPDATE `hallprice` SET expire="'.$timestamp.'" WHERE id='.$packageid.'';
        querySend($sql);
        $sql='SELECT `id`, `month`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `hall_id`, `package_name` FROM `hallprice` WHERE id='.$packageid.'';
        $detailPack=queryReceive($sql);
        $sql='INSERT INTO `hallprice`(`id`, `month`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `hall_id`, `package_name`) VALUES (NULL,"'.$detailPack[0][1].'",0,'.$value.',"'.$detailPack[0][4].'","'.$detailPack[0][5].'",NULL,'.$detailPack[0][7].',"'.$detailPack[0][8].'")';
        querySend($sql);
       
    }
    else if($_POST['option']=="ExpireBtn")
    {

        $packageid=$_POST['packageid'];
        $expirevalue=$_POST['expirevalue'];

        if($expirevalue=="Click Expire")
        {
            $dayAndTime=date('Y-m-d H:i:s');
            $sql='UPDATE `hallprice` SET expire="'.$dayAndTime.'" WHERE id='.$packageid.'';
        }
        else
        {
            $sql='UPDATE `hallprice` SET expire=NULL WHERE id='.$packageid.'';
        }
        querySend($sql);

    }
    else if($_POST['option']=="packagechange")
    {
        $packageid=$_POST['packageid'];
        $columnname=$_POST['columnname'];
        $value=$_POST['value'];
        $sql='UPDATE hallprice as hp SET hp.'.$columnname.' ="'.$value.'" WHERE hp.id='.$packageid.'';
        querySend($sql);

    }
    else if($_POST['option']=="alreadydishremove")
    {
        $id=$_POST['id'];
        $dayAndTime=date('Y-m-d H:i:s');
        $sql='UPDATE `menu` SET expire="'.$dayAndTime.'" WHERE id='.$id.'';
        querySend($sql);
    }
    else if($_POST['option']=="Extendmenu")
    {
        $packageid=$_POST['packageid'];
        if(!isset($_POST['dishname']))
        {
            exit();
        }
        $dishnames=$_POST['dishname'];
        $image=$_POST['image'];

        for($i=0;$i<count($dishnames);$i++)
        {
            $sql='INSERT INTO `menu`(`id`, `dishname`, `image`, `expire`, `hallprice_id`) VALUES (NULL,"'.$dishnames[$i].'","'.$image[$i].'",NULL,'.$packageid.')';
            querySend($sql);
        }

    }
    else if($_POST['option']=="checkpackages1")
    {
        $monthno=$_POST['month'];
        $date=$_POST['date'];
        $time=$_POST['time'];
        $perheadwith=$_POST['perheadwith'];
        $hallid=$_POST['hallid'];
        $monthsArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $month=$monthsArray[$monthno];
        $sql='SELECT `id`, `package_name`,`price`,`describe` FROM `hallprice` WHERE ISNULL(expire) AND (month="'.$month.'") AND (dayTime="'.$time.'") And (isFood='.$perheadwith.') AND (hall_id='.$hallid.')';
        $detailpackage=queryReceive($sql);
        if(($perheadwith==1)&&(!(count($detailpackage)>0)))
        {
            exit();
        }

        $display='<h3 align="center">Packages Detail </h3>';
        if($perheadwith==1)
        {
            //with food menu

            for ($i=0;$i<count($detailpackage);$i++)
            {
                $display.=' <div class="checkclasshas custom-control custom-radio form-group  ">
        <input type="radio" data-describe="'.$detailpackage[$i][0].'" value="'.$detailpackage[$i][0].'" class="changeradio custom-control-input" id="defaultUnchecked'.$i.'" name="defaultExampleRadios">
        <label class="custom-control-label" for="defaultUnchecked'.$i.'">'.$detailpackage[$i][1].'  package with Rs='.$detailpackage[$i][2].' price</label>
    </div> 
     <input hidden id="selectpricefix'.$detailpackage[$i][0].'" type="number" value="'.$detailpackage[$i][2].'">
    <input hidden id="describe'.$detailpackage[$i][0].'" type="text" value="'.$detailpackage[$i][3].'">';
            }





        }
        else
        {
            //with seating menu
            $display.=' <div class="checkclasshas custom-control custom-radio form-group ">
        <input type="radio"   value="'.$detailpackage[0][0].'"  class="custom-control-input" id="defaultUnchecked" name="defaultExampleRadios" checked>
        <label class="custom-control-label" for="defaultUnchecked"> Only Seating price = '.$detailpackage[0][2].'</label>
        <input hidden id="selectpricefix'.$detailpackage[0][0].'" type="number" value="'.$detailpackage[0][2].'">
    </div>';

        }
        if($time=="Morning")
        {
            $time="09:00:00";
        }
        else if($time=="Afternoon")
        {

            $time="12:00:00";
        }
        else {

            $time="18:00:00";
        }
        $sql='SELECT id FROM orderDetail as od WHERE (od.booking_date= "'.$date.'") AND (od.destination_time="'.$time.'") AND (od.status_hall="Running") AND (od.hall_id='.$hallid.')';
        $detailhalls=queryReceive($sql);
        if(count($detailhalls)>0)
        {
            $display.='<h4 class="btn-outline-danger">Already '.count($detailhalls).' function has booked</h4>';
            for ($i=0;$i<count($detailhalls);$i++)
            {
                $display.='<p>'.($i+1).' function booked with '.$detailhalls[$i][0].' Guests</p>';
            }
        }
        echo $display;


    }
    else if($_POST['option']=="viewmenu")
    {
        $packageid=$_POST['packageid'];
        $sql='SELECT `dishname`, `image` FROM `menu` WHERE (hallprice_id='.$packageid.') AND ISNULL(expire)';
        $menu=queryReceive($sql);
        $display='<h4 align="center" class="col-12">Menu</h4>';
        for ($i=0;$i<count($menu);$i++)
        {
            $display.='
            <div  class="col-3 alert-danger shadow border m-2 form-group rounded" style="height: 30vh;" >
                <img src="'.$menu[$i][1].'" class="col-12 " style="height: 15vh">
                <p class="col-form-label" class="form-control col-12">'.$menu[$i][0].'</p>
            </div>';
        }
        echo $display;
    }
    else if($_POST['option']=="createOrderofHall")
    {
        $packageid='';
            if(isset($_POST['packageid']))
                $packageid=$_POST['packageid'];
            $hallid=$_POST['hallid'];
            $userid=$_POST['userid'];
            $personid=$_POST['personid'];
            $guests=chechIsEmpty($_POST['guests']);
            $date=$_POST['date'];
            $time=$_POST['time'];
            $perheadwith=$_POST['perheadwith'];
            $describe=$_POST['describe'];
            $totalamount=chechIsEmpty($_POST['totalamount']);
            $currentdate=date('Y-m-d');
            $Discount=chechIsEmpty($_POST['Discount']);
            $Charges=chechIsEmpty($_POST['Charges']);
            if($time=="Morning")
            {
                $time="09:00:00";
            }
            else if($time=="Afternoon")
            {

                $time="12:00:00";
            }
            else
                {
                $time = "18:00:00";
            }

            $cateringid="NULL";
            $catering="NULL";
            if($perheadwith==1)
            {
                $catering="'Running'";
                $cateringid=$_POST['cateringid'];
            }
            $sql='INSERT INTO `orderDetail`(`id`, `hall_id`, `catering_id`, `hallprice_id`, `user_id`, `person_id`, 
        `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, 
        `status_catering`,`describe`, `address`, `location_id`, `discount`, `extracharges`) 
        VALUES (NULL,'.$hallid.','.$cateringid.','.$packageid.','.$userid.','.$personid.','.$totalamount.','.$guests.',"Running","'.$date.'","'.$currentdate.'",
        "'.$time.'",'.$catering.',"'.$describe.'",NULL,NULL,'.$Discount.','.$Charges.')';
            querySend($sql);
            $_SESSION['order']=mysqli_insert_id($connect);

    }
    else if($_POST['option']=="Edithallorder")
    {
        $order=$_POST['order'];
        $packageid='';
        if(isset($_POST['packageid']))
            $packageid=$_POST['packageid'];
        $guests=chechIsEmpty($_POST['guests']);
        $date=$_POST['date'];
        $time=$_POST['time'];
        $perheadwith=$_POST['perheadwith'];

        $cateringid='NULL';
        if(isset($_POST['cateringid']) &&($perheadwith==1))
        {
            $cateringid=$_POST['cateringid'];
        }

        $describe=$_POST['describe'];
        $totalamount=chechIsEmpty($_POST['totalamount']);
        $Discount=chechIsEmpty($_POST['Discount']);
        $Charges=chechIsEmpty($_POST['Charges']);
        $catering="";
        if($time=="Morning")
        {
            $time="09:00:00";
        }
        else if($time=="Afternoon")
        {

            $time="12:00:00";
        }
        else if($time=="Evening")
        {

            $time="18:00:00";
        }
        $orderStatus=$_POST['orderStatus'];
        if($perheadwith==0)
        {
            //just cancel of catering /../
            $catering="Cancel";
        }
        else
            {
                $catering=$orderStatus;
            }
        $branchOrder=$_POST['branchOrder'];
        $userid=$_POST['userid'];


        $timestamp = date('Y-m-d H:i:s');


        if(checkChangeHallOrder($order,$packageid,$cateringid,$date,$time,$perheadwith,$guests,$orderStatus,$totalamount,$branchOrder,$describe,$catering,$timestamp,NULL,$Charges,$Discount))
        {
            $sql='UPDATE `orderDetail` SET `catering_id`='.$cateringid.',`hallprice_id`='.$packageid.',
`total_amount`='.$totalamount.',`total_person`='.$guests.',`status_hall`
="'.$orderStatus.'",`destination_date`="'.$date.'",`destination_time`="'.$time.'",
`status_catering`="'.$catering.'",`describe`="'.$describe.'" , `hall_id`='.$branchOrder.',`user_id`='.$userid.',`discount`='.$Discount.',`extracharges`='.$Charges.'
WHERE  id='.$order.'';
            querySend($sql);
        }
    }
    else if($_POST['option']=="halledit")
    {
        $hallid=$_POST['hallid'];
        $hallname=$_POST['hallname'];
        $hallimage=$_POST['previousimage'];
        if(!empty($_FILES['image']["name"]))
        {
            $hallimage = "../images/hall/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $hallimage);//$dishimage is destination file location;
            if ($resultimage != "")
            {
                print_r($resultimage);
                exit();
            }

            $hallimage =$_FILES['image']['name'];
        }
        $daytime='';
        $parking=0;

        if(isset($_POST['parking']))
        {
            $parking=1;

        }
        $timestamp = date('Y-m-d H:i:s');
        $halltype=$_POST['halltype'];
        $capacity=chechIsEmpty($_POST['capacity']);
        $partition=chechIsEmpty($_POST['partition']);

        $address=$_POST['address'];
        $latitude=$_POST['latitude'];
        $longitude=$_POST['longitude'];
        $city=$_POST['city'];
        $country=$_POST['country'];
        $previousaddress=$_POST['previousaddress'];
        $previousaddressid=$_POST['previousaddressid'];
        if($previousaddress!=$address)
        {

            $sql='UPDATE `location` SET expire="'.$timestamp.'"  WHERE id='.$previousaddressid.'';
            querySend($sql);
            $sql='INSERT INTO `location`(`id`, `longitude`, `expire`, `country`, `city`, `latitude`, `active`, `address`) VALUES (NULL,'.$longitude.',NULL,"'.$country.'","'.$city.'","'.$latitude.'","'.$timestamp.'","'.$address.'")';
            querySend($sql);
            $addressid=mysqli_insert_id($connect);
            $previousaddressid=$addressid;
        }

        $sql='UPDATE `hall` SET `name`="'.$hallname.'",`max_guests`='.$capacity.',`noOfPartitions`='.$partition.',`ownParking`='.$parking.',`image`="'.$hallimage.'",`hallType`='.$halltype.',`location_id`='.$previousaddressid.' WHERE id='.$hallid.'';
        querySend($sql);
    }
    else if($_POST['option']=="cateringedit")
    {
        $cateringid=$_POST['cateringid'];
        $cateringname=$_POST['cateringname'];
        $cateringimage=$_POST['previousimage'];
        if(!empty($_FILES['image']["name"]))
        {
            $cateringimage = "../images/catering/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $cateringimage);//$dishimage is destination file location;
            if ($resultimage != "")
            {
                print_r($resultimage);
                exit();
            }

            $cateringimage = $_FILES['image']['name'];

        }
        $sql='UPDATE `catering` SET `name`="'.$cateringname.'",`image`="'.$cateringimage.'" WHERE id='.$cateringid.'';
        querySend($sql);
    }
    else if($_POST['option']=="formDishadd")
    {

        $dishname=chechIsEmpty($_POST['dishname']);
        $dishimage='';
        if(!empty($_FILES['image']["name"]))
        {
            $dishimage = "../images/dishImages/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $dishimage);//$dishimage is destination file location;
            if ($resultimage != "") {
                print_r($resultimage);
                exit();
            }
            $dishimage =$_FILES['image']['name'];
        }
       /* $sql='INSERT INTO `systemDish`(`name`, `id`, `image`, `isExpire`, `systemDishType_id`) VALUES ("'.$dishname.'",NULL,"'.$dishimage.'",NULL,NULL)';
        querySend($sql);*/
       $userid=$_POST['userid'];
       $companyid=$_POST['$companyid'];
       $sql='INSERT INTO `systemItem`(`id`, `image`, `active`, `expire`, `user_id`, `company_id`, `name`) VALUES (NULL,"'.$dishimage.'","'.$timestamp.'",NULL,'.$userid.','.$companyid.',"'.$dishname.'")';
        querySend($sql);
       // $sql = 'SELECT `name`, `id`, `image` FROM `systemDish` WHERE ISNULL(isExpire) ';
        $sql='SELECT  `name`,`id`, `image` FROM `systemItem` WHERE (ISNULL(expire))AND(company_id='.$companyid.')';
        echo dishesOfPakage($sql);

    }
    else if($_POST['option']=="Showdishessystem")
    {
        $sql = 'SELECT `name`, `id`, `image` FROM `systemDish` WHERE ISNULL(isExpire) ';
        echo dishesOfPakage($sql);

    }
    else if($_POST['option']=="commentAdd")
    {
        $hallid=$_POST['hallid'];
        $comments=$_POST['comment'];
        $email=$_POST['email'];
        $currentdatetime=date('Y-m-d H:i:s');
        $sql='INSERT INTO `comments`(`hall_id`, `catering_id`, `id`, `comment`, `email`, `datetime`, `expire`) VALUES ('.$hallid.',NULL,NULL,"'.$comments.'","'.$email.'","'.$currentdatetime.'",NULL)';
        querySend($sql);
    }
    else if($_POST['option']=="dishpredict")
    {
        $companyid=$_POST['companyid'];
        $dishname=$_POST['dishname'];
        $sql='SELECT  `name`,`id`, `image` FROM `systemItem` WHERE (ISNULL(expire))AND(company_id='.$companyid.') AND(name LIKE "%'.$dishname.'%")';
        //$sql='SELECT `name`, `id`, `image` FROM `systemDish` WHERE ISNULL(isExpire) AND name LIKE "%'.$dishname.'%"';
        echo dishesOfPakage($sql);
    }



}
?>