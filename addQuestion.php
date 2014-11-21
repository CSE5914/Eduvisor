<!--<form  action="addQuestion.php" method="POST" id="question_form">

                    <div class="modal-body">

                    </div>    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form> -->


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "eduvisor";
$student_id=$_SESSION['student_id'];
$question = $_POST['question']; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO student_questions (student_id, question)
VALUES ('".$student_id."', '".$question."')");

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>