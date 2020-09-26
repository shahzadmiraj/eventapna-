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
        $parking=$_POST['parking'];

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

        $hallManager=$_POST['hallManager'];
        $AdvanceAmount=$_POST['AdvanceAmount'];
        $token=uniqueToken("hall");
        $userid=$_POST['userid'];



        $sql='INSERT INTO `hall`(`id`, `name`, `max_guests`, `noOfPartitions`, `ownParking`, `expire`, `image`, `hallType`, `location_id`, `company_id`,`active`, `token`, `AdvancePercentage`) VALUES (NULL,"'.$hallname.'",'.$capacity.','.$partition.','.$parking.',NULL,"'.$hallimage.'",'.$halltype.','.$addressid.','.$companyid.',"'.$timestamp.'","'.$token.'",'.$AdvanceAmount.')';
        querySend($sql);

       $hallid=mysqli_insert_id($connect);

        $sql='INSERT INTO `BranchesJobStatus`(`id`, `hall_id`, `catering_id`, `ActiveUserId`, `ExpireUserId`, `ActiveDate`, `ExpireDate`, `WorkingStatus`, `user_id`) VALUES (NULL,'.$hallid.',NULL,'.$userid.',NULL,"'.$timestamp.'",NULL,"Manager",'.$hallManager.')';
        querySend($sql);


    }
    else if($_POST['option']=="alreadydishremove")
    {
        $id=$_POST['id'];
        $dayAndTime=date('Y-m-d H:i:s');
        $sql='UPDATE `menu` SET expire="'.$dayAndTime.'" WHERE id='.$id.'';
        querySend($sql);
    }

    else if($_POST['option']=="viewmenu")
    {
        $packageDateid=$_POST['packageid'];
        $sql='SELECT p.id FROM packageDate as pd INNER join packages as p
on (p.id=pd.package_id)
WHERE
(pd.id='.$packageDateid.')';
        $packagedetail=queryReceive($sql);
        if(count($packagedetail)==0)
            exit();


        $sql='SELECT `id`, `itemname`,`itemtype` FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$packagedetail[0][0].') GROUP BY itemtype';
        $MenuType=queryReceive($sql);
        $OneD = array_column($MenuType, 2);
        $List = implode(', ', $OneD);


        $display='';

        if(count($MenuType)>0)
        {
            $display = "<h3 class='text-center'>Choices of items in package</h3>
                    <input type='text'  hidden name='MenuTypeInpackages' id='MenuTypeInpackages' value='".$List."'>
                    ";

        }
        for($i=0;$i<count($MenuType);$i++)
        {



            $display.='
                                     
         <div class="form-group row">
            <label class="col-form-label">Select One <span>'.$MenuType[$i][2].'</span> Item type  </label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-utensils"></i></span>
                </div>
                <select id="'.$MenuType[$i][2].'"   name="'.$MenuType[$i][2].'" class="form-control MenuTypeOptionChanges">
                                     
                                     ';

            $sql='SELECT `id`, `itemname`,`itemtype`,`price` FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$packagedetail[0][0].')AND (itemtype="'.$MenuType[$i][2].'")';
            $MenuName=queryReceive($sql);
            for($k=0;$k<count($MenuName);$k++)
            {
                $display.='  <option data-price="'.$MenuName[$k][3].'"  value="'.$MenuName[$k][0].'">Item Name:'.$MenuName[$k][1].' with Price: '.$MenuName[$k][3].'    </option>';
            }

            $display.='</select>
            </div>
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

            $sql='INSERT INTO `orderDetail`(`id`, `hall_id`, `catering_id`, `packageDate_id`, `user_id`, `person_id`, 
        `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, 
        `status_catering`,`describe`, `address`, `location_id`, `discount`, `extracharges`) 
        VALUES (NULL,'.$hallid.','.$cateringid.','.$packageid.','.$userid.','.$personid.','.$totalamount.','.$guests.',"Running","'.$date.'","'.$currentdate.'",
        "'.$time.'",'.$catering.',"'.$describe.'",NULL,NULL,'.$Discount.','.$Charges.')';
            querySend($sql);
            $pid=$_POST['pid'];
            $token=$_POST['token'];
            $last=mysqli_insert_id($connect);
$sql='UPDATE BookingProcess as bp SET bp.orderDetail_id='.$last.'  WHERE (bp.id='.$pid.')AND(bp.token="'.$token.'")';
querySend($sql);

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
            $sql='UPDATE `orderDetail` SET `catering_id`='.$cateringid.',`packageDate_id`='.$packageid.',
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
        $parking=$_POST['parking'];
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





        $PreviousManagerId=$_POST['PreviousManagerId'];
        $BranchesJobStatusManagerId=$_POST['BranchesJobStatusManagerId'];
        $currentManager=$_POST['currentManager'];
        $userid=$_POST['userid'];
        if($currentManager!=$PreviousManagerId)
        {
            $sql='UPDATE `BranchesJobStatus` SET ExpireUserId`='.$userid.',`ExpireDate`="'.$timestamp.'"  WHERE id='.$BranchesJobStatusManagerId.'';
            querySend($sql);
            $sql='INSERT INTO `BranchesJobStatus`(`id`, `hall_id`, `catering_id`, `ActiveUserId`, `ExpireUserId`, `ActiveDate`, `ExpireDate`, `WorkingStatus`, `user_id`) VALUES (NULL,'.$hallid.',NULL,'.$userid.',NULL,"'.$timestamp.'",NULL,"Manager",'.$currentManager.')';
            querySend($sql);
        }
        $AdvanceAmount=$_POST['AdvanceAmount'];

        $sql='SELECT `id`, `name`, `max_guests`, `noOfPartitions`, `ownParking`, `expire`, `image`, `hallType`, `location_id`, `company_id`, `active`, `token`, `AdvancePercentage` FROM `hall` WHERE id='.$hallid.'';
        $previousHallDetail=queryReceive($sql);


        if($previousHallDetail[0][1]!=$hallname)
        {
            //name
            $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"hall","name","'.$previousHallDetail[0][1].'",'.$userid.',"'.$timestamp.'",'.$hallid.')';
            querySend($sql);
        }
        if($previousHallDetail[0][2]!=$capacity)
        {
            //max guest
            $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"hall","max_guests","'.$previousHallDetail[0][2].'",'.$userid.',"'.$timestamp.'",'.$hallid.')';
            querySend($sql);
        }
        if($previousHallDetail[0][3]!=$partition)
        {
            //$partition
            $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"hall","noOfPartitions","'.$previousHallDetail[0][3].'",'.$userid.',"'.$timestamp.'",'.$hallid.')';
            querySend($sql);
        }
        if($previousHallDetail[0][4]!=$parking)
        {
            //parking
            $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"hall","ownParking","'.$previousHallDetail[0][4].'",'.$userid.',"'.$timestamp.'",'.$hallid.')';
            querySend($sql);
        }
        if($previousHallDetail[0][6]!=$hallimage)
        {
            //image
            $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"hall","image","'.$previousHallDetail[0][6].'",'.$userid.',"'.$timestamp.'",'.$hallid.')';
            querySend($sql);
        }

        if($previousHallDetail[0][7]!=$halltype)
        {
            //hallType
            $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"hall","hallType","'.$previousHallDetail[0][7].'",'.$userid.',"'.$timestamp.'",'.$hallid.')';
            querySend($sql);
        }
        if($previousHallDetail[0][12]!=$AdvanceAmount)
        {
                //advanceAMount
            $sql='INSERT INTO `HistoryGenaric`(`id`, `table`, `column`, `Value`, `user_id`, `active`,`primaryKeyInTable`) VALUES (NULL,"hall","AdvancePercentage",'.$previousHallDetail[0][12].','.$userid.',"'.$timestamp.'",'.$hallid.')';
            querySend($sql);
        }
        $sql='UPDATE `hall` SET `name`="'.$hallname.'",`max_guests`='.$capacity.',`noOfPartitions`='.$partition.',`ownParking`='.$parking.',`image`="'.$hallimage.'",`hallType`='.$halltype.',`location_id`='.$previousaddressid.',`AdvancePercentage`='.$AdvanceAmount.' WHERE id='.$hallid.'';
        querySend($sql);

    }
    else if($_POST['option']=="Showdishessystem")
    {
        $sql = 'SELECT `name`, `id`, `image` FROM `systemDish` WHERE ISNULL(isExpire) ';
        echo dishesOfPakage($sql);

    }





}
?>