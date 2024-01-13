<?php
session_start();
if(isset($_SESSION["uname"]))
{
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="select * from newvoter";
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
<a  class="left" href="admin.php" align="left"><img src="home.png" height="50" width="50"></a>
	</div>
	<table  align="center">
	<tr>
		<th colspan="7">Voters List</th></tr>
	     <th>Voter_id</th>
		<th>Name</th>
		<th>Age</th>
		<th>Phone number</th>
		 <th>Constituency Seat</th>
		<th></th>
		<th></th>
		<?php
		while($result=mysqli_fetch_array($res))
		{
			$n=$result['Name'];
		?>
		<tr><form action="" method="post">
			<td><?php echo $result['Voter_id'] ?></td>
			<td><?php echo $result['Name'] ?></td>
			<td><?php echo $result['Age'] ?></td>
			<td><?php echo $result['Phone number'] ?></td>
			<td><?php echo $result['Constituency_seat'] ?></td>
			<td><?php echo "<button type='submit' name='approve' class='Abutton' value='$n'>Approve</button>"?></td>
			<td><?php echo "<button type='submit' name='del' class='button' value='$n'>DELETE</button>"?></td>
		</tr>
		<?php
		}?>
	     </table>
	</body></html>
<?php
if(isset($_POST["approve"])){
	$n=$_POST['approve'];
	//$a="revi";
	$sql1="select * from newvoter where Name='$n'";
	//echo "<script>alert('$n')</script>;";
	
	$res1=mysqli_query($conn,$sql1);
	$result=mysqli_fetch_array($res1);
	$votid=$result['Voter_id'];

	$name=$result['Name'];
	
	$age=$result['Age'];
	$phone=$result['Phone number'];
	$seat=$result['Constituency_seat'];

	$user=$result['username'];
	$pass=$result['password'];
	
	$sql2="insert into voters values('$votid','$name','$age','$phone','$seat')";
	$sql3="insert into login values('$user','$pass','voter')";
	$res2=mysqli_query($conn,$sql2);
	$res3=mysqli_query($conn,$sql3);
	if($res2&&$res3){
		$sql4="DELETE FROM newvoter WHERE Name='$n'";
        $res4=mysqli_query($conn,$sql4);
		if($res4){
		echo '<script>if(!alert("New voter Added Successfully")){document.location.href="admin.php"};</script>';
		}
	}
}
if(isset($_POST["del"]))
{
$n=$_POST['del'];
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="DELETE FROM newvoter WHERE Name='$n'";
$sql1="DELETE FROM login WHERE username='$n'";
$res1=mysqli_query($conn,$sql1);
$res=mysqli_query($conn,$sql);
if($res&&$res1)
{
	echo '<script>if(!alert("New voter registration rejected")){document.location.href="admin.php"};</script>';
}
else{
	echo '<script>alert("Error")</script>';
}
}
}
else{
	echo '<script>alert("You are currently in logged out")</script>';
}
?>
