<?php

function showPrizrListDetail($hallname,$hallid,$daytime,$companyid)
{

    $encodehallid=base64url_encode($hallid);
    $icon='';
    $monthsArray = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');

    if($daytime=="Morning")
    {
        $icon='<i class="fas fa-coffee ml-4"></i>';
    }
    else if($daytime=="Afternoon")
    {
        $icon='<i class="fas fa-sun ml-4"></i>';
    }
    else
    {
        $icon='<i class="fas fa-moon ml-4"></i>';
    }


    $display='<table class="col-12 badge-light border">
        <thead>

        <tr>
            <th scope="col" >
                <h4 align="center"><i class="fas fa-list-ol mr-3"></i>'.$daytime.' Prize list</h4>
            </th>
        </tr>
        </thead>
        <tbody>';
    for($i=0;$i<count($monthsArray);$i++)
    {
        $sql='SELECT `id`,`price` FROM `hallprice` WHERE (hall_id='.$hallid.')AND (isFood=0) AND (dayTime="'.$daytime.'") AND ISNULL(expire)
AND (month="'.$monthsArray[$i].'")';
        $detailList=queryReceive($sql);
        $display.='
        <tr>
            <td scope="col" >
                
                <div class="alert-light col-12 card mt-5 border border-dark">
                <h1 align="center">'.$monthsArray[$i].''.$icon.'</h1>
                
                
               
                
                <div class="form-group row col-12 p-0 ">
                         <label class="col-form-label col-4"> Prize Only Seating </label>
                        <div class="input-group  input-group-lg col-8">
                            <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-money-bill-alt"></i></span>
                            </div>
                             <input data-menuid="'.$detailList[0][0].'" class="changeSeating form-control" type="number" value="'.$detailList[0][1].'">
                        </div>

                 </div>

                   
                   
                   
                    <h6 class="col-12 mt-3">List of packages with Food</h6>
                    <a  href="addnewpackage.php?hallname='.$hallname.'&month='.$monthsArray[$i].'&daytime='.$daytime.'&hall='.$encodehallid.'" class="form-control  btn-primary  text-center"><i class="fas fa-plus-square"></i> Add New Package</a>
                    
                    
                    
                    <div class="form-group row ">';

        $sql='SELECT `id`,`expire`, `package_name` FROM `hallprice` WHERE (hall_id='.$hallid.')
AND (dayTime="'.$daytime.'") AND (month="'.$monthsArray[$i].'") AND (isFood=1)AND ISNULL(expire)';
        $ALLpackages=queryReceive($sql);
        for ($j=0;$j<count($ALLpackages);$j++)
        {

            //only difference of colors
            if($ALLpackages[$j][1]!="")
            {
                $display.= '<a href="?editpackage=yes&hallname='.$hallname.'&month='.$monthsArray[$i].'&daytime='.$daytime.'&packageid='.$ALLpackages[$j][0].'&hall='.$encodehallid.'" class="btn btn-danger col-sm-4 col-md-3 col-xl-3 m-1">'.$ALLpackages[$j][2].'</a>';

            }
            else
            {
                $display.= '<a href="?editpackage=yes&hallname='.$hallname.'&month='.$monthsArray[$i].'&daytime='.$daytime.'&packageid='.$ALLpackages[$j][0].'&hall='.$encodehallid.'" class="btn btn-warning col-sm-4 col-md-3 col-xl-3 m-1">'.$ALLpackages[$j][2].'</a>';
            }



        }


        $display.='</div></div>
            </td>
        </tr>';


    }
    $display.='
        </tbody>
    </table>';
    return $display;
}

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
        <div id="dishid' . $dishdetail[$j][1] . '" class="col-4 alert-danger border m-1 form-group p-0" style="height: 30vh;" >
            <img src="'.$image.'" class="col-12" style="height: 15vh">
            <p class="col-form-label" class="form-control col-12">' . $dishdetail[$j][0] . '</p>
            <input   data-image="'.$image.'" data-dishname="' . $dishdetail[$j][0] . '"  data-basimage="'. $dishdetail[$j][2].'" type="button" value="Select" class="form-control col-12 touchdish btn btn-success">
        </div>';

    }
    return $display;
}