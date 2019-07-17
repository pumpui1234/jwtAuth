<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
// generate json web token
include_once 'core.php';
require_once __DIR__.'/vendor/autoload.php';
use \Firebase\JWT\JWT;
 
// generate jwt will be here
// echo $key; die;
$status_ = 1;

if(!empty($_GET)){
//    $id= $_GET['id'];
//    $username= $_GET['username'];
//    $email= $_GET['email'];
}

$token = array(
    "iss" => $iss,
    "aud" => $aud,
    "iat" => $iat,
    "nbf" => $nbf,
    "exp" => $exp,
    "data" => array(
        "status_" => $status_,
    )
 );

 // set response code
 http_response_code(200);

 // generate jwt
 $jwt = JWT::encode($token, $key);
 echo json_encode(
         array(
             "message" => "Successful Gen.",
             "jwt" => $jwt
         )
     );
?>