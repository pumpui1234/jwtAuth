<?php
// show error reporting
error_reporting(E_ALL);
 
// set your default time-zone
date_default_timezone_set('Asia/Manila');
require_once __DIR__.'/vendor/autoload.php';
use \Firebase\JWT\JWT;
// variables used for jwt
// $jwt = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9wb3Jua2FzZW1jbGluaWMtaXNzLmNvbSIsImF1ZCI6Imh0dHA6XC9cL3Bvcm5rYXNlbWNsaW5pYy1hdXRoLmNvbSIsImlhdCI6MTM1Njk5OTUyNCwibmJmIjoxMzU3MDAwMDAwLCJkYXRhIjp7InN0YXR1c18iOjF9fQ.CJFhKnxnR9FTHNw3txydug1_FvBWAB9tBeIOaUeqn5k";
$key  = hash('sha256', 'dread_vador');
// echo hash('sha256', 'dread_vador');
$iss = "http://pornkasemclinic-iss.com";
$aud = "http://pornkasemclinic-auth.com";
$iat = 1356999524;
// $nbf = strtotime('2021-01-01 00:00:01'); //start
// $exp = strtotime('2021-01-01 00:00:01'); //expire
$nbf = 1357000000;
// $nbf = strtotime('2004-01-01 00:00:01');
// $exp = strtotime('2005-06-01 00:00:01');


?>
