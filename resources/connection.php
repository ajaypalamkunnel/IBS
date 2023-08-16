<html>
<head>
</head>
<body>
<?php
$servername="localhost";
$username="root";
$password="";
$db="bank";
$conn=mysqli_connect($servername,$username,$password,$db);
if(!$conn)
{
  die("connection failed:".mysqli_connect_error());
}
echo "connection successfull";
?>
</body>
</html>