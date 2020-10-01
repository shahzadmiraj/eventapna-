
<div class="container">
    <h1 class="font-weight-light text-lg-left mt-4 mb-3">Gallery</h1>


    <form id="multiplesimages" enctype="multipart/form-data" class="form-inline">
        <input hidden type="number" name="hallid" value="<?php echo $hallid;?>">
        <input type="file" name="userfile[]" value="" multiple="" class="col-8 btn  btn-light">
        <input id="submitMultiples" type="submit" name="submit" value="Upload" class="btn btn-success col-4">
    </form>




    <hr class="mt-3 mb-5 border-white">

    <div class="row text-center text-lg-left">


        <?php


        $sql='SELECT `id`, `image` FROM `images` WHERE hall_id='.$hallid.'' ;
        // $destination="../../images/hall/";
        echo showGallery($sql,$destination);

        ?>


    </div>



</div>

<script>

    $(document).ready(function ()
    {
        $("#submitMultiples").click(function (e)
        {
            if (!confirm('Are you sure you want to Save Picture /video?'))
                return  false;
            e.preventDefault();
            var formData=new FormData($("#multiplesimages")[0]);
            formData.append("option","hallmutiplesimages");
            formData.append("imagePath","<?php echo $destination; ?>");
            $.ajax({
                url:urlData,
                method:"POST",
                data:formData,
                contentType: false,
                processData: false,

                beforeSend: function() {
                    $('#pleaseWaitDialog').modal();
                },
                success:function (data)
                {
                    $('#pleaseWaitDialog').modal('hide');
                    location.reload();


                }
            });




        });

    });



</script>