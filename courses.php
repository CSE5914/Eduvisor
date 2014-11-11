<?php
session_start();
$con = mysqli_connect("localhost","root","","eduvisor");
    if(mysqli_connect_errno())
        echo "Failed" . mysqli_connect_error();
$student_id=$_SESSION['student_id'];    
$core=[];
$applied=[];
$other=[];
echo $student_id;
$result = mysqli_query($con,"SELECT * FROM student_courses WHERE student_id='" . $student_id . "'");
while($row = mysqli_fetch_array($result)) {
    if($row['type'] === "core")
        $core[]=$row;
    else if($row['type'] === "applied")
        $applied[]=$row;
    else
        $other[]=$row;
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
                <a class="navbar-brand" href="index.php">Edu-Visor</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="page-scroll">
                       <a href="#welcome">Welcome,  '.explode(" ",$_SESSION['user'])[0].'</a>
                    </li>
                    
                    <li class="page-scroll">
                        <a href="index.php">Log-out</a>
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
                    <li class="active"><a href=""><i class="glyphicon glyphicon-book"></i> Courses</a></li>
                </ul>
            </div>
            <div class="col-lg-1">
                <button type="submit" class="btn btn-primary btn-mini" ><i class="glyphicon glyphicon-plus"></i> Add</button>
            </div>  
        </div>
        <br>
        <div classe="row">
            <div class="container-fluid">
                <table class="table table-condensed" style="border-collapse:collapse;">
                    <tbody>
                        <tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
                            <td><h5><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></h5></td>
                            <td><h5>Core Courses</h5></td>
                        </tr>
                        <tr>
                            <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo1">';
                                if($core)
                                echo '
                                <table class="table table-striped">
                                    <thead>
                                        <tr><td><h6>Name</h6></td><td><h6>Number</h6></td><td><h6>Credits</h6></td><td><h6>Action</h6></td></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Programming Language</td><td>6431</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>
                                        <tr><td>Operationg Systems</td><td>6331</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>
                                        <tr><td>Algorithms</td><td>6341</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>              
                                    </tbody>
                                </table>';
                                else
                                    echo '<h6>No courses added here</h6>';
                                echo '    
                                </div> 
                            </td>
                        </tr>
                        <tr data-toggle="collapse" data-target="#demo2" class="accordion-toggle">
                            <td><h5><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></h5></td>
                            <td><h5>Applied Core Courses</h5></td>
                        </tr>
                        <tr>
                            <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo2">'; 
                                if($applied)
                                echo '    
                                <table class="table table-striped">
                                    <thead>
                                        <tr><td><h6>Name</h6></td><td><h6>Number</h6></td><td><h6>Credits</h6></td><td><h6>Action</h6></td></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Data Mining</td><td>5243</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>
                                        <tr><td>Parrallel Computing</td><td>5441</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>
                                                      
                                    </tbody>
                                </table>';
                                else
                                    
                                echo '<h6>No courses added</h6>';
                                echo'
                                </div> 
                            </td>
                        </tr>
                        <tr data-toggle="collapse" data-target="#demo3" class="accordion-toggle">
                            <td><h5><button class="btn btn-default btn-xs"><span class="glyphicon glyphicon-eye-open"></span></button></h5></td>
                            <td><h5>Other Courses</h5></td>
                        </tr>
                        <tr>
                            <tr>
                            <td colspan="12" class="hiddenRow"><div class="accordian-body collapse" id="demo3">'; 
                                if($other)
                                echo '
                                <table class="table table-striped">
                                    <thead>
                                        <tr><td><h6>Name</h6></td><td><h6>Number</h6></td><td><h6>Credits</h6></td><td><h6>Action</h6></td></tr>
                                    </thead>
                                    <tbody>
                                        <tr><td>Adv. Computer Arch</td><td>6429</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>
                                        <tr><td>Mobile App Dev</td><td>5246</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>
                                        <tr><td>MS Research</td><td>6998</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>  
                                        <tr><td>Info Security Projects</td><td>5472</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>
                                        <tr><td>Capstone: SW App</td><td>5911</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>
                                        <tr><td>Capstone: Knowledge Sys</td><td>5914</td><td>3</td><td><a href="#" class="btn btn-default btn-sm">
                                        <i class="glyphicon glyphicon-cog"></i></a></td></tr>             
                                    </tbody>
                                </table>';
                                else
                                    echo '<h6>No course added here</h6>';
                                echo '
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
    <footer class="text-center">
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
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>

</body>

</html>';
?>