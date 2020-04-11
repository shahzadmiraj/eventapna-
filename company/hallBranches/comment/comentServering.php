

<div class="container card">
    <h1 class="font-weight-light  mt-4 mb-0">Comments</h1>

    <hr class="mt-2 mb-3">




    <div class="row bootstrap snippets">

        <div class="col-md-12 col-md-offset-2 col-sm-12 m-auto">
            <div class="comment-wrapper">
                <div class="panel panel-info ">
                    <form id="commentform">
                        <?php
                        echo '<input hidden type="number" name="hallid" value="'.$hallid.'">';
                        ?>
                        <div class="panel-body">
                            <textarea name="comment" class="form-control" placeholder="write a comment..." rows="3"></textarea>
                            <br>

                            <button id="btncoment" type="button" class="btn btn-info pull-right float-right col-5">Post</button>
                    </form>

                    <?php
                    $display='';

                    $sql='SELECT `hall_id`, `catering_id`, `id`, `comment`, `email`, `datetime`, `expire` FROM `comments` WHERE (hall_id='.$hallid.')&&(ISNULL(expire))';
                    $commentresult=queryReceive($sql);
                    for ($i=0;$i<count($commentresult);$i++)
                    {
                        $display.='                   
                    <div class="clearfix"></div>
                        <hr>
                        <ul class="media-list text-white">





                            <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="https://bootdey.com/img/Content/user_1.jpg" alt="" class="img-circle">
                                </a>
                                <div class="media-body">
                                <span class="text-muted pull-right">
                                    <small class="text-dark">'.$commentresult[$i][5].'</small>
                                </span>
                                    <strong class="text-warning">@'.$commentresult[$i][4].'</strong>
                                    <p>
                                       '.$commentresult[$i][3].'
                                    </p>
                                </div>
                            </li>

                        </ul>
';
                    }


                    echo $display;
                    ?>

                </div>
            </div>
        </div>

    </div>
</div>



</div>











<script>


    $(document).ready(function ()
    {



        $("#btncoment").click(function ()
        {
            var formdata = new FormData($("#commentform")[0]);
            formdata.append("option", "commentAdd");

            $.ajax({
                url: urldata,
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
                    location.reload();

                }


            });
        }) ;








    });



</script>