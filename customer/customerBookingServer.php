<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-03
 * Time: 17:20
 */

include_once ("../connection/connect.php");




if(isset($_POST['option']))
{
    if($_POST['option']=="customerCreate")
    {
        $image='';

        if(!empty($_FILES['image']["name"]))
        {
            $image = "../images/customerimage/" . $_FILES['image']['name'];
            $resultimage = ImageUploaded($_FILES, $image);//$dishimage is destination file location;
            if ($resultimage != "") {
                print_r($resultimage);
                exit();
            }

            $image =$_FILES['image']['name'];
        }

        $name = trim($_POST['name']);
        $numberArray = $_POST['number'];
        $cnic = chechIsEmpty($_POST['cnic']);
        $city = chechIsEmpty($_POST['city']);
        $area = chechIsEmpty($_POST['area']);
        $streetNo = chechIsEmpty($_POST['streetNo']);
        $houseNo = chechIsEmpty($_POST['houseNo']);
        $date = date('Y-m-d');








        $sql = 'INSERT INTO `person`(`name`, `cnic`, `id`, `date`, `image`,`active`) VALUES ("'.$name.'","'.$cnic.'",NULL,"'.$date.'","'.$image.'","'.$timestamp.'")';
        querySend($sql);
        $last_id = mysqli_insert_id($connect);
        $sql='INSERT INTO `address`(`id`, `address_street_no`, `address_house_no`, `person_id`, `address_city`, `address_town`) VALUES (NULL,"'.$streetNo.'","'.$houseNo.'",'.$last_id.',"'.$city.'","'.$area.'")';
        querySend($sql);
        for ($i = 0; $i < count($numberArray); $i++) {

            $sql='INSERT INTO `number`(`number`, `id`, `is_number_active`, `person_id`) VALUES ("'.$numberArray[$i].'",NULL,1,'.$last_id.')';
            querySend($sql);
        }
        $customerId = $last_id;
        $_SESSION['customer']=$customerId;
    }
    else
    {
        //if($_POST['option']=="customerExist")
        $value=$_POST['value'];
            $sql='SELECT  n.person_id FROM number as n WHERE n.number="'.$value.'"';
            $customerexist=queryReceive($sql);
            if(count($customerexist)>0)
            {
                //echo $customerexist[0][0];
                $_SESSION['customer']=$customerexist[0][0];
                echo "customerexist";
            }
    }
}

?>