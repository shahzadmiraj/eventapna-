<?php
include_once ('../../../connection/connect.php');



if($_POST['option']=="hallmutiplesimages")
{

    $hallid=$_POST['hallid'];
    $userid=$_POST["userid"];
    $Distination="../../../images/hall/";
    if(isset($_FILES['userfile']))
    {

        $file_array=reArray($_FILES['userfile']);
        for ($i=0;$i<count($file_array);$i++)
        {
            $Distination= $Distination.$file_array[$i]['name'];
            $error=MutipleUploadFile($file_array[$i],$Distination);
            if(count($error)>0)
            {
                echo '<h4 class="badge-danger">'.$file_array[$i]['name'].'.'.$error[0].'</h4>';
            }
            else
            {
               // $sql='INSERT INTO `images`(`id`, `image`, `expire`, `catering_id`, `hall_id`) VALUES (NULL,"'.$file_array[$i]['name'].'",NULL,NULL,'.$hallid.')';

                $sql='INSERT INTO `images`(`id`, `image`, `expire`, `catering_id`, `hall_id`, `active`, `user_id`, `expireUser`) VALUES (NULL,"'.$file_array[$i]['name'].'",NULL,NULL,'.$hallid.',"'.$timestamp.'",'.$userid.',NULL)';
                querySend($sql);
            }

        }

    }

}




?>