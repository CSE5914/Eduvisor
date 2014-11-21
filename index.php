<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $con = mysqli_connect("localhost","root","","eduvisor");

    if(mysqli_connect_errno())
        echo "Failed" . mysqli_connect_error();

    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pwd = md5(sha1($_POST['password']));
        
        $result = mysqli_query($con,"SELECT * FROM student WHERE email='" . $email . "' AND password='" . $pwd . "'");
        $count=0;
        if($result){
        $row = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
        }

        if($count==1){
        session_start();
        $_SESSION['user']=$row['first_name'].' '.$row['last_name'];
        $_SESSION['email']=$row['email'];
        $_SESSION['student_id']=$row['student_id'];
        header("Location: profile_personal.php");
        }
        else{
            $message = "Please try again: Invalid email/password";
            echo "<script type='text/javascript'>alert('$message');</script>";
        }
        
    }
    if(isset($_POST['register'])){

        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $email = $_POST['email'];
        $pwd = md5(sha1($_POST['password']));
        $rpwd = md5(sha1($_POST['confirm']));
        $depart = "Computer Science and Engineering";
        $phone = $_POST['phone'];
        $degree = $_POST['degree'];
        $year = $_POST['enroll_year'];
        $semester = $_POST['sem'];
        $error=[];

        if(empty($fname))
            $error[]="First name cannot be empty.";
        if(empty($lname))
            $error[]="Last name cannot be empty.";
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
            $error[]="Email is invalid/empty.";
        if(empty($_POST['password']))
            $error[]="Password cannot be empty.";
        if(empty($_POST['confirm']))
            $error[]="Confirm password cannot be empty.";
        if(empty($phone))
            $error[]="Phone cannot be empty.";
        if(empty($degree))
            $error[]="Please select a degree.";
        if(empty($year))
            $error[]="Enrollment year cannot be empty.";
        if(empty($semester))
            $error[]="Please select enrollment semester.";
        if(!empty($pwd) && !empty($rpwd) && $pwd != $rpwd)
            $error[]="Password and confirm password do not match.";

        if(count($error)>0) {
            echo '
       <div class="modal-dialog" id="modal1" style="position:fixed;relative: 100px;right: 0;left: 0;z-index: 1050;-webkit-overflow-scrolling: touch;outline: 0;">
            <div class="modal-content">
            <h5 style="padding:15px;">Kindly address the following errors:</h5>
                    <ul>';
                    foreach ($error as &$value) {
                        echo'<li>'.$value.'</li>';
                    }
                echo'
                    </ul>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" onclick="displayme1();">Close</button>
                    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->';

        }else{

            $mail_result = mysqli_query($con,"SELECT * FROM student WHERE email='" . $email ."'");
            $count1=0;
            if($mail_result){
            $count1 = mysqli_num_rows($mail_result);
            }

            if($count1>0){
                echo '
        <div class="modal-dialog" id="modal2" style="position:fixed;top: 100px;right: 0;left: 0;z-index: 1050;-webkit-overflow-scrolling: touch;outline: 0;">
            <div class="modal-content">
            <h5 style="padding:15px;">Sorry, this email address is already taken.</h5>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="displayme2()">Close</button>
                    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->';
            } else{

        $status=mysqli_query($con,"INSERT INTO student (first_name, last_name, email, password, phone, department, degree_id, enroll_sem, enroll_year) VALUES('" .$fname. "','" .$lname. "','" .$email. "','" .$pwd. "','" .$phone. "','" .$depart. "','" .$degree. "','" .$semester. "'," .$year. ")");

        echo'
        <div class="modal-dialog" id="modal3" style="position:fixed;top: 100px;right: 0;left: 0;z-index: 1050;-webkit-overflow-scrolling: touch;outline: 0;">
            <div class="modal-content">';
            if($status)
                echo'<h5 style="padding:15px;">Congratulations! You have successfully signed up.</h5>';
            else
                echo'<h5 style="padding:15px;">Sorry there was some error while signing up, try again later.</h5>';
            echo'
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="displayme3()">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->';
    }
    }
    }
    mysql_close($con);
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
    <script> function displayme1() {
 document.getElementById("modal1").style.display = "none";}
 function displayme2(){
 document.getElementById("modal2").style.display = "none";}
 function displayme3(){
 document.getElementById("modal3").style.display = "none";}</script>

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
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>';
               session_start();
