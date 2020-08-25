<?php
include_once ('../../../../connection/connect.php');
//include_once('../../packages/packagesServerfunction.php');
include  ("../../../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfHall("Owner,Employee,Viewer","../../../../index.php",'h');

$sql='SELECT `company_id`,`username`, `jobTitle` ,`id`  FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$id=$_GET['h'];
$token=$_GET['token'];
$sql='SELECT `name`,`image` FROM `hall` WHERE (id='.$id.')AND(token="'.$token.'")AND(ISNULL(expire))';
$halldetail=queryReceive($sql);
$Query='h='.$id.'&token='.$token;



$hallid=$id;
$companyid=$userdetail[0][0];



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
//include_once ("../../../../webdesign/header/header.php");

?>


<?php
$HeadingImage=$halldetail[0][1];
$HeadingName=$halldetail[0][0];
$Source='../../../../images/hall/';
$pageName='Orders Status';
include_once ("../../../ClientSide/Company/Box.php");
?>


<div class="container card">

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




    <h4>Package information</h4>
    <hr>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active daytime"  data-daytime="All" id="pills-All-tab" data-toggle="pill" href="#pills-All" role="tab" aria-controls="pills-All" aria-selected="true">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link daytime" data-daytime="Morning" id="pills-Morning-tab" data-toggle="pill" href="#pills-Morning" role="tab" aria-controls="pills-Morning" aria-selected="false">Morning</a>
        </li>
        <li class="nav-item">
            <a class="nav-link daytime"  data-daytime="Afternoon" id="pills-Afternoon-tab" data-toggle="pill" href="#pills-Afternoon" role="tab" aria-controls="pills-Afternoon" aria-selected="false">Afternoon</a>
        </li>

        <li class="nav-item">
            <a class="nav-link daytime" data-daytime="Evening" id="pills-Evening-tab" data-toggle="pill" href="#pills-Evening" role="tab" aria-controls="pills-Evening" aria-selected="false">Evening</a>
        </li>
    </ul>
    <!--<div class="tab-content" id="pills-tabContent">-->
    <!--    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">FIRST TABE</div>-->
    <!--    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">SECOND TABE</div>-->
    <!--    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">THIRD TABE</div>-->
    <!--</div>-->


    <h5>Package type</h5>
    <hr>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active PackageType" data-packagetype="All" id="pills-type-All-tab" data-toggle="pill" href="#pills-type-All" role="tab" aria-controls="pills-type-All" aria-selected="true">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link PackageType" data-packagetype="0" id="pills-Only-Seating-tab" data-toggle="pill" href="#pills-Only-Seating" role="tab" aria-controls="pills-Only-Seating" aria-selected="false">Only Seating</a>
        </li>
        <li class="nav-item">
            <a class="nav-link PackageType" data-packagetype="1" id="pills-FoodAndSeating-tab" data-toggle="pill" href="#pills-FoodAndSeating" role="tab" aria-controls="pills-FoodAndSeating" aria-selected="false">Food+Seating</a>
        </li>
    </ul>


    <h2>Calender </h2>
    <hr>
    <div id="calendar" ></div>




</div>













<?php

//include_once ("../../../../webdesign/footer/footer.php");
?>

<script>

    $(document).ready(function()
    {


        var searching="Running";
        var daytime='All';
        var PackageType='All';


        $(".Search").click(function () {
            searching=$(this).data("search");
            formdata.append("searching",searching);
            $('#calendar').fullCalendar('refetchEvents');
        });

        $(".daytime").click(function ()
        {
            daytime=$(this).data("daytime");
            formdata.append("daytime",daytime);
            $('#calendar').fullCalendar('refetchEvents');
        });
        $(".PackageType").click(function () {
            PackageType=$(this).data("packagetype");
            formdata.append("packagetype",PackageType);
            $('#calendar').fullCalendar('refetchEvents');
        });

        var formdata=new FormData;
        formdata.append("daytime",daytime);
        formdata.append("searching",searching);
        formdata.append("packagetype",PackageType);
        formdata.append("option","ViewOrders");
        formdata.append("hallid",1);


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
                    url: 'CalenderServer.php',
                    method:"POST",
                    data:formdata,
                    contentType: false,
                    processData: false,
                    success: function(doc) {
                    //alert(doc);

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
                    url:"CalenderServer.php",
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
