<?php

header("Content-Type:application/json");

$httpMethod = $_SERVER['REQUEST_METHOD'];
$entityBody = file_get_contents('php://input');

if(!empty($_GET['key']))
{
	$key=$_GET['key'];

	$data = $entityBody;

	response(200, $key, $data);
	
}
else
{
	response(400,"Invalid Request",NULL);
}


function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);	
	$response['status']=$status;
	$response['status_message']=$status_message;
	$response['data']=$data;	

	$cleanData1 = str_replace("\n", "", $data);
	$cleanData2 = str_replace("\\", "", $cleanData1);
	
	$dataDecoded = json_decode($cleanData2);

	$response['email']=$dataDecoded['email'];
	$response['mail']=$dataDecoded['mail'];

	$json_response = json_encode($response);
	echo $json_response;
}