<?php

$question = $_POST['ask'];

$username = "osu_student23";
$password = "mkzNvWyD";
$authString = "Basic " . base64_encode($username . ":" . $password);

$watsonURL = "https://watson-wdc01.ihost.com/instance/501/deepqa/v1/question";

$questionInfo='{"question":{ "questionText":"' . $question .'", "formattedAnswer":true}}';

$options = array(
	"http" => array(
		"header" => "X-SyncTimeout: 30\r\n" .
					"Content-Type: application/json\r\n" .
					"Accept: application/json\r\n" .
					"Authorization: " . $authString . "\r\n",
		"method" => "POST",
		"content" => $questionInfo,
	),
);

$context = stream_context_create($options);

$result = file_get_contents($watsonURL, false, $context);

$watsonResult = json_decode($result);
$answers = $watsonResult->{"question"}->{"answers"};
$evidence = $watsonResult->{"question"}->{"evidencelist"};

$response = $answers[0];

echo '
	<!DOCTYPE html>
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
    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
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
                       <a href="#welcome">Welcome, user</a>
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
    <br><section class="success" id="register">
        <div class="container">
            <div class="col-lg-12 text-center">
                <h2>Response</h2>
                <hr class="star-light">
            </div>
        </div>
    </section>

    <!-- <div class="row">
        <div class="row text-center">
            <div class="form-group col-md-6 text-right">
                    <button type="submit" class="btn btn-primary btn-mini" style="width:25%"><i class="glyphicon glyphicon-user"></i> Personal</button>
            </div>
            <div class="form-group col-md-6 text-left">
                    <button type="submit" class="btn btn-primary btn-mini" style="width:25%"><i class="glyphicon glyphicon-book"></i> Course</button>
            </div>
                 
        </div> -->
    </div>
    <div class="container">   
        <div class="row">
            <div class="col-lg-10">
                <ul class="nav nav-tabs">  
                     <li class="active"><a href=""><i class="glyphicon glyphicon-user"></i> Response</a></li>
                    <li><a href="savedQuestions.html"><i class="glyphicon glyphicon-book"></i> Saved Questions</a></li>
                </ul>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="container-fluid">
                <h2>'.$question.'</h2>
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">';
$i = 0;
foreach ($answers as &$value)
{
	echo '
        
               <div class="list-group" data-toggle="collapse" data-target="#answer'.$i.'" class="accordion-toggle" style="margin-bottom:0;">
                    <a class="list-group-item active">
                        <h4 class="list-group-item-heading">Answer</h4>
                        <p class="list-group-item-text" style="color:white;">'.$value->{"text"}.'</p>
                    </a>
                       <div class="container collapse" id="answer'.$i.'">   
                          <div class="panel-body">'.$value->{"formattedText"}.'<br>
                            <br>
                            <a href="#">See Full Document</a>
                          </div>
                          <div class="panel-footer">
                            <div class="btn-group btn-group-justified">
                                <div class="col-lg-2 pull-right">
                                    <a href="#" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-arrow-left"></i> Return to all responses
                                    </a>
                                    <button type="submit" class="btn btn-warning btn-mini"><i class="glyphicon glyphicon-floppy-disk"></i> Save response</button>
                                </div>
                            </div>
                          </div>
                        </div>       
                    </div>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: '.substr($value->{"confidence"},2,2).'%">
                            <span class="">'.substr($value->{"confidence"},2,2).'% Confidence</span>
                        </div>
                    </div>
                
                <br>';
                $i++;

}
echo '
             </div> 
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
unset($value);
?>