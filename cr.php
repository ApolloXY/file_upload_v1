<?php

$url = 'https://www.instagram.com/nasa/?__a=1';
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json') );
$data = curl_exec($ch);
curl_close($ch);

echo $data; // Show the response

?>
