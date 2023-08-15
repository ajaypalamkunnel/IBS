<html>
<head>
<title>
IBS Login
</title>
</head>
<body>
<h1 align="center"> Login </h1>
<form method="POST">
<center>
<big>Username:</big><input type="text" name="name" align="center"/>
<br><br>
<big>Password:</big><input type="password" name="password"/>
<br><br>
<input type="submit" name="login" value="submit"/>
</center>
</form>
<?php
require("connection.php");
if(isset($_POST["login"]))
{
$name1=$_REQUEST['name'];
$password1=$_REQUEST['password'];
$sql="SELECT * FROM bank WHERE username='$name1' AND password='$password1'";
$s=mysqli_query($conn,$sql);
if(mysqli_num_rows($s)>0) 
{
echo "<br> Record is found";
}
else
{
echo "<br> Record not found";
}
}

?>
</body>
</html>

