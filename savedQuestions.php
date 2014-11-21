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
    $result = mysqli_query($con,"SELECT * FROM student_courses WHERE student_id='" . $student_id . "'");
    while($row = mysqli_fetch_array($result)) {
        $result2 = mysqli_query($con,"SELECT * FROM course_list WHERE CourseID='" . $row['course_id'] . "'");
        $row2 = mysqli_fetch_array($result2);
        if($row['type'] === "core"){
            $core[] = $row2;
        }    
        else if($row['type'] === "applied"){
            $applied[] = $row2;
        }
        else{
            $other[] = $row2;
        }    
    }

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
</head>

<body id="page-top" class="index">

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

    </div>
    <div class="container">   
        <div class="row">
            <div class="col-lg-10">
                <ul class="nav nav-tabs">  
                    <li ><a href="profile_personal.php"><i class="glyphicon glyphicon-user"></i> Personal</a></li>
                    <li class=""><a href="courses.php"><i class="glyphicon glyphicon-book"></i> Courses</a></li>
                    <li class="active"><a href="savedQuestions.php"><i class="glyphicon glyphicon-book"></i> Saved Questions</a></li>
                </ul>
            </div>
        </div>
        <br>
        <div classe="row">
<div class="container-fluid">
                <table class="table table-condensed" style="border-collapse:collapse;">
                    <tbody>
                        <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                            <td><h5><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></h5></td>
                            <td><h5>What classes do I still need to graduate?</h5></td>
                        </tr>
                        <tr>
                            <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo1"> 
                                <table class="table table-striped">
                                    <thead>
                                        <tr><td><h6>Respnose</h6></td></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><p>You still need to take the following classes to graduate with a B.S. CSE: 
                                        <ul>
                                            <li>CSE 3932</li>
                                            <li>CSE 5013</li>
                                            <li>MATH 4193</li>
                                        </ul></p></td></tr>              
                                    </tbody>
                                </table>
              
                                </div> 
                            </td>
                        </tr>
                        <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle bg-gray">
                            <td><h5><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></h5></td>
                            <td><h5>Who is my advisor?</h5></td>
                        </tr>
                        <tr>
                            <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo2"> 
                                <table class="table table-striped">
                                    <thead>
                                        <tr><td><h6>Response</h6></td></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><p>Eduvisor will be here to answer all of your basic questions, past that you should contact <a href="http://web.cse.ohio-state.edu/~reeves/">Kitty Reeves</a></p></td></tr>
                                                      
                                    </tbody>
                                </table>
              
                                </div> 
                            </td>
                        </tr>
                        <tr data-toggle="collapse" data-target="#demo3" class="accordion-toggle">
                            <td><h5><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></h5></td>
                            <td><h5>When will CSE 3901 be offered this spring?</h5></td>
                        </tr>
                        <tr>
                            <tr>
                            <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo3"> 
                                <table class="table table-striped">
                                    <thead>
                                        <tr><td><h6>Response</h6></td></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td><p>CSE 3901 will be offered MWF 9:10-10:05 taught by Naeem Shareef, and 1:20-2:15 taught by Naeem Shareef.</p></td></tr>             
                                    </tbody>
                                </table>
              
                                </div> 
                            </td>
                        </tr>
                        </tr>
                    </tbody>
                </table>
                <br>    
            </div>   
        </div>         
    </div>
    


    </section>
    <!-- Footer -->
    <footer class="text-center navbar-fixed-bottom" id="footer">
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

    <div class="modal fade" id="addCourseModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form  action="addCourse.php" method="POST" id="signin_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title">Add a Course</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2"><h4><label for="category" style="padding-top:8px">Course:</label></h4></div>
                            <div class="col-md-8"><select class="form-control" style="width: 100%" name="course">';
                                $result = mysqli_query($con,"SELECT * FROM course_list");
                                while($row=mysqli_fetch_array($result)){
                                    echo '<option value="'.$row['CourseID'].'">' .$row['Number'].': '.$row['CourseTitle']. '</option>';
                                }
                            echo '
                            </select></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"><h4><label for="category" style="padding-top:8px">Course:</label></h4></div>
                            <div class="col-md-8"><select class="form-control" style="width: 100%" name="type">
                                <option value="core">Core</option>
                                <option value="applied">Applied Core</option>
                                <option value="other">Other</option>
                            </select></div>
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </form> 
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="modal fade" id="deleteCourseConfirmModal" name="deleteCourseConfirmModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <form  action="addCourse.php" method="POST" id="signin_form">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="false">&times;</span><span class="sr-only">Close</span></button>
                        <h3 class="modal-title">delete a Course</h3>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <h3>Are you sure you want to delete this course?</h3>
                            <input type="text" name="test" id="test"/>
                        </div>
                    </div>    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" name="confirmDelete" id="confirmDelete">Yes</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    </div>
                </form> 
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

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
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>';
} else{
    session_destroy();
    header("location: index.php");
}    
?>