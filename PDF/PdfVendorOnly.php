<?php

if(!(isset($_POST['PrintedOrders']) && isset($_POST['BranchName']) && isset($_POST['ViewOrDownload']) ))
    header('location:../index.php');



include_once ('../connection/connect.php');
include  ("../access/userAccess.php");
RedirectOtherwiseOnlyAccessUsersWho("Owner,Employee,Viewer","../index.php");

require('../fpdf182/fpdf.php');

//header('Content-Disposition: attachment; filename="downloaded.pdf"');
class PDF extends FPDF
{

    function HeaderCompany($BranchName,$userName,$printDate)
    {
        // Logo
        // $this->Image('../gmail.png',10,6,20);
        // Arial bold 15
        $this->SetFont('Arial','B',20);
        // Move to the right
        // Title
        $this->Cell(189,10,$BranchName,0,1,'C');

        $this->SetFont('Arial','B',8);

        $this->Cell(45,10,"Printed UserName ",0,0);
        $this->Cell(40,10,$userName,0,0);
        $this->Cell(40,10,"Printed Date Time",0,0);
        $this->Cell(64,10,$printDate,0,1);


    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom

        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial','I',9);

        $this->Cell(189,0,"",1,1);

       // $this->Image('../gmail.png', 5, $this->GetY(), 12);


        $this->Cell(0,10,"EVENT APNA (website:www.eventapna.com) , (Gmail:support@eventapna.com) , (whatsapp:+923227300538)   ".'Page '.$this->PageNo().'/{nb}',0,1,'R');

    }


    function cateringorderPrint($detailorder,$person,$numbers,$dishDetail)
    {



        $displayDateTime="Order Status : ".$detailorder[0][17]."  , Date(Y:M:D) : ". $detailorder[0][14]."  , Time :".$detailorder[0][16]." , persons ".$detailorder[0][12];

        $this->Cell(30,10,$displayDateTime,0,1);



        if($detailorder[0][19]!="")
        {

            $text='Description : '.$detailorder[0][19];
            $nb=$this->WordWrap($text,189);
            $this->Write(10,$text);

            $this->Cell(189,10,"",0,1);
        }

        if($detailorder[0][1]!="")
        {
            //address must be Own HAll in catering services
            //hall
            $sql = 'SELECT `name`,(SELECT `address` FROM `location` WHERE id=hall.location_id) FROM `hall` WHERE id=' . $detailorder[0][1] . '';
            $hallName=queryReceive($sql);
            $detailorder[0][23]="Hall Name : ".$hallName[0][0]." || ".$hallName[0][1];
        }


        $displayaddress="Delivering Address : ".$detailorder[0][23];

        $this->Cell(30,10,'Customer Name ',0,0);
        $this->Cell(30,10,$person[0][0]."     Order no # : ".$detailorder[0][0],0,1);
        $this->Cell(189,10,$displayaddress,0,1);

        $numberdis="customer # ";
        for($i=0;($i<count($numbers)&&($i!=3));$i++)
        {
            $numberdis.=$numbers[$i][0]." ,";
        }
        $this->Cell(189,10,$numberdis,0,1);

        //order billing

        $this->Cell(149,10,"Dish Name",0,0);
        $this->Cell(40,10,"Quantity",0,1);
        //$this->Cell(40,10,"Price",1,0);
        //$this->Cell(45,10,"Total price",1,1);

        $systemCalculate=0;

        for($i=0;$i<count($dishDetail);$i++)
        {


            $this->Cell(149,10,($i+1)."  ".$dishDetail[$i][5],0,0);
            $this->Cell(40,10,$dishDetail[$i][3],0,1);
            //$this->Cell(40,13,(int)($dishDetail[$i][2]),1,0);
            //$systemCalculate+=(int)($dishDetail[$i][3]*$dishDetail[$i][2]);
           // $this->Cell(45,13,(int)($dishDetail[$i][3]*$dishDetail[$i][2]),1,1);



            // detail of dish attributes

            $sql='SELECT `name`,quantity FROM `attribute` WHERE (ISNULL(expire)) AND (dishWithAttribute_id='.$dishDetail[$i][4].')';
            $AttributeDetail=queryReceive($sql);
            if(count($AttributeDetail)>0)
            {


                $display = '';
                for ($j = 0; $j < count($AttributeDetail); $j++) {
                    $display .= $AttributeDetail[$j][0] . "=" . $AttributeDetail[$j][1] . "  ,  ";
                }
                $display .= $dishDetail[$i][1];
                $this->Cell(189, 3, $display, 0, 1);
            }
        }


    }
    function hallorderPrint($detailorder,$person,$numbers,$menu,$DetailExtraItems)
    {


        $this->Cell(30,10,'Customer Name ',0,0);
        $this->Cell(30,10,$person[0][0]."  .........    Order id: ".$detailorder[0][0],0,1);

        $numberdis="customer # ";
        for($i=0;($i<count($numbers)&&($i!=3));$i++)
        {
            $numberdis.=$numbers[$i][0]." ,";
        }
        $this->Cell(189,10,$numberdis,0,1);


        $this->Cell(45,10,"No of Guest : ",0,0);
        $this->Cell(45,10,$detailorder[0][12],0,0);
        $this->Cell(45,10,"Event Booked Date : ",0,0);
        $this->Cell(45,10,$detailorder[0][14],0,1);



        $this->Cell(45,10,"Hall Timing : ",0,0);
        $Eventtime='';
        if($detailorder[0][16]=="09:00:00")
        {
            $Eventtime="Morning";
        }
        else if($detailorder[0][16]=="12:00:00")
        {
            $Eventtime="Afternoon";
        }
        else
        {
            $Eventtime="Evening";
        }
        $perHead="Sitting Only";
        if($detailorder[0][3]==1)
        {
            $perHead="Food +Sitting";
        }
        $this->Cell(45,10,$Eventtime,0,0);
        $this->Cell(45,10,"per Head  : ",0,0);
        $this->Cell(45,10,$perHead,0,1);


        $this->Cell(45,10,"current Order Status : ",0,0);
        $this->Cell(45,10,$detailorder[0][13],0,1);
      //  $this->Cell(45,10,"Customer Visited Date : ",0,0);
        //$this->Cell(45,10,$detailorder[0][15],0,1);


        if($detailorder[0][19]!="")
        {

            $text='Description : '.$detailorder[0][19];
            $nb=$this->WordWrap($text,189);
            $this->Write(10,$text);

            $this->Cell(189,10,"",0,1);
        }

        if(count($DetailExtraItems)>0)
        {
         //hall extra items
            $displayExtraitems="Extra Item Detail : ";
            for($i=0;$i<count($DetailExtraItems);$i++)
            {

                $displayExtraitems.=$DetailExtraItems[$i][0].'  ,  ';
            }

            $nb=$this->WordWrap($displayExtraitems,189);
            $this->Write(10,$displayExtraitems);

            $this->Cell(189,10,"",0,1);

        }



        if($detailorder[0][3]==1)
        {
            //menu if per head with food
            $displayExtraitems="Package Detail : ";
            for($i=0;$i<count($menu);$i++)
            {

                $displayExtraitems.=$menu[$i][0].'  ,  ';
            }

            $nb=$this->WordWrap($displayExtraitems,189);
            $this->Write(10,$displayExtraitems);
            $this->Cell(189,10,"",0,1);



            $sql = 'SELECT `name`,`company_id`,(SELECT `address`FROM `cateringLocation` WHERE ISNULL(expire)AND(catering_id=catering.id)) FROM `catering` WHERE id=' . $detailorder[0][2] . '';
            $CateringName=queryReceive($sql);
            $this->Cell(45,10,"Catering  Branch  : ",0,0);
            $this->Cell(45,10,$CateringName[0][0],0,1);

        }








    }




    function billing($userName,$printDate,$orderIds,$BranchName)
    {


        $this->HeaderCompany($BranchName, $userName, $printDate);


        for ($i = 0; $i < count($orderIds); $i++)
        {
            if(!is_numeric($orderIds[$i]))
                continue;
            $sql = 'SELECT `id`, `hall_id`, `catering_id`,(SELECT p.isFood FROM orderDetail as od INNER join packageDate as pd
on (od.packageDate_id=pd.id)
INNER join packages as p
on (p.id=pd.package_id)
WHERE
(od.id=orderDetail.id)),
 `user_id`, `booking_date`, `booking_date`, `booking_date`, 
 `booking_date`, 1, `person_id`, `total_amount`, 
 `total_person`, `status_hall`, `destination_date`, 
 `booking_date`, `destination_time`, `status_catering`, 
 `booking_date`,`describe`,(SELECT p.describe FROM orderDetail as od INNER join packageDate as pd
on (od.packageDate_id=pd.id)
INNER join packages as p
on (p.id=pd.package_id)
WHERE
(od.id=orderDetail.id)),`packageDate_id`,(SELECT p.price FROM orderDetail as od INNER join packageDate as pd
on (od.packageDate_id=pd.id)
INNER join packages as p
on (p.id=pd.package_id)
WHERE
(od.id=orderDetail.id)),`address`,`discount`, `extracharges`  FROM `orderDetail` WHERE id=' . $orderIds[$i] . '';
            $detailorder = queryReceive($sql);




            //customer information
            $sql = "SELECT `name`, `cnic`, `id` , `address` FROM `person` WHERE id=" . $detailorder[0][10] . "";
            $person = queryReceive($sql);


            // customer numbers
            $sql = "SELECT n.number  FROM number as n inner JOIN person as p ON p.id=n.person_id
WHERE (p.id='" . $person[0][2] . "')AND(ISNULL(n.expire)) order BY n.id";
            $numbers = queryReceive($sql);


            //Order number print
            $this->Cell(189,10,"Order number : ".($i+1),1,1,'C');
            if (($detailorder[0][1]== ""))
            {
                //catering orders


                //detail of order dish
                $sql = 'SELECT id,dd.describe, dd.price, dd.quantity, dd.dishWithAttribute_id,(SELECT (SELECT d.name FROM dish as d WHERE d.id=dwa.dish_id) FROM dishWithAttribute as dwa WHERE dwa.id= dd.dishWithAttribute_id) FROM  dish_detail as dd WHERE (dd.orderDetail_id=' . $orderIds[$i] . ')AND(ISNULL(dd.expire))';
                $dishDetail = queryReceive($sql);


                $this->cateringorderPrint($detailorder, $person, $numbers, $dishDetail);

            } else
                {
                //hall order
                $menu = array();
                    //with menu
                    $sql = 'SELECT `itemname`, `itemtype`,`price` FROM `menu` WHERE (package_id=' . $detailorder[0][21] . ') AND ISNULL(expire)';
                    $menu = queryReceive($sql);

                $sql = 'SELECT (SELECT ei.name FROM Extra_Item as ei WHERE ei.id=hei.Extra_Item_id), (SELECT ei.price FROM Extra_Item as ei WHERE ei.id=hei.Extra_Item_id) from hall_extra_items as hei
WHERE (hei.orderDetail_id=' . $orderIds[$i] . ')AND(ISNULL(hei.expire))';
                $DetailExtraItems = queryReceive($sql);


                $this->hallorderPrint($detailorder,$person, $numbers, $menu, $DetailExtraItems);

            }


        }
    }



    function WordWrap(&$text, $maxwidth)
    {
        $text = trim($text);
        if ($text==='')
            return 0;
        $space = $this->GetStringWidth(' ');
        $lines = explode("\n", $text);
        $text = '';
        $count = 0;

        foreach ($lines as $line)
        {
            $words = preg_split('/ +/', $line);
            $width = 0;

            foreach ($words as $word)
            {
                $wordwidth = $this->GetStringWidth($word);
                if ($wordwidth > $maxwidth)
                {
                    // Word is too long, we cut it
                    for($i=0; $i<strlen($word); $i++)
                    {
                        $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                        if($width + $wordwidth <= $maxwidth)
                        {
                            $width += $wordwidth;
                            $text .= substr($word, $i, 1);
                        }
                        else
                        {
                            $width = $wordwidth;
                            $text = rtrim($text)."\n".substr($word, $i, 1);
                            $count++;
                        }
                    }
                }
                elseif($width + $wordwidth <= $maxwidth)
                {
                    $width += $wordwidth + $space;
                    $text .= $word.' ';
                }
                else
                {
                    $width = $wordwidth + $space;
                    $text = rtrim($text)."\n".$word.' ';
                    $count++;
                }
            }
            $text = rtrim($text)."\n";
            $count++;
        }
        $text = rtrim($text);
        return $count;
    }

}



function action($userName,$printDate,$orderid,$action,$BranchName)
{

    // Instanciation of inherited class
    $pdf = new PDF('P',"mm","A4");
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',8);
    $pdf->billing($userName,$printDate,$orderid,$BranchName);
    //$pdf->Output($action,"orderid".$orderid."date".$printDate);


    $pdf->Cell(189,10,"",0,1);

    $pdf->Output($action,"date".$printDate.".pdf");
}



    $sql='SELECT `company_id`,`username`, `jobTitle` FROM `user` WHERE id='.$_COOKIE['userid'].'';
    $userdetail=queryReceive($sql);

    $PrintedOrders=$_POST['PrintedOrders'];
    $PrintedOrdersArray= explode(",", $PrintedOrders);
    $ViewOrDownload=$_POST['ViewOrDownload'];
    if($ViewOrDownload=="View")
        $ViewOrDownload="I";
    else
        $ViewOrDownload="D";

    action($userdetail[0][1],date('Y-M-D'),$PrintedOrdersArray,$ViewOrDownload,$_POST['BranchName']);

?>

<?php
include_once ("../webdesign/footer/EndOfPage.php");
?>
