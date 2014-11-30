<?php
    //global variables
    $question = $_POST['ask'];
    $KEEPQUESTION = $_POST['ask'];    
    $dedicated_answer=[];
    $keywords=[];


    function askWatson(){

    global $question;
    global $keywords;

    if(isset($_POST['ask']))
        $question=$_POST['ask'];


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
    
    global $dedicated_answer;

    for($i=0;$i<$numb;$i++)
    {
        //echo $evidence[$i]->{"metadataMap"}->{"originalfile"};
        if(preg_match("/\ACF_.*/i", $evidence[$i]->{"metadataMap"}->{"originalfile"})){
            $dedicated_answer[] = $answers[$i];
        }
    }

    $commonWords = array('a','able','about','above','abroad','according','accordingly','across','actually','adj','after','afterwards','again','against','ago','ahead','ain\'t','all','allow','allows','almost','alone','along','alongside','already','also','although','always','am','amid','amidst','among','amongst','an','and','another','any','anybody','anyhow','anyone','anything','anyway','anyways','anywhere','apart','appear','appreciate','appropriate','are','aren\'t','around','as','a\'s','aside','ask','asking','associated','at','available','away','awfully','b','back','backward','backwards','be','became','because','become','becomes','becoming','been','before','beforehand','begin','behind','being','believe','below','beside','besides','best','better','between','beyond','both','brief','but','by','c','came','can','cannot','cant','can\'t','caption','cause','causes','certain','certainly','changes','clearly','c\'mon','co','co.','com','come','comes','concerning','consequently','consider','considering','contain','containing','contains','corresponding','could','couldn\'t','course','c\'s','currently','d','dare','daren\'t','definitely','described','despite','did','didn\'t','different','directly','do','does','doesn\'t','doing','done','don\'t','down','downwards','during','e','each','edu','eg','eight','eighty','either','else','elsewhere','end','ending','enough','entirely','especially','et','etc','even','ever','evermore','every','everybody','everyone','everything','everywhere','ex','exactly','example','except','f','fairly','far','farther','few','fewer','fifth','first','five','followed','following','follows','for','forever','former','formerly','forth','forward','found','four','from','further','furthermore','g','get','gets','getting','given','gives','go','goes','going','gone','got','gotten','greetings','h','had','hadn\'t','half','happens','hardly','has','hasn\'t','have','haven\'t','having','he','he\'d','he\'ll','hello','help','hence','her','here','hereafter','hereby','herein','here\'s','hereupon','hers','herself','he\'s','hi','him','himself','his','hither','hopefully','how','howbeit','however','hundred','i','i\'d','ie','if','ignored','i\'ll','i\'m','immediate','in','inasmuch','inc','inc.','indeed','indicate','indicated','indicates','inner','inside','insofar','instead','into','inward','is','isn\'t','it','it\'d','it\'ll','its','it\'s','itself','i\'ve','j','just','k','keep','keeps','kept','know','known','knows','l','last','lately','later','latter','latterly','least','less','lest','let','let\'s','like','liked','likely','likewise','little','look','looking','looks','low','lower','ltd','m','made','mainly','make','makes','many','may','maybe','mayn\'t','me','mean','meantime','meanwhile','merely','might','mightn\'t','mine','minus','miss','more','moreover','most','mostly','mr','mrs','much','must','mustn\'t','my','myself','n','name','namely','nd','near','nearly','necessary','need','needn\'t','needs','neither','never','neverf','neverless','nevertheless','new','next','nine','ninety','no','nobody','non','none','nonetheless','noone','no-one','nor','normally','not','nothing','notwithstanding','novel','now','nowhere','o','obviously','of','off','often','oh','ok','okay','old','on','once','one','ones','one\'s','only','onto','opposite','or','other','others','otherwise','ought','oughtn\'t','our','ours','ourselves','out','outside','over','overall','own','p','particular','particularly','past','per','perhaps','placed','please','plus','possible','presumably','probably','provided','provides','q','que','quite','qv','r','rather','rd','re','really','reasonably','recent','recently','regarding','regardless','regards','relatively','respectively','right','round','s','said','same','saw','say','saying','says','second','secondly','see','seeing','seem','seemed','seeming','seems','seen','self','selves','sensible','sent','serious','seriously','seven','several','shall','shan\'t','she','she\'d','she\'ll','she\'s','should','shouldn\'t','since','six','so','some','somebody','someday','somehow','someone','something','sometime','sometimes','somewhat','somewhere','soon','sorry','specified','specify','specifying','still','sub','such','sup','sure','t','take','taken','taking','tell','tends','th','than','thank','thanks','thanx','that','that\'ll','thats','that\'s','that\'ve','the','their','theirs','them','themselves','then','thence','there','thereafter','thereby','there\'d','therefore','therein','there\'ll','there\'re','theres','there\'s','thereupon','there\'ve','these','they','they\'d','they\'ll','they\'re','they\'ve','thing','things','think','third','thirty','this','thorough','thoroughly','those','though','three','through','throughout','thru','thus','till','to','together','too','took','toward','towards','tried','tries','truly','try','trying','t\'s','twice','two','u','un','under','underneath','undoing','unfortunately','unless','unlike','unlikely','until','unto','up','upon','upwards','us','use','used','useful','uses','using','usually','v','value','various','versus','very','via','viz','vs','w','want','wants','was','wasn\'t','way','we','we\'d','welcome','well','we\'ll','went','were','we\'re','weren\'t','we\'ve','what','whatever','what\'ll','what\'s','what\'ve','when','whence','whenever','where','whereafter','whereas','whereby','wherein','where\'s','whereupon','wherever','whether','which','whichever','while','whilst','whither','who','who\'d','whoever','whole','who\'ll','whom','whomever','who\'s','whose','why','will','willing','wish','with','within','without','wonder','won\'t','would','wouldn\'t','x','y','yes','yet','you','you\'d','you\'ll','your','you\'re','yours','yourself','yourselves','you\'ve','z','zero');
    $question_split = preg_replace('/\b('.implode('|',$commonWords).')\b/i','',$question);
    $keywords = array_filter(split(" ", trim(preg_replace('/[^A-Za-z0-9\ ]/ ', " ", $question_split))));

    }

    askWatson();

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
    <br>
    <section class="success" id="register">
        <div class="container">
            <div class="col-lg-12 text-center">
                <form action="search.php" method="POST" name="advice" id="adviceform">
                    <div class="intro-text">
                         <div class="input-group">
                            <input type="text" class="col-lg-8 form-control" required placeholder="Ask me" name="ask" id="ask" value="'.$question.'" />
                            <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-small">Advice <span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                         </div>
                            
                        
                        <hr class="star-light">
                    </div>
                </form>
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
        <br>
        <div class="row">
            <div class="container-fluid">
                <h2 style="display:inline-block;">'.$question.'</h2> ';
        if(isset($_SESSION['student_id'])){
        echo'
            <form id="formSaveQuestion" class="form-inline" style="display:inline-block;float:right;" role="form" name="formSaveQuestion" method="post" action="add_question.php">
                <div class="form-group">
                    <input name="a_answer" id="a_answer" type="hidden" value="'.$KEEPQUESTION.'">
                </div>
                <input type="submit" class="btn btn-primary" name="Submit" value="Save Question" />
            </form>';
        }
        echo '</div>
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
                        <p class="list-group-item-text" style="color:white;">'.substr($value->{"text"}, strpos($value->{"text"}, "-") + 1).'</p>
                    </a>
                       <div class="container collapse" id="answer'.$i.'">   
                          <div class="panel-body">';
                          $main_str = $value->{"formattedText"};
                          foreach ($keywords as $keyword) {
                            $main_str=preg_replace('#'. preg_quote($keyword) .'#i', '<span style="background-color:#FFFF66; color:#FF0000;">\\0</span>', $main_str);
                          } 
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
        </div>';
        
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

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>
';
unset($value);
?>

</body>
</html>