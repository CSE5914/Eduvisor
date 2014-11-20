<?php
session_start();
if(isset($_SESSION['student_id'])){
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['btn_save'])){
            $con = mysqli_connect("localhost","root","","eduvisor");
            if(mysqli_connect_errno())
                echo "Failed" . mysqli_connect_error();
            $name = $_POST['name'];
            $names = explode(" ", $name);
            $fname = $names[0];
            $lname = $names[1];
            $email = $_POST['email'];
            $depart = "Computer Science and Engineering";
            $phone = $_POST['phone'];
            $degree = $_POST['degree'];
            $year = $_POST['year'];
            $semester = $_POST['sem'];

            
            mysqli_query($con,"UPDATE student  SET first_name='" .$fname. "',last_name='" .$lname. "',email='" .$email. "', phone='" .$phone. "', department='" .$depart. "', degree_id='" .$degree. "', enroll_sem='" .$semester. "', enroll_year= '".$year."' WHERE email='".$email."'");
            mysql_close($con);


        }
         $message = "Please try again: Invalid email/password";
                echo "<script type='text/javascript'>alert('$message');</script>";
    }
   
echo '
<html lang="en">

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
        function edit(){
            document.getElementById("lbl_name").style.display = "none";
            document.getElementById("lbl_email").style.display = "none";
            document.getElementById("lbl_phone").style.display = "none";
            document.getElementById("lbl_depart").style.display = "none";
            document.getElementById("lbl_degree").style.display = "none";
            document.getElementById("lbl_sem").style.display = "none";
            document.getElementById("lbl_year").style.display = "none";
            document.getElementById("btn_edit").style.display = "none";

            document.getElementById("name").style.display = "block";
            document.getElementById("email").style.display = "block";
            document.getElementById("phone").style.display = "block";
            document.getElementById("depart").style.display = "block";
            document.getElementById("degree").style.display = "block";
            document.getElementById("sem").style.display = "block";
            document.getElementById("year").style.display = "block";
            document.getElementById("btn_save").style.display = "block";
            document.getElementById("btn_cancel").style.display = "block";
        }
        function edit_cancel(){
            document.getElementById("lbl_name").style.display = "block";
            document.getElementById("lbl_email").style.display = "block";
            document.getElementById("lbl_phone").style.display = "block";
            document.getElementById("lbl_depart").style.display = "block";
            document.getElementById("lbl_degree").style.display = "block";
            document.getElementById("lbl_sem").style.display = "block";
            document.getElementById("lbl_year").style.display = "block";
            document.getElementById("btn_edit").style.display = "block";

            document.getElementById("name").style.display = "none";
            document.getElementById("email").style.display = "none";
            document.getElementById("phone").style.display = "none";
            document.getElementById("depart").style.display = "none";
            document.getElementById("degree").style.display = "none";
            document.getElementById("sem").style.display = "none";
            document.getElementById("year").style.display = "none";
            document.getElementById("btn_save").style.display = "none";
            document.getElementById("btn_cancel").style.display = "none";
        }
        function save_student(){
            console.log(document.getElementById("name").value.split(" ")[0]);

            var theForm, newInput1, newInput2, newInput3, newInput4, newInput5, newInput6;
            theForm = document.createElement("form");
            theForm.action = "saveStudent.php";
            theForm.method = "post";

            newInput1 = document.createElement("input");
            newInput1.type = "hidden";
            newInput1.name = "txt_fname";
            newInput1.value = (document.getElementById("name").value).split(" ")[0];

            newInput2 = document.createElement("input");
            newInput2.type = "hidden";
            newInput2.name = "txt_lname";
            newInput2.value = (document.getElementById("name").value).split(" ")[1];
            
            newInput3 = document.createElement("input");
            newInput3.type = "hidden";
            newInput3.name = "txt_phone";
            newInput3.value = document.getElementById("phone").value;
             
            newInput4 = document.createElement("input");
            newInput4.type = "hidden";
            newInput4.name = "txt_degree";
            newInput4.value = document.getElementById("degree").value;
             
            newInput5 = document.createElement("input");
            newInput5.type = "hidden";
            newInput5.name = "txt_sem";
            newInput5.value = document.getElementById("sem").value;
             
            newInput6 = document.createElement("input");
            newInput6.type = "hidden";
            newInput6.name = "txt_year";
            newInput6.value = document.getElementById("year").value;

            theForm.appendChild(newInput1);
            theForm.appendChild(newInput2);
            theForm.appendChild(newInput3);
            theForm.appendChild(newInput4);
            theForm.appendChild(newInput5);
            theForm.appendChild(newInput6);
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

    <!-- <div class="row">
        <div class="row text-center">
            <div class="form-group col-md-6 text-right">
                    <button type="button" class="btn btn-primary btn-mini" style="width:25%"><i class="glyphicon glyphicon-user"></i> Personal</button>
            </div>
            <div class="form-group col-md-6 text-left">
                    <button type="button" class="btn btn-primary btn-mini" style="width:25%"><i class="glyphicon glyphicon-book"></i> Course</button>
            </div>
                 
        </div> -->
    </div>
    <div class="container">   
        <div class="row">
            <div class="col-lg-10">
                <ul class="nav nav-tabs">  
                     <li class="active"><a href=""><i class="glyphicon glyphicon-user"></i> Personal</a></li>
                    <li><a href="courses.php"><i class="glyphicon glyphicon-book"></i> Courses</a></li>
                    <li><a href="savedQuestions.php"><i class="glyphicon glyphicon-book"></i> Saved Questions</a></li>
                </ul>
            </div>
            <div class="col-lg-1">
                <button type="button" class="btn btn-primary btn-mini" name="btn_edit" id="btn_edit" onclick=edit();><i class="glyphicon glyphicon-edit"></i> Edit</button>
            </div>   
        </div>
        <br>
        <div classe="row">
            
                <div class="container-fluid">';
                    $con = mysqli_connect("localhost","root","","eduvisor");
                    if(mysqli_connect_errno())
                        echo "Failed" . mysqli_connect_error();

                    $email =  $_SESSION['email'];
                    $result = mysqli_query($con,"SELECT * FROM student WHERE email='" . $email . "'");
                    $row = mysqli_fetch_array($result);

                    $name = $row['first_name'] .' '. $row['last_name'];
                    $email = $row['email'];
                    $phone = $row['phone'];
                    $depart = $row['department'];
                    $degreeid = $row['degree_id'];
                    $result2 = mysqli_query($con,"SELECT * FROM degree WHERE id='" . $degreeid . "'");
                    $row2 = mysqli_fetch_array($result2);
                    $degree = $row2['description'];
                    $sem = $row['enroll_sem'];
                    $year = $row['enroll_year'];  
                    //mysql_close($con);
                    echo '
                    <form method="POST" name="editstudent" id="editstudentform" novalidate>
                    <div class="row">
                        <div class="col-md-3"><h6><label>Name :</label></h6></div>
                        <div class="col-md-4"><h6><label name="lbl_name" id="lbl_name">' .$name. '</label></h6>
                        <input type="text" class="form-control" placeholder="John Doe" name="name" id="name" value="' .$name. '" required style ="display:none"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-3"><h6><label for="name">Email :</label></h6></div>
                        <div class="col-md-4"><h6><label name="lbl_email" id="lbl_email">' .$email. '</label></h6>
                        <input type="email" class="form-control" placeholder="doe@email.com" name="email" id="email" value="' .$email. '" required style="display:none" disabled/></div>
                    </div>
                    <br> 
                    <div class="row">
                        <div class="col-md-3"><h6><label>Phone :</label></h6></div>
                        <div class="col-md-4"><h6><label name="lbl_phone" id="lbl_phone">' .$phone. '</label></h6>
                        <input type="number" class="form-control" placeholder="doe@email.com" name="phone" id="phone" required value="' .$phone. '" style="display:none"></div>
                    </div>
                    <br> 
                   <div class="row">
                        <div class="col-md-3"><h6><label>Department :</label></h6></div>
                        <div class="col-md-4"><h6><label name="lbl_depart" id="lbl_depart">' .$depart. '</label></h6>
                        <input type="text" class="form-control" placeholder="CSE" name="depart" id="depart" required value="' .$depart. '" style="display:none" disabled></div>
                    </div>
                    <br> 
                    <div class="row">
                        <div class="col-md-3"><h6><label>Degree :</label></h6></div>
                        <div class="col-md-4"><h6><label name="lbl_degree" id="lbl_degree">' .$degree. '</label></h6>
                        <select name="degree" id="degree" class="form-control" style="width: 100%; display:none;">
                                    <option value="1"'; if(strcasecmp($degree, "Bachelor of Arts") == 0) echo 'selected'; echo' >BA</option>
                                    <option value="2"'; if(strcasecmp($degree, "Bachelor of Science") == 0) echo 'selected'; echo'>BS</option>
                                    <option value="3"'; if(strcasecmp($degree, "Master of Science") == 0) echo 'selected'; echo'>MS</option>
                                    <option value="4"'; if(strcasecmp($degree, "Doctor of Philosophy") == 0) echo 'selected'; echo'>Phd</option>
                                    </select></div>
                    </div>
                    <br> 
                   <div class="row">
                        <div class="col-md-3"><h6><label for="name">Enrollment Semester :</label></h6></div>
                        <div class="col-md-4"><h6><label name="lbl_sem" id="lbl_sem">' .$sem. '</label></h6>
                        <select name="sem" id="sem" class="form-control" style="width: 100%; display:none;">
                                    <option value="Spring"'; if(strcasecmp($sem, "Spring") == 0) echo 'selected'; echo' >Spring</option>
                                    <option value="Summer"'; if(strcasecmp($sem, "Summer") == 0) echo 'selected'; echo' >Summer</option>
                                    <option value="Autumn"'; if(strcasecmp($sem, "Autumn") == 0) echo 'selected'; echo'>Autumn</option>
                                    </select>
                        </div>
                    </div>
                    <br>  
                    <div class="row">
                        <div class="col-md-3"><h6><label>Enrollment Year :</label></h6></div>
                        <div class="col-md-4"><h6><label name="lbl_year" id="lbl_year">' .$year. '</label></h6>
                        <input type="text" class="form-control" placeholder="yyyy" name="year" id="year" required value="' .$year. '" style="display:none"></div>
                    </div> 
                    <br> 
                    
                    <div class="row">
                        <div class="col-lg-1">
                            <button type="button" name="btn_save" id="btn_save" class="btn btn-info btn-sm" style="width:100%; display: none;" onclick="save_student();">Save</button>
                        </div>
                        <div class="col-lg-1">
                            <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-warning btn-sm" style="width:100%; display:none;" onclick=;edit_cancel();>cancel</button>
                        </div>
                    </div>  
                    </form> 
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

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visble-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Portfolio Modals -->
    
    
    
    
    
    

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