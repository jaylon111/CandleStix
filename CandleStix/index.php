<?php
require_once "vendor/autoload.php";

use GuzzleHttp\Client;
 
$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://www.alphavantage.co',
]);
 
$response = $client->request('GET', '/query', [
    'query' => [
        'function' => 'TIME_SERIES_INTRADAY',
        'symbol' => 'IBM',
        'interval' => '5min',
        'apikey' => 'OTUCHAQEMGPRYWMU',
    ]
]);
 
$body = $response->getBody();
$arr_body = json_decode($body);
print_r($arr_body);