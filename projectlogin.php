<html>
<head>
<title>LOGIN</title>
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
select {
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
h1 {
text-align: center;
color: #fff;
}
.previous {
background-color: #f1f1f1;
color: #d13737;
}
.round {
border-radius: 50%;
}
</style>
</head>
<body>
<form action="connection.php" method="post">
<h2>LOGIN</h2>
<label>Username</label>
<input type="text" name="username" value="" required><br>
<label>Password</label>
<input type="password" name="password" value="" required><br>
<button type="submit" name="submit" class="button">Login</button>
</form>
</body>
</html>

