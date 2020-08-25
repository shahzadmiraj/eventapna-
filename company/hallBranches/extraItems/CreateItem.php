<?php
/**
 * Created by PhpStorm.
 * User: shahzadmiraj
 * Date: 2019-09-01
 * Time: 21:31
 */
include_once ("../../../connection/connect.php");
include  ("../../../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner","../../../index.php");



$sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
$userdetail=queryReceive($sql);

$sql='SELECT `id`, `name` FROM `hall` WHERE (ISNULL(expire))AND (company_id= '.$userdetail[0][0].')';
$Names=queryReceive($sql);
$listOfCatering=array_column($Names, 0);
$List = implode(', ', $listOfCatering);
$userid=$_COOKIE['userid'];
?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="../../../bootstrap.min.css">
    <script src="../../../jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../../../bootstrap.min.js"></script>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../../../webdesign/css/loader.css">
    <link rel="stylesheet" href="../../../webdesign/css/complete.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <script src="../../../webdesign/JSfile/JSFunction.js"></script>

</head>
<body >
<?php
include_once ("../../../webdesign/header/header.php");
?>



    <form class="card container">

        <input hidden name="userid" value="<?php echo $userid;?>">
        <input hidden name="companyid" value="<?php echo $userdetail[0][0];?>">
        <h1 class="text-muted text-center">Add Extra item</h1>
        <div class="form-group row">

            <label for="name" class="col-form-label">Name item </label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-drum"></i></span>
                </div>
                <input id="name" type="text" name="name" class="form-control " placeholder="name of extra item">
            </div>

        </div>



        <div class="form-group row">

            <label for="image" class="col-form-label">Image Item </label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-camera-retro"></i></span>
                </div>
                <input  type="file" name="image" class="form-control ">
            </div>

        </div>

        <div class="form-group row">

            <label for="Price" class="col-form-label"> Price</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                </div>
                <input id="Price" type="number" name="Price" class="form-control " placeholder="Price of extra item">
            </div>

        </div>



        <div class="form-group row">

            <label for="typeofitem" class="col-form-label"> Type of item</label>

            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-sitemap"></i></span>
                </div>
                <select  name="typeofitem" id="typeofitem" class="form-control">

                    <?php
                    //dish type of catering
                    $sql='SELECT EIT.id,EIT.name FROM ExtraItemControl as EIC INNER join  Extra_Item as EI 
on(EIC.Extra_Item_id=EI.id) INNER join Extra_item_type as EIT 
on (EI.Extra_item_type_id=EIT.id)
WHERE
(ISNULL(EIC.expire)) AND(ISNULL(EIT.expire))AND(EIC.hall_id in('.$List.'))
GROUP by (EIT.id)';

                    $typeDetail=queryReceive($sql);


                    for($i=0;$i<count($typeDetail);$i++)
                    {
                        echo '<option value="'.$typeDetail[$i][0].'">'.$typeDetail[$i][1].'</option>';
                    }

                    ?>
                    <option value="other">other</option>

                </select>
            </div>

        </div>




        <div class="form-group row" id="showType">

            <label for="otherTypeName" class="col-form-label">Other Type name</label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-layer-group"></i></span>
                </div>
                <input id="otherTypeName" type="text" name="otherTypeName" class="form-control " placeholder="other  type name">
            </div>
        </div>


        <div class="form-group card">


            <lable  class="col-form-label">Select hall for Extra item active</lable>


            <?php
            for($i=0;$i<count($Names);$i++)
            {
                echo '  
              <div class="checkbox">
                <h4><input type="checkbox" checked  name="branchactive[]" value="'.$Names[$i][0].'"> '.$Names[$i][1].'</h4>
                </div>';
            }
            ?>

        </div>


        <div class="form-group row justify-content-center">

            <button id="Back"  class="form-control col-5 btn btn-danger"><i class="fas fa-arrow-left"></i> Cancel</button>
            <button type="button" id="submit" class="form-control col-5 btn-primary"><i class="fas fa-check "></i> Submit</button>

        </div>
    </form>




<?php
include_once ("../../../webdesign/footer/footer.php");
?>
<script>
    $(document).ready(function ()
    {
        $("#typeofitem").change(function ()
        {
            var value=$(this).val();
            if(value=="other")
            {
                $("#showType").show();
            }
            else
            {

                $("#showType").hide();
            }
        });

        $("#Back").click(function (e)
        {
            e.preventDefault();
            window.history.back();
        });

        $("#submit").click(function (e)
        {
            e.preventDefault();
            var state=false;


            if(validationWithString("name","Please Enter Item name"))
                state=true;

            if(validationWithString("Price","Please Enter Item Price"))
                state=true;

            if($("#typeofitem").val()=="other")
            {
                if(validationWithString("otherTypeName","Please Enter Item type"))
                    state=true;
            }


            if(state)
                return false;

            var formdata=new FormData($('form')[0]);
            formdata.append('option',"addItem");
            $.ajax({
                url:"hallitemsServer.php",
                data:formdata,
                method:"POST",
                contentType: false,
                processData: false,
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
                        window.history.back();
                    }
                }
            });

        });

    });

</script>
</body>
</html>
