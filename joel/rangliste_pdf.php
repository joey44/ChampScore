<?php
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
//First table: put all columns automatically
$pdf->Table("SELECT u.user_name as Name, u.user_box as Box, r.res_score as Punkte FROM tbl_user u inner join tbl_user_division d \n"
    . "on u.user_ID = d.fk_user_ID inner join tbl_result r on d.user_div_ID = r.fk_user_div_ID ORDER BY Punkte ASC");






$pdf->Output();
?>
