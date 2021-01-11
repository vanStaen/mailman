<?php

header("Content-Type:application/json");

$httpMethod = $_SERVER['REQUEST_METHOD'];
$data = file_get_contents('php://input');

if(!empty($_GET['key']))
{
	$key=$_GET['key'];

	$cleanData = str_replace("\n", "", $data);
	$dataDecoded = json_decode($cleanData, true);
	$response['email']=$dataDecoded['email'];
	$response['body']=$dataDecoded['body'];

	response(200, $key, $dataDecoded);
	
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

	$json_response = json_encode($response);
	echo $json_response;
}