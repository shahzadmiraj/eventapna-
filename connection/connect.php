<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:25
 */
//dish  ../../images/dishImages/" . $_FILES['image']['name'];   https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png
//customer    /images/customerimage/     echo "https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png";
//user     ../../images/users/                      echo "https://www.pavilionweb.com/wp-content/uploads/2017/03/man-300x300.png";
//for image Hall      ../../images/hall/                        $display.='https://thumbs.dreamstime.com/z/wedding-hall-decoration-reception-party-35933352.jpg';
// for catering image ../../images/catering/                $display.='https://www.liberaldictionary.com/wp-content/uploads/2019/02/cater-4956.jpg';
//session are customer,typebranch,branchtypeid,tempid,2ndpage,order
//cookies are userid,username,companyid,userimage,isOwner
//public_html on companyserver.php,header footer
//$OrderStatus=array("Running","Cancel","Delieved","Clear");
//
session_start();
date_default_timezone_set("Asia/Karachi");
//date_default_timezone_get();

$connect=mysqli_connect('localhost',"root","","version2");
//$connect=mysqli_connect("localhost","id10884474_shahzad","11111111","id10884474_a111");
    if(!$connect)
    {
        echo "fail connection";
    }
    if (mysqli_connect_errno())
    {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

 $Root='/public_html/';
$timestamp = date('Y-m-d H:i:s');
function base64url_encode( $data )
{
    $dammy=substr(md5(time()), 0, 6);
    return rtrim( strtr( base64_encode( $data), '+/', '-_'), '=').$dammy;
}
function base64url_decode( $data )
{
    $data=substr($data,0,-6);
    return base64_decode( strtr( $data, '-_', '+/') . str_repeat('=', 3 - ( 3 + strlen( $data )) % 4 ));
}




function queryReceive($sql)
{
    global $connect;
    $result = mysqli_query($connect, $sql);
    if (!$result)
    {
        echo $sql;
        echo("Error description: " . mysqli_error($connect));
    }else
        {
        return mysqli_fetch_all($result);
    }
}


function querySend($sql)
{
    global $connect;
    $result = mysqli_query($connect, $sql);

    if (!$result)
    {
        echo $sql;
        echo("Error description: " . mysqli_error($connect));
    }
}

function checknumberOtherNull($value)
{


    if($value=="")
    {
        $value='NULL';
    }

    return $value;
}

function isSetOtherNULL($value)
{


    if(!isset($value))
    {
        $value='NULL';
    }

    return $value;
}

function chechIsEmpty($value)
{
    if($value=="")
    {
        return 0;
    }
    return $value;
}
function arrayCheckIsEmpty($valuesArray)
{
    for ($a=0;$a<count($valuesArray);$a++)
    {
        if($valuesArray[$a]=="")
        {
            $valuesArray[$a]=0;
        }
    }
    return $valuesArray;
}

function ImageUploaded($File,$DestinationFile)
{
    if(isset($File['image']))//         name=image
    {

        $errors= array();

        $file_size = $File['image']['size'];
        $file_tmp = $File['image']['tmp_name'];
        $file_type = $File['image']['type'];
        $passbyreference=explode('.',$File['image']['name']);
        $file_ext=strtolower(end($passbyreference));

        $extensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size > 30097152)
        {
            $errors[]='File size must be excately  MB';
        }

//        if (file_exists($DestinationFile))
//        {
//            $errors[]= "Sorry, file already exists.";
//        }

        if(empty($errors)==true)
        {
            move_uploaded_file($file_tmp,$DestinationFile);
            return "";
        }else{
             return $errors;
        }
    }
    return "";


}
function showarray($arrays)
{
    echo '<pre>';
    print_r($arrays);
    echo '</pre>';
}
function reArray($file_post)
{
    $file_ary=array();
    $file_count=count($file_post['name']);
    $file_key=array_keys($file_post);
    for ($i=0;$i<$file_count;$i++)
    {
        foreach ($file_key as $key)
        {
            $file_ary[$i][$key]=$file_post[$key][$i];
        }
    }
    return $file_ary;
}

