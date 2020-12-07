<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>JavaScript Automatic Page Redirect</title>
    <script src="jquery-3.3.1.js"></script>

</head>
<body>


<script>
    var curTab = $('.ui-tabs-panel:not(.ui-tabs-hide)'),
        curTabIndex = curTab.index(),  //  will get you the index number of where it sits
        curTabID = curTab.prop("id"),  //  will give you the id of the tab open if existant
        curTabCls = curTab.attr("class");
    console.log(curTab);


    var curTab = $('#myTabs_1 .ui-tabs-panel:not(.ui-tabs-hide)');
    // var index = $('#tabs a[href="#simple-tab-2"]').parent().index();
    // $("#tabs").tabs("option", "active", index);

    // console.log(index);

    /*     var win = window.open('http://stackoverflow.com/', '_parent');
         if (win) {
             //Browser has allowed it to be opened
             win.focus();
         } else {
             //Browser has blocked it
             alert('Please allow popups for this website');
         }*/

    // function pageRedirect() {
    //     window.location.replace("https://www.tutorialrepublic.com/");
    // }
    // setTimeout("pageRedirect()", 1000);
</script>
</body>
</html>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


function addSwal() {
swal({
html:true,
title: "Add item",
text: 'Item has been added',
buttons: false,
icon: "success",
timer: 1500,
});

}


swal({
title: "Deleted",
text: 'Item has been Deleted',
buttons: false,
icon: "error",
timer: 1500,
html: true
});

$newDate = new DateTime($PrintedDate);
$newDate->format('d M Y')