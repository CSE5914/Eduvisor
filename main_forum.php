<?php
$tbl_name="forum_question1"; // Table name 

session_start();
   
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
    </style>
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
                    <!--<li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>-->
                </ul>
            </div>';
            }else{
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
                    <!--<li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>-->
                </ul>
            </div>';
            }
            echo '
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <br>
    <section class="success" id="register">
        <div class="container">
            <div class="col-lg-12 text-center">
                <h2>Edu-visor Community</h2>
                <hr class="star-light">
                <h4 style="text-transform:none;margin-top:30px;">If you cant find the answer using our search, try posting your question here to see answers from other users.</h4>
            </div>
        </div>
    </section>

    <div class="container">   
        <div class="row">
              
        </div>
        <br>
        <div classe="row">
            <div class="container-fluid">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th class="col-md-5 text-center">Topic</th>
                            <th class="col-md-2 text-center">Views</th>
                            <th class="col-md-2 text-center">Replies</th>
                            <th class="col-md-3 text-center">Posted</th>
                        </tr>
                        </thead>
                        <tbody>';
                        $con = mysqli_connect("localhost","root","","eduvisor");
                        if(mysqli_connect_errno())
                                echo "Failed" . mysqli_connect_error(); 

                        $result = mysqli_query($con,"SELECT * FROM $tbl_name ORDER BY id DESC");

                        while($row=mysqli_fetch_array($result)){
                        echo'
                            <tr>
                                <td><a href="view_topic.php?id='.$row['id'].'">'.$row['topic'].'</a></td>
                                <td class="col-md-2 text-center">'.$row['view'].'</td>
                                <td class="col-md-2 text-center">'.$row['reply'].'</td>
                                <td class="col-md-3 text-center">'.$row['datetime'].'</td>
                            </tr>';
                        }
                        echo'
                        </tbody>
                    </table>
                </div>';
                if(isset($_SESSION['student_id'])){
                echo'    
                <div class="row col-md-2 col-md-offset-10" style="margin-top:40px;">
                    <a type="button" class="btn btn-primary btn-md btn-block" href="create_topic.php">Add new topic</a>
                </div>';
                }
                echo'
            </div> 
        </div>         
    </div>
    <!-- Footer -->
    <footer class="text-center" id="footer" style="margin-top:40px;">
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