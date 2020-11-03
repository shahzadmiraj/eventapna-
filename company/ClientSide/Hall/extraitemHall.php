<?php
$ExtraitemStyleOne='';
$displayModelExtraItems='<div class="modal fade" id="ExtraitemModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Extra items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="row" style="overflow: auto">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">id#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Item</th>
                            <th scope="col">Type</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Delete</th>
                        </tr>
                        </thead>
                        <tbody>';
for ($j=0;$j<count($ExtraType);$j++)
{


    $ExtraitemStyleOne.= '<h4  data-dishtype="'.$j.'" data-display="hide" class="col-md-12 text-center dishtypes" style="font-size: 30px;background-color: #c2bebe">'.$ExtraType[$j][1].' </h4>
    <div id="dishtype'.$j.'"  class="row container" >


';

    $sql='SELECT ex.id,ex.name,ex.price,ex.image,ex.active,(SELECT `name` FROM `Extra_item_type` WHERE id=ex.Extra_item_type_id) FROM Extra_Item as ex
 INNER join
 ExtraItemControl as EIC
 on(EIC.Extra_Item_id=ex.id)
 WHERE (ISNULL(ex.expire)) AND (ex.Extra_item_type_id='.$ExtraType[$j][0].')AND(ISNULL(EIC.expire))AND(EIC.hall_id =('.$hallInformation[0][0].'))';

    $Extraitem=queryReceive($sql);
    $image = "";
    for ($i = 0; $i < count($Extraitem); $i++)
    {
        $image = $Extraitem[$i][3];
        if ((file_exists('../../../images/hallExtra/' . $image)) && ($image != ""))
            $image = '../../../images/hallExtra/' . $image;
        else
            $image = '../../../images/systemImage/imageNotFound.png';

        $ExtraitemStyleOne .= '
            <div class="col-md-4 mb-5 ">
            <div class="card">
                  <div class="text-center">
            <img src="' . $image . '" class="card-img-top " src="" alt="Image" style="width: 200px">
                </div>
                
                <div class="card-body">
                    <p class="card-title">' . $Extraitem[$i][1] . '</p>
                    <span class="card-subtitle text-danger">Amount ' . $Extraitem[$i][2] . '</span>
                </div>
            </div>
            </div>
            ';
        $displayModelExtraItems.= '<tr>
                            <th scope="row">' . $Extraitem[$i][0] . '</th>
                            <td><img src="'.$image.'" style="width: 80px"></td>
                            <td>' . $Extraitem[$i][1] . '</td>
                            <td>' . $Extraitem[$i][5] . '</td>
                            <td><lable>' . $Extraitem[$i][2] . '</lable></td>
                            <td><input id="TableNotReal' . $Extraitem[$i][0] . '"  placeholder="Quantity" type="number" value="1"></td>
                            <td><button data-notrealrowprice="' . $Extraitem[$i][2] . '" data-notrealrowtype="' . $Extraitem[$i][5] . '" data-notrealname="' . $Extraitem[$i][1] . '" data-notrealrowimage="' . $image . '" data-notrealrowid="' . $Extraitem[$i][0] . '"   class="btn btn-outline-primary AddRowOfTable">+</button></td>
                        </tr>';
    }
    $ExtraitemStyleOne.=' </div>';

}
$displayModelExtraItems.= '   </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>'
?>



<!-- Modal -->



