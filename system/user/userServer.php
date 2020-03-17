<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-03
 * Time: 17:20
 */
include_once ("../../connection/connect.php");

$companyid=$_COOKIE['companyid'];
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
            $image = "../../images/users/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $image);//$dishimage is destination file location;
            if ($resultimage != "") {
                print_r($resultimage);
                exit();
            }

            $image =$_FILES['image']['name'];
        }

        $name = trim($_POST['name']);
        $numberArray = $_POST['number'];
        $userType=$_POST['usertype'];
        $cnic = $_POST['cnic'];
        $city = $_POST['city'];
        $area = $_POST['area'];
        $streetNo = chechIsEmpty($_POST['streetNo']);
        $houseNo = chechIsEmpty($_POST['houseNo']);
        $date = date('Y-m-d');
        $sql = 'INSERT INTO `person`(`name`, `cnic`, `id`, `date`, `image`,`active`) VALUES ("'.$name.'","'.$cnic.'",NULL,"'.$date.'","'.$image.'","'.$timestamp.'")';
        querySend($sql);
        $last_id = mysqli_insert_id($connect);
        $sql="INSERT INTO `address` (`id`, `address_street_no`, `address_house_no`, `person_id`, `address_city`, `address_town`) VALUES (NULL, '".$streetNo."', '".$houseNo."', '".$last_id."', '".$city."', '".$area."')";
        querySend($sql);
        for ($i=0;$i<count($numberArray);$i++)
        {

            $sql = "INSERT INTO `number`(`number`, `id`, `is_number_active`, `person_id`) VALUES ('".$numberArray[$i]."',NULL,1,$last_id)";
            querySend($sql);
        }
        $customerId = $last_id;
        $sql='INSERT INTO `user`(`id`, `username`, `password`, `person_id`, `isExpire`,`userType`,`company_id`,`active`) VALUES (NULL,"'.$username.'","'.$password.'",'.$customerId.',NULL,"'.$userType.'",'.$companyid.',"'.$timestamp.'")';
        querySend($sql);

    }
    if($_POST['option']=="change")
    {

        $customerId = $_POST['customerid'];
        $column_name = $_POST['columnname'];
        $text = chechIsEmpty($_POST['value']);
        $number_table = $_POST['edittype'];
        if ($number_table == 1) {
            //address table change
            $sql = 'UPDATE address as a SET a.' . $column_name . '="' . $text . '" WHERE a.person_id=' . $customerId . ' ';
            querySend($sql);
        } else if ($number_table == 2) {
            //person change table change
            $sql = 'UPDATE person as p SET p.' . $column_name . '="' . $text . '" WHERE p.id=' . $customerId . ' ';
            querySend($sql);
        } else if ($number_table == 3) {
            //number table change
            $numberId = $_POST['id'];
            $sql = 'UPDATE number as n SET n.' . $column_name . '="' . $text . '" WHERE (n.person_id=' . $customerId . ') AND (n.id=' . $numberId . ')';
            querySend($sql);
        }


    }
    else if($_POST['option']=="deleteNumber")
    {

        $id=$_POST['id'];
        $sql='DELETE FROM number  WHERE id='.$id.'';
        querySend($sql);
    }
    else if($_POST['option']=="addNumber")
    {

        $customerId = $_POST['customerid'];
        $numberText=$_POST['number'];
        $sql='INSERT INTO `number`(`number`, `id`, `is_number_active`, `person_id`) VALUES ("'.$numberText.'",NULL,1,"'.$customerId.'")';
        querySend($sql);

    }
    else if($_POST['option']=="changeImage")
    {
        $customerid=$_POST['customerid'];
        $previouspath=$_POST['image'];
        $image="../../images/users/".$_FILES['image']['name'];
        $resultimage=ImageUploaded($_FILES,$image);//$dishimage is destination file location;
        if($resultimage!="")
        {
            print_r($resultimage);
            exit();
        }

        $image=$_FILES['image']['name'];
        $sql='UPDATE person as p SET p.image="'.$image.'" WHERE p.id='.$customerid.';';
        querySend($sql);
        if (file_exists($previouspath))
        {
            $deleted = unlink($previouspath);
        }
    }
    else if ($_POST['option']=="authorChange")
    {
        $PreviousUsername=$_POST['PreviousUsername'];
        $Previouspassword=$_POST['Previouspassword'];
        $Previoustype=$_POST['Previoustype'];
        $userid=$_POST['userid'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $password1=$_POST['password1'];
        $userType=$_POST['usertype'];
        if(strlen($username)<5)
        {
            echo "username must be greater then 5 letters";
            exit();
        }

        if(strlen($password)<5)
        {
            echo "Password must be greater then 5 letters";
            exit();
        }
        if($password!=$password1)
        {
            echo "Password does not match";
            exit();
        }
        if($PreviousUsername!=$username)
        {
            $sql = 'SELECT u.id FROM user as u WHERE (u.password="' . $password . '") AND (u.username="' . $username . '")';
            $userExist = queryReceive($sql);
            if (count($userExist) != 0) {
                echo "user is already exist";
                exit();
            }
        }
        $sql='UPDATE `user` SET `username`="'.$username.'",`password`="'.$password.'",`userType`="'.$userType.'" WHERE id='.$userid.'';
        querySend($sql);
        setcookie("usertype",'',time() - (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
        setcookie("usertype",$userType,time() + (86400 * 30), "/",$_SERVER["SERVER_NAME"]);
    }
}
?>