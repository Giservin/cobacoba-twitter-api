<?php
require 'vendor/autoload.php';


$getVal = $_GET["query"];

use GuzzleHttp\Client;

$client = new Client();


// 2. Take the code from the URL then exchange it for access token

// 3. Jadikan Access Token sebagai bearer untuk API post request:
$response = $client->request('POST', 'https://api.twitter.com/2/tweets', [
    'headers' => 
        ['Authorization' => 'Bearer '.$_COOKIE["access_token"]],
    'json' => 
        ['text' => $getVal]
    
]);

$result = $response->getBody()->getContents();

header('Content-Type: application/json');
echo $result;

exit;

?>