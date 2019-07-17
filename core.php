<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Asia/Manila');
require_once __DIR__.'/vendor/autoload.php';
use \Firebase\JWT\JWT;
// variables used for jwt
$key  = hash('sha256', 'dread_vador');
$iss = "http://localhost-iss.com";
$aud = "http://localhost-auth.com";
$iat = 1356999524;
// $nbf = strtotime('2021-01-01 00:00:01'); //start
// $exp = strtotime('2021-01-01 00:00:01'); //expire
// $nbf = 1357000000;
$nbf = strtotime('2004-01-01 00:00:01');
$exp = strtotime('2005-06-01 00:00:01');


?>
