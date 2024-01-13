<?php
session_start();
if(isset($_SESSION["uname"]))
{?>
<html><head>
<style>
* {
box-sizing: border-box;
}
body {
font-family: Arial, Helvetica, sans-serif;
margin: 0;
background-color: #483D8B;
}
form {
width: 500px;
border: 2px solid #ccc;
padding: 30px;
background: #483D8B;
border-radius: 15px;
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
padding: 20px 25px;
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
.navbar h1 {
float: center;
color: white;
font-size: 25;
text-align: center;
text-decoration: none;
text-shadow: -1px 0 black, 0 2px black, 2px 0 black, 0 2px black;
}
</style>
</head>
<body>
<div class="navbar">
<a  class=""><h1>Admin Page</h1></a><center><form>
<a href="viewcandidate.php">VIEW CANDIDATES</a>
<a href="viewvoter.php">VIEW VOTERS</a>
<a href="votingstatus.php">START/END VOTING</a>
<a href="addc.php">NEW CANDIDATE</a>
<a href="addv.php">NEW VOTER</a>
<a href="count.php">COUNT VOTE</a>
<a href="logout.php">LOG OUT</a></form></center>
</div>
</body>
</html>
<?php
}
else
{
	echo '<script>alert("You are currently in logged out")</script>';
}
?>