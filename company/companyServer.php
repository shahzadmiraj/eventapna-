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
        $sql='SELECT u.id FROM user as u WHERE (u.password="'.$password.'") AND (u.username="'.$username.'")';
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
        $isowner=1;
        $cnic = $_POST['cnic'];
        $city = $_POST['city'];
        $area = $_POST['area'];
        $streetNo = chechIsEmpty($_POST['streetNo']);
        $houseNo = chechIsEmpty($_POST['houseNo']);
        $date = date('Y-m-d');
        $sql='INSERT INTO `person`(`name`, `cnic`, `id`, `date`, `image`) VALUES ("'.$name.'","'.$cnic.'",NULL,"'.$date.'","'.$image.'")';
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
        $sql='INSERT INTO `user`(`id`, `username`, `password`, `person_id`, `isExpire`,`isowner`, `company_id`) VALUES (NULL,"'.$username.'","'.$password.'",'.$customerId.',NULL,"'.$isowner.'",NULL)';
        querySend($sql);
        $userid = mysqli_insert_id($connect);

        $sql='INSERT INTO `company`(`id`, `name`, `expire`, `user_id`) VALUES (NULL,"'.$_POST['companyName'].'",NULL,'.$userid.')';
        querySend($sql);
        $companyid=mysqli_insert_id($connect);

        $sql='UPDATE user as u SET u.company_id='.$companyid.' WHERE u.id='.$userid.'';
        querySend($sql);

        setcookie('userid',$userid , time() + (86400 * 30), "/");
        setcookie("isOwner",1,time() + (86400 * 30), "/");
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
        $sql='INSERT INTO `catering`(`id`, `name`, `expire`, `image`, `location_id`, `company_id`) VALUES (NULL,"'.$namecatering.'",NULL,"'.$Cateringimage.'",NULL,'.$companyid.')';
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
        $sql='INSERT INTO `hall`(`id`, `name`, `max_guests`, `function_per_Day`, `noOfPartitions`, `ownParking`, `expire`, `image`, `hallType`, `location_id`, `company_id`) VALUES (NULL,"'.$hallname.'",'.$capacity.',"'.$daytime.'",'.$partition.','.$parking.',NULL,"'.$hallimage.'",'.$halltype.',NULL,'.$companyid.')';
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
        if($_POST['perivious']!="none")
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
        }


        if(!isset($_POST['dishname']))
        {
            exit();
        }
        $dishnames=$_POST['dishname'];
        $image=$_POST['image'];
        $month=$_POST['month'];
        $daytime=$_POST['daytime'];
        $hallid=$_POST['hallid'];
        $packagename=$_POST['packagename'];
        $rate=chechIsEmpty($_POST['rate']);
        $describe=$_POST['describe'];
        $sql='INSERT INTO `hallprice`(`id`, `month`, `isFood`, `price`, `describe`, `dayTime`, `expire`, `hall_id`, `package_name`) VALUES (NULL,"'.$month.'",1,'.$rate.',"'.$describe.'","'.$daytime.'",NULL,'.$hallid.',"'.$packagename.'")';
        querySend($sql);
        $id=mysqli_insert_id($connect);
        for ($i=0;$i<count($dishnames);$i++)
        {
            $sql='INSERT INTO `menu`(`id`, `dishname`, `image`, `expire`, `hallprice_id`) VALUES (NULL,"'.$dishnames[$i].'","'.$image[$i].'",NULL,'.$id.')';
            querySend($sql);
        }
    }
    else if($_POST['option']=="showdaytimelist")
    {

        $hallname=$_POST['hallname'];
        $hallid=$_POST['hallid'];
        $encodehallid=base64url_encode($hallid);

        $daytime=$_POST['daytime'];
        $companyid=$_POST['companyid'];
        $monthsArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

        $display='<table class="col-12 border-white border">
        <thead>

        <tr>
            <th scope="col" >
                <h4 align="center"><i class="fas fa-list-ol mr-3"></i>'.$daytime.' Prize list</h4>
            </th>
        </tr>
        </thead>
        <tbody>';
        for($i=0;$i<count($monthsArray);$i++)
        {
            $sql='SELECT `id`,`price` FROM `hallprice` WHERE (hall_id='.$hallid.')AND (isFood=0) AND (dayTime="'.$daytime.'") AND ISNULL(expire)
AND (month="'.$monthsArray[$i].'")';
            $detailList=queryReceive($sql);
            $display.='
        <tr>
            <td scope="col" >
                <h4 align="center">'.$monthsArray[$i].'</h4>
                <div class="alert-light col-12 card">
                
                
               
                
                <div class="form-group row col-12 p-0 ">
                         <label class="col-form-label col-4"> Prize Only Seating </label>
                        <div class="input-group  input-group-lg col-8">
                            <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                            </div>
                             <input data-menuid="'.$detailList[0][0].'" class="changeSeating form-control" type="number" value="'.$detailList[0][1].'">
                        </div>

                 </div>

                   
                   
                   
                   
                   
                    <h3 align="center" class="col-12 mt-3">List of packages with Food</h3>
                    <a  href="addnewpackage.php?hallname='.$hallname.'&month='.$monthsArray[$i].'&daytime='.$daytime.'&hall='.$encodehallid.'" class="form-control  btn-primary col-12 text-center"><i class="fas fa-plus-square"></i> Add New Package</a>
                    
                    
                    
                    <div class="form-group row ">';

            $sql='SELECT `id`,`expire`, `package_name` FROM `hallprice` WHERE (hall_id='.$hallid.')
AND (dayTime="'.$daytime.'") AND (month="'.$monthsArray[$i].'") AND (isFood=1)AND ISNULL(expire)';
            $ALLpackages=queryReceive($sql);
            for ($j=0;$j<count($ALLpackages);$j++)
            {

                if($ALLpackages[$j][1]!="")
                {
                    $display.= '<a href="?editpackage=yes&hallname='.$hallname.'&month='.$monthsArray[$i].'&daytime='.$daytime.'&packageid='.$ALLpackages[$j][0].'&hall='.$hallid.'" class="btn btn-danger col-sm-4 col-md-3 col-xl-3 m-1">'.$ALLpackages[$j][2].'</a>';

                }
                else
                {
                    $display.= '<a href="?editpackage=yes&hallname='.$hallname.'&month='.$monthsArray[$i].'&daytime='.$daytime.'&packageid='.$ALLpackages[$j][0].'&hall='.$hallid.'" class="btn btn-warning col-sm-4 col-md-3 col-xl-3 m-1">'.$ALLpackages[$j][2].'</a>';
                }



            }


            $display.='</div></div>
            </td>
        </tr>';


        }
        $display.='
        </tbody>
    </table>';
        echo $display;

    }
    else if($_POST['option']=="changeSeating")
    {
        $packageid=$_POST['packageid'];
        $value=chechIsEmpty($_POST['value']);
        $sql='UPDATE `hallprice` SET price='.$value.' WHERE id='.$packageid.'';
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
    <input hidden id="describe'.$detailpackage[$i][0].'" type="text" value="'.$detailpackage[$i][3].'">';
            }





        }
        else
        {
            //with seating menu
            $display.=' <div class="checkclasshas custom-control custom-radio form-group ">
        <input type="radio"  value="'.$detailpackage[0][0].'" class="custom-control-input" id="defaultUnchecked" name="defaultExampleRadios" checked>
        <label class="custom-control-label" for="defaultUnchecked"> Only Seating price = '.$detailpackage[0][2].'</label>
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
        $sql='SELECT id FROM orderDetail as od WHERE (od.booking_date= "'.$date.'") AND (od.destination_time="'.$time.'") AND (od.sheftHall="Running") AND (od.hall_id='.$hallid.')';
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
            if($time=="Morning")
            {
                $time="9:00";
            }
            else if($time=="Afternoon")
            {

                $time="12:00";
            }
            else {

                    $time="18:00";
                }


            $catering="";
            $notice="";
            if($perheadwith==1)
            {
                $catering="Running";
                $notice="alert";
            }
            $sql='INSERT INTO `orderDetail`(`id`, `hall_id`, `catering_id`, `hallprice_id`, `user_id`, 
        `sheftCatering`, `sheftHall`, `sheftCateringUser`, `sheftHallUser`, `address_id`, `person_id`, 
        `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, 
        `status_catering`, `notice`,`describe`) 
        VALUES (NULL,'.$hallid.',NULL,'.$packageid.','.$userid.',NULL,
        NULL,NULL,NULL,NULL,'.$personid.','.$totalamount.','.$guests.',"Running","'.$date.'","'.$currentdate.'",
        "'.$time.'","'.$catering.'","'.$notice.'","'.$describe.'")';
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
        $catering="";
        $notice="";
        if($time=="Morning")
        {
            $time="9:00:00";
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
            $notice="";
        }
        else
            {
                $catering=$orderStatus;
                if($catering=="Running")
                $notice="alert";
            }
        $sql='UPDATE `orderDetail` SET `catering_id`='.$cateringid.',`hallprice_id`='.$packageid.',
`total_amount`='.$totalamount.',`total_person`='.$guests.',`status_hall`
="'.$orderStatus.'",`destination_date`="'.$date.'",`destination_time`="'.$time.'",
`status_catering`="'.$catering.'",`notice`="'.$notice.'",`describe`="'.$describe.'" 
WHERE  id='.$order.'';
        querySend($sql);
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
        $halltype=$_POST['halltype'];
        $capacity=chechIsEmpty($_POST['capacity']);
        $partition=chechIsEmpty($_POST['partition']);
        $sql='UPDATE `hall` SET `name`="'.$hallname.'",`max_guests`='.$capacity.',`noOfPartitions`='.$partition.',`ownParking`='.$parking.',`image`="'.$hallimage.'",`hallType`='.$halltype.' WHERE id='.$hallid.'';
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
        $sql='INSERT INTO `systemDish`(`name`, `id`, `image`, `isExpire`, `systemDishType_id`) VALUES ("'.$dishname.'",NULL,"'.$dishimage.'",NULL,NULL)';
        querySend($sql);
        $sql = 'SELECT `name`, `id`, `image` FROM `systemDish` WHERE ISNULL(isExpire) ';
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
        $dishname=$_POST['dishname'];
        $sql='SELECT `name`, `id`, `image` FROM `systemDish` WHERE ISNULL(isExpire) AND name LIKE "%'.$dishname.'%"';
        echo dishesOfPakage($sql);
    }



}
?>