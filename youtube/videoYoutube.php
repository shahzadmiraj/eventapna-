<h1 > Video Tutorials</h1>
<div class="container">

    <div class="row">

        <?php
        $video=array("QGoO-E_FNYQ","v8s3f_OW48Q","yzWW2cOFqN0","dUSfGcVzvdQ","wK0ujVzDqho","Qe4qE6555G4","qnWY1fEMDS8","SjlRx1D2Mlc");
        $Content=array("First tutorial of online Hall and Food & Catering Booking website | EVENT APNA | Intro 2020",
           "How to Register A Company of Hall, Marquee, Dera, Food & Catering? | EVENT APNA | Tutorial 2 | 2020",
           "How to Register Hall, Marquee, Dera in EVENT APNA? | Tutorial 3 | Food & Catering Management Soft",
            "How to Add Packages of Hall, Marquee, Dera in EVENT APNA? | Tutorial 4 | Food & Catering Management",
            "How to Add Food Packages of Hall, Marquee, Dera in EVENT APNA website? | Tutorial 5 | 2020",
            "How to Add Extra items in Hall, Marquee, Dera in EVENT APNA website?| Tutorial 6 | Manage Extra Item",
            "How to Add Order in Hall, Marquee, Dera in EVENT APNA website?| Tutorial 7 | Hall Order Management",
            "How to Add user in company of Hall, Marquee, Dera, Food&Catering in EVENT APNA website?| Tutorial 8"





            );
        for($i=0;$i<count($video);$i++)
        {



        ?>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-image">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $video[$i] ?>" frameborder="0" allowfullscreen></iframe>
                                </div>

                            </div><!-- card image -->

                            <div class="card-content">
                                <span class="card-title"><?php echo $Content[$i] ?></span>

                            </div><!-- card content -->


                        </div>
                    </div>



        <?php
        }
        ?>


    </div>


</div>