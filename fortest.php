<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
// files for decoding jwt will be here
include_once 'core.php';
require_once __DIR__.'/vendor/autoload.php';
use \Firebase\JWT\JWT;

// get posted data
// $data = json_decode(file_get_contents("http://localhost:8888/JWTauth/gen_token.php"));
// get jwt
// $jwt=isset($data->jwt) ? $data->jwt : "";

// var_dump($data); die;
 $jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9wb3Jua2FzZW1jbGluaWMtaXNzLmNvbSIsImF1ZCI6Imh0dHA6XC9cL3Bvcm5rYXNlbWNsaW5pYy1hdXRoLmNvbSIsImlhdCI6MTM1Njk5OTUyNCwibmJmIjoxMzU3MDAwMDAwLCJkYXRhIjp7InN0YXR1c18iOjF9fQ.CJFhKnxnR9FTHNw3txydug1_FvBWAB9tBeIOaUeqn5k";
// decode jwt here
// if jwt is not empty
if($jwt){ 
 
    // if decode succeed, show user details
    try {
        // decode jwt
        $decoded = JWT::decode($jwt, $key, array('HS256'));
        $decoded;
        if($decoded->data->status_){
            $data_ = array(
                "message" => "Access granted.",
                "data" => $decoded->data
           );
        }else{
            $data_ = array(
                "message" => "Access denied.",
                "error" => "Token Error"
           );
        }
        // set response code
        http_response_code(200);
    
        // show user details
        echo json_encode($data_ );
 
    }// if decode fails, it means jwt is invalid
    catch (Exception $e){
    
        // set response code
        http_response_code(401);
    
        // tell the user access denied  & show error message
        echo json_encode(array(
            "message" => "Access denied.",
            "error" => $e->getMessage()
        ));
    }
}
 
// error if jwt is empty will be here
// show error message if jwt is empty
else{
 
    // set response code
    http_response_code(401);
 
    // tell the user access denied
    echo json_encode(array("message" => "Access denied."));
}
?>