<?php
session_start();
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="select * from voting_status";
$result=mysqli_query($conn,$sql);
$res=mysqli_fetch_array($result);
$status=$res['status'];
if($status=="End"){


?>
<html>
<head>
<title>New Voter</title>
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
</style>
</head>
<body><div class="navbar">
	<a  class="left" href="login.html" align="left"><img src="home.png" height="50" width="50">
	</a>
<form action="" method="post">
<h2>New Voter Registration</h2>
<label>Voter ID</label>
<input type="text" name="Vid" value="" required><br>
<label>Name</label>
<input type="text" name="name" value="" required><br>
<label>Constituency seat</label>
<select name="seat" style="display: block;
border: 2px solid #ccc;
width: 95%;
padding: 10px;
margin: 10px auto;
border-radius: 5px;">
    <option>Select your constituency seat</option>
	<option value="Poonjar">Poonjar</option>
	<option value="Pala">Pala</option>
	<option value="Thavanoor">Thavanoor</option>
	<option value="Palakkad">Palakkad</option>
	<option value="Manjeshwar">Manjeshwar</option></select>	
	<br>
<label>Age</label>
<input type="text" name="age" value="" required><br>
<label>User name</label>
<input type="text" name="uname" value="" required><br>
<label>Password</label>
<input type="password" name="password" value="" required><br>
	<label>Phone number</label>
	<input type="text" name="phone" value=""><br>
<button type="submit" name="sub" class="button">Submit</button>
</form>
</body>
</html>
<?php
if(isset($_POST["sub"]))
{
	
	$name=$_POST["name"];
	$vid=$_POST["Vid"];
	$con=$_POST["seat"];
	$age=$_POST["age"];
	$user=$_POST["uname"];
	$pass=$_POST["password"];
	$ph=$_POST["phone"];
	if($age<18)
	{
		echo '<script>alert("Not Eligible as voter")</script>';
	}
	else{
	//$conn=mysqli_connect("localhost","root","","online voting system");
	$sql="insert into newvoter values('$vid','$name','$age','$ph','$con','$user','$pass')";
	$res=mysqli_query($conn,$sql);
	if($res)
	{
		echo '<script>alert("Registration completed")</script>';
	}
	else{
		echo '<script>alert("error")</script>';
	}
	}
}
}else{
	echo '<script>if(!alert("you can\'t register right now")){document.location.href="voterslogin.html"}</script>';
}
	
	?>
	
