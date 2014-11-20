<?php
session_start();
if(isset($_SESSION['student_id'])){
    $con = mysqli_connect("localhost","root","","eduvisor");
        if(mysqli_connect_errno())
            echo "Failed" . mysqli_connect_error();
    $student_id=$_SESSION['student_id'];    
} else{
    session_destroy();
    header("location: main_forum.php");
}    
?>
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

<body id="page-top" class="index" style="background:#b00;">

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
            <?php echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
            </div>' ?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <header>
        <div class="row" style="padding-top:80px;">
            <h1>Create New Topic</h1>
            <h4 style="text-transform:none;margin-top:30px;">If you can't find the answer using our search, try posting your question here to see answers from other users.</h4>
        </div>
    </header>
    <div class="row col-md-10 col-md-offset-1" style="margin-top:30px;">
<form id="form1" role="form" name="form1" method="post" action="add_topic.php">
<div class="form-group">
	<label for="topic"><h4 style="color:white;margin-bottom:5px;">Topic</h4></label>
    <input type="text" class="form-control" name="topic" id="topic" placeholder="Enter topic...">
</div>
<div class="form-group">
	<label for="topic"><h4 style="color:white;margin-bottom:5px;">Question</h4></label>
    <textarea rows="3" type="text" class="form-control" name="detail" id="detail" placeholder="Enter question..."></textarea>
</div>
<?php echo '
<div class="form-group" style="display:none;">
	<label for="name"><h4 style="color:white;margin-bottom:5px;margin-bottom:5px;">Name</h4></label>
    <input type="text" class="form-control" name="name" id="name" value="'.explode(" ",$_SESSION['user'])[0].'" readonly>
</div>' ?>
<div class="form-group" style="display:none;">
	<label for="email"><h4 style="color:white;margin-bottom:5px;">Email</h4></label>
    <input type="text" class="form-control" name="email" id="email" value="DELETE@AOL.com" disabled>
</div>

<input type="submit" class="btn btn-default" name="Submit" value="Submit" /> 
<input class="btn btn-default" type="reset" name="Submit2" value="Reset" />
</form>
</div>
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
</body>