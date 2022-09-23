<?php
require '../vendor/autoload.php';

$auth_code = $_GET["code"];

use GuzzleHttp\Client;

$client = new Client();
// 1. Get Code to Authenticate (get permission to resource owner)
$response = $client->request('POST', 'https://api.twitter.com/2/oauth2/token', [
    'headers' =>
        ['Content-Type' => 'application/x-www-form-urlencoded'],
    'form_params' => [
        'code' => $auth_code,
        'grant_type' => 'authorization_code',
        'client_id' => 'SjRLcTE4MDdhYzNXVzVibVhxQmk6MTpjaQ',
        'redirect_uri' => 'http://127.0.0.1:80/tes-rest-api/Mini-Project-Twitter-API/auth/',
        'code_verifier' => 'challenge'
    ]
]);

$access_token = json_decode($response->getBody()->getContents(), true)['access_token'];
setcookie("access_token", $access_token, time()+7200, "/");

header("Location: ../index.html");
exit;

?>