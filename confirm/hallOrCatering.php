<?php
if(isset($_GET['branchtype']))
{
    $branchtype=base64url_decode($_GET['branchtype']);
    $branchtypeid=base64url_decode($_GET['branchtypeid']);

    if(($branchtype=="hall")||($branchtype=="catering"))
    {
        if($branchtype=="hall")
        {
            $hallid=$branchtypeid;
        }
        else
        {
            $cateringid=$branchtypeid;
        }
    }
    else
    {
        exit();
    }

}