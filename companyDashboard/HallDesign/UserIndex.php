
<div class="row">



    <?php

    $displayNav='';
    for($iCom=0;$iCom<count($usersCom);$iCom++)
    {

        $img= "";

        if((file_exists('../images/hall/'.$usersCom[$iCom][2]))&&($usersCom[$iCom][2]!=""))
        {
            $img= "../images/hall/".$usersCom[$iCom][2];
        }
        else
        {
            $img='../images/systemImage/imageNotFound.png';
        }


        $tokenCom=$usersCom[$iCom][4];
        $EncordedCom=$usersCom[$iCom][0];
        $QueryCom='uid='.$EncordedCom.'&token='.$tokenCom;
        ?>


        <?php
        $displayNav.='
                  <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 text-center">
                 <img src="'.$img.'" class="card-img-top" style="width: 200px">
                    <h6 class="m-0 font-weight-bold text-primary">'.$usersCom[$iCom][1].'</h6>
                   
                </div>
                <div class="card-body">
                 
                 
           ';

        //start link




        $displayNav.='<a href="'.$Root.'user/UserProfile.php?' . $QueryCom . '" class="btn btn-outline-warning btn-icon-split"><span class="icon text-white-50"><i class="fas fa-id-card "></i></span> <span class="text">User Profile</span></a><div class="my-2"></div>';


        //end link

        $displayNav.='     </div>
              </div>

            </div>';

        ?>



        <?php
    }


    echo $displayNav;




    ?>



</div>