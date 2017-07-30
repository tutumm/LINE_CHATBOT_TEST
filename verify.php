<?php
$access_token = 'CPsrfgu1aQf9NvoemSxJql6hUFfSW8xTCmcZOPMqS4kNp3rvCgWmsZe7mT/XNnEpNAP1ZgPHfpQ2SwbV382WMnoNEXDfwkCBuU0KVj6B73I3lqgIPJ+k2EyDXeY5xG8vXcuaRBdpXrLYCo0SpemLWgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;