<?php
session_start();
if(isset($_SESSION["uname"]))
{?>
<html>
	<head>
		<style>
body {
background: #483D8B;
display: flex;
justify-content: center;
align-items: center;
height: 100vh;
flex-direction: column;
}
*{
font-family: sans-serif;
box-sizing: border-box;
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
if(isset($_POST['make']))
{
$user_id=$_SESSION['uname'];
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="SELECT * FROM votes where  voter_name='$user_id'";
$result3=mysqli_query($conn,$sql);
$q=mysqli_num_rows($result3);
if($q>0)
{
echo "<center><h4 style='color:red'>!!!!!! You have already done your vote !!!!!!!</h4></center>";?>
	<div class="navbar">
			<a href="logout.php">LOG OUT</a></div>
	<?php
}
else	
{
$vote=$_POST['votes'];
$user_id=$_SESSION['uname'];	
$sql="UPDATE candidates SET No_of_votes=No_of_votes+1 WHERE Name='$vote'";
$result3=mysqli_query($conn,$sql);
	$sql1="SELECT Voter_id FROM voters where  Name='$user_id'";
	$res=mysqli_query($conn,$sql1);
	$res1=mysqli_fetch_array($res);
	$vot_id=$res1['Voter_id'];
	$sql2="insert into votes values('$vot_id','$user_id')";
$result4=mysqli_query($conn,$sql2);	
echo "<center><h4 style='color:red'>Congrats, You have submitted your vote for canditate
".$vote."</h4></center>";?>
		<body><div class="navbar">
			<a href="logout.php">LOG OUT</a></div></body></html>
			<?php
	}
}
}
else
{
	echo '<script>alert("you are currently logged out")</script>';
}

?>