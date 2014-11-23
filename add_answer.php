<?php
session_start();
$student_id=$_SESSION['student_id'];
$question_id=$_POST['question_id'];

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="eduvisor"; // Database name 
$tbl_name="forum_answer1"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// Get value of id that sent from hidden field 


/*// Find highest answer number. 
$sql="SELECT MAX(a_id) AS Maxa_id FROM $tbl_name WHERE question_id='$id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);

// add + 1 to highest answer number and keep it in variable name "$Max_id". if there no answer yet set it = 1 
if ($rows) {
$Max_id = $rows['Maxa_id']+1;
}
else {
$Max_id = 1;
}

// get values that sent from form 
$a_name=$_POST['a_name'];
$a_email=$_POST['a_email'];*/

$a_answer=$_POST['a_answer']; 
date_default_timezone_set('America/New_York');
$datetime=date("g:i A - M j, Y");   //create date time

// Insert answer 
$sql2="INSERT INTO $tbl_name(question_id, student_id, a_answer, a_datetime)VALUES('$question_id','$student_id', '$a_answer', '$datetime')";
$result2=mysql_query($sql2);

if($result2){
// If added new answer, add value +1 in reply column 
$tbl_name2="forum_question1";
$sql3="UPDATE $tbl_name2 SET reply=reply+1 WHERE id='$question_id'";
$result3=mysql_query($sql3);
header("Location: view_topic.php?id=".$question_id.""); /* Redirect browser */
exit();
}
else {
echo "ERROR";
}

// Close connection
mysql_close();
?>