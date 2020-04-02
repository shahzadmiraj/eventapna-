<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */


/*
 *
 *
 *
 * <i class="fas fa-trash-alt"></i> delete
 *<i class="fas fa-user"></i> user
 *  <i class="fa fa-list-ol" aria-hidden="true"></i> list no
 *  <i class="fa fa-print" aria-hidden="true"></i> //print
 *      <i class="far fa-calendar-alt"></i> calender
 * <i class="fas fa-check "></i>    ok check
 * <i class="fas fa-arrow-left"></i> back arrow
 *<i class="fas fa-layer-group"></i> files
 * <i class="fas fa-sitemap"></i> type
 * <i class="far fa-money-bill-alt"></i>    amount
 * <i class="fas fa-camera-retro"></i>  camera
<i class="fas fa-plus"></i> pluse
<i class="fas fa-drum"></i> drum
<i class="fas fa-concierge-bell"></i> Dish


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




<!--<div class="container badge-light">
    <h1 class="text-center">kkiiji</h1>
    <div class="form-inline">



        <div class="card col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3">
            <img class="card-img-top" src="..." alt="Card image cap">
            <div class="card-footer">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Some quick examplet.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
        </div>




    </div>
</div>-->





$('.toast').toast('show');

<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
        <h4 class="mr-auto">Dish Deleted</h4>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        hello,you have successfully Deleted dish
    </div>
</div>

$selectedDates=explode (",", $selectedDatesString); //string convert into array in php by comma split