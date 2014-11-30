<?php
session_start();
$tbl_name="forum_question1"; // Table name
$tbl_name2="forum_answer1"; 
$tbl_name3="student";

$con = mysqli_connect("localhost","root","","eduvisor");
if(mysqli_connect_errno())
    echo "Failed" . mysqli_connect_error(); 

$question_id=$_GET['id'];
$result = mysqli_query($con,"SELECT * FROM $tbl_name WHERE id='".$question_id."'");
$row = mysqli_fetch_array($result);
$student_result = mysqli_query($con,"SELECT * FROM $tbl_name3 WHERE student_id='".$row['student_id']."'");
$student = mysqli_fetch_array($student_result);
echo'
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Education e-Advisor</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js does not work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .table-striped>tbody>tr:nth-child(odd)>td, .table-striped>tbody>tr:nth-child(odd)>th
    {
        background-color:#666666;
    }
     .table-striped>tbody>tr:nth-child(even)>td, .table-striped>tbody>tr:nth-child(even)>th
    {
        background-color:#D3D3D3;
    }
    tbody tr td, tbody tr td a, tbody tr th
    {
        color:white;
    }
    html,body{
    height: 100%
}

#holder{
    min-height: 100%;
    position:relative;
}

#body{
    padding-bottom: 70px;    /* height of footer */
}

footer{
    height: 70px; 
    width:100%;
    position: absolute;
    left: 0;
    bottom: 0; 
}
    </style>

</head>

<body id="page-top" class="index" style="background-color:#b00;">
<div id="holder">
<div id="body">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Edu-Visor</a>
            </div>';
            if(isset($_SESSION['student_id'])){
            echo'    
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                       <a href="profile_personal.php">Welcome,  '.explode(" ",$_SESSION['user'])[0].'</a>
                    </li>
                    <li>
                    <a href="index.php">Ask a Question</a>
                    <li>
                    <a href="main_forum.php">Forum</a>
                    </li>
                    <li class="page-scroll">
                        <a href="logout.php">Log-out</a>
                    </li>
                </ul>
            </div>';
            } else {
            echo'
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a href="index.php">Ask a Question</a>
                    </li>
                    <li>
                        <a href="main_forum.php">Forum</a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#login">Log-in</a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#register">Register</a>
                    </li>
                </ul>
            </div>';
            }
            echo'
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <div class="container" style="padding-top:40px;">
        <header>
            <div class="row" style="padding-top:40px;">
                <h1>'.$row['topic'].'</h1>
            </div>
        </header>
        <div class="row col-md-12" style="margin-top:30px;">
        	<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Question<span style="float:right;"><form id="formIncreaseRating" class="form-inline" style="display:inline-block;" role="form" name="formIncreaseRating" method="post" action="increase_ratingQuestion.php"><input type="hidden" name="question_id" id="question_id" value="'.$question_id.'"/><button type="submit" class="btn btn-default btn-xs" style="margin-right:20px;"><span class="glyphicon glyphicon-chevron-up"></span></button></form>'.$row['rating'].'<form id="formIncreaseRating" class="form-inline" style="display:inline-block;" role="form" name="formIncreaseRating" method="post" action="decrease_ratingQuestion.php"><input type="hidden" name="question_id" id="question_id" value="'.$question_id.'"/><button type="submit" class="btn btn-default btn-xs" style="margin-left:20px;"><span class="glyphicon glyphicon-chevron-down"></span></button></form></span></h3></div>
				  <div class="panel-body">'.$row['detail'].'</div>
				  <div class="panel-footer">
				  	<span style="line-height:1.1;"><h6 style="display:inline;">By:' .$student['first_name'].' '.$student['last_name'].' </h6> </span>
				  	<span style="line-height:1.1;float:right;"><h6 style="display:inline;">Date/time:' .$row['datetime'].'</span>
				  </div>
        	</div>
            
        </div>';
        $count=0;
        $result2 = mysqli_query($con,"SELECT * FROM $tbl_name2 WHERE question_id='".$question_id."' ORDER BY rating DESC");
        while($rows = mysqli_fetch_array($result2)){
        $count  = $count+1;  
        if($count == 1)
        {
            echo '<div class="row col-md-12">
        <hr style="width:100%;" class="star-light"><h3 class="text-center" style="color:white;">Top Answer</h3>
        </div>';
        } 
        if($count == 2)
        {
            echo '<div class="row col-md-12">
        <hr style="width:100%;" class="star-light"><h4 class="text-center" style="color:white;">Other Answers</h4>
        </div>';
        }
        echo'
        
        <div class="row col-md-12" style="margin-top:30px;">
        	<div class="panel panel-default">
    		    <div class="panel-heading">
    		      <h3 class="panel-title">Answer '.$count.'<span style="float:right;"><form id="formIncreaseRating" class="form-inline" style="display:inline-block;" role="form" name="formIncreaseRating" method="post" action="increase_rating.php"><input type="hidden" name="answer_id" id="answer_id" value="'.$rows['a_id'].'"/><input type="hidden" name="question_id" id="question_id" value="'.$question_id.'"/><button type="submit" class="btn btn-default btn-xs" style="margin-right:20px;"><span class="glyphicon glyphicon-chevron-up"></span></button></form>'.$rows['rating'].'<form id="formIncreaseRating" class="form-inline" style="display:inline-block;" role="form" name="formIncreaseRating" method="post" action="decrease_rating.php"><input type="hidden" name="answer_id" id="answer_id" value="'.$rows['a_id'].'"/><input type="hidden" name="question_id" id="question_id" value="'.$question_id.'"/><button type="submit" class="btn btn-default btn-xs" style="margin-left:20px;"><span class="glyphicon glyphicon-chevron-down"></span></button></form></span></h3>
    		    </div>
    			<div class="panel-body">'.$rows['a_answer'].'</div>';
                $student_result2 = mysqli_query($con,"SELECT * FROM $tbl_name3 WHERE student_id='".$rows['student_id']."'");
                $student2 = mysqli_fetch_array($student_result2);
                echo'
    			<div class="panel-footer">
    				<span style="line-height:1.1;"><h6 style="display:inline;">By: '.$student2['first_name'].' '.$student2['last_name'].'</h6></span>
    				<span style="line-height:1.1;float:right;"><h6 style="display:inline;">Date/time: '.$rows['a_datetime'].'</h6></span>
    			</div>
            </div>';
        echo '</div>';
        }
        //$sql3="UPDATE $tbl_name SET view=view+1 WHERE id='$question_id'";
        //$result3=mysql_query($sql3);
        $result = mysqli_query($con,"UPDATE $tbl_name SET view=view+1 WHERE id='$question_id'");
        if(isset($_SESSION['student_id'])){
        echo'
        <div class="row col-md-10" style="margin-top:30px;">
            <form id="form1" role="form" name="form1" method="post" action="add_answer.php">
                <div class="form-group">
                    <label for="topic"><h4 style="color:white;margin-bottom:5px;">Answer</h4></label>
                    <textarea rows="3" type="text" class="form-control" name="a_answer" id="a_answer" placeholder="Enter your answer..." required></textarea>
                </div>
                <input name="question_id" type="hidden" value='.$question_id.'>
                <input type="submit" class="btn btn-default" name="Submit" value="Submit" /> 
                <input class="btn btn-default" type="reset" name="Submit2" value="Reset" />
            </form>
        </div>';
        }
    echo'    
    </div>
    </div>
    <footer class="text-center" id="footer" style="height:70px;">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Powered by IBM Watson
                    </div>
                </div>
            </div>
        </div>
    </footer>
    </div>
    </body>
</html>';
?>
