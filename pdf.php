<?php
	if(isset($_POST["sub"]))
	{
		ob_end_clean();
	    require('fpdf.php');
		$con=mysqli_connect('localhost','root','','online voting system');
        mysqli_select_db($con,'voters');


class PDF extends FPDF {
	function Header(){
		$this->SetFont('Arial','B',15);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo
		//$this->Image('logo-small.png',10,10,10);
		
		$this->Cell(100,10,'Client List',0,1,'C');
		
		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln(5);
		
		$this->SetFont('Arial','B',11);
		
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		$this->Cell(50,10,'Name',1,0,'C');
		$this->Cell(50,10,'Symbol',1,0,'C');
		$this->Cell(50,10,'No_of_votes',1,1,'C');
		
		
	}
	function Footer(){
		//add table's bottom line
		//$this->Cell(190,0,'','T',1,'',true);
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new PDF('P','mm','A4'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');

$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();

$pdf->SetFont('Arial','',9);
$pdf->SetDrawColor(180,180,255);

//$query=mysqli_query($con,"select * from voters");
	$seat=array("Poonjar","Pala","Thavanoor","Palakkad","Manjeshwar");
	$no=count($seat);
	for($j=0;$j<5;$j=$j+1)
	{
$query=mysqli_query($con,"SELECT Name,Symbol,No_of_votes from candidates  where Constituency_seat='$seat[$j]' order by No_of_votes DESC");
while($data=mysqli_fetch_array($query)){
	$l=80;
	$w=35;
	$pdf->Cell(50,10,$data['Name'],1,0,'C');
	$pdf->Cell(50,10,$pdf->Image($data['Symbol'],$l,50,15),1,0,'C');
	$pdf->Cell(50,10,$data['No_of_votes'],1,1,'C');
	
}
		
		
	}
		
		$pdf->Output();
/*
$pdf = new FPDF();
  
//Add a new page
$pdf->AddPage();
  
// Set the font for the text
$pdf->SetFont('Arial', 'B', 18);
  
// Prints a cell with given text 
$pdf->Cell(60,20,'Hello GeeksforGeeks!');
  
// return the generated output*/

	}
?>