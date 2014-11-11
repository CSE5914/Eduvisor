<?php
session_start();
$student_id=$_SESSION['student_id'];
$course = $_POST['course'];
$course = $_POST['type'];

$con = mysqli_connect("localhost","root","","eduvisor");
if(mysqli_connect_errno())
echo "Failed" . mysqli_connect_error();
$result = mysqli_query($con,"INSERT INTO student_courses (student_id, course_id, type) VALUES ('".$student_id."', '".$course."', '".$course. "')");

header("Location: courses.php");

?>