<?php

$url="http://localhost/cyripe/test.php?id=1&profile=Shopping";
//$url="http://54.172.0.220/webservices/questions.php";
$client=curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
$response=curl_exec($client);
echo $response;
?>