<div class="row">
    <div class="col-12 mb-5">
        <h2>Image Gallery</h2>
        <hr>
        <div class="container">

            <div class="row">
                <div class="row">
                    <?php
                    $extensions= array("jpeg","jpg","png");
                    $display='';
                    for($i=0;$i<count($Images);$i++)
                    {


                        $img=$Images[$i][0];

                        $passbyreference=explode('.',$img);
                        $file_ext=strtolower(end($passbyreference));


                        if((in_array($file_ext,$extensions)==true )&&(file_exists($destinatios.$img))&&($img!="")) {
                            $img = $destinatios . $img;

                            $display .= '    
                <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                        <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                           data-image="'.$img.'?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                           data-target="#image-gallery">
                            <img class="img-thumbnail"
                                 src="'.$img.'?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                 alt="Another alt text">
                        </a>
                    </div>';
                        }

                    }
                    echo $display;


                    ?>










                </div>


                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="image-gallery-title"></h4>
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                </button>

                                <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>









    </div>
</div>


