<?php
session_start();
if(isset($_POST["submit"]))
{
$name=$_POST["username"];
$pass=$_POST["password"];
$user="admin";
$conn=mysqli_connect("localhost","root","","online voting system");
$sql="select * from login where username='$name'&& password='$pass' && usertype='$user';";
$result=mysqli_query($conn,$sql);
$resval=mysqli_num_rows($result);
if($resval>0)
{
$_SESSION["uname"]=$name;
header('location:admin.php');
}
else 
{
echo '<script>if(confirm("please enter a valid username/password")){document.location.href="adminlogin.html"};</script>';
}
}
?>

