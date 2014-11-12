<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $con = mysqli_connect("localhost","root","","eduvisor");
    if(mysqli_connect_errno())
        echo "Failed" . mysqli_connect_error();
    $fname = $_POST['txt_fname'];
    $lname = $_POST['txt_lname'];
    $student_id = $_SESSION['student_id'];
   // $depart = "Computer Science and Engineering";
    $phone = $_POST['txt_phone'];
    $degree = $_POST['txt_degree'];
    $year = $_POST['txt_year'];
    $semester = $_POST['txt_sem'];
    $result  = mysqli_query($con, "UPDATE student  SET first_name='".$fname."', last_name='".$lname."', phone='".$phone."', degree_id='".$degree."', enroll_sem='".$semester."', enroll_year= '".$year."' WHERE student_id='".$student_id."'");
    mysql_close($con);

    header("Location: profile_personal.php");
}
?>