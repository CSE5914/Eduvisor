<?php
session_start();
$student_id=$_SESSION['student_id'];

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="eduvisor"; // Database name 
$tbl_name="student_questions"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");


$a_answer=$_POST['a_answer']; 

// Insert answer 
$sql2="INSERT INTO $tbl_name(student_id, question)VALUES('$student_id', '$a_answer')";
$result2=mysql_query($sql2);

//if($result2){
//echo 'SUCCESS';
//}
//else {
//echo "ERROR";
//}
header("Location: savedQuestions.php"); 

// Close connection
mysql_close();
?>