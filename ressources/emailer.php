<?php

header("Content-Type:application/json");

$httpMethod = $_SERVER['REQUEST_METHOD'];
$data = file_get_contents('php://input');

$cleanData = str_replace("\n", "", $data);
$dataDecoded = json_decode($cleanData, true);
$from=$dataDecoded['from'];
$to=$dataDecoded['to'];
$subject=$dataDecoded['subject'];
$body=$dataDecoded['body'];

	try {
		$headers="from: ".$from."\r\n";
		$headers .= "Reply-To: ".$from."\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		$txt=wordwrap($body,500);
		mail($to,$subject,$txt,$headers);
		response(200, "OK", $dataDecoded);
	}
	catch (Exception $e) {
		$data = $e->getMessage();
		response(400,"Invalid Request", $data);
	}

function response($status,$status_message,$data) {
	header("HTTP/1.1 ".$status);	
	$response['status']=$status;
	$response['status_message']=$status_message;
	if(isset($data['to'])) {
		$response['sentto']="Email sent to ".$data['to'];
	} else {
		$response['error']=$data;
	}

	$json_response = json_encode($response);
	echo $json_response;
}

?>