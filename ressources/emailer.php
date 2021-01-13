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
		$headers="from: ".$from;
		$txt=wordwrap($body,500);
		mail($to,$subject,$txt,$headers);
		response(200, "OK", $dataDecoded);
	}
	catch (Exception $e) {
		$data = 'Message: ' .$e->getMessage();
		response(400,"Invalid Request", $data);
	}

function response($status,$status_message,$data) {
	header("HTTP/1.1 ".$status);	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;

	$json_response = json_encode($response);
	echo $json_response;
}