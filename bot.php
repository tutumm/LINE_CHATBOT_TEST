<?php
$access_token = 'CPsrfgu1aQf9NvoemSxJql6hUFfSW8xTCmcZOPMqS4kNp3rvCgWmsZe7mT/XNnEpNAP1ZgPHfpQ2SwbV382WMnoNEXDfwkCBuU0KVj6B73I3lqgIPJ+k2EyDXeY5xG8vXcuaRBdpXrLYCo0SpemLWgdB04t89/1O/w1cDnyilFU=';

$content = file_get_contents('php://input');
$events = json_decode($content, true);

if (!is_null($events['events'])) {

	foreach ($events['events'] as $event) {

		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {

      if($event['message']['text'] == 'BKK'){
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "http://data.tmd.go.th/api/WeatherToday/V1/?type=json");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);
        $jsonArray = json_decode($output,true);
        $stations = "Stations";
        foreach($jsonArray[$stations] as $key=>$list) {
          if($list["StationNameTh"]== $city){
            $text =
            "จังหวัด: " . $list["StationNameTh"].
            "\r\nอุณหภูมิ: " . $list["Observe"]["Temperature"]["Value"].
            "\r\nอากาศสูงสุด: " . $list["Observe"]["MaxTemperature"]["Value"].
            "\r\nอากาศต่ำสุด: " . $list["Observe"]["MinTemperature"]["Value"];
          }
        }
      } else {
        $text = "พิมพ์ชื่อจังหวัดผิดอะป่าววว ภาษาไทยน้าาา";
      }

			$replyToken = $event['replyToken'];

			$messages = [
				'type' => 'text',
				'text' => $text
			];

			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";
