<?php

header("Content-Type:application/json");

$httpMethod = $_SERVER['REQUEST_METHOD'];
$data = file_get_contents('php://input');    
$dataDecoded = json_decode($data, true);	        

if(!empty($_GET['id']) && $data != NULL)
{
    $id=$_GET['id'];
    $url = $_ENV["emailerURL"].$id;	

    // Check if id and Key are a match
    if ($_ENV[$id] != $dataDecoded['key']) 
    {
        response(401, "Unauthorized", NULL);
    } 
    else 
    {
        // Call emailer script
        try {
            $result = call_user_func('callAPI', 'POST', $url, $data);
            $resultDecoded = json_decode($result, true);	    
            response($resultDecoded['status'], $resultDecoded['status_message'], $resultDecoded['sentto']);   
        }
        catch (Exception $e) {
            $data = $e->getMessage();
            response(400,"Invalid Request", $data);
        }
    }
}
else
{
	response(400, "Invalid Request", NULL);
}


function response($status,$status_message,$data)
{
	header("HTTP/1.1 ".$status);	
	$response['status']=$status;
	$response['status_message']=$status_message;

	if(!empty($data)) {	
		$response['sendto']=$data;
	}

	$json_response = json_encode($response);
	echo $json_response;
}


function callAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

	/*
    // Optional Authentication:
	curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($curl, CURLOPT_USERPWD, "username:password");
	*/
	
    curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

?>