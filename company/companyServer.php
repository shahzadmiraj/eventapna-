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


        $sql='SELECT `dishname`, `image` FROM `menu` WHERE (package_id='.$packagedetail[0][0].') AND ISNULL(expire)';
        $menu=queryReceive($sql);
        $display='<h4 align="center" class="col-12">Menu</h4>';
        for ($i=0;$i<count($menu);$i++)
        {
            $img='https://www.salonlfc.com/wp-content/uploads/2018/01/image-not-found-scaled-1150x647.png';

            if((file_exists('../images/dishImages/'.$menu[$i][1]))&&($menu[$i][1]!=""))
                $img='../../images/dishImages/'.$menu[$i][1];

            $display.='
            <div  class="col-md-4 card" >
                <img src="'.$img.'" class="card-img-top" style="height: 15vh">
                <div class="card-header">
                Item Name:'.$menu[$i][0].'
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
    else if($_POST['option']=="Showdishessystem")
    {
        $sql = 'SELECT `name`, `id`, `image` FROM `systemDish` WHERE ISNULL(isExpire) ';
        echo dishesOfPakage($sql);

    }



}
?>