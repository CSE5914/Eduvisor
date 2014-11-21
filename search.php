<?php

$question = $_POST['ask'];    
    $items=10;
    $formattedAnswer="True";
    $lat="";
    $passthru="";
    $category="";
    $context="";
    $evidenceRequest_profile="yes";
    $evidenceRequest_items="8";

    $username = "osu_student16";
    $password = "OquihcQI";
    $authString = "Basic " . base64_encode($username . ":" . $password);

    $watsonURL = "https://watson-wdc01.ihost.com/instance/501/deepqa/v1/question";
    

     //= '{"question":{ "questionText":"' . $question .', "formattedAnswer":true}}';
    $questionInfo='{"question":{ "questionText":"' . $question .'", "formattedAnswer":"'.$formattedAnswer.'" , "lat":"'.$lat.'","passthru":"'.$passthru.'","items":"'.$items.'","category":"'.$category.'","context":"'.$context.'","evidenceRequest":{"profile":"'.$evidenceRequest_profile.'" , "items":"'.$evidenceRequest_items.'"}}}';
    //$questionInfo='{"question":{ "questionText":"' .$question.'" }}';
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

    $result = file_get_contents($watsonURL, true, $context);
    //var_dump($result);
    $watsonResult = json_decode($result);
    $answers = $watsonResult->{"question"}->{"answers"};
    $evidence=$watsonResult->{"question"}->{"evidencelist"};
    $numb=count($answers);
    $dedicated_answer=[];

    for($i=0;$i<$numb;$i++)
    {
        echo $evidence[$i]->{"metadataMap"}->{"originalfile"};
        if(preg_match("/\ACF_.*/i", $evidence[$i]->{"metadataMap"}->{"originalfile"})){
            $dedicated_answer[] = $answers[$i];
        }
    }

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
    <link href="js/jquery-1.11.0.js" type="text/javascript">

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
<script> function displayme() {
 document.getElementById("modal").style.display = "none";}</script>
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
                <ul class="nav navbar-nav navbar-right">';
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
                        <a href="index.php#login">Log-in</a>
                    </li>
                    <li class="page-scroll">
                        <a href="index.php#register">Register</a>
                    </li>';
                }
                   echo '</ul>
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
                    <li><a href="savedQuestions.php"><i class="glyphicon glyphicon-book"></i> Saved Questions</a></li>
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
if(count($dedicated_answer)>0){
foreach ($dedicated_answer as &$value)
{
    if($i == 0 && intval(substr($value->{"confidence"},2,2)) < 25)
    {echo '
        <div class="modal-dialog" id="modal" style="position:fixed;top: 100px;right: 0;left: 0;z-index: 1050;-webkit-overflow-scrolling: touch;outline: 0;">
            <div class="modal-content">
            <h5 style="padding:15px;">We are not very confident in this response, maybe you should ask this question on our forum.</h5>
                    <div class="modal-footer">
                        <a href="main_forum.php" class="btn btn-success">Go to Forum</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="displayme()">Close</button>
                    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->';
    }

	echo '
               <div class="list-group" data-toggle="collapse" data-target="#answer'.$i.'" class="accordion-toggle" style="margin-bottom:0;">
                    <a class="list-group-item active">
                        <h4 class="list-group-item-heading">Answer</h4>
                        <p class="list-group-item-text" style="color:white;">'.$value->{"text"}.'</p>
                    </a>
                       <div class="container collapse" id="answer'.$i.'">   
                          <div class="panel-body">'.$value->{"formattedText"}.'<br>
                            <br>
                            <!--<a href="#">See Full Document</a>-->
                          </div>
                          <!--<div class="panel-footer">
                            <div class="btn-group btn-group-justified">
                                <div class="col-lg-2 col-lg-offset-6">
                                    <a href="#" class="btn btn-primary btn-mini"><i class="glyphicon glyphicon-arrow-left"></i> Return to all responses
                                    </a>
                                    </div>
                                    <div class="col-lg-2 col-lg-offset-2">
                                    <button type="submit" class="btn btn-warning btn-mini"><i class="glyphicon glyphicon-floppy-disk"></i> Save response</button>
                                </div>
                            </div>
                          </div>-->
                        </div>       
                    </div>
                    <div class="progress" style="height:20px;">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" style="font-size: 18px;line-height: 18px;width: '.substr($value->{"confidence"},2,2).'%">
                            <span class="">'.substr($value->{"confidence"},2,2).'% Confidence</span>
                        </div>
                    </div>
                
                <br>';
                $i++;

}
}else{
    echo '
        <div class="modal-dialog" id="modal" style="position:fixed;top: 100px;right: 0;left: 0;z-index: 1050;-webkit-overflow-scrolling: touch;outline: 0;">
            <div class="modal-content">
            <h5 style="padding:15px;">Sorry we do not have answer to that question, maybe you should ask this question on our forum.</h5>
                    <div class="modal-footer">
                        <a href="main_forum.php" class="btn btn-success">Go to Forum</a>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="displayme()">Close</button>
                    </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->';

}
echo '
             </div> 
            </div>   
        </div>
</div>
		</section>
        <div  style="padding-bottom:100px;">
        &nbsp;
        </div>
        
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
';
unset($value);
?>

</body>
</html>