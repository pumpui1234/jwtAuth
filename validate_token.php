<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
// required headers
header("Access-Control-Allow-Origin: http://localhost:8888/JWTauth/"); //check your locals
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// files for decoding jwt will be here
include_once 'core.php';
require_once __DIR__.'/vendor/autoload.php';
use \Firebase\JWT\JWT;

// get posted data
$data = json_decode(file_get_contents("http://localhost:8888/JWTauth/gen_token.php"));
// get jwt
$jwt=isset($data->jwt) ? $data->jwt : "";
// var_dump($data); die;
//  $jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9leGFtcGxlLm9yZyIsImF1ZCI6Imh0dHA6XC9cL2V4YW1wbGUuY29tIiwiaWF0IjoxMzU2OTk5NTI0LCJuYmYiOjEzNTcwMDAwMDAsImRhdGEiOnsiaWQiOiI2NjYiLCJ1c2VybmFtZSI6InB1bXB1aTY2NiIsImVtYWlsIjoibW9uZ2tvbC5uQGFkeWltLmNvbSJ9fQ.-ydDEvkJkiYQZ99DVrkcq_OVFlhTZs6bDLGDMk8-SXM";

 
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