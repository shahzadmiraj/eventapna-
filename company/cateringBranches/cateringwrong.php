<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include  ("../../connection/connect.php");
$cateringid=$_POST['cateringid']=1;
$sql='SELECT  `name`, `expire`, `image`, `location_id` FROM `catering` WHERE id='.$cateringid.'';
$cateringdetail=queryReceive($sql);

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

    <style>
        *{
            margin:0;
            padding: 0;
        }
    </style>
</head>
<body>
<h1 align="center">Setting OF Catering</h1>
<img src="
<?php
if(file_exists("../".$cateringdetail[0][2]) &&($cateringdetail[0][2]!=""))
{
    echo "../".$cateringdetail[0][2];
}
else
{
    echo "../../gmail.png";
}
?>

" class="rounded mx-auto d-block m-4" alt="..." style="height: 30vh">

<form id="formcatering">
<input type="number" hidden name="cateringid" value="<?php echo $cateringid; ?>">
<input type="text" hidden name="previousimage" value="<?php echo $cateringdetail[0][2]; ?>">
<div class="form-group row">
    <label class="col-form-label col-4">Catering Branch Name:</label>
    <input name="cateringname" class="form-control col-8" type="text" value="<?php echo $cateringdetail[0][0]; ?>">
</div>
<div class="form-group row">
    <label class="col-form-label col-4">Catering Branch Image:</label>
    <input name="image" class="form-control col-8" type="file">
</div>
<div class="form-group row">
    <label class="col-form-label col-4">Catering Branch Address</label>
</div>
    <div class="form-group row col-12 mb-5">

        <input id="expirecatering" type="button" class="rounded mx-auto d-block btn btn-outline-danger col-5 " value="Expire catering">
        <input id="submiteditcatering" type="button" class="rounded mx-auto d-block btn btn-primary col-5 " value="Submit">

    </div>
</form>


<script>

    $(document).ready(function ()
    {


        $("#submiteditcatering").click(function () {
            var formdata = new FormData($("#formcatering")[0]);
            formdata.append("option", "cateringedit");
            $.ajax({
                url: "../companyServer.php",
                method: "POST",
                data: formdata,
                contentType: false,
                processData: false,
                success: function (data) {
                    if (data != '')
                    {
                        alert(data);
                        return false;
                    } else
                    {
                        location.reload();

                    }


                }
            });
        });
    });


</script>
</body>
</html>
