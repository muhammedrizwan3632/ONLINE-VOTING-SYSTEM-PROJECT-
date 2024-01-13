<?php
session_start();
if(isset($_SESSION["uname"]))
{
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="SELECT * FROM voting_status voting_status";
$result=mysqli_query($conn,$sql);
$result1=mysqli_fetch_array($result);
$status=$result1['status'];
if($status=="End")
{?>
<html>
	<head>
	<style>
		body {
background: #483D8B;
display: flex;
justify-content: center;


flex-direction: column;
}
		.navbar {
overflow: hidden;
background-color: #483D8B;
padding: 0 0 0 0;

}
.navbar a {
float: left;
display: block;
color: white;
text-align: center;
padding:10 10;
text-decoration: none;
}
.navbar a.left {
float: left;
	position:fixed;

}
.navbar a:hover {
background-color: #ddd;
color: black;
border-radius: 5px;
}
table {
border-collapse: collapse;
width: 700;
border: 1px solid #282828;
}
th, td {
text-align: center;
padding: 8px;
border: 1px solid #303030;
}
tr {background-color: #f2f2f2}
th {
background-color: #282828;
color: white;
}
		</style></head>
<body>
	<div class="navbar">
<a  class="left" href="admin.php" ><img src="home.png" height="50" width="50"></a><br><br><br><br>
<a class="left" href="pdf1.php">Download</a>		
	</div>
	
	<?php

	$seat=array("Poonjar","Pala","Thavanoor","Palakkad","Manjeshwar");
	$no=count($seat);
	for($j=0;$j<5;$j=$j+1)
	{
$sql1="SELECT Name,Symbol,No_of_votes from candidates  where Constituency_seat='$seat[$j]' order by No_of_votes DESC;";
$result1=mysqli_query($conn,$sql1);
?>
	
<table  align="center">
	<tr>
	<th colspan="4"><?php echo $seat[$j] ?>
		</th>
	</tr>
	<tr>
	<th>Position</th>
	<th>Name</th>
	<th>Symbol</th>
	<th>No_of_votes</th>
	</tr>
	<?php
	$i=1;
while($res=mysqli_fetch_array($result1))
{
	
	?>
	
	<tr>
		<td><?php echo $i?></td>	
        <td><?php echo $res['Name']?></td>
        <td><?php echo '<img src="'.$res['Symbol'].'" height="70" width="70"></img>'?></td>
	 <td><?php echo $res['No_of_votes']?></td>
		</tr>
    <br>
<?php
		$i=$i+1;
}

}
	?> </table><?php
}
else{
echo "<script>if(confirm('Voting on progress')){document.location.href='admin.php'};</script>";
}
?>
	
	</body>
</html>
<?php
}
else
{
	echo '<script>alert("You are currently in logged out")</script>';
}
?>