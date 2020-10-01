<?php

include_once ("../../connection/connect.php");

$data = array();

/*$query = "SELECT * FROM events ORDER BY id";
$sql='SELECT p.id,p.isFood,package_name,pd.selectedDate FROM packages as p INNER JOIN packageDate as pd
on p.id=pd.package_id
WHERE
(ISNULL(p.expire))AND (ISNULL(pd.expire))';
$ViewPackages=queryReceive($sql);
 $date = new DateTime($ViewPackages[0][1]);
 $date->add(new DateInterval('PT6H3M30S'));
echo date_format($date,"Y-m-d H:i:s");*/
?>

<!DOCTYPE html>
<html>
<head>
    <title>Jquery Fullcalandar Integration with PHP and Mysql</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>

    <script>


        $(document).ready(function() {


     var formdata=new FormData;
     formdata.append("daytime","All");
     formdata.append("packagetype","All");
     formdata.append("option","ViewPackages");
     formdata.append("hallid",1);
            var calendar = $('#calendar').fullCalendar({
                editable:false,
                header:{
                    left:'prev,next today',
                    center:'title',
                    right:'month,agendaWeek,agendaDay,listWeek,dayGridWeek'
                },
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: 'pacakageOption.php',
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
                    if(confirm("Are you sure you want to remove it?"))
                    {
                        var id = event.id;
                        $.ajax({
                            url:"delete.php",
                            type:"POST",
                            data:{id:id},
                            success:function()
                            {
                                calendar.fullCalendar('refetchEvents');
                                alert("Event Removed");
                            }
                        });
                    }
                }

            });
            //
            // $('#calendar').fullCalendar('refetchEvents');

        });

    </script>
</head>
<body>
<br />
<h2 align="center"><a href="#">Jquery Fullcalandar Integration with PHP and Mysql</a></h2>
<br />
<div class="container">
    <div id="calendar"></div>
</div>
</body>
</html>
<?php
include_once ("../../webdesign/footer/EndOfPage.php");
?>