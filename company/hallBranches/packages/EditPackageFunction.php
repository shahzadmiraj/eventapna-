<?php

function ShowFirstSelectedChoice($orderDetail_id,$packageDateid)
{
    $sql='SELECT p.id FROM packageDate as pd INNER join packages as p
on (p.id=pd.package_id)
WHERE
(pd.id='.$packageDateid.')';
    $packagedetail=queryReceive($sql);
    if(count($packagedetail)==0)
        exit();


    $sql='SELECT `id`, `itemname`,`itemtype` FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$packagedetail[0][0].') GROUP BY itemtype';
    $MenuType=queryReceive($sql);
    //print_r($MenuType);
    $MenuSelectedIdsList='';
    $MenuExistNowIds=array();

        if(count($MenuType)>0)
        $MenuExistNowIds = array_column($MenuType, 0);
        $sql='SELECT `menu_id` FROM `hallChoiceSelect` WHERE (orderDetail_id='.$orderDetail_id.') AND (ISNULL(expire))';
        $MenuIdArray=queryReceive($sql); //null


        $MenuSelectedIds=array();
        if(count($MenuIdArray)>0)
        $MenuSelectedIds = array_column($MenuIdArray, 0);

        $MenuSelectedIdsList=implode(',', $MenuSelectedIds);
        $arraySingleMerge=array_merge($MenuSelectedIds,$MenuExistNowIds);
        $arraySingleMergeUnique=array_unique($arraySingleMerge);
        $ListOfIdz = implode(',', $arraySingleMergeUnique);

        $sql='SELECT `id`, `itemname`,`itemtype` FROM `menu` WHERE id in ('.$ListOfIdz.') GROUP BY itemtype';
        $MenuType=queryReceive($sql);




    $OneD=array();
    if(count($MenuType)>0)
    $OneD = array_column($MenuType, 2);
    $List = implode(',', $OneD);

    $display='';

    if(count($MenuType)>0)
    {
        $display = "<h3 class='text-center col-sm-12   col-12 col-md-12 col-lg-12' >Choices of items in package</h3>
                    <input type='text'  hidden name='MenuTypeInpackages' id='MenuTypeInpackages' value='".$List."'>
                    ";
    }
    for($i=0;$i<count($MenuType);$i++)
    {
        $display.='
                                     
         <div class="form-group col-sm-12   col-12 col-md-6 col-lg-6">
            <label class="col-form-label">Select One <span>'.$MenuType[$i][2].'</span> Item type  </label>
            <div class="input-group mb-3 input-group-lg">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-utensils"></i></span>
                </div>
                <select id="'.$MenuType[$i][2].'"   name="SelectOptionFromItem'.$MenuType[$i][2].'" class="form-control MenuTypeOptionChanges">';

        $MenuNameselected=array();
        if(count($MenuIdArray)>0)
        {
            $sql = 'SELECT `id`, `itemname`,`itemtype`,`price` FROM `menu` WHERE id in (' . $MenuSelectedIdsList . ') AND (itemtype="' . $MenuType[$i][2] . '")';
            $MenuNameselected = queryReceive($sql);
        }

        if(count($MenuNameselected)>0)
        {
            $display.='  <option data-price="'.$MenuNameselected[0][3].'"  value="'.$MenuNameselected[0][0].'">'.$MenuNameselected[0][1].' with Price: '.$MenuNameselected[0][3].'    </option>';

            $sql='SELECT `id`, `itemname`,`itemtype`,`price` FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$packagedetail[0][0].')AND (itemtype="'.$MenuType[$i][2].'") AND(id!='.$MenuNameselected[0][0].')';
        }
        else
        {
            $sql='SELECT `id`, `itemname`,`itemtype`,`price` FROM `menu` WHERE (ISNULL(expire))AND (package_id='.$packagedetail[0][0].')AND (itemtype="'.$MenuType[$i][2].'")';
        }
        $display.='<option data-price="0"  value="Default">Select</option>';

        $MenuName=queryReceive($sql);
        for($k=0;$k<count($MenuName);$k++)
        {
            $display.='  <option data-price="'.$MenuName[$k][3].'"  value="'.$MenuName[$k][0].'">'.$MenuName[$k][1].' with Price: '.$MenuName[$k][3].'    </option>';
        }

        $display.='</select>
            </div>
        </div>';
    }

    echo $display;
}
?>

