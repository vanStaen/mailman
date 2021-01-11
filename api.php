<?php

header("Content-Type:application/json");

$entityBody = stream_get_contents(STDIN);

if(!empty($_GET['key']))
{
	$key=$_GET['key'];
	
	/* if(empty($price))
	{
		response(200,"Product Not Found",NULL);
	}
	else
	{
		response(200,"Product Found",$price);
	} */

	response(200,$key,$entityBody);
	
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