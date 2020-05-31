<?php



function dishesOfPakage($sql)
{
    $dishdetail = queryReceive($sql);
    $display='';
    for ($j = 0; $j < count($dishdetail); $j++)
    {

        $image="https://www.pngkey.com/png/detail/430-4307759_knife-fork-and-plate-vector-icon-dishes-png.png";


        if((file_exists('../../../images/dishImages/'.$dishdetail[$j][2]))&&($dishdetail[$j][2]!=""))
        {
            $image='../../images/dishImages/'.$dishdetail[$j][2];;
        }


        $display.= '
        <div id="dishid' . $dishdetail[$j][1] . '" class="col-md-4 card border" style="height: 30vh;" >
            <img src="'.$image.'" class="card-img-top" style="height: 15vh">
            <p class="col-form-label">' . $dishdetail[$j][0] . '</p>
            <input   data-image="'.$image.'" data-dishname="' . $dishdetail[$j][0] . '"  data-basimage="'. $dishdetail[$j][2].'" type="button" value="Select" class="touchdish btn btn-success">
        </div>';

    }
    return $display;
}