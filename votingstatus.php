<?php
session_start();
if(isset($_SESSION["uname"]))
{?>
<html>
<head>
<title>Votingstatus</title>
<style type="text/css">
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
.button {
float: left;
background: #483D8B;
padding: 20px 25px;
color: #fff;
border-radius: 5px;
margin-right: 10px;
border: none;
cursor: pointer;
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
.navbar {
overflow: hidden;
background-color: #483D8B;
}
.navbar a {
float: left;
display: block;
color: white;
text-align: center;
padding: 10px 10px;
text-decoration: none;
}
.navbar a.left {
float: left;
}
.navbar a:hover {
background-color: #ddd;
color: black;
border-radius: 5px;
}
</style>
</head>
<body>
<div class="navbar">
<a  class="left" href="admin.php" align=""><img src="home.png" height="50" width="50"></a>
	</div>	
<form action="" method="post">
<button type="submit" name="enable" class="button" value="Start">Start Voting</button>
<button type="submit" name="disable" class="button" value="End" >End Voting</button>
<?php
if(isset($_POST["enable"]))
{
$status=$_POST['enable'];
$conn=mysqli_connect("localhost","root","","online voting system");
$sqlu="UPDATE candidates set No_of_votes=0";
$sqld="DELETE from votes";
mysqli_query($conn,$sqld);
mysqli_query($conn,$sqlu);
$sql="UPDATE voting_status SET status='$status'";
$result=mysqli_query($conn,$sql);
	
	 echo "<br><center>";
	echo "<font color='red'>Current status:<b> '$status' </b>";
	echo "</center>";

}
if(isset($_POST["disable"]))
{
$status=$_POST['disable'];
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="UPDATE voting_status SET status='$status'";
$result=mysqli_query($conn,$sql);
   echo "<br><center>";
	echo "<font color='red'>Current status:<b> '$status' </b>";
	echo "</center>";
}
?>
	</form>
	</body>
</html>
<?php
}
else
{
	echo '<script>alert("You are currently in logged out")</script>';
}
?>

