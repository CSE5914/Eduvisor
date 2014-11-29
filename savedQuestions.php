<?php
session_start();
if(isset($_SESSION['student_id'])){
    $con = mysqli_connect("localhost","root","","eduvisor");
        if(mysqli_connect_errno())
            echo "Failed" . mysqli_connect_error();
    $student_id=$_SESSION['student_id'];    
    $core=[];
    $applied=[];
    $other=[];
    $result = mysqli_query($con,"SELECT * FROM student_questions WHERE student_id='" . $student_id . "'");
echo '
<!--<html lang="en">

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

    <script type="text/javascript">
        function deleteCourse(courseid){
            var theForm, newInput1, newInput2;
            theForm = document.createElement("form");
            theForm.action = "deleteCourse.php";
            theForm.method = "post";
            newInput1 = document.createElement("input");
            newInput1.type = "hidden";
            newInput1.name = "courseID";
            newInput1.value = courseid;
            theForm.appendChild(newInput1);
            theForm.submit();
        }
    </script>
    <style>
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

<body id="page-top" class="index">
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
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
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
                    <!--<li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <br>
    <section class="success" id="register">
        <div class="container">
            <div class="col-lg-12 text-center">
                <h2>Profile</h2>
                <hr class="star-light">
            </div>
        </div>
    </section>

    <div class="container">   
        <div class="row">
            <div class="col-lg-10">
                <ul class="nav nav-tabs">  
                    <li ><a href="profile_personal.php"><i class="glyphicon glyphicon-user"></i> Personal</a></li>
                    <li class=""><a href="courses.php"><i class="glyphicon glyphicon-book"></i> Courses</a></li>
                    <li><a href="recommendation.php"><i class="glyphicon glyphicon-comment"></i> Reccommendations</a></li>
                    <li class="active"><a href="savedQuestions.php"><i class="glyphicon glyphicon-floppy-disk"></i> Saved Questions</a></li>
                </ul>
            </div>
        </div>
        <br>';
$tableFlag = 0;
$row = mysqli_fetch_array($result);
if(is_null($row))
{
    echo '<div class="row">
<div class="container-fluid text-center">
<h3>It doesn\'t look like you have any saved questions yet,<br /> try <a href="index.php">asking a question</a>.</h3>';
}
else
{
    $tableFlag = 1;
    $questionText = $row['question'];
    echo '<div class="row">
<div class="container-fluid">
<table class="table table-condensed" style="border-collapse:collapse;">
                    <tbody><tr>
                            <td><form action="search.php" method="POST" name="advice" id="adviceform" novalidate>
                             <div class="input-group">
                                <input name="ask" id="ask" type="hidden" value="'.$questionText.'">
                                <span class="input-group-btn">
                                <h3><button type="submit" class="btn btn-default btn-large" style="margin-right:20px;"><span class="glyphicon glyphicon-eye-open"></span></button>'.$questionText.'</h3>
                             </div>
                    </form></td>
                        </tr>';
}
while($row = mysqli_fetch_array($result))
{
    $questionText = $row['question'];
    echo '<tr>
                            <td><form action="search.php" method="POST" name="advice" id="adviceform" novalidate>
                             <div class="input-group">
                                <input name="ask" id="ask" type="hidden" value="'.$questionText.'">
                                <span class="input-group-btn">
                                <h3><button type="submit" class="btn btn-default btn-large" style="margin-right:20px;"><span class="glyphicon glyphicon-eye-open"></span></button>'.$questionText.'</h3>
                             </div>
                    </form></td>
                        </tr>';
                    }
            if($tableFlag == 1)
            {
                echo '</tbody> </table>';
            }
                echo '<br>    
            </div>   
        </div>         
    </div>
    


    </section>
    </div>
    <!-- Footer -->
    <footer class="text-center" id="footer">
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

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>
    </div>

</body>

</html>';
} else{
    session_destroy();
    header("location: index.php");
}    
?>