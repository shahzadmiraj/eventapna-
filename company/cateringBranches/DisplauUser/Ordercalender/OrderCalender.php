<?php
include_once ('../../../../connection/connect.php');
//include_once('../../packages/packagesServerfunction.php');

/*if(!isset($_GET['hall']))
{

    header("location:../../../companyRegister/companyEdit.php");
}
$encoded=$_GET['hall'];
$id=base64url_decode($encoded);

if((!is_numeric($id))||$id=="")
{
    header("location:../../../companyRegister/companyEdit.php");
}*/


$hallid=1;
$companyid='';


//$companyid=$_COOKIE['companyid'];
//$sql='SELECT `name`, `max_guests`, `noOfPartitions`, `ownParking`, `expire`, `image`, `hallType`, `location_id` FROM `hall` WHERE id='.$hallid.'';
//$halldetail=queryReceive($sql);

?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../../../bootstrap.min.css">
    <script src="../../../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../../../webdesign/css/complete.css">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <style>

    </style>

    <script>



    </script>

</head>
<body>

<?php
include_once ("../../../../webdesign/header/header.php");

?>

<div class="jumbotron jumbotron-fluid text-center" style="background-image: url(<?php
if((file_exists('../../images/hall/'.$halldetail[0][5]))&&($halldetail[0][5]!=""))
{
    echo "'../../images/hall/".$halldetail[0][5]."'";
}
else
{
    echo "https://www.pakvenues.com/system/halls/cover_images/000/000/048/original/Umar_Marriage_Hall_lahore.jpg?1566758537";
}
?>);background-repeat: no-repeat ;background-size: 100% 100%">
    <div class="container" style="background-color: white;opacity: 0.7">
        <h1 class="display-4"><i class="fas fa-clipboard-list fa-1x"></i>  </h1>
        <p class="lead">You can manage month wise prize list.Prize list consist of per head with food  and per head only seating .</p>
        <h1 class="text-center"> <a href="../../../companyRegister/companyEdit.php " class="col-6 btn btn-info "> <i class="fas fa-city mr-2"></i>Edit Company</a></h1>
    </div>
</div>


<div class="container card">

    <h4>Searching Order </h4>
    <hr>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active Search"  data-search="Running" id="pills-SearchRunning-tab" data-toggle="pill" href="#pills-SearchRunning" role="tab" aria-controls="pills-SearchRunning" aria-selected="true">Running</a>
        </li>
        <li class="nav-item">
            <a class="nav-link Search" data-search="Delivered"  id="pills-SearchDelivered-tab" data-toggle="pill" href="#pills-SearchDelivered" role="tab" aria-controls="pills-SearchDelivered" aria-selected="false">Delivered</a>
        </li>
        <li class="nav-item">
            <a class="nav-link Search"  data-search="Cancel" id="pills-SearchCancel-tab" data-toggle="pill" href="#pills-SearchCancel" role="tab" aria-controls="pills-SearchCancel" aria-selected="false">Cancel</a>
        </li>

        <li class="nav-item">
            <a class="nav-link Search" data-search="Visited" id="pills-SearchVisited-tab" data-toggle="pill" href="#pills-SearchVisited" role="tab" aria-controls="pills-SearchVisited" aria-selected="false">Visited</a>
        </li>
        <li class="nav-item">
            <a class="nav-link Search" data-search="Clear" id="pills-SearchClear-tab" data-toggle="pill" href="#pills-SearchClear" role="tab" aria-controls="pills-SearchClear" aria-selected="false">Clear</a>
        </li>
        <li class="nav-item">
            <a class="nav-link Search" data-search="All" id="pills-SearchAll-tab" data-toggle="pill" href="#pills-SearchAll" role="tab" aria-controls="pills-SearchAll" aria-selected="false">All</a>
        </li>

    </ul>



    <h2>Calender </h2>
    <hr>
    <div id="calendar" ></div>




</div>













<?php

include_once ("../../../../webdesign/footer/footer.php");
?>

<script>

    $(document).ready(function()
    {


        var searching="Running";


        $(".Search").click(function () {
            searching=$(this).data("search");
            formdata.append("searching",searching);
            $('#calendar').fullCalendar('refetchEvents');
        });


        var formdata=new FormData;
        formdata.append("searching",searching);

        formdata.append("option","ViewCateringOrder");
        formdata.append("cateringid",1);


        var calendar = $('#calendar').fullCalendar({
            editable:false,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,agendaWeek,agendaDay,listWeek,dayGridWeek'
            },
            height: 800,
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: 'orderServer.php',
                    method:"POST",
                    data:formdata,
                    contentType: false,
                    processData: false,
                    success: function(doc) {
                        var obj = jQuery.parseJSON(doc);
                        var events = [];
                        $.each(obj, function(index, value) {
                            events.push({
                                end: value['end'],
                                id: value['id'],
                                start: value['start'],
                                title: value['title'],
                            });
                            //console.log(value)
                        });
                        callback(events);
                    },
                    error: function(e, x, y) {
                        console.log(e);
                        console.log(x);
                        console.log(y);
                    }
                });
            },
            selectable:false,
            selectHelper:true,
            eventClick:function(event)
            {
                var id = event.id;
                $.ajax({
                    url:"orderServer.php",
                    type:"POST",
                    data:{id:id,option:"orderCustomerGo"},
                    success:function(data)
                    {
                        location.href="../../../../order/PreviewOrder.php";
                    }
                });


            }

        });
        //
        // $('#calendar').fullCalendar('refetchEvents');

    });



</script>
</body>
</html>
