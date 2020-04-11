<h2>Video Gallery</h2>
<hr>
<!-- Grid row -->
<div class="row">



    <?php
    for($i=0;$i<count($video);$i++)
    {
    $img=$video[$i][0];

    $passbyreference=explode('.',$img);
        $file_ext=strtolower(end($passbyreference));
        $extensions= array("mp4");
    if((in_array($file_ext,$extensions)===true )&&(file_exists($destinatios.$img))&&($img!="")) {
        $img = $destinatios . $img;

        ?>

        <!-- Grid column -->
        <div class="col-lg-4 col-md-12 mb-4">

            <!--Modal: Name-->
            <div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">

                    <!--Content-->
                    <div class="modal-content">

                        <!--Body-->
                        <div class="modal-body mb-0 p-0">


                            <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                                <iframe class="embed-responsive-item" src="<?php echo $img;?>"
                                        allowfullscreen></iframe>
                            </div>

                        </div>

                        <!--Footer-->
                        <div class="modal-footer justify-content-center">
                            <span class="mr-4">Spread the word!</span>
                            <a type="button" class="btn-floating btn-sm btn-fb"><i class="fab fa-facebook-f"></i></a>
                            <!--Twitter-->
                            <a type="button" class="btn-floating btn-sm btn-tw"><i class="fab fa-twitter"></i></a>
                            <!--Google +-->
                            <a type="button" class="btn-floating btn-sm btn-gplus"><i class="fab fa-google-plus-g"></i></a>
                            <!--Linkedin-->
                            <a type="button" class="btn-floating btn-sm btn-ins"><i class="fab fa-linkedin-in"></i></a>

                            <button type="button" class="btn btn-outline-primary btn-rounded btn-md ml-4"
                                    data-dismiss="modal">Close
                            </button>

                        </div>

                    </div>
                    <!--/.Content-->

                </div>
            </div>
            <!--Modal: Name-->

            <a><img class="img-fluid z-depth-1" src="<?php echo $img;?>"
                    alt="video"
                    data-toggle="modal" data-target="#modal1"></a>

        </div>


        <?php

        }
    }
    ?>


</div>





