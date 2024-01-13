<?php

	
		$con=mysqli_connect("localhost","root","","online voting system");
		$sql="select * from candidates";
		$res=mysqli_query($con,$sql);
        require('tcpdf_min/tcpdf.php');  
        $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
        $obj_pdf->SetCreator(PDF_CREATOR);  
        $obj_pdf->SetTitle("Score Card");  
        $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
        $obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
        $obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
        $obj_pdf->SetDefaultMonospacedFont('helvetica');  
        $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
        $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
        $obj_pdf->setPrintHeader(false);  
        $obj_pdf->setPrintFooter(false);  
        $obj_pdf->SetAutoPageBreak(TRUE, 10);  
        $obj_pdf->SetFont('helvetica', '', 12);  
        $obj_pdf->AddPage(); 
		$seat=array("Poonjar","Pala","Thavanoor","Palakkad","Manjeshwar");
	    $no=count($seat);
	 
	
        $content = '';
		$content .= '  <br>
        <h1 align="center">Result</h1>
		
        <table align="center" border="1" cellspacing="0" cellpadding="5">  
             <tr>  <th width="20%">Const_seat</th> 
                  <th width="35%">Name</th>  
                  <th width="25%">Symbol</th>  
                  <th width="20%">Number of vote</th>  
				  
             </tr>';  
        $content .= fetch_data();  
        $content .= '</table>';        
        $obj_pdf->writeHTML($content); 
        $obj_pdf->Output('sample.pdf', 'I');  
   
	

 function fetch_data() 
 {  
      $output = '';  
      $con=mysqli_connect("localhost","root","","online voting system");
	  $seat=array("Poonjar","Pala","Thavanoor","Palakkad","Manjeshwar");
	  $sql="SELECT Name,Symbol,No_of_votes from candidates where No_of_votes=(select max(No_of_votes) from candidates where Constituency_seat='Poonjar') and Constituency_seat='Poonjar'";
	  $res=mysqli_query($con,$sql);
	  $no=mysqli_num_rows($res);
	  $row = mysqli_fetch_array($res);
	  $sql1="SELECT Name,Symbol,No_of_votes from candidates where No_of_votes=(select max(No_of_votes) from candidates where Constituency_seat='Pala') and Constituency_seat='Pala'";
	  $res1=mysqli_query($con,$sql1);
	 $no1=mysqli_num_rows($res1);
	  $row1 = mysqli_fetch_array($res1);
	 $sql2="SELECT Name,Symbol,No_of_votes from candidates where No_of_votes=(select max(No_of_votes) from candidates where Constituency_seat='Thavanoor') and Constituency_seat='Thavanoor'";
	  $res2=mysqli_query($con,$sql2);
	  $no2=mysqli_num_rows($res2);
	  $row2 = mysqli_fetch_array($res2);
	  $sql3="SELECT Name,Symbol,No_of_votes from candidates where No_of_votes=(select max(No_of_votes) from candidates where Constituency_seat='Palakkad') and Constituency_seat='Palakkad'";
	  $res3=mysqli_query($con,$sql3);
	 $no3=mysqli_num_rows($res3);
	  $row3 = mysqli_fetch_array($res3);
	  $sql4="SELECT Name,Symbol,No_of_votes from candidates where No_of_votes=(select max(No_of_votes) from candidates where Constituency_seat='Manjeshwar') and Constituency_seat='Manjeshwar'";
	  $res4=mysqli_query($con,$sql4);
	 $no4=mysqli_num_rows($res4);
	  $row4 = mysqli_fetch_array($res4);
	 if($no>1)
	 {
	 $output .= '<tr>  <td >Poonjar</td>
                          <td colspan="3">No one has lead</td>
						  </tr>';
	 }
	 else
	 {
      $output .=
		  '<tr>  <td>Poonjar</td>
                          <td>'.$row["Name"].'</td>
                          <td><img src="'.$row["Symbol"].'"></td>
                          <td>'.$row["No_of_votes"].'</td> 
                     </tr>';
	 }
	 if($no1>1)
	 {
		 $output .= '<tr>  <td>Pala</td>
                          <td colspan="3">No one has lead</td>
						  </tr>'; 
	 }
	 else
	 {
					$output .= '  <tr>
					  <td>Pala</td>
                          <td>'.$row1["Name"].'</td>
                          <td><img src="'.$row1["Symbol"].'"></td>
                          <td>'.$row1["No_of_votes"].'</td> 
		              </tr>';
	 }
	  if($no2>1)
	 {
	 $output .= '<tr>  <td >Thavanoor</td>
                          <td colspan="3">No one has lead</td>
						  </tr>';
	 }
	 else
	 {
				$output .= '	  <tr>
					  <td>Thavanoor</td>
                          <td>'.$row2["Name"].'</td>
                          <td><img src="'.$row2["Symbol"].'"></td>
                          <td>'.$row2["No_of_votes"].'</td> 
		              </tr>';
	 }
	 if($no3>1)
	 {
	 $output .= '<tr>  <td>Palakkad</td>
                          <td colspan="3">No one has lead</td>
						  </tr>';
	 }
	 else
	 {
					$output .= '  <tr>
					  <td>Palakkad</td>
                          <td>'.$row3["Name"].'</td>
                          <td><img src="'.$row3["Symbol"].'"></td>
                          <td>'.$row3["No_of_votes"].'</td> 
		              </tr>';
	 }
	if($no4>1)
	 {
	 $output .= '<tr>  <td>Manjeshwar</td>
                          <td colspan="3">No one has lead</td>
						  </tr>';
	 }
	 else
	 {	 
		$output .= '			  <tr>
					  <td>Manjeshwar</td>
                          <td>'.$row4["Name"].'</td>
                          <td><img src="'.$row4["Symbol"].'"></td>
                          <td>'.$row4["No_of_votes"].'</td> 
		              </tr>
					  
                       
                       '; 
	 }

       
	 
      return $output;
 
 }
 ?>

