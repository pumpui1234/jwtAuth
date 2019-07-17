<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
$authorization = "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9wb3Jua2FzZW1jbGluaWMtaXNzLmNvbSIsImF1ZCI6Imh0dHA6XC9cL3Bvcm5rYXNlbWNsaW5pYy1hdXRoLmNvbSIsImlhdCI6MTM1Njk5OTUyNCwibmJmIjoxMzU3MDAwMDAwLCJkYXRhIjp7InN0YXR1c18iOjF9fQ.CJFhKnxnR9FTHNw3txydug1_FvBWAB9tBeIOaUeqn5k";
$ch = curl_init();
// echo $payload;die;
curl_setopt($ch, CURLOPT_URL,"http://localhost:8888/JWTauth/resource_token.php");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization ));

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);
var_dump(json_decode($result));
?>
