


<div class="container">
    <div class="mb-5">

        <h2>Comments </h2>
        <hr>
        <div class="row bootstrap snippets">

            <div class="col-12 col-md-offset-2 col-sm-12 m-auto">
                <div class="comment-wrapper">
                    <div class="panel panel-info ">
                        <form id="commentform">
                            <?php
                            echo $formApend;
                            ?>
                            <div class="panel-body">
                                <textarea name="comment" class="form-control" placeholder="write a comment..." rows="3"></textarea>
                                <br>
                                <div id="divMain ">
                                    <div id="demo1" name="stars" value="3" ></div>
                                </div>
                                <input name="image" type="file" class="btn-outline-secondary   btn col-5 ">
                                <button id="btncoment" type="button" class="btn btn-info pull-right float-right col-5">Post</button>
                        </form>
                        <?php
                        $display='';
                        $commentresult=queryReceive($sql);
                        for ($i=0;$i<count($commentresult);$i++)
                        {
                            $display.='                   
                    <div class="clearfix" ></div>
                        <hr>
                        <ul class="media-list" >
                                                        
                            <li class="media">
                                <a href="#" class="pull-left">
                                    <img src="';
                            //userimage
                            if((file_exists($destinatiosUser.$commentresult[$i][7])) &&($commentresult[$i][7]!=""))
                            {
                                $display.=$destinatiosUser.$commentresult[$i][7];
                            }
                            else
                            {
                                $display.='https://bootdey.com/img/Content/user_1.jpg"';
                            }
                            $display.='alt="" class="img-circle"></a>
                                <div class="media-body">
                                <span class="text-muted pull-right">
                                    <small class="text-dark">'.$commentresult[$i][5].'</small>
                                </span>
                                    <strong class="text-primary">@'.$commentresult[$i][6].' </strong><br>
                             ';
                            //star out of 5
                            for($s=0;$s<5;$s++)
                            {
                                if($commentresult[$i][10]>$s)
                                {

                                    $display.='<span class="fa fa-star checked"></span>';
                                }
                                else
                                {
                                    $display.='<span class="fa fa-star"></span>';
                                }
                            }

                            //paragraph of image uploaded comment packageid
                            $display.='
                                   <p>';
                            //user uploaded image or video



                            $passbyreference=explode('.',$commentresult[$i][11]);
                            $file_ext=strtolower(end($passbyreference));
                            $extensions= array("mp4");
                            if((in_array($file_ext,$extensions)===false)&&(file_exists($destinationComment.$commentresult[$i][11])) &&($commentresult[$i][11]!=""))
                            {
                                $display.='<img class="col-12"  style="width: 100%;height: 40vh" class="m-2"  src="'.$destinationComment.$commentresult[$i][11].'"><br>';
                            }
                            else if((in_array($file_ext,$extensions)===true)&&(file_exists($destinationComment.$commentresult[$i][11])) &&($commentresult[$i][11]!=""))
                            {
                                $display.='<iframe allowfullscreen class="col-12"  style="width: 100%;height: 40vh" class="m-2"  src="'.$destinationComment.$commentresult[$i][11].'"></iframe><br>';

                            }
                            //package id
                            if(($commentresult[$i][8]!="")AND($isPackShow))
                            {
                                $display.='
                                                          <span class="alert-light ml-3">Packageid#'.$commentresult[$i][8]. '<br></span>';
                            }
                            //comment and delete button
                            $display.=$commentresult[$i][3].'<button hidden type="button" class="btn btn-danger float-right deletecomment" data-deletecomment="'.$commentresult[$i][2].'"><i class="fas fa-trash-alt"></i>Delete</button>
                                    
                                    
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
</div>

<script>

    $(document).ready(function () {

        var scores=3;
        $(document).ready(function(){
            $('#demo1').jsRapStar({
                onClick:function(score){
                    $(this)[0].StarF.css({color:'red'});
                    scores=score;
                }});
        });
        $("#btncoment").click(function (e)
        {
            var formdata = new FormData($("#commentform")[0]);
            formdata.append("option", "CommentOnHall");
            formdata.append("stars", scores);
            $.ajax({
                url: "<?php echo $urldata;?>",
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

<link rel="stylesheet" href="../../../Fractional-Star-Rating-jsRapStar/jsRapStar.css" />
<link rel="stylesheet" href="../../../Fractional-Star-Rating-jsRapStar/index.css" />
<script src="../../../Fractional-Star-Rating-jsRapStar/jsRapStar.js"></script>