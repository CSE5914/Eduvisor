<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="eduvisor"; // Database name 
$tbl_name="forum_question1"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");

// get value of id that sent from address bar 
$id=$_GET['id'];
$sql="SELECT * FROM $tbl_name WHERE id='$id'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);
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
<?php
session_start();
if(isset($_SESSION['student_id'])){
    $con = mysqli_connect("localhost","root","","eduvisor");
        if(mysqli_connect_errno())
            echo "Failed" . mysqli_connect_error();
    $student_id=$_SESSION['student_id'];
    echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
} else{
    session_destroy();
    echo '<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
?>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    <header>
        <div class="row" style="padding-top:80px;">
            <h1><? echo $rows['topic']; ?></h1>
        </div>
    </header>
    <div class="row col-md-10 col-md-offset-1" style="margin-top:30px;">
    	<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Question</h3>
				  </div>
				  <div class="panel-body">
				    <? echo $rows['detail']; ?>
				  </div>
				  <div class="panel-footer">
				  	<span style="line-height:1.1;"><h6 style="display:inline;">By: </h6> <? echo $rows['name']; ?></span>
				  	<span style="line-height:1.1;float:right;"><h6 style="display:inline;">Date/time: </h6><? echo $rows['datetime']; ?></span>
				  </div>
				</div>
    	</div>
    </body>
<!--below here not modified-->
<BR>

<?php

$tbl_name2="forum_answer1"; // Switch to table "forum_answer"
$sql2="SELECT * FROM $tbl_name2 WHERE question_id='$id'";
$result2=mysql_query($sql2);
while($rows=mysql_fetch_array($result2)){
?>
<div class="row col-md-10 col-md-offset-1" style="margin-top:30px;">
    	<div class="panel panel-default">
				  <div class="panel-heading">
				    <h3 class="panel-title">Answer <? echo $rows['a_id']; ?></h3>
				  </div>
				  <div class="panel-body">
				    <? echo $rows['a_answer']; ?>
				  </div>
				  <div class="panel-footer">
				  	<span style="line-height:1.1;"><h6 style="display:inline;">By: </h6><? echo $rows['a_name']; ?></span>
				  	<span style="line-height:1.1;float:right;"><h6 style="display:inline;">Date/time: </h6><? echo $rows['a_datetime']; ?></span>
				  </div>
				</div>
    	</div>
 
<?php
}

$sql3="SELECT view FROM $tbl_name WHERE id='$id'";
$result3=mysql_query($sql3);
$rows=mysql_fetch_array($result3);
$view=$rows['view'];
 
// if have no counter value set counter = 1
if(empty($view)){
$view=1;
$sql4="INSERT INTO $tbl_name(view) VALUES('$view') WHERE id='$id'";
$result4=mysql_query($sql4);
}
 
// count more value
$addview=$view+1;
$sql5="update $tbl_name set view='$addview' WHERE id='$id'";
$result5=mysql_query($sql5);
mysql_close();
?>
<?php
if(isset($_SESSION['student_id'])){
    $con = mysqli_connect("localhost","root","","eduvisor");
        if(mysqli_connect_errno())
            echo "Failed" . mysqli_connect_error();
    $student_id=$_SESSION['student_id'];
    echo '<div class="row col-md-8 col-md-offset-2" style="margin-top:30px;">
<form id="form1" role="form" name="form1" method="post" action="add_answer.php">
<div class="form-group">
    <label for="topic"><h4 style="color:white;margin-bottom:5px;">Answer</h4></label>
    <textarea rows="3" type="text" class="form-control" name="a_answer" id="a_answer" placeholder="Enter your answer..."></textarea>
</div>
<div class="form-group" style="display:none;">
    <label for="name"><h4 style="color:white;margin-bottom:5px;margin-bottom:5px;">Name</h4></label>
    <input type="text" class="form-control" name="a_name" id="a_name" value="'.explode(" ",$_SESSION['user'])[0].'" readonly>
</div>
<div class="form-group" style="display:none;">
    <label for="email"><h4 style="color:white;margin-bottom:5px;">Email</h4></label>
    <input type="text" class="form-control" name="a_email" id="a_email" value="DELETE@AOL.com" disabled>
</div>
<input name="id" type="hidden" value="';
echo $id;
echo '">
<input type="submit" class="btn btn-default" name="Submit" value="Submit" /> 
<input class="btn btn-default" type="reset" name="Submit2" value="Reset" />
</form>
</div>';
} ?>
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
