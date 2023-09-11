<?php
require __DIR__ . '/vendor/autoload.php';

// configure the Google Client
$client = new \Google_Client();
$client->setApplicationName('Google Sheets API');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
// credentials.json is the key file we downloaded while setting up our Google Sheets API
$path = './credentials.json';
$client->setAuthConfig($path);

// configure the Sheets Service
$service = new \Google_Service_Sheets($client);
$spreadsheetId = '1VHzyrQguoJZj2qhIXlGK7GjXviRWVUEpLLkOCGULLD4';
$spreadsheet = $service->spreadsheets->get($spreadsheetId);

// get all the rows of a sheet
$range = 'adyen_pre_order'; // here we use the name of the Sheet to get all the rows
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$rows = $response->getValues();

// Remove the first one that contains headers
$headers = array_shift($rows);
// Combine the headers with each following row
$array = [];
foreach ($rows as $row) {
    $array[] = array_combine($headers, $row);
}
var_dump($array);

