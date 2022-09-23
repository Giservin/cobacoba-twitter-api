<?php
require 'vendor/autoload.php';

$getVal = $_GET["query"];

use GuzzleHttp\Client;

$client = new Client();

$response = $client->request('GET', 'https://api.twitter.com/2/tweets/search/recent', [
    'headers' => 
        ['Authorization' => 'Bearer AAAAAAAAAAAAAAAAAAAAAEplhQEAAAAADTq3uR%2BGHUZ7cWk2oVrOsdDIsMw%3DaCYkC1W6722VuNmyvmFycak399tSFN1bMoIP22dN0oY11VRv2e'],
    'query' => 
        ['query' => 'from:'.$getVal]
    
]);

$result = $response->getBody()->getContents();
// untuk memberi respon ke request
header('Content-Type: application/json');
echo $result;
// echo json_encode([
//     "token" => $tokenBearer
// ]);
exit;

?>