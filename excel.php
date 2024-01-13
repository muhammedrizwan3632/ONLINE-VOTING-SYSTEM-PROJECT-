<?php
	if(isset($_POST["sub"]))
	{
	 $re=$_POST["reg"];
	 $con=mysqli_connect("localhost","root","","internal_mark");
      $sql1="SELECT * FROM student WHERE reg_no='$re';";


      $sql3="SELECT mark.semesterm as sem, mark.s1internal1 as s1internal1, mark.s1cinternal1 as s1internal2, mark.s2internal1 as s2internal1, mark.s2cinternal1 as s2internal2, 
			mark.s3internal1 as s3internal1, mark.s3cinternal1 as s3internal2, mark.s1semiassi as sa1, mark.s2semiassi as sa2, mark.s3semiassi as sa3, mark.attendance as atten, 
			subject.reg_nos AS reg_nos, 
			subject.subject1 as sub1, subject.subject2 as sub2, subject.subject3 as sub3,mark.reg_nom AS reg_nom 
			FROM subject,mark WHERE subject.reg_nos=mark.reg_nom AND subject.semesters=mark.semesterm AND subject.reg_nos='$re';";

      $res2=mysqli_query($con,$sql3);
	 $res=mysqli_query($con,$sql1);
	 $rescheck=mysqli_num_rows($res);
      $rescheck2=mysqli_num_rows($res2);
	 if($rescheck && $rescheck2>0)
	 {
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
        $content = '';  
        $content .= '  <br>
        <h1 align="center">SCORE CARD</h1>
        <h3 align="center">Student details</h3>  
        <table border="1" cellspacing="0" cellpadding="5">  
             <tr>  
                  <th width="12%">Reg_no</th>  
                  <th width="20%">Name</th>  
                  <th width="15%">Department</th>  
                  <th width="20%">Phone number</th>  
                  <th width="33%">Mail ID</th>  
             </tr>';  
        $content .= fetch_data($re);  
        $content .= '</table>';          
        $obj_pdf->writeHTML($content);
        $content1 = '';  
        $content1 .= '  
        <h3 align="center">Internal mark</h3>
        <table border="1" cellspacing="0" cellpadding="5">  
             <tr>
                  <th width="15%">Semester</th>
                  <th width="15%">Subject1</th>
                  <th width="10%">Mark1</th>
                  <th width="15%">Subject2</th>
                  <th width="10%">Mark2</th>
                  <th width="15%">Subject3</th>
                  <th width="10%">Mark3</th>
                  <th width="10%">Grade</th>
             </tr>';  
        $content1 .= fetch_data1($re);  
        $content1 .= '</table>';          
        $obj_pdf->writeHTML($content1); 
        $obj_pdf->Output('sample.pdf', 'I');  
   }
   else{
       echo "no student is found in this register number!!!!";?>
       <html><br><br><a href="screen6.0.php">Generate another pdf</a></html>
       <?php
   }
} 
 function fetch_data($re) 
 {  
      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "internal_mark");  
      $sql = "SELECT * FROM student WHERE reg_no='$re'";  
      $result = mysqli_query($connect, $sql); 
      while($row = mysqli_fetch_array($result))    
      {   
          $fname=$row["name"];
          $mname=$row["mname"];
          $lname=$row["lname"];

          if($mname=='')
          {
               $naf=$fname.' '.$lname;
          }
          else
          {
               $naf=$fname.' '.$mname.' '.$lname;
          }         
      $output .= '<tr>  
                          <td>'.$row["reg_no"].'</td>  
                          <td>'.$naf.'</td>  
                          <td>'.$row["department"].'</td>  
                          <td>'.$row["phone_number"].'</td>  
                          <td>'.$row["mail_id"].'</td>  
                     </tr>  
                          ';  
      }  
      return $output;  
 } 
 
 function fetch_data1($re)
 {
 $output = '';
      $connect2=mysqli_connect("localhost", "root", "", "internal_mark");


      $sql2="SELECT mark.semesterm as sem, mark.s1internal1 as s1internal1, mark.s1cinternal1 as s1internal2, mark.s2internal1 as s2internal1, mark.s2cinternal1 as s2internal2, 
			mark.s3internal1 as s3internal1, mark.s3cinternal1 as s3internal2, mark.s1semiassi as sa1, mark.s2semiassi as sa2, mark.s3semiassi as sa3, mark.attendance as atten, 
			subject.reg_nos AS reg_nos, 
			subject.subject1 as sub1, subject.subject2 as sub2, subject.subject3 as sub3,mark.reg_nom AS reg_nom 
			FROM subject,mark WHERE subject.reg_nos=mark.reg_nom AND subject.semesters=mark.semesterm AND subject.reg_nos='$re';";

      $result2=mysqli_query($connect2, $sql2);      
      while($row = mysqli_fetch_array($result2))
      {
          $s1internal1=$row["s1internal1"];
          $s1internal2=$row["s1internal2"];
          $s2internal1=$row["s2internal1"];
          $s2internal2=$row["s2internal2"];
          $s3internal1=$row["s3internal1"];
          $s3internal2=$row["s3internal2"];

          $sa1=$row["sa1"];
          $sa2=$row["sa2"];
          $sa3=$row["sa3"];

          $atten=$row["atten"];

          $mark1=(($s1internal1)/16)+(($s1internal2)/16)+($sa1)+($atten);
          $mark2=(($s2internal1)/16)+(($s2internal2)/16)+($sa2)+($atten);
          $mark3=(($s3internal1)/16)+(($s3internal2)/16)+($sa3)+($atten);

          $avg=($mark1+$mark2+$mark3)/3;

          if($avg>=18)
          {
               $gr='a';
          }
          elseif($avg>=16)
          {
               $gr='b';
          }
          elseif($avg>=14)
          {
               $gr='c';
          }
          else {
               $gr='d';
          }

           $output .= '<tr>
                              <td>'.$row["sem"].'</td>
                              <td>'.$row["sub1"].'</td>
                              <td>'.$mark1.'</td>
                              <td>'.$row["sub2"].'</td>
                              <td>'.$mark2.'</td>
                              <td>'.$row["sub3"].'</td>
                              <td>'.$mark3.'</td>
                              <td>'.$gr.'</td>
                              
                         </tr>';
      }
      return $output; 
}
?>