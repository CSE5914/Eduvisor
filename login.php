<?php
$email = $_POST['email'];
$pwd = $_POST['password'];
$con = mysqli_connect("localhost","root","","eduvisor");
if(mysqli_connect_errno())
echo "Failed" . mysqli_connect_error();
$result = mysqli_query($con,"SELECT * FROM student WHERE emall='" . $email . "' AND password='" . $pwd . "'");
/*while($row = mysqli_fetch_array($result)) {
  echo $row['username'];
  echo "<br>";
}*/
$row = mysqli_fetch_array($result);
$count = mysqli_num_rows($result);
//$count = count($result);
if($count==1){
session_start();
$_SESSION['user']=$row['first_name'].' '.$row['last_name'];

header("Location: profile.html");
}
else{
	$message = "Please try again: Invalid email/password";
	header("Location: index.php");
	echo "<script type='text/javascript'>alert('$message');</script>";
	//alert("Please try again: Invalid email/password");
	
	//alert("Please try again: Invalid email/password");
}
mysql_close($con);
?>