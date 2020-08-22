<?php
include_once ("../../connection/connect.php");
include  ("../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUserOfPackagesDate("Owner","../../index.php");


$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);


$packageDateId=$_GET['pdid'];
$packageDateToken=$_GET['pdtoken'];


$sql='SELECT package_id,selectedDate FROM packageDate WHERE ISNULL(expire)AND(id='.$packageDateId.')AND(token="'.$packageDateToken.'")';
$packageSelective=queryReceive($sql);

$packageid=$packageSelective[0][0];

$companyid=$userdetail[0][0];
$sql='SELECT `id`, `isFood`, `price`, `describe`, `dayTime`, `expire`,1, `package_name`, `active`, `user_id`, `expireUser`, (SELECT u.username FROM user as u where u.id=packages.user_id),`minimumAmountBooking` FROM `packages` WHERE (id='.$packageid.')AND(ISNULL(expire))';
$packageDetail=queryReceive($sql);
$userid=$_COOKIE['userid'];

$sql='SELECT `name` FROM `company` WHERE id='.$companyid.' AND ISNULL(expire)';
$CompanyInfo=queryReceive($sql);
?>

<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../bootstrap.min.css">
    <script src="../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <link rel="stylesheet" href="../../webdesign/css/comment.css">

    <link rel="stylesheet" href="../../Fractional-Star-Rating-jsRapStar/jsRapStar.css" />
    <link rel="stylesheet" href="../../Fractional-Star-Rating-jsRapStar/index.css" />
    <script src="../../Fractional-Star-Rating-jsRapStar/jsRapStar.js"></script>
    <style>

        #selectedmenu
        {
            background: #F09819;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #EDDE5D, #F09819);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #EDDE5D, #F09819); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }
        #selectmenu
        {
            background: #9796f0;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #fbc7d4, #9796f0);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #fbc7d4, #9796f0); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

        }

        .checked {
            color: orange;
        }
    </style>
</head>
<body>

<?php
//include_once ("../../webdesign/header/header.php");

?>

<?php
$HeadingImage="";
$HeadingName=$CompanyInfo[0][0];
$Source='';
$pageName='Package Edit ';
include_once ("../ClientSide/Company/Box.php");
?>

<div class="container card">
    <form id="EditPackageForm">
        <input hidden name="companyid" value="<?php echo $companyid;?>">

        <input hidden name="userid" value="<?php echo $userid;?>">

        <input hidden name="packageid" value="<?php echo $packageDetail[0][0];?>">
    <h6>You can just manage Dates  , Delect package and activation for halls</h6>
    <div class="form-group row">
        <lable class="col-form-label">Packages Name</lable>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-hamburger"></i></span>
            </div>
            <input  readonly data-columnname="package_name"     class="packagechange form-control" type="text" value="<?php echo $packageDetail[0][7];?>">
        </div>
    </div>

    <div class="form-group row">
        <lable class="col-form-label">Packages Rate per head</lable>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
            </div>
            <input readonly data-columnname="price" class="packagechange form-control" type="number" value="<?php echo $packageDetail[0][2];?>">
        </div>
    </div>

    <div class="form-group row">
        <lable for="PackagesType" class="col-form-label">Packages per head With:</lable>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-chair"></i></span>
            </div>
            <select name="PackagesType" id="PackagesType" class="form-control">
                <?php
                if($packageDetail[0][1]==0)
                {
                    echo '<option value="0">per head only seating </option>';
                }
                else
                {
                        echo '
                <option value="1">per head Food and seating</option>';
                }

                ?>
            </select>
        </div>
    </div>

    <div class="form-group row">
        <lable for="describe" class="col-form-label">Package Daytime:</lable>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-clock"></i></span>
            </div>
            <select id="Daytime" name="Daytime" class="form-control" placeholder="Daytime" >
                <?php
                echo '
                <option>'.$packageDetail[0][4].'</option>'

                ?>
            </select>

        </div>
    </div>
    <div class="form-group row">
        <lable for="rate" class="col-form-label">Minimum Amount of Package Booking</lable>

        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-money-bill-alt"></i></span>
            </div>
            <input readonly id="MinimumAmount" name="MinimumAmount" class="form-control" type="number" placeholder="how much money required to book" value="<?php echo $packageDetail[0][12];?>">
        </div>
    </div>

    <div class="form-group row">
        <lable class="col-form-label">Packages Description</lable>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-comments"></i></span>
            </div>
            <textarea readonly data-columnname="describe"  class=" form-control" > <?php echo $packageDetail[0][3];?></textarea>
        </div>
    </div>

    <div class="form-group row">
        <lable class="col-form-label">Packages Active Date</lable>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user-clock"></i></span>
            </div>
            <input readonly data-columnname="price" class="packagechange form-control" type="datetime" value="<?php echo $packageDetail[0][8];?>">
        </div>
    </div>


    <div class="form-group card">


        <lable  class="col-form-label">Select hall for package active</lable>


        <?php
        //
        $sql='SELECT `hall_id`,`id`,(SELECT hall.name from hall WHERE hall.id=packageControl.hall_id) FROM `packageControl` WHERE (ISNULL(expire))AND(package_id='.$packageDetail[0][0].')';
        $SelectiveHalls=queryReceive($sql);
        for($i=0;$i<count($SelectiveHalls);$i++)
        {
            echo '  
              <div class="checkbox">
                <h4><input type="checkbox" checked  name="selectedHalls[]" value="'.$SelectiveHalls[$i][1].'"> '.$SelectiveHalls[$i][2].'</h4>
                </div>';
        }
        $SelectiveHalls=array_column($SelectiveHalls, 0);
        $List = implode(', ', $SelectiveHalls);



        $sql='SELECT `id`, `name` FROM `hall` WHERE (ISNULL(expire))AND (company_id= '.$companyid.')AND( id NOT IN ('.$List.'))';
        $AllHalls=queryReceive($sql);
        for($i=0;$i<count($AllHalls);$i++)
        {
            echo '  
              <div class="checkbox">
                <h4><input type="checkbox"   name="hallactive[]" value="'.$AllHalls[$i][0].'"> '.$AllHalls[$i][1].'</h4>
                </div>';
        }
        ?>

    </div>

    <div class="form-group row">
        <lable class="col-form-label">Packages Active User</lable>
        <div class="input-group mb-3 input-group-lg">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
            <input readonly  class="form-control" type="text" value="<?php echo $packageDetail[0][11];?>">
        </div>
    </div>


    </form>
    <h2>Calender </h2>
    <hr>
    <div id="calendar" ></div>
    <hr>







<form id="submitpackage">
        <?php
        $sql='SELECT `id`, `dishname`, `image`, `expire`, `package_id` FROM `menu` WHERE (package_id='.$packageid.') AND ISNULL(expire)';
        $menuDetail=queryReceive($sql);
        print_r($menuDetail);
        if(count($menuDetail)>0)
        {
            echo '
    <h3  align="center"><i class="fas fa-thumbs-up"></i> Selected Menu of Package</h3>
<div id="selectedmenu" class="row form-group m-0" style="overflow:auto;width: 100% ;height: 50vh">
';
        }

        for($i=0;$i<count($menuDetail);$i++)
        {

            echo '
        <div id="alreadydishid'.$menuDetail[$i][0].'" class="col-4 border m-2 form-group p-0 card shadow " style="height: 30vh;" >
            <img src="../../images/dishImages/'.$menuDetail[$i][2].'" class="col-12" style="height: 15vh">
            <p class="col-form-label" class="form-control col-12">'.$menuDetail[$i][1].'</p>
            <input  hidden data-dishid="'.$menuDetail[$i][0].'" type="button" value="Remove" class="form-control alreadydishid col-12  btn btn-success">
        </div>';


        }


        if(count($menuDetail)>0)
        {
            echo '</div>';
        }
        ?>

<h2>Packages all detail</h2>
<div style="overflow:auto;height: 40vh">

    <table class="table table-striped">
        <thead>
        <tr>
            <th>No:</th>
            <th>ID date:</th>
            <th>Date:</th>
            <th>User Name:</th>
            <th>Active Date:</th>
        </tr>
        </thead>
        <tbody  id="tableEditpackages">

        </tbody>
    </table>
</div>





<div class="col-12 mt-2 row" >
        <button id="deletePackage"  type="button"  class="btn btn-danger col-6 m-auto"><i class="fas fa-trash-alt"></i>Delect Package</button>
    <button id="SubmitFormPackage"  type="button"  class="btn btn-primary col-6 m-auto">Submit</button>
    </div>

</form>
</div>
<?php
//include_once ("../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {

        $("#SubmitFormPackage").click(function () {

            var formdata = new FormData($("#EditPackageForm")[0]);
            formdata.append("option","SubmitPackagesSave");
            $.ajax({
                url:"packages/PACKServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {

                    $("#preloader").hide();
                }
            });
        });


        function updateTable()
        {
            $.ajax({
                url:"../../calender/fulcalender/pacakageOption.php",
                type:"POST",
                data:{option:"updateEdittable",Packageid:"<?php echo $packageid?>"},

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
                    //console.log(data);
                    $("#tableEditpackages").html(data);
                }
            })
        }



        var Editformdata=new FormData;
        Editformdata.append("option","SpecificpackageView");
        Editformdata.append("packageid","<?php echo $packageid?>");
        var calendar = $('#calendar').fullCalendar({
            editable:false,
            header:{
                left:'prev,next today',
                center:'title',
                right:'month,listWeek,dayGridWeek'
            },
            events: function(start, end, timezone, callback) {
                $.ajax({
                    url: '../../calender/fulcalender/pacakageOption.php',
                    method:"POST",
                    data:Editformdata,
                    contentType: false,
                    processData: false,
                    beforeSend: function() {
                        $("#preloader").show();
                    },
                    success:function (doc)
                    {
                        $("#preloader").hide();
                        updateTable();
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
            selectable:true,
            selectHelper:true,
            eventClick:function(event)
            {
                if(confirm("Are you sure you want to remove it?"))
                {
                    var id = event.id;
                    var userid="<?php echo $userid;?>";
                    $.ajax({
                        url:"../../calender/fulcalender/pacakageOption.php",
                        type:"POST",
                        data:{id:id,option:"DelectEventdate",userid:userid},
                        beforeSend: function()
                        {
                            $("#preloader").show();
                         },
                    success:function (data)
                    {
                        $("#preloader").hide();

                        calendar.fullCalendar('refetchEvents');
                            updateTable();
                           // alert("Event Removed");
                        }
                    })
                }
            },
            select: function(start, end, allDay)
            {
                var selectedDate = $.fullCalendar.formatDate(start, "Y-MM-DD");
                if(confirm("Are you sure to Add event on this Date "+selectedDate))
                {
                    $.ajax({
                        url:"../../calender/fulcalender/pacakageOption.php",
                        type:"POST",
                        data:{option:"InsertNewDate", selectedDate:selectedDate,Packageid:"<?php echo $packageid?>",userid:"<?php echo $userid;?>"},
                        beforeSend: function() {
                            $("#preloader").show();
                         },
                         success:function ()
                        {
                        $("#preloader").hide();
                        calendar.fullCalendar('refetchEvents');
                            updateTable();
                          //  alert("Added Successfully");
                        }
                    })
                }
            }

        });

        function checkpaktype()
        {
            var PackagesType=$("#PackagesType").val();
            if(PackagesType==0)
            {
                $("#selectedmenu").hide('slow');
                $("#selectingmenu").hide('slow');
            }
            else
            {
                $("#selectedmenu").show('slow');
                $("#selectingmenu").show('slow');
            }
        }

        $("#PackagesType").change(function ()
        {
            checkpaktype();
        });
        checkpaktype();
        $("#deletePackage").click(function (e)
        {
            e.preventDefault();

            var userid="<?php echo $userid;?>";
            var formdata=new FormData;
            formdata.append("option","PackDelete");
            formdata.append("packageid",<?php echo $packageid;?>);
            formdata.append("userid",<?php echo $userid;?>);
            $.ajax({
                url:"packages/PACKServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();

                    if(data!='')
                    {
                        alert(data);
                    }
                    else
                    {
                        window.history.back();
                    }
                }
            });


        });



        $(".packagechange").change(function () {
            var columnname=$(this).data("columnname");
            var value=$(this).val();
            var formdata=new FormData;
            formdata.append("option","packagechange");
            formdata.append("packageid",<?php echo $packageid;?>);
            formdata.append("value",value);
            formdata.append("columnname",columnname);
            $.ajax({
                url:"../companyServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();

                    if(data!='')
                    {
                        alert(data);
                    }
                }
            });


        });



        var numbers=0;
        $(document).on("click",".touchdish",function ()
        {
            var text='';
            var value=$(this).val();
            var id=$(this).data("dishid");
            var image=$(this).data("image");
            var dishname=$(this).data("dishname");
            if(value=="Remove")
            {

                $("#dishtempid"+id).remove();
            }
            else
            {

                text="<div id=\"dishtempid"+numbers+"\" class=\"col-4 alert-danger border m-1 form-group p-0\" style=\"height: 30vh;\" >\n" +
                    "            <img src=\""+image+"\" class=\"col-12\" style=\"height: 15vh\">\n" +
                    "            <p class=\"col-form-label\" class=\"form-control col-12\">"+dishname+"</p>\n" +
                    "            <input    data-dishid=\""+numbers+"\" type=\"button\" value=\"Remove\" class=\"form-control col-12 touchdish btn btn-danger\">\n" +
                    "            <input hidden type=\"text\"  name=\"dishname[]\"  value=\""+dishname+"\">\n" +
                    "             <input hidden type=\"text\"  name=\"image[]\"  value=\""+image+"\">\n" +
                    "        </div>";
                numbers++;
                $("#selectedmenu").append(text);

            }

        });
        $("#btnsubmit").click(function ()
        {
            var formdata=new FormData($('#submitpackage')[0]);
            formdata.append("option","Extendmenu");
            formdata.append("packageid",<?php echo $packageid;?>)
            $.ajax({
                url:"../companyServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();

                    if(data!='')
                    {
                        alert(data);
                    }
                    else
                    {
                        window.history.back();
                    }
                }
            });

        });
        $("#btncancel").click(function (e)
        {  e.preventDefault();
            var value=$(this).val();
            var formdata=new FormData;
            formdata.append("option","ExpireBtn");
            formdata.append("packageid",<?php echo $packageid;?>);
            formdata.append("expirevalue",value);
            $.ajax({
                url:"../companyServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();

                    if(data!='')
                    {
                        alert(data);
                    }
                    else
                    {
                        window.history.back();
                    }
                }
            });
        });

        $(".alreadydishid").click(function ()
        {
           var id= $(this).data("dishid");

           $.ajax({

               url:"../companyServer.php",
               method:"POST",
               data:{option:"alreadydishremove",id:id},
               dataType:"text",

               beforeSend: function() {
                   $("#preloader").show();
               },
               success:function (data)
               {
                   $("#preloader").hide();
                    if(data!="")
                    {
                        alert(data);
                    }
                    else
                    {
                            $("#alreadydishid"+id).remove();
                    }
               }

           });


        });


        $('#myModal').on('shown.bs.modal', function () {
            $('#myInput').trigger('focus')
        });

        $("#submitformDishadd").click(function (e)
        {
            e.preventDefault();
            if($.trim($("#dishnameadd").val()).length==0)
            {
                alert("please enter dish name");
                return false;
            }
            var formdata = new FormData($("form")[1]);
            formdata.append("option","formDishadd");
            $.ajax({
                url:"../companyServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();
                    $("#selectmenu").html(data);
                    $("form")[1].reset();
                    $('#exampleModal').modal('toggle');

                }
            });
        });

        $("#searchdish").keyup(function () {
            var dishname=$(this).val();

            var formdata=new FormData();
            formdata.append("option","dishpredict");
            formdata.append("dishname",dishname);
            $.ajax({
                url:"../companyServer.php",
                method:"POST",
                data:formdata,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $("#preloader").show();
                },
                success:function (data)
                {
                    $("#preloader").hide();

                    $("#selectmenu").html(data);
                }
            });


        });







    });


    var scores=3;
    $(document).ready(function(){
        $('#demo1').jsRapStar({
            onClick:function(score){
                $(this)[0].StarF.css({color:'red'});
                scores=score;
            }});
    });


</script>
</body>
</html>