function MutipleUploadFile($File,$DestinationFile)
{
        $errors= array();

        $file_size = $File['size'];
        $file_tmp = $File['tmp_name'];
        $file_type = $File['type'];
        $passbyreference=explode('.',$File['name']);
        $file_ext=strtolower(end($passbyreference));

        $extensions= array("jpeg","jpg","png","mp4");

        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file or MP4 or JPEG.";
        }

        if($file_size > 30097152)
        {
            $errors[]='File size must be excately  MB';
        }

//        if (file_exists($DestinationFile))
//        {
//            $errors[]= "Sorry, file already exists.";
//        }
        if(empty($errors)==true)
        {
            move_uploaded_file($file_tmp,$DestinationFile);
            return $errors;
        }else{
            return $errors;
        }



}
    function showGallery($sql,$destination)
    {
        $result=queryReceive($sql);

        $source='';
        $display='';
        $extensions= array("jpeg","jpg","png");
        for($k=0;$k<count($result);$k++)
        {
            if(file_exists($destination.$result[$k][1]))
            {


                $passbyreference = explode('.', $result[$k][1]);
                $file_ext = strtolower(end($passbyreference));

                if (in_array($file_ext, $extensions) === true) {
                    //image file

                    $display .= '
                        <div class="col-12 col-lg-3 col-md-4 col-xl-3   mb-2 mt-2">
                            <a href="#" class="d-block mb-4 h-100">
                                <img class="img-thumbnail" src="'.$destination.''. $result[$k][1] . '" alt="" style="width:100%;height:60vh">
                            </a>
                        </div>';
                } else {
                    //video file

                    $source = $result[$k][1];
                    $video = substr_replace($source, "", -4);
                    $display .= '
                         
                          <div class="col-lg-4 col-md-6  col-xl-3 col-12 mb-2 mt-2">
                                <div class="embed-responsive embed-responsive-16by9 d-block mb-4 h-100">
                                    <video width="320" height="440" controls class="card"  >
                                        <source src="'.$destination.'' . $video . '.mp4" type="video/mp4">
                                        <source src="'.$destination.'' . $video . '.ogg" type="video/ogg">
                                        Your browser does not support the video tag.
                                    </video>
                                </div>
                           </div>
                         
                         ';
                }
            }


        }
        return $display;


    }

function dishesOfPakage($sql)
{
    $dishdetail = queryReceive($sql);
    $display='';
    for ($j = 0; $j < count($dishdetail); $j++)
    {
        $display.= '
        <div id="dishid' . $dishdetail[$j][1] . '" class="col-4 alert-danger border m-1 form-group p-0" style="height: 30vh;" >
            <img src="';
            if((file_exists('../images/dishImages/'.$dishdetail[$j][2])||file_exists('../../images/dishImages/'.$dishdetail[$j][2]))&&($dishdetail[$j][2]!=""))
            {
                $display.='../../images/dishImages/'.$dishdetail[$j][2];;
            }
            else
            {
                $display.='https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';

            }



            $display.='" class="col-12" style="height: 15vh">
            <p class="col-form-label" class="form-control col-12">' . $dishdetail[$j][0] . '</p>
            <input   data-image="';


        if((file_exists('../images/dishImages/'.$dishdetail[$j][2])||file_exists('../../images/dishImages/'.$dishdetail[$j][2]))&&($dishdetail[$j][2]!=""))
        {
            $display.='../../images/dishImages/'.$dishdetail[$j][2];;
        }
        else
        {
            $display.='https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png';

        }





            $display.='" data-dishname="' . $dishdetail[$j][0] . '"  data-dishid="' . $dishdetail[$j][1] . '" type="button" value="Select" class="form-control col-12 touchdish btn btn-success">
            <input hidden type="text"  name="dishname[]"  value="' . $dishdetail[$j][0] . '">
             <input hidden type="text"  name="image[]"  value="' . $dishdetail[$j][2] . '">
        </div>';

    }
    return $display;
}






