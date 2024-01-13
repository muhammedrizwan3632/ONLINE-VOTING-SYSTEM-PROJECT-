<?php 
session_start();
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="SELECT * FROM voting_status voting_status";
$result=mysqli_query($conn,$sql);
$result1=mysqli_fetch_array($result);
$status=$result1['status'];
if($status=="Start")
{
?>
<html>
<head>
<title>LOGIN</title>
<style type="text/css">
body {
background: #483D8B;
display: flex;
justify-content: center;
align-items: center;
flex-direction: column;
}
*{
font-family: sans-serif;
box-sizing: border-box;
}
form {
width: 500px;
border: 2px solid #ccc;
padding: 30px;
background: #fff;
border-radius: 15px;
}
h2 {
text-align: center;
margin-bottom: 40px;
font-family: 'Georgia', serif
}
input {
display: block;
border: 2px solid #ccc;
width: 95%;
padding: 10px;
margin: 10px auto;
border-radius: 5px;
}
label {
color: black;
font-family: 'Georgia', serif;
font-size: 18px;
padding: 10px;
}
table {
border-collapse: collapse;
width: 500;
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
.button {
float: right;
background: #483D8B;
padding: 10px 15px;
color: #fff;
border-radius: 5px;
margin-right: 10px;
border: none;
cursor: pointer;
}
.navbar {
overflow: hidden;
background-color: #483D8B;
}
.navbar a {
float: center;
display: block;
color: white;
text-align: center;
padding: 14px 25px;
text-decoration: none;
}
.navbar a.center {
float: center;
}
.navbar a:hover {
background-color: #ddd;
color: black;
border-radius: 5px;
}
</style>
</head>
<?php	
if(isset($_POST["sub"]))
{
$name=$_POST["uname"];
$pass=$_POST["pword"];
$user="voter";
$seat="";	
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="select * from login where username='$name'&& password='$pass' && usertype='$user';";
$result=mysqli_query($conn,$sql);
$resval=mysqli_num_rows($result);
if($resval>0)
{
$_SESSION["uname"]=$name;

if(isset($_SESSION["uname"]))
{
?>
<body>
<form> 	
<h2>VOTERS LOGIN</h2>
	<?php
	//echo $name;
//$conn1=mysqli_connect("localhost","root","","online voting system");
$sql1="select * from voters where Name='$name'";
$result1=mysqli_query($conn,$sql1);
while($result2=mysqli_fetch_array($result1))
{
	$name=$result2['Name'];
	$voterid=$result2['Voter_id'];
	$constseat=$result2['Constituency_seat'];
	$seat=$constseat;
	
echo '<label>Name</label>:  ';
echo $name;
echo '<br><br>';
echo '<label>Voter_ID</label>:  ';
echo $voterid;
echo "<br><br>";
echo '<label>Consituency seat</label>:  ';
echo $constseat;
echo "<br><br>";
}
	?>
	<div class="navbar">
		<a href="logout.php">LOG OUT</a></div></form>
<table align="center">
<tr>
<th>SL.no</th>
<th>NAME</th>
<th>SYMBOL</th>
<th>   </th>
</tr>
<form action="makevote.php" method="post">	
<?php
//$conn2=mysqli_connect("localhost","root","","online voting system");
$sql2="select * from candidates where Constituency_seat='$seat'";
$result3=mysqli_query($conn,$sql2);
$i=1;
while($result4=mysqli_fetch_array($result3))
{

$fn=$result4['Name'];
	$ph=$result4['Symbol'];?>
<tr>
<td><?php echo $i?></td>	
<td><?php echo $fn?></td>
<td><?php echo '<img src="'.$ph.'" height="70" width="70"></img>'?></td>
<td>
	<?php
echo "<input type='radio' name='votes' value='$fn'/>"?>
	</td>
</tr><?php
$i=$i+1;
 }?>
<tr>
<td colspan="4"><center>
	Select one of the candidate you want to give vote<button type="submit" name="make" class="button">submit</button></center></td></tr></form></table>
</body>
</html>
<?php
}
	else{
	echo '<script>alert("you are currently logged out")</script>';
	}
}
	else 
{
echo '<script>if(confirm("please enter a valid username/password")){document.location.href="voterslogin.html"}</script>';
}
}
else
{
echo '<script>alert("please enter username and password")</script>';
}
}
else
{
echo '<script>if(!alert("voting not started")){document.location.href="login.html"}</script>';	
}


?>


	