if(isset($_SESSION['student_id'])){
                echo '<li class="page-scroll">
                       <a href="profile_personal.php">Welcome,  '.explode(" ",$_SESSION['user'])[0].'</a>
                    </li>
                    <li>
                    <a href="index.php">Ask a Question</a>
                    <li>
                    <a href="main_forum.php">Forum</a>
                    </li>
                    <li class="page-scroll">
                        <a href="logout.php">Log-out</a>
                    </li>';
               }
               else{     
                    echo '<li>
                        <a href="index.php">Ask a Question</a>
                    </li>
                    <li>
                        <a href="main_forum.php">Forum</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#login">Log-in</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#register">Register</a>
                    </li>';
                }
                   echo '<!--<li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>-->
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="img/profile.png" alt="">
                    <form action="search.php" method="POST" name="advice" id="adviceform" novalidate>
                    <div class="intro-text">
                             <div class="input-group">
                                <input type="text" class="col-lg-8 form-control" placeholder="Ask me" name="ask" id="ask" >
                                <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-small">Advice <i class="glyphicon glyphicon-search"></i></button>
                             </div>
                            
                        
                        <hr class="star-light">
                        <span class="skills">An Online Advisor - Whenever you need, wherever you need.</span>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </header>';
    if(!isset($_SESSION['student_id'])){
    echo '<!-- Portfolio Grid Section -->
    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Log-In</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form method="POST" name="login" id="loginform" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="text" class="form-control" placeholder="Email" name="email" id="email" required data-validation-required-message="Please enter your Username/Email">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" id="password" required data-validation-required-message="Please enter your Password">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                                <div class="form-group col-xs-12">
                                    <button type="submit" name="login" class="btn btn-success btn-lg">Let me in</button>
                                </div>
                         </div>
                    </form> 
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="success" id="register">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Register</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form method="POST" name="register" id="registerForm" novalidate>
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-2"><h6><label for="firstname">First Name</label></h6></div>
                                <div class="col-md-4"><input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname" required data-validation-required-message="Please enter your name."></div>                            
                                 <div class="col-md-2"><h6><label for="lastname">Last Name</label></h6></div>
                                 <div class="col-md-4"><input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname" required data-validation-required-message="Please enter your name."></div>
                            </div>
                             <br>
                             <div class="row">
                                <div class="col-md-2"><h6><label for="email">Email</label></h6></div>
                                <div class="col-md-10"><input type="email" class="form-control" placeholder="Email Address" name ="email" id="email" required data-validation-required-message="Please enter your email address."></div>                            
                            </div>
                             <br>
                             <div class="row">
                                <div class="col-md-2"><h6><label for="paswword">Password</label></h6></div>
                                <div class="col-md-4"><input type="password" class="form-control" placeholder="Password" name="password" id="password" required data-validation-required-message="Please enter your name."></div>                            
                                 <div class="col-md-2"><h6><label>Confirm Password</label></h6></div>
                                 <div class="col-md-4"><input type="password" class="form-control" placeholder="Confirm Password" name="confirm" id="confirm" required data-validation-required-message="Please enter your name."></div>
                            </div>
                             <br>
                             <div class="row">
                                <div class="col-md-2"><h6><label for="dob">Department</label></h6></div>
                                <div class="col-md-10"><input type="input" class="form-control" name="depart" id="depart" required data-validation-required-message="Please enter your name." value="Computer Science and Engineering" disabled></div>                            
                            </div>
                             <br>
                             <div class="row">
                                <div class="col-md-2"><h6><label for="phone">Phone number</label></h6></div>
                                <div class="col-md-4"><input type="text" class="form-control" placeholder="Phone Number" name="phone" id="phone" required data-validation-required-message="Please enter your name."></div>                            
                                 <div class="col-md-2"><h6><label for="country">Degree</label></h6></div>
                                 <div class="col-md-4"><select name="degree" id="degree" class="form-control" style="width: 100%">
                                    <option value="" selected>Select</option>
                                    <option value="1">BA</option>
                                    <option value="2">BS</option>
                                    <option value="3">MS</option>
                                    <option value="4">Phd</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2"><h6><label for="phone">Enrollment Year</label></h6></div>
                                <div class="col-md-4"><input type="text" class="form-control" placeholder="yyyy" name="enroll_year" id="enroll_year" required data-validation-required-message="Please enter your name."></div>                            
                                 <div class="col-md-2"><h6><label for="country">Enrollment Semester</label></h6></div>
                                 <div class="col-md-4"><select name="sem" id="sem" class="form-control" style="width: 100%">
                                    <option value="" selected>Select</option>
                                    <option value="Spring">Spring</option>
                                    <option value="Summer">Summer</option>
                                    <option value="Autumn">Autumn</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div id="success"></div>
                            <div class="row">
                                <div class="form-group col-xs-12" style="padding-bottom:80px;">
                                    <button type="submit"  name="register" class="btn btn-primary btn-lg">Register</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>';
}
else
{
    echo '<div style="height:200px;background-color:#b00;">&nbsp;</div>';
}
echo '<!-- Footer -->
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
    <!--<script src="js/contact_me.js"></script>-->

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>';
?>