function showRemainings($sql)
{
    $display='<table class="table table-warning newcolor table-responsive text-white">
    <thead class="font-weight-bold">
    <tr>
            <th scope="col"><h1 class="fas fa-id-card "></h1>order Id</th>
            <th scope="col"><h1 class="fas fa-user "></h1>customer Name</th>
            <th scope="col"><h1 class="far fa-eye "></h1>order status</th>
            <th scope="col"><h1 class="fab fa-amazon-pay"></h1>received amount</th>
            <th scope="col">System  Amount</th>
            <th scope="col">remaining system amount </th>
            <th scope="col"><h1 class="far fa-money-bill-alt"></h1> Demanded amount</th>
            <th scope="col">remaining demand amount</th>
    </tr>
    </thead>
    <tbody>';



    $details=queryReceive($sql);
    for ($i=0;$i<count($details);$i++)
    {
        $display.='<tr data-href="?action=preview&order='.$details[$i][0].'&customer='.$details[$i][0].'" class="clickable-row">
        <td  scope="row">'.$details[$i][0].'</td>
        <td>'.$details[$i][1].'</td>
        <td>';
        if(!empty($hallid))
        {
            //if order status is hall
            $display.=$details[$i][7];

        }
        else
        {
            //if order status is catering
            $display.=$details[$i][6];

        }


        $display.='</td>
        <td>'.(int)$details[$i][2].'</td>
        <td>'.(int)$details[$i][5].'</td>
        <td> '.(int) ($details[$i][5]-$details[$i][2]).'</td>
        <td>'.(int) $details[$i][4].'</td>
        <td>'.(int) ($details[$i][4]-$details[$i][2]).'</td>
 ';



        $display.='</tr>';
    }





    $display.='
    </tbody>

</table>';
    return $display;

}




function checkChangeHallOrder($order,$packageid,$cateringid,$date,$time,$perheadwith,$guests,$orderStatus,$totalamount,$HallOrderBranch,$describe,$catering,$timestamp)
{
    $status=false;
    $sql='SELECT `id`, `hall_id`, `catering_id`, `hallprice_id`, `total_amount`, `total_person`, `status_hall`, `destination_date`, `booking_date`, `destination_time`, `status_catering`, `describe`, `user_id` FROM `orderDetail` WHERE id='.$order.'';
    $PreviouseDetailOrder=queryReceive($sql);

    if($PreviouseDetailOrder[0][3]!=$packageid)
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"hallprice_id","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][3].'")';
        querySend($sql);
        $status=true;
    }
    if(checknumberOtherNull($PreviouseDetailOrder[0][2])!=$cateringid)
    {

        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"catering_id","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][2].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][7]!=$date)
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"destination_date","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][7].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][9]!=$time)
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"destination_time","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][9].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][5]!=$guests)
    {
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"total_person","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][5].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][6]!=$orderStatus)
    {

        //hall status

        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"status_hall","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][6].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][1]!=$HallOrderBranch)
    {


        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"hall_id","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][1].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][4]!=$totalamount)
    {


        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"total_amount","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][4].'")';
        querySend($sql);
        $status=true;
    }
    if($PreviouseDetailOrder[0][11]!=$describe)
    {


        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"describe","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][11].'")';
        querySend($sql);
        $status=true;
    }

    if(checknumberOtherNull($PreviouseDetailOrder[0][10])!=$catering)
    {

        //catering status
        $sql='INSERT INTO `HistoryOrder`(`id`, `ColumnName`, `active`, `expire`, `orderDetail_id`, `user_id`, `columnValue`) VALUES (NULL,"status_catering","'.$timestamp.'",NULL,'.$PreviouseDetailOrder[0][0].','.$PreviouseDetailOrder[0][12].',"'.$PreviouseDetailOrder[0][10].'")';
        querySend($sql);
        $status=true;
    }
    return$status;
}

?>