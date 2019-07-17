<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
include_once 'core.php';
require_once __DIR__.'/vendor/autoload.php';
use \Firebase\JWT\JWT;
/** 
 * Get header Authorization
 * */
function getAuthorizationHeader(){
    $headers = null;
    if (isset($_SERVER['Authorization'])) {
        $headers = trim($_SERVER["Authorization"]);
    }
    else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
        $headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
    } elseif (function_exists('apache_request_headers')) {
        $requestHeaders = apache_request_headers();
        // Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
        $requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
        //print_r($requestHeaders);
        if (isset($requestHeaders['Authorization'])) {
            $headers = trim($requestHeaders['Authorization']);
        }
    }
    return $headers;
}
/**
* get access token from header
* */
function getBearerToken() {
$headers = getAuthorizationHeader();
// HEADER: Get the access token from the header
if (!empty($headers)) {
    if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
        return $matches[1];
    }
}
return null;
}
// var_dump(getAuthorizationHeader());
// var_dump(getBearerToken());
// var_dump($_POST);
// var_dump($_GET);
// die;
$post = [];
if(!empty($_POST)){$post=$_POST;}
 $jwt = getBearerToken();
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
                "data" => $decoded->data,
                "post" => $post
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