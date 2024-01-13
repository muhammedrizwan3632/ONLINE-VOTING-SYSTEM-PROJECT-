<?php
session_start();
if(isset($_SESSION["uname"]))
{
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="select Candidate_id,Name,Symbol,Political_party,Constituency_seat from candidates";
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
		<th colspan="6">Candidate List</th></tr><tr></tr>
		<th>Candidate id</th>
	    <th>Candidate name</th>
		<th>Symbol</th>
	    <th>Political party</th>
		<th>Constituency Seat</th>
		<th></th></tr>
		<?php
		while($result=mysqli_fetch_array($res))
		{
			$ph=$result['Symbol'];
			$n=$result['Name']
		?>
		<tr><form action="" method="post">
			<td><?php echo $result['Candidate_id'] ?></td>
			<td><?php echo $result['Name'] ?></td>
			<td><?php echo '<img src="'.$ph.'" height="100" width="100"></img>'?></td>
			<td><?php echo $result['Political_party'] ?></td>
			<td><?php echo $result['Constituency_seat'] ?></td>
			<td><?php echo "<button type='submit' name='del' class='button' value='$n'>DELETE</button>"?></td>
	</tr>
	</form>
		<?php
		}?>
	     </table>
	</body></html>
<?php
if(isset($_POST["del"]))
{
$n=$_POST['del'];
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="DELETE FROM candidates WHERE Name='$n'";
$sql1="DELETE FROM login WHERE username='$n' && usertype='candidate'";
$res1=mysqli_query($conn,$sql1);
$res=mysqli_query($conn,$sql);
if($res&&$res1)
{
	echo '<script>if(!alert("Candidate deleted ")){document.location.href="admin.php"};</script>';
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
