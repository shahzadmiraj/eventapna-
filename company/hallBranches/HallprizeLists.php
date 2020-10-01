<?php
include_once ('../../connection/connect.php');
include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner","../../index.php");



$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);
$companyid=$userdetail[0][0];
$sql='SELECT `name` FROM `company` WHERE id='.$companyid.' AND ISNULL(expire)';
$CompanyInfo=queryReceive($sql);


?>
<!DOCTYPE html>
<head>

    <?php
    include('../../webdesign/header/InsertHeaderTag.php');
    ?>
    <title>Hall Package Management</title>
    <meta name="description" content="Hall Package Management page,Hall Package Deal View,Detail packages Marquee,Detail Marquee Deal,Detail New Dera Packages only company user can used this
Find the Best  Wedding Hall Deals! , Catering Deals! Check the prices,availability,compare hundreds of venues and book online Now.
Do you want Management System of Hall OR Catering  for you company? Yes,This is the right place!
EVENT APNA  provides Free Software ....... So Register NOW
">
    <meta name="keywords" content="Hall Package Management page,Add Package Management,Package Management Marquee,New Add Package Management Marquee,Add  New Package Management Dera page,Book Wedding Hall,Catering Managment system,Hall Managment system,shadi hall software,marquee Software,Book marquee,Food Management system">


    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../webdesign/css/complete.css">


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
include_once ("../../webdesign/header/header.php");

?>


<?php
$HeadingImage="";
$HeadingName=$CompanyInfo[0][0];
$Source='';
$pageName='Package Manage';
include_once ("../ClientSide/Company/Box.php");
?>

<div class="container card">


    <div class="container mt-2 mb-4  ">
        <h3  class="float-left"> <i class="fas fa-place-of-worship "></i> Halls Packages</h3>
        <a href="addnewpackage.php"  class="btn btn-success float-right"><i class="fas fa-plus"></i> Add Package</a>
    </div>

    <h5>Package hall</h5>
    <hr>
    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active  hallnumber"  data-hallnumber="All" id="pills-All-tab" data-toggle="pill" href="#pills-All" role="tab" aria-controls="pills-All" aria-selected="true">All</a>
        </li>


        <?php
        $sql='SELECT `id`, `name` FROM `hall` WHERE (ISNULL(expire))AND (company_id= '.$companyid.')';
        $AllHalls=queryReceive($sql);


        for($i=0;$i<count($AllHalls);$i++)
        {
            echo '  
              
        <li class="nav-item">
            <a class="nav-link hallnumber" data-hallnumber="'.$AllHalls[$i][0].'" id="pills-'.$AllHalls[$i][0].'-tab" data-toggle="pill" href="#" role="tab" aria-controls="pills-'.$AllHalls[$i][0].'" aria-selected="false">'.$AllHalls[$i][1].'</a>
        </li>';
        }
        ?>

    </ul>

    <h5>Package timing</h5>
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
            <ul class="nav nav-pills mb-3"  role="tablist">
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


    <h4>Result Packages </h4>
    <hr>

    <div class="container" id="TableCalender">


    </div>


    <h2>Calender </h2>
    <hr>
    <div id="calendar" ></div>




</div>













<?php

include_once ("../../webdesign/footer/footer.php");
?>

<script>

        $(document).ready(function()
        {

            function tabel(packids)
            {
                $.ajax({
                    url:"../../calender/fulcalender/pacakageOption.php",
                    type:"POST",
                    data:{"option":"PackagesShowsOnTable","PackID":packids},
                    success:function(data)
                    {
                        $("#TableCalender").html(data);
                    }
                });
            }


            var hallnumber='All';
            var daytime='All';
            var PackageType='All';

            $(".hallnumber").click(function ()
            {
                hallnumber=$(this).data("hallnumber");
                formdata.append("hallnumber",hallnumber);
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
            formdata.append("packagetype",PackageType);
            formdata.append("hallnumber",hallnumber);
            formdata.append("companyid","<?php echo $companyid;?>");
            formdata.append("option","ViewPackages");


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
                        url: '../../calender/fulcalender/pacakageOption.php',
                        method:"POST",
                        data:formdata,
                        contentType: false,
                        processData: false,
                        success: function(doc)
                        {
                            var events = [];
                            var packids = [];


                            if(isNaN(doc))
                            {
                                var obj = jQuery.parseJSON(doc);
                                $.each(obj, function (index, value) {
                                    events.push({
                                        end: value['end'],
                                        id: value['id'],
                                        start: value['start'],
                                        title: value['title'],
                                    });
                                    packids.push(parseInt(value['id']));
                                });
                            }
                            tabel(packids);
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
                        url:"../../calender/fulcalender/pacakageOption.php",
                        type:"POST",
                        data:{id:id,option:"encordpackage"},
                        success:function(data)
                        {
                            location.href='Editpackage.php?'+data;
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
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>