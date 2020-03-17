<?php
include_once ('connect.php');
require('../fpdf182/fpdf.php');

class PDF extends FPDF
{

    function HeaderCompany($branchinfo,$owerinfo)
    {
        // Logo
       // $this->Image('../gmail.png',10,6,20);
        // Arial bold 15
        $this->SetFont('Arial','B',10);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,$branchinfo[0][0],1,1,'C');

        $displaynum=$branchinfo[0][0]." company # : ";
        for($i=0;$i<count($owerinfo)&&($i!=3);$i++)
        {
            if($owerinfo[$i][1]!="")
            {
                //$displaynum .= $owerinfo[$i][0] . " " . $owerinfo[$i][1] . " | ";
                $displaynum .= $owerinfo[$i][1] . " , ";
            }
        }

        $this->Cell(189,10,$displaynum,0,1,"C");

    }

// Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom

        $this->SetY(-15);

        // Arial italic 8
        $this->SetFont('Arial','I',9);

        $this->Cell(189,0,"",1,1);

        $this->Image('../gmail.png', 5, $this->GetY(), 12);


        $this->Cell(0,10,"EVENT APNA (website:www.eventapna.com) , (Gmail:group.of.shaheen@gmail.com) , (whatsapp:0923350498004)   ".'Page '.$this->PageNo().'/{nb}',0,1,'R');
    }


    function cateringorderPrint($detailorder,$person,$numbers,$addresDetail,$dishDetail,$address,$totalReceivedPayment,$branchinfo,$owerinfo,$userName,$printDate)
    {


        $this->HeaderCompany($branchinfo,$owerinfo);

        $this->Cell(189,10,'Information ',1,1,'C');
        $displayDateTime="order status : ".$detailorder[0][17]." , Date : ". $detailorder[0][14]."  , Time :".$detailorder[0][16]." , persons ".$detailorder[0][12];


        $this->Cell(30,10,$displayDateTime,0,1);

        if($detailorder[0][19]!="")
        {

            $text='Description : '.$detailorder[0][19];
            $nb=$this->WordWrap($text,189);
            $this->Write(10,$text);

            $this->Cell(189,10,"",0,1);
        }
        $displayaddress="Delivering Address : ".$addresDetail[0][1]." , ".$addresDetail[0][2]." , ".$addresDetail[0][3]." , ".$addresDetail[0][4];

        $this->Cell(30,10,'Customer Name ',0,0);
        $this->Cell(30,10,$person[0][0],0,1);
        $this->Cell(189,10,$displayaddress,0,1);

        $numberdis="customer # ";
        for($i=0;($i<count($numbers)&&($i!=3));$i++)
        {
            $numberdis.=$numbers[0][$i]." ,";
        }
        $this->Cell(189,10,$numberdis,0,1);

        $this->Cell(45,10,"User Name : ",0,0);

        $this->Cell(45,10,$userName,0,0);

        $this->Cell(45,10,"Printed Date:",0,0);

        $this->Cell(45,10,$printDate,0,1);


        //$this->Cell(189,10,$displayaddress,0,1);




        $this->Cell(189,10,"Catering Order",1,1,"C");


        //order billing


        $this->Cell(64,10,"Dish Name",1,0);
        $this->Cell(40,10,"quantity",1,0);
        $this->Cell(40,10,"price",1,0);
        $this->Cell(45,10,"total price",1,1);


        $systemCalculate=0;

        for($i=0;$i<count($dishDetail);$i++)
        {


            $this->Cell(64,10,$dishDetail[$i][5],0,0);
            $this->Cell(40,13,$dishDetail[$i][3],1,0);
            $this->Cell(40,13,$dishDetail[$i][2],1,0);
            $systemCalculate+=$dishDetail[$i][3]*$dishDetail[$i][2];
            $this->Cell(45,13,$systemCalculate,1,1);



            // detail of dish attributes
            $sql='SELECT a.name,an.quantity FROM attribute_name as an INNER join attribute as a
on
(an.attribute_id=a.id)
WHERE
(an.dish_detail_id='.$dishDetail[$i][0].')
';
$attributeDetail=queryReceive($sql);

            $display='';
            for($j=0;$j<count($attributeDetail);$j++)
            {
                $display.=$attributeDetail[$j][0]."=".$attributeDetail[$j][1]."  ,  ";
            }
            $display.=$dishDetail[$i][1];
            $this->Cell(189,3,$display,0,1);
            $this->Cell(189,0,"",1,1);
        }
        $this->Cell(144,10,"total Amount= ",1,0);
        $this->Cell(45,10,$systemCalculate,1,1);

        $this->Cell(144,10,"receive Amount= ",1,0);
        $this->Cell(45,10,$totalReceivedPayment[0][0],1,1);

        $this->Cell(144,10,"Remaining Amount ",1,0);
        $this->Cell(45,10,$systemCalculate-$totalReceivedPayment[0][0],1,1);


        $this->Cell(144,10,"your Demanded Amount= ",1,0);
        $this->Cell(45,10,$detailorder[0][11],1,1);

        $this->Cell(144,10,"your Demanded Remaining Amount ",1,0);
        $this->Cell(45,10,$detailorder[0][11]-$totalReceivedPayment[0][0],1,1);


    }
    function hallorderPrint($detailorder,$person,$numbers,$menu,$totalReceivedPayment,$branchinfo,$owerinfo,$userName,$printDate,$DetailExtraItems)
    {
        $this->HeaderCompany($branchinfo,$owerinfo);

        $this->Cell(189,10,'Information ',1,1,'C');
        //$displayDateTime="order status : ".$detailorder[0][13]." , Date : ". $detailorder[0][14]."  , Time :".$detailorder[0][16]." , persons ".$detailorder[0][12];

        $this->Cell(30,10,'Customer Name ',0,0);
        $this->Cell(30,10,$person[0][0],0,1);

        $numberdis="customer # ";
        for($i=0;($i<count($numbers)&&($i!=3));$i++)
        {
            $numberdis.=$numbers[0][$i]." ,";
        }
        $this->Cell(189,10,$numberdis,0,1);



        $this->Cell(45,10,"User Name : ",0,0);

        $this->Cell(45,10,$userName,0,0);

        $this->Cell(45,10,"Printed Date:",0,0);

        $this->Cell(45,10,$printDate,0,1);


        $this->Cell(189,10,"Order Detail",1,1,"C");


        $this->Cell(45,10,"No of Guest : ",0,0);
        $this->Cell(45,10,$detailorder[0][12],0,0);
        $this->Cell(45,10,"Deliver Date : ",0,0);
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

        $this->Cell(45,10,$Eventtime,0,0);
        $this->Cell(45,10,"per Head  : ",0,0);
        $this->Cell(45,10,$detailorder[0][3],0,1);


        $this->Cell(45,10,"current Order Status : ",0,0);
        $this->Cell(45,10,$detailorder[0][13],0,0);
        $this->Cell(45,10,"booked Date : ",0,0);
        $this->Cell(45,10,$detailorder[0][15],0,1);



        if($detailorder[0][19]!="")
        {

            $text='Description : '.$detailorder[0][19];
            $nb=$this->WordWrap($text,189);
            $this->Write(10,$text);

            $this->Cell(189,10,"",0,1);
        }
        $AmountExtraItems=0;

        if(count($DetailExtraItems)>0)
        {
            $this->Cell(189,10,"Extra Item Detail : ",1,1,"C");
            $isNewRow=0;
            for($i=0;$i<count($DetailExtraItems);$i++)
            {
                if(($i+1)%2==0)
                {
                    $isNewRow=1;
                }
                else
                {
                    $isNewRow=0;
                }
                $AmountExtraItems+=$DetailExtraItems[$i][1];
                $this->Cell(45,10,$DetailExtraItems[$i][0],0,0);
                $this->Cell(45,10,$DetailExtraItems[$i][1],0,$isNewRow);
            }

            $this->Cell(45,10,"Total Amount : ",0,0);
            $this->Cell(45,10,$AmountExtraItems,0,1);
        }



        $this->Cell(189,10,"Payments Detial : ",1,1,"C");
        $this->Cell(45,10,"Total Amount : ",0,0);
        $this->Cell(45,10,$detailorder[0][11],0,0);
        $this->Cell(45,10,"Per Head Rate :",0,0);
        if($detailorder[0][12]==0)
            $detailorder[0][12]=1;
        $this->Cell(45,10,($detailorder[0][11]/$detailorder[0][12]),0,1);


        $this->Cell(45,10,"Received Amount : ",0,0);
        $this->Cell(45,10,$totalReceivedPayment[0][0],0,0);
        $this->Cell(45,10,"Remaining Amount :",0,0);
        $this->Cell(45,10, ($detailorder[0][11]-$totalReceivedPayment[0][0]),0,1);


        if($detailorder[0][3]==1)
        {
            //menu if per head with food

            $this->Cell(189,10,"Package Detail ",1,1,"C");
            $x=0;
            for($i=0;$i<count($menu);$i++)
            {

                if((($i+1)%4)==0)
                {
                    $x=1;
                }
                else
                {
                    $x=0;
                }
                $this->Cell(45,10,$menu[$i][0],0,$x);
            }
            $this->Cell(189,10,"",0,1);
            $this->Cell(189,10,"Description : ".$detailorder[0][20],0,1);


        }








    }




    function billing($userName,$printDate,$orderId)
    {



        //order 9 catering hall 1
       // $orderId=9;
        $sql='SELECT `id`, `hall_id`, `catering_id`, (SELECT hp.isFood from hallprice as hp WHERE hp.id=orderDetail.hallprice_id),
 `user_id`, `booking_date`, `booking_date`, `booking_date`, 
 `booking_date`, `address_id`, `person_id`, `total_amount`, 
 `total_person`, `status_hall`, `destination_date`, 
 `booking_date`, `destination_time`, `status_catering`, 
 `booking_date`,`describe`,(SELECT hp.describe from hallprice as hp WHERE hp.id=orderDetail.hallprice_id),hallprice_id,(SELECT hp.price from hallprice as hp WHERE hp.id=orderDetail.hallprice_id) FROM `orderDetail` WHERE id='.$orderId.'';
        $detailorder = queryReceive($sql);


        $sql='SELECT sum(py.amount) FROM payment as py WHERE (py.IsReturn=0)AND(py.orderDetail_id='.$orderId.')';
        $totalReceivedPayment=queryReceive($sql);




        //customer information
        $sql = "SELECT `name`, `cnic`, `id`, `date`, `image` FROM `person` WHERE id=".$detailorder[0][10]."";
        $person=queryReceive($sql);




        //numbers
        $sql="SELECT n.number, n.id, n.is_number_active, n.person_id FROM number as n inner JOIN person as p ON p.id=n.person_id
WHERE p.id='".$person[0][2]."' order BY n.id";
        $numbers=queryReceive($sql);



        if($detailorder[0][1]=="")
        {
                 //catering order
            $sql = 'SELECT `id`, `address_city`, `address_town`, `address_street_no`, `address_house_no`, `person_id` FROM `address` WHERE id="'.$detailorder[0][9].'"';
            $addresDetail = queryReceive($sql);


            $sql='SELECT `name`,`company_id` FROM `catering` WHERE id='.$detailorder[0][2].'';
            $branchinfo=queryReceive($sql);

            //catering owener info
            $sql='SELECT p.name,n.number FROM company as c INNER join user as u 
on (c.user_id=u.id)
INNER join person as p 
on (p.id=u.person_id)
INNER join number as n 
on (p.id=n.person_id)
WHERE
 (c.id='.$branchinfo[0][1].')
 AND
 (n.is_number_active=1)
';
            $owerinfo=queryReceive($sql);


            //detail of order dish
            $sql='SELECT id,`describe`, `price`, `quantity`, `dish_id`,(SELECT d.name FROM dish as d WHERE d.id=dish_id ) FROM `dish_detail` WHERE (orderDetail_id='.$orderId.')AND(ISNULL(expire_date))';
            $dishDetail=queryReceive($sql);


            //person address
            $sql = "SELECT a.id, a.address_city, a.address_town, a.address_street_no, a.address_house_no, a.person_id FROM address as a inner JOIN person p ON a.person_id=p.id
WHERE a.person_id=".$detailorder[0][10]."
ORDER by a.person_id;";
            $address=queryReceive($sql);



            $this->cateringorderPrint($detailorder,$person,$numbers,$addresDetail,$dishDetail,$address,$totalReceivedPayment,$branchinfo,$owerinfo,$userName,$printDate);

        }
        else
        {
            //hall order


            $sql='SELECT `name`, `company_id` FROM `hall` WHERE id='.$detailorder[0][1].'';
            $branchinfo=queryReceive($sql);

            //catering owener info
            $sql='SELECT p.name,n.number FROM company as c INNER join user as u 
on (c.user_id=u.id)
INNER join person as p 
on (p.id=u.person_id)
INNER join number as n 
on (p.id=n.person_id)
WHERE
 (c.id='.$branchinfo[0][1].')
 AND
 (n.is_number_active=1)
';
            $owerinfo=queryReceive($sql);


            $menu=array();
            if($detailorder[0][3]==1)
            {

                //with menu
                $sql = 'SELECT `dishname`, `image` FROM `menu` WHERE (hallprice_id='.$detailorder[0][21] . ') AND ISNULL(expire)';
                $menu = queryReceive($sql);
            }
            $sql='SELECT (SELECT ei.name FROM Extra_Item as ei WHERE ei.id=hei.Extra_Item_id), (SELECT ei.price FROM Extra_Item as ei WHERE ei.id=hei.Extra_Item_id) from hall_extra_items as hei
WHERE (hei.orderDetail_id='.$orderId.')AND(ISNULL(hei.expire))';
            $DetailExtraItems=queryReceive($sql);


            $this->hallorderPrint($detailorder,$person,$numbers,$menu,$totalReceivedPayment,$branchinfo,$owerinfo,$userName,$printDate,$DetailExtraItems);

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



function action($userName,$printDate,$orderid,$action)
{

    // Instanciation of inherited class
    $pdf = new PDF('P',"mm","A4");
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',8);
    $pdf->billing($userName,$printDate,$orderid);
    //$pdf->Output($action,"orderid".$orderid."date".$printDate);


    $pdf->Cell(189,10,"",0,1);
    $pdf->Cell(45,20,"Company User signature",0,0,"C");
    $pdf->Cell(45,20,"",1,0);
    $pdf->Cell(45,20,"Customer signature",0,0,"C");
    $pdf->Cell(45,20,"",1,1);

    $pdf->Output($action,"orderid".$orderid."date".$printDate.".pdf");
}

?>