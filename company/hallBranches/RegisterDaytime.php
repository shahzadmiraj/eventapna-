<?php
$hallid=$_POST['hallid']=2;
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
    <link rel="stylesheet" href="../../webdesign/css/loader.css">
    <style>
        *{
            margin:0;
            padding: 0;
        }
    </style>
</head>
<body>
<h1 align="center">Hall information</h1>
<h3 align="center">Hall Branch Name:</h3>
<h4 align="center">Only seating price</h4>

<?php
$daytimearray=array("Morning","Afternoon","Evening");
for ($k=0;$k<count($daytimearray);$k++)
{


    ?>


    <div class="shadow card p-2 mb-4" id="formdisplay<?php echo $daytimearray[$k]; ?>">
        <form id="form<?php echo $daytimearray[$k]; ?>">
            <h4 align="center"><?php echo $daytimearray[$k]; ?></h4>
            <input hidden type="text" name="daytime" value="<?php echo $daytimearray[$k]; ?>">
            <table class=" table table-striped table-danger ">
                <thead>

                <tr>
                    <th scope="col">
                        Months
                    </th>
                    <th scope="col">
                        Price per head
                    </th>
                </tr>
                </thead>
                <tbody>

                <?php
                $monthsArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

                for ($m = 0; $m < count($monthsArray); $m++) {
                    echo '
                <tr>
                <th scope="row">' . $monthsArray[$m] . '</th>
                <td><input type="number" name="month[]" value="0"></td>
                </tr>
                    ';
                }
                ?>

                <tr>
                    <td colspan="2">
                        <input data-formid='<?php echo $daytimearray[$k]; ?>' type="button" value="submit"
                               class="btnsubmit btn btn-success form-control">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
    <?php
}
?>



<script>
$(document).ready(function () {
    var formno=3;
    var hallid=<?php echo $hallid;?>;
   $(".btnsubmit").click(function ()
   {
       var id=$(this).data("formid");
       var formdata=new FormData($('#form'+id)[0]);
       formdata.append("option","createOnlyseating");
       formdata.append("hallid",hallid);
       $.ajax({
           url: "../companyServer.php",
           method: "POST",
           data: formdata,
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
                   $('#formdisplay'+id).hide('slow');
                   formno--;
                   if(formno==0)
                   {
                       window.location.href="RegisterFoodMenu.php?hallid="+hallid+"";
                   }
               }

           }
       });
   }) ;
});


</script>
</body>
</html>
