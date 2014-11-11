<?php

$question = $_POST['ask'];

$username = "osu_student23";
$password = "mkzNvWyD";
$authString = "Basic " . base64_encode($username . ":" . $password);

$watsonURL = "https://watson-wdc01.ihost.com/instance/501/deepqa/v1/question";

$questionInfo = '{"question":{ "questionText":"' . $question .'"}}';

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

echo $evidence[0]->{"text"};
echo '<br>';
echo $answers[0]->{"id"};
echo '<br>';
echo $answers[0]->{"text"};
echo '<br>';
echo $answers[0]->{"pipeline"};
echo '<br>';
echo $answers[0]->{"confidence"};
?>