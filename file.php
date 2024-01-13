<?php
session_start();
if(isset($_SESSION["uname"]))
{
?>
<html>
	<body bgcolor="dffffe">
</body>
<?php
include 'database.php';

$uploadfile=$_FILES['uploadfile']['tmp_name'];

require 'PHPExcel/Classes/PHPExcel.php';
require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
$objExcel=PHPExcel_IOFactory::load($uploadfile);
foreach($objExcel->getWorksheetIterator() as $worksheet)
{
	$highestrow=$worksheet->getHighestRow();

	for($row=0;$row<=$highestrow;$row++)
	{
		$reg_no=$worksheet->getCellByColumnAndRow(0,$row)->getValue();
		$sem=$worksheet->getCellByColumnAndRow(7,$row)->getValue();

		$sub1=$worksheet->getCellByColumnAndRow(8,$row)->getValue();
		$mark11=$worksheet->getCellByColumnAndRow(9,$row)->getValue();
		$mark12=$worksheet->getCellByColumnAndRow(10,$row)->getValue();
		$assisemi1=$worksheet->getCellByColumnAndRow(11,$row)->getValue();

		$sub2=$worksheet->getCellByColumnAndRow(12,$row)->getValue();
		$mark21=$worksheet->getCellByColumnAndRow(13,$row)->getValue();
		$mark22=$worksheet->getCellByColumnAndRow(14,$row)->getValue();
		$assisemi2=$worksheet->getCellByColumnAndRow(15,$row)->getValue();

		$sub3=$worksheet->getCellByColumnAndRow(16,$row)->getValue();
		$mark31=$worksheet->getCellByColumnAndRow(17,$row)->getValue();
		$mark32=$worksheet->getCellByColumnAndRow(18,$row)->getValue();
		$assisemi3=$worksheet->getCellByColumnAndRow(19,$row)->getValue();

		$atten=$worksheet->getCellByColumnAndRow(20,$row)->getValue();

		$sql="SELECT * FROM student WHERE reg_no='$reg_no'";
		$res=mysqli_query($con,$sql);
		$rescheck=mysqli_num_rows($res);

		$sql1="SELECT * FROM mark WHERE reg_nom='$reg_no' && semesterm='$sem'";
		$res1=mysqli_query($con,$sql1);
		$rescheck1=mysqli_num_rows($res1);

		$sql2="SELECT * FROM subject WHERE reg_nos='$reg_no' && semesters='$sem'";
		$res2=mysqli_query($con,$sql2);
		$rescheck2=mysqli_num_rows($res2);

		if($reg_no!='')
		{
		if($rescheck)
		{			
			if($rescheck1<1)
			{
			$insertsub="INSERT INTO `subject` (`reg_nos`,`semesters`,`subject1`,`subject2`,`subject3`) VALUES ('$reg_no','$sem','$sub1','$sub2','$sub3')";
			$insertsubqry=mysqli_query($con,$insertsub);
			echo "Entered to subject table <br />";
			}
			else
			{
				echo "already entered to subject table <br />";
			}
			if($rescheck2<1)
			{
				$insertmark="INSERT INTO mark VALUES ('$reg_no','$sem','$mark11','$mark12','$assisemi1','$mark21','$mark22','$assisemi2','$mark31','$mark32','$assisemi3','$atten')";
			$insertmarkres=mysqli_query($con,$insertmark);			
			echo "Entered to mark table <br />";
			}
			else
			{
				echo "already entered to mark table <br />";
			}
		}
		else
		{
			echo $reg_no, "  not reg <br />";
		}
	}
}
}
?>
<html>
<br>
<br>
<a href="excel.php">Upload another file</a>
<br>
<br>
<a href="screen3.php">Go to home page</a>
</html>
<?php
}
else {
  echo '<script type="text/javascript">alert("Access denied")</script>';
}
?>