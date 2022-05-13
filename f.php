<?php

$ch = curl_init();
$url = $_GET["url"] ;
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);

$rawdata = curl_exec ($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

header ("Content-Type: ".$contentType."");
header("Access-Control-Allow-Origin: *");
print_r($rawdata);

curl_close($ch);
flush();

?>
