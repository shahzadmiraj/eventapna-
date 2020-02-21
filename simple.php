<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
//include  ("../connection/connect.php");
//date_default_timezone_set("asia/karachi");
//mysqli_insert_id($connect);
// //$timestamp = date('Y-m-d H:i:s');
//    $date = date('Y-m-d');
//$timeSet=date('H:i',time($orderDetail[0][7]));
function queryReceive($sql)
{
    global $connect;
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        echo("Error description: " . mysqli_error($connect));
    }else{
        return mysqli_fetch_all($result);
    }
}
//  $.ajax({
//               url:"customerBookingServer.php",
//               method:"POST",
//               data:formdatd,
//               contentType: false,
//               processData: false,
//               success:function (data)
//               {
//                   console.log(data);
//               }
//           });
function querySend($sql)
{
    global $connect;
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        echo("Error description: " . mysqli_error($connect));
    }
}

?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../bootstrap.min.css">
    <script src="../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <style>
        *{
            margin:0;
            padding: 0;
        }
    </style>
</head>
<body>
<p>hellooo header</p>




<script>
//window.history.back();



/*var previous='';
$('.showDetail').click(function ()
{
    var formid=$(this).data("formid");
    var value=$(this).val();
    if((previous!=formid)&& (previous!=''))
    {
        $("#"+previous).val("Detail");
        $("#"+previous).hide('slow');
    }
    previous=formid;
    if(value=="Detail")
    {
        $(this).val("preview");
        $("#"+formid).show('slow');
    }
    else if(value=="preview")
    {
        $(this).val("Detail");
        $("#"+formid).hide('slow');
    }


});


           $('.allnumber').map(function () {
               var data=$(this).val();
               console.log(data);
           }).get().join();



*/


//
//$daytimearray=array("Morning","Afternoon","Evening");

//                $monthsArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
//
//$halltype=array("Marquee","Hall","Deera /Open area");
// Display the values
// for (var value of formdata.values()) {
//     console.log(value);
// }
</script>
</body>
</html>
