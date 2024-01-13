<?php
if(isset($_POST["sub"]))
{
$name=$_POST["uname"];
$pass=$_POST["pword"];
$user="voter";
$conn=mysqli_connect("localhost","root","","VotingDB");
$sql="select * from login where username='$name'&& password='$pass' && usertype='$user';";
$result=mysqli_query($conn,$sql);
$resval=mysqli_num_rows($result);
if($resval>0)
{
header('location:voter.php');
}
else 
{
echo '<script>alert("please enter a valid  username/password")</script>';
}
}
else
{
echo '<script>alert("please enter username and password")</script>';
}
?>


