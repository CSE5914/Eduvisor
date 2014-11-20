<?php

$host="localhost"; // Host name 
$username="root"; // Mysql username 
$password=""; // Mysql password 
$db_name="eduvisor"; // Database name 
$tbl_name="forum_question1"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
mysql_select_db("$db_name")or die("cannot select DB");
$sql="SELECT * FROM $tbl_name ORDER BY id DESC";
// OREDER BY id DESC is order result by descending

$result=mysql_query($sql);
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
                       <a href="#welcome">Welcome,  '.explode(" ",$_SESSION['user'])[0].'</a>
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
            <h1>Edu-visor Community</h1>
            <h4 style="text-transform:none;margin-top:30px;">If you can't find the answer using our search, try posting your question here to see answers from other users.</h4>
        </div>
    </header>
    <div class="row" style="margin-top:80px;">
        <!--
<table width="90%" border="0" align="center" cellpadding="3" cellspacing="1" bgcolor="#CCCCCC">
<tr>
<td width="6%" align="center" bgcolor="#E6E6E6"><strong>#</strong></td>
<td width="53%" align="center" bgcolor="#E6E6E6"><strong>Topic</strong></td>
<td width="15%" align="center" bgcolor="#E6E6E6"><strong>Views</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Replies</strong></td>
<td width="13%" align="center" bgcolor="#E6E6E6"><strong>Date/Time</strong></td>
</tr>
-->
<div class="col-md-10 col-md-offset-1">
<table class="table table-striped table-bordered">
    <tr>
        <th class="col-md-5 text-center">
            Topic
        </th>
        <th class="col-md-2 text-center">
            Views
        </th>
        <th class="col-md-2 text-center">
            Replies
        </th>
        <th class="col-md-3 text-center">
            Posted
        </th>
    </tr>
<?php
 
// Start looping table row
while($rows=mysql_fetch_array($result)){
?>
<!--
<tr>
<td bgcolor="#FFFFFF"><? echo $rows['id']; ?></td>
<td bgcolor="#FFFFFF"><a href="view_topic.php?id=<? echo $rows['id']; ?>"><? echo $rows['topic']; ?></a><BR></td>
<td align="center" bgcolor="#FFFFFF"><? echo $rows['view']; ?></td>
<td align="center" bgcolor="#FFFFFF"><? echo $rows['reply']; ?></td>
<td align="center" bgcolor="#FFFFFF"><? echo $rows['datetime']; ?></td>
</tr>
-->
<tr>
    <td class="col-md-5 text-center">
        <a href="view_topic.php?id=<? echo $rows['id']; ?>"><? echo $rows['topic']; ?></a>
    </td>
    <td class="col-md-2 text-center">
        <? echo $rows['view']; ?>
    </td>
    <td class="col-md-2 text-center">
        <? echo $rows['reply']; ?>
    </td>
    <td class="col-md-3 text-center">
        <? echo $rows['datetime']; ?>
    </td>
</tr>

<?php
// Exit looping and close connection 
}
mysql_close();
?>
</table>
</div>
<!--<td colspan="5" align="right" bgcolor="#E6E6E6"><a href="create_topic.php"><strong>Create New Topic</strong> </a></td>
</tr>
</table>-->
</div>
<?php
if(isset($_SESSION['student_id'])){
    $con = mysqli_connect("localhost","root","","eduvisor");
        if(mysqli_connect_errno())
            echo "Failed" . mysqli_connect_error();
    $student_id=$_SESSION['student_id'];
    echo '<div class="row col-md-2 col-md-offset-9" style="margin-top:40px;">
        <a type="button" class="btn btn-primary btn-md btn-block" href="create_topic.php">Add new topic</a>
    </div>';
} ?>
</body>