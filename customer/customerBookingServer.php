<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-03
 * Time: 17:20
 */

include_once ("../connection/connect.php");

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
        $company_id=$_POST['companyid'];





$sql='INSERT INTO `person`(`name`, `cnic`, `id`, `image`, `active`, `expire`, `address`,`company_id`) VALUES ("'.$name.'","'.$cnic.'",NULL,"'.$image.'","'.$timestamp.'",NULL,"'.$address.'",'.$company_id.')';

        querySend($sql);
        $last_id = mysqli_insert_id($connect);

        for ($i = 0; $i < count($numberArray); $i++)
        {
            $sql='INSERT INTO `number`(`number`, `id`, `person_id`, `active`, `expire`, `userActive`, `userExpire`) VALUES ("'.trim($numberArray[$i]).'",NULL,'.$last_id.',"'.$timestamp.'",NULL,'.$userid.',NULL)';
            querySend($sql);
        }
        $customerId = $last_id;

       $token= uniqueToken('BookingProcess');
       $cateringid=$_POST['cateringid'];
       $hallid=$_POST['hallid'];
        $sql="";
        $redirectPage='';
       if($cateringid!='No')
       {

           $sql='INSERT INTO `BookingProcess`(`id`, `TokenString`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id`) VALUES (NULL,"'.$token.'",'.$cateringid.',NULL,1,NULL,"'.$timestamp.'",'.$customerId.')';

           $redirectPage='"../order/orderCreate.php';
       }
       else if($hallid!="No")
       {

           $sql='INSERT INTO `BookingProcess`(`id`, `TokenString`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id`) VALUES (NULL,"'.$token.'",NULL,'.$hallid.',1,NULL,"'.$timestamp.'",'.$customerId.')';
           $redirectPage='"../company/hallBranches/hallorder.php';
       }
       querySend($sql);
        $last_id = mysqli_insert_id($connect);

        $redirectPage.='?pid='.$last_id.'&tokenid='.$token.'"';
        echo $redirectPage;

    }
    else  if($_POST['option']=="checkExistByChange")
    {
             $value=$_POST['value'];
             $company_id=$_POST['company_id'];
            //$sql='SELECT  n.person_id FROM number as n WHERE n.number="'.$value.'"';
        $sql='SELECT p.id FROM person as p INNER JOIN 
number as n
on (p.id=n.person_id)
WHERE
(n.number="'.$value.'")AND(p.company_id='.$company_id.')AND (ISNULL(p.expire))AND(ISNULL(n.expire))';
        $customerexist=queryReceive($sql);
            if(count($customerexist)>0)
            {
                echo 1;
            }
    }

    else  if($_POST['option']=="checkExistByKeyUp")
    {
        $display='';
        $value=trim($_POST['value']);
        if($value=="")
            exit();
        $company_id=$_POST['company_id'];
        //$sql='SELECT  n.person_id FROM number as n WHERE n.number="'.$value.'"';
        $sql='SELECT p.id,p.name,n.number FROM person as p INNER JOIN 
number as n
on (p.id=n.person_id)
WHERE
(n.number like "%'.$value.'%")AND(p.company_id='.$company_id.')AND (ISNULL(p.expire))AND(ISNULL(n.expire)) limit 5';
        $customerexist=queryReceive($sql);
       for($i=0;$i<count($customerexist);$i++)
       {
           $display.='
            <li><a href="#" data-number="'.$customerexist[$i][0].'" class="rightNumber"><i class="mr-2">'.$customerexist[$i][2].'</i> '.$customerexist[$i][1].'</a></li>';
       }
       echo $display;
    }
    else if($_POST['option']=="RightPerson")
    {
        $customerId = $_POST['id'];
        $token= uniqueToken('BookingProcess');
        $cateringid=$_POST['cateringid'];
        $hallid=$_POST['hallid'];
        $sql="";
        $redirectPage='';
        if($cateringid!='No')
        {

            $sql='INSERT INTO `BookingProcess`(`id`, `TokenString`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id`) VALUES (NULL,"'.$token.'",'.$cateringid.',NULL,1,NULL,"'.$timestamp.'",'.$customerId.')';

        }
        else if($hallid!="No")
        {

            $sql='INSERT INTO `BookingProcess`(`id`, `TokenString`, `catering_id`, `hall_id`, `IsProcessComplete`, `orderDetail_id`, `active`, `person_id`) VALUES (NULL,"'.$token.'",NULL,'.$hallid.',1,NULL,"'.$timestamp.'",'.$customerId.')';
        }
        querySend($sql);
        $last_id = mysqli_insert_id($connect);
        $redirectPage='"customerEdit.php';
        $redirectPage.='?pid='.$last_id.'&tokenid='.$token.'"';
        echo $redirectPage;

    }


?>