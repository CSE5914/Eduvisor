<?php
session_start();
$student_id=$_SESSION['student_id'];
$course_id=$_POST['courseID'];

$con = mysqli_connect("localhost","root","","eduvisor");
if(mysqli_connect_errno())
echo "Failed" . mysqli_connect_error();
mysqli_query($con,"DELETE FROM student_courses WHERE student_id='".$student_id."' AND course_id='".$course_id."'");

header("Location: courses.php");
mysql_close($con);
?>