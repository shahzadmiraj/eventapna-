<?php
include_once ('../../../../connection/connect.php');
include  ("../../../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfCateringBranch("Owner,Employee,Viewer","../../../../index.php",'c');


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$id=$_GET['c'];
$token=$_GET['token'];
$sql='SELECT `name`,`image` FROM `catering` WHERE (id='.$id.')AND(token="'.$token.'")AND(ISNULL(expire))';
$cateringdetail=queryReceive($sql);

$companyid=$userdetail[0][0];
$cateringid=$id;



include('../../../../companyDashboard/includes/startHeader.php'); //html

?>

    <?php
    include('../../../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Calender of Catering Orders </title>
    <meta name="description" content="Calender of Food Orders Calender of Catering Orders,Calender Orders Finder only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Food Catering Calender Orders  Finder  Event Apna,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">



<link rel="stylesheet" type="text/css" href="<?php echo $Root;?>bootstrap.min.css">
<script src="<?php echo $Root;?>jquery-3.3.1.js"></script><!--
    <script type="text/javascript" src="../bootstrap.min.js"></script>-->
<link rel="stylesheet" href="<?php echo $Root;?>webdesign/css/loader.css">
<!--<link rel="stylesheet" href="../webdesign/css/complete.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">-->
<script src="<?php echo $Root;?>webdesign/JSfile/JSFunction.js"></script>

<!--   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
   <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>-->

<!-- Custom fonts for this template-->
<link href="<?php echo $Root;?>companyDashboard/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

<link rel="stylesheet" href="<?php echo $Root;?>webdesign/css/loader.css">
<!-- Custom styles for this template-->
<link href="<?php echo $Root;?>companyDashboard/css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />







<?php
include('../../../../companyDashboard/includes/endHeader.php');
include('../../../../companyDashboard/includes/navbar.php');
?>
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Order Calender</h1>
        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>
</div>



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
            <a class="nav-link Search"  data-search="Draft" id="pills-SearchDraft-tab" data-toggle="pill" href="#pills-SearchDraft" role="tab" aria-controls="pills-SearchDraft" aria-selected="false">Draft</a>
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
        formdata.append("cateringid","<?php echo $cateringid?>");


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
                    success: function(doc)
                    {
                        console.log(doc);
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
                        location.href="../../../../order/PreviewOrder.php"+data;
                    }
                });


            }

        });
        //
        // $('#calendar').fullCalendar('refetchEvents');

    });



</script>
<?php
include('../../../../companyDashboard/includes/scripts.php');
include('../../../../companyDashboard/includes/footer.php');
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>


<?php
include_once ("../../../../webdesign/footer/EndOfPage.php");
?>
