<?php
session_start();
if(isset($_SESSION["uname"]))
{
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="select * from newcandid";
$res=mysqli_query($conn,$sql);

?>
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
.navbar button:hover {
background-color: #ddd;
color: black;
border-radius: 5px;
}
.button {
background-color: red;
float: right;
padding: 10px 15px;
color: #fff;
border-radius: 5px;
margin-right: 10px;
border: none;
cursor: pointer;
}
.Abutton {
background-color: blue;
float: right;
padding: 10px 15px;
color: #fff;
border-radius: 5px;
margin-right: 10px;
border: none;
cursor: pointer;
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
tr {background-color: #f2f2f2
		}
th {
background-color: #282828;
color: white;
}
</style></head>
<body>
	<div class="navbar">
<a  class="left" href="admin.php" align="left"><img src="home.png" height="50" width="50">
													 </a>
	</div>
	<table  align="center">
	<tr>
		<th colspan="9">List of Nominated candidates</th></tr><tr></tr>
		<th>Candidate id</th>
	    <th>Candidate name</th>
		<th>Address</th>
		<th>Age</th>
		<th>Symbol</th>
	    <th>Political party</th>
		<th>Constituency Seat</th>
		<th></th>
	    <th></th>
</tr>
		<?php
		while($result=mysqli_fetch_array($res))
		{
			$ph=$result['Symbol'];
			$n=$result['Name']
		?>
		<tr><form action="" method="post">
			<td><?php echo $result['Candidate_id'] ?></td>
			<td><?php echo $result['Name'] ?></td>
			<td><?php echo $result['Address'] ?></td>
			<td><?php echo $result['Age'] ?></td>
			<td><?php echo '<img src="'.$ph.'" height="100" width="100"></img>'?></td>
			<td><?php echo $result['Political_party'] ?></td>
			<td><?php echo $result['Constituency_seat'] ?></td>
			<td><?php echo "<button type='submit' name='approve' class='Abutton' value='$n'>Approve</button>"?></td>
			<td><?php echo "<button type='submit' name='del' class='button' value='$n'>DELETE</button>"?></td>
	</tr>
	</form>
		<?php
		}?>
	     </table>
	</body></html>
<?php
if(isset($_POST["approve"])){
	$n=$_POST['approve'];
	//$a="revi";
	$sql1="select * from newcandid where Name='$n'";
	//echo "<script>alert('$n')</script>;";
	
	$res1=mysqli_query($conn,$sql1);
	$result=mysqli_fetch_array($res1);
	$canid=$result['Candidate_id'];

	$name=$result['Name'];
	$address=$result['Address'];
	$age=$result['Age'];
	$symbol=$result['Symbol'];
	$party=$result['Political_party'];
	
    $seat=$result['Constituency_seat'];
	$user=$result['username'];
	$pass=$result['password'];
	
	$sql2="insert into candidates values('$canid','$name','$address','$age','$symbol','$party','$seat','0')";
	$sql3="insert into login values('$user','$pass','candidate')";
	$res2=mysqli_query($conn,$sql2);
	$res3=mysqli_query($conn,$sql3);
	if($res2&&$res3){
		$sql4="DELETE FROM newcandid WHERE Name='$n'";
        $res4=mysqli_query($conn,$sql4);
		if($res4){
		echo '<script>if(!alert("Candidate Nomination Approved")){document.location.href="admin.php"};</script>';
		//header('location:addc.php');
		}
	}
}
if(isset($_POST["del"]))
{
$n=$_POST['del'];
$conn=mysqli_connect("localhost","root","","online voting system");
$sql5="DELETE FROM newcandid WHERE Name='$n'";
$res6=mysqli_query($conn,$sql5);
if($res6)
{
	echo '<script>if(!alert("Candidate Nomination Rejected ")){document.location.href="admin.php"};</script>';
}
else{
	echo '<script>alert("Error")</script>';
}
}
}
else
{
	echo '<script>alert("You are currently in logged out")</script>';
}
?>
