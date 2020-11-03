<?php
$sql='SELECT `itemname`, `itemtype` FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$PackageDetail[0][0].') GROUP by itemtype';
$MenuType=queryReceive($sql);
$includeitemStyleOne='';
$SecondincludeItemStyle='';

for($i=0;$i<count($MenuType);$i++)
{
    $includeitemStyleOne.= '<ul class="list-group mt-5 ml-2 mr-2 " style="width: 23rem;">
            <li class="list-group-item alert-info" style="font-size: 30px;background-color: #c2bebe">' .$MenuType[$i][1].'</li>';
    $sql='SELECT `itemname`, `itemtype`,`price` FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$PackageDetail[0][0].') AND(itemtype="'.$MenuType[$i][1].'")';
    $MenuName=queryReceive($sql);

$SecondincludeItemStyle.='<h5 class="font-weight-bold">' .$MenuType[$i][1].'</h5>
        <div class="form-group row">
        <label class="col-sm-12   col-12 col-md-6 col-lg-4">
                <input value="0" type="radio" name="' .$MenuType[$i][1].'" checked> Default
</label>
         
        ';
    for($k=0;$k<count($MenuName);$k++)
    {
        $includeitemStyleOne.='<li class="list-group-item">'.$MenuName[$k][0];

        $SecondincludeItemStyle.='  <label class="col-sm-12   col-12 col-md-6 col-lg-4">
                <input class="Radiobuttoncheck"  value="'.$MenuName[$k][2].'" type="radio" name="' .$MenuType[$i][1].'"> '.$MenuName[$k][0].'
';
        if($MenuName[$k][2]!=0)
        {
            $includeitemStyleOne.=' <span class="float-right btn btn-outline-danger"> Price :'.$MenuName[$k][2].'</span>';
            $SecondincludeItemStyle.='<span class="text-danger">Extra charge :'.$MenuName[$k][2].'</span>';
        }
        $SecondincludeItemStyle.='</label>';

        $includeitemStyleOne.='</li>';
    }
    $SecondincludeItemStyle.='</div>';
    $includeitemStyleOne.='</ul>';
}


?>