<?php
  header ('Content-type: text/html; charset=utf-8');
  $ch = curl_init(); 
  curl_setopt($ch, CURLOPT_URL, "http://data.tmd.go.th/api/WeatherToday/V1/?type=json");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
  $output = curl_exec($ch); 
  curl_close($ch);
  echo $output["Stations"];
?>