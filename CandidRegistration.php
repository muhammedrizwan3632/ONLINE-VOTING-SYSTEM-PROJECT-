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
<title>New Candidate</title>
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
.error {
background: #F2DEDE;
color: #A94442;
padding: 10px;
width: 95%;
border-radius: 5px;
margin: 20px auto;
}
</style>
</head>
<body><div class="navbar">
	<a  class="left" href="login.html" align="left"><img src="home.png" height="50" width="50">
	</a>
<form action="" method="post">
<h2>New Candidate Registration</h2>
<label>Candidate_id</label>
<input type="text" name="cid" value="" required><br>
<label>Candidate name</label>
<input type="text" name="name" value="" required><br>
<label>House name</label>
<input type="text" name="hname" value="" required><br>
<label>Constituency seat</label>
<select name="seat" style="display: block;
border: 2px solid #ccc;
width: 95%;
padding: 10px;
margin: 10px auto;
border-radius: 5px;">
<option>Select constituency seat</option>
	<option value="Poonjar">Poonjar</option>
	<option value="Pala">Pala</option>
	<option value="Thavanoor">Thavanoor</option>
	<option value="Palakkad">Palakkad</option>
	<option value="Manjeshwar">Manjeshwar</option></select>	
<br>
<label>Age</label>
<input type="text" name="age" value="" required><br>
<label>Symbol(path)</label>
<input type="file" name="symbol" value="" required><br>
<label>Political Party</label>
<input type="text" name="party" value="" required><br>
<label>User name</label>
<input type="text" name="uname" value="" required><br>
<label>Password</label>
<input type="password" name="password" value="" required><br>
<button type="submit" name="sub" class="button">Submit</button>
</form>
</body>
</html>
<?php
if(isset($_POST["sub"]))
{
	$can=$_POST["cid"];
	$name=$_POST["name"];
	$house=$_POST["hname"];
	$con=$_POST["seat"];
	$age=$_POST["age"];
	$sym=$_POST["symbol"];
	$party=$_POST["party"];
	$user=$_POST["uname"];
	$pass=$_POST["password"];
	if($age<25)
	{
		echo '<script>alert("Not Eligible as candidate")</script>';
	}
	else{
	$sql="insert into newcandid values('$can','$name','$house','$age','$sym','$party','$con','$user','$pass')";
	$res1=mysqli_query($conn,$sql);
	if($res1)
	{
		echo '<script>alert("Registration completed")</script>';
	}
	else{
		echo '<script>alert("error")</script>';
	}
	}
}
}else{
	echo '<script>if(!alert("you can\'t register right now")){document.location.href="Candidatelogin.html"}</script>';
}

	?>
	