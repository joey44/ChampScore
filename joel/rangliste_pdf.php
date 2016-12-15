<?php

 list ($selected_wod, $divison) = explode('X', $_POST['btn_pdf']);


require('mysql_table.php');

class PDF extends PDF_MySQL_Table
{
function Header()
{
	//Title
	$this->SetFont('Arial','',18);
	$this->Cell(0,6,'Champscore Crossfit',0,1,'C');
	$this->Ln(10);
	//Ensure table header is output
	parent::Header();
}
}

//Connect to database
mysql_connect('localhost','root','');
mysql_select_db('champscore_net');

$pdf=new PDF();
$pdf->AddPage();

if ($selected_wod == "overall123"){
    
 $pdf->Table( "SELECT @curRank := @curRank + 1 AS Rank, u.user_name as Name, u.user_box as Box, SUM(r.res_score) as Punkte FROM"
         . "(SELECT @curRank := 0) q, tbl_user u inner \n"
    . " join tbl_user_division d\n"
    . " on u.user_ID = d.fk_user_ID inner \n"
    . " join tbl_result r on d.user_div_ID = r.fk_user_div_ID \n"
    . " WHERE d.fk_div_ID = ".$divison." GROUP by Name ORDER by Punkte ASC");
        



}
else{
    
$pdf->Table("SELECT wod_name AS WOD, wod_desc AS Description from tbl_wod where wod_ID =".$selected_wod);


$pdf->Table("SELECT u.user_name as Name, u.user_box as Box, r.res_score as Points FROM tbl_user u inner join tbl_user_division d \n"
    . "on u.user_ID = d.fk_user_ID inner join tbl_result r on d.user_div_ID = r.fk_user_div_ID where r.fk_wod_ID =".$selected_wod." ORDER BY Points ASC");


    
}




$pdf->Output();
?>
