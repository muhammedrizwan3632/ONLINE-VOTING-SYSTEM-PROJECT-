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
color: blue;
font-family: 'Georgia', serif;
font-size: 22px;
padding: 10px;
}
labeln {
color: black;
font-family: 'Georgia', serif;
font-size: 22px;
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
session_start();
if(isset($_POST["submit"]))
{
$name=$_POST["username"];
$pass=$_POST["password"];
$user="candidate";
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="select * from login where username='$name'&& password='$pass' && usertype='$user';";
$result=mysqli_query($conn,$sql);
$resval=mysqli_num_rows($result);
if($resval>0)
{
$_SESSION["uname"]=$name;
//echo $name
//echo '<script>alert("This is candidate home page")</script>';
//header('location:candidhome.php');
?>
<body>
<form> 	
<h2>CANDIDATE LOGIN</h2>
	<?php
	//echo $name;
//$conn1=mysqli_connect("localhost","root","","online voting system");
$sql1="select * from candidates where Name='$name'";
$result1=mysqli_query($conn,$sql1);
while($result2=mysqli_fetch_array($result1))
{
    //echo $name;
	$name=$result2['Name'];
	$candidateid=$result2['Candidate_id'];
    $Address=$result2['Address'];
    $party=$result2['Political_party'];
	$constseat=$result2['Constituency_seat'];
	$seat=$constseat;

echo '<label>Candidate_id</label>:  ';
echo '<labeln>';
echo $candidateid;
echo '<br><br>';
echo '<br><br>';
echo '<label>Name</label>:  ';
echo $name;
echo '<br><br>';
echo "<br><br>";
echo '<label>Address</label>:  ';
echo $Address;
echo "<br><br>";
echo "<br><br>";
echo '<label>Political Party</label>:  ';
echo $party;
echo '<br><br>';
echo '<br><br>';
echo '<label>Consituency seat</label>:  ';
echo $constseat;
echo "<br><br>";
echo '<br><br>';
}
	echo '<div class="navbar">';
	echo '<a href="logout.php">LOG OUT</a></div></form>';

}
else 
{
echo '<script>if(!alert("please enter a valid username/password")){document.location.href="Candidatelogin.html"}</script>';
}
}
else
{
echo '<script>alert("please enter username and password")</script>';
}
?>