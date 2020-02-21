<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-05
 * Time: 13:39
 */

include_once ("../connection/connect.php");


if(isset($_POST['option']))
{

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
        $image="../images/customerimage/".$_FILES['image']['name'];
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
}

?>