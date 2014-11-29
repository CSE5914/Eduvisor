<?php
session_start();
if(isset($_SESSION['student_id'])){
$student_id="2";
$core_list=array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0);
$related_list=array("1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0);
$focus_area="";


$con = mysqli_connect("localhost","root","","eduvisor");
if(mysqli_connect_errno())
    echo "Failed" . mysqli_connect_error();

$result = mysqli_query($con,"SELECT course_list.core, course_list.related FROM student_courses,course_list WHERE student_courses.course_id=course_list.CourseID AND student_id='".$student_id."'");
while($row = mysqli_fetch_assoc($result)){
	
	if($row['core']!=0){
		$cores=str_split($row['core']);
		foreach ($cores as $value) {
			$core_list["$value"]=$core_list[$value]+1;
		}
	}
	if($row['related']!=0){
		$relateds=str_split($row['related']);
		foreach ($relateds as $value) {
			$related_list["$value"]=$related_list[$value]+1;
			
		}
	}
}

function getFocusArea($num){
	if(trim($num)==1)
		return "Advanced Studies";
	else if(trim($num)==2)
		return "Artificial Intelligence";
	else if(trim($num)==3)
		return "Computer Games";
	else if(trim($num)==4)
		return "Computer Graphics";
	else if(trim($num)==5)
		return "Computer Systems";
	else if(trim($num)==6)
		return "Data Analytics";
	else if(trim($num)==7)
		return "Information Security";
	else if(trim($num)==8)
		return "Software Engineering";

	return "Computer Science";
}

if(max($core_list)>0){
	$focus_area=getFocusArea(array_keys($core_list, max($core_list))[0]);
}else if(max($related_list)>0){
	$focus_area=getFocusArea(array_keys($related_list, max($related_list))[0]);
}else
	$focus_area="CSE";

//echo $focus_area;


mysqli_close($con);

function askWatson($ques){
	$question=$ques;
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
	    //echo $evidence[$i]->{"metadataMap"}->{"originalfile"};
	    if(preg_match("/\ACF_.*/i", $evidence[$i]->{"metadataMap"}->{"originalfile"})){
	        $dedicated_answer[] = $answers[$i];
	    }
	}

	return $dedicated_answer;
}

$question1="what is new in ".$focus_area."?";
$question2="what research is going on in ".$focus_area."?";

$new=askWatson($question1);
$research=askWatson($question2);

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
				if(isset($_SESSION['student_id'])){
                echo '<li class="page-scroll">
                       <a href="profile_personal.php">Welcome,  '.explode(" ",$_SESSION['user'])[0].'</a>
                    </li>
                    <li>
                    <a href="index.php">Ask a Question</a>
                    </li>
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
    <br>
    <section class="success" id="register">
        <div class="container">
            <div class="col-lg-12 text-center">
                        <h2>Recommendations</h2>
                        <hr class="star-light">
                    </div>
                </form>
            </div>
        </div>
    </section>

    </div>
    <div class="container">   
        <br>
        <div class="row">
            <div class="col-lg-10">
                <ul class="nav nav-tabs">  
                     <li><a href="profile_personal.php"><i class="glyphicon glyphicon-user"></i> Personal</a></li>
                    <li><a href="courses.php"><i class="glyphicon glyphicon-book"></i> Courses</a></li>
                    <li class="active"><a href=""><i class="glyphicon glyphicon-comment"></i> Reccommendations</a></li>
                    <li><a href="savedQuestions.php"><i class="glyphicon glyphicon-floppy-disk"></i> Saved Questions</a></li>
                </ul>
            </div>  
        </div>
        <div class="row">
            <div class="container-fluid text-center">';
            	if(strcasecmp($focus_area,"CSE")){
            	echo '<h4>You seem to be interested in <i>'.$focus_area.'</i>, so here are some news regarding this field of study at OSU.</h4>';
                }else
                	echo'<h4>It seems you have not taken any courses from a registered focus areas at OSU, for information on focus areas <a href="https://cse.osu.edu/current-students/undergraduate/focus-areas" target="_blank">click here</a>.</h4> <h3>showing latest news from <i>CSE</i></h4>';
            echo'    
            </div>
        </div>
        <div class="row">
            <div class="container-fluid">';

if(count($new)>0){
	echo '
       <div class="list-group" data-toggle="collapse" data-target="#new" class="accordion-toggle" style="margin-bottom:0;">
            <a class="list-group-item active">
                <h4 class="list-group-item-heading">Latest News:</h4>
                <p class="list-group-item-text" style="color:white;">'.substr($new[0]->{"text"}, strpos($new[0]->{"text"}, "-") + 1).'</p>
            </a>
               <div class="container collapse" id="new">   
                  <div class="panel-body">';
                  $main_str = $new[0]->{"formattedText"};
                  echo $main_str;

                  echo '<br>
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
                <div class="progress-bar progress-bar-success progress-bar-striped active" style="font-size: 18px;line-height: 18px;width: '.substr($new[0]->{"confidence"},2,2).'%">
                    <span class="">'.substr($new[0]->{"confidence"},2,2).'% Confidence</span>
                </div>
            </div>
        
        <br>';
}
if(count($research)>0){
	echo '
       <div class="list-group" data-toggle="collapse" data-target="#research" class="accordion-toggle" style="margin-bottom:0;">
            <a class="list-group-item active">
                <h4 class="list-group-item-heading">Research:</h4>
                <p class="list-group-item-text" style="color:white;">'.substr($research[0]->{"text"}, strpos($research[0]->{"text"}, "-") + 1).'</p>
            </a>
               <div class="container collapse" id="research">   
                  <div class="panel-body">';
                  $main_str = $research[0]->{"formattedText"};
                  echo $main_str;

                  echo '<br>
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
                <div class="progress-bar progress-bar-success progress-bar-striped active" style="font-size: 18px;line-height: 18px;width: '.substr($research[0]->{"confidence"},2,2).'%">
                    <span class="">'.substr($research[0]->{"confidence"},2,2).'% Confidence</span>
                </div>
            </div>
        
        <br>';
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
} else{
    session_destroy();
    header("location: index.php");
}
?>