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
       $address=$_POST['address'];
       $userid=$_POST['userid'];






$sql='INSERT INTO `person`(`name`, `cnic`, `id`, `image`, `active`, `expire`, `address`) VALUES ("'.$name.'","'.$cnic.'",NULL,"'.$image.'","'.$timestamp.'",NULL,"'.$address.'")';

        querySend($sql);
        $last_id = mysqli_insert_id($connect);

        for ($i = 0; $i < count($numberArray); $i++)
        {
            $sql='INSERT INTO `number`(`number`, `id`, `person_id`, `active`, `expire`, `userActive`, `userExpire`) VALUES ("'.$numberArray[$i].'",NULL,'.$last_id.',"'.$timestamp.'",NULL,'.$userid.',NULL)';
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