<?php
require __DIR__ . './../vendor/autoload.php';

// Configure the Google Client
$client = new \Google_Client();
$client->setApplicationName('Google Sheets API');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
// Credentials.json is the key file we downloaded while setting up our Google Sheets API
$path = './credentials.json';
$client->setAuthConfig($path);

// Configure the Sheets Service
$service = new \Google_Service_Sheets($client);

// The ID of the original spreadsheet and the sheetId of the sheet you want to copy
$sourceSpreadsheetId = '1VHzyrQguoJZj2qhIXlGK7GjXviRWVUEpLLkOCGULLD4';
$sourceSheetId = '0'; // Sheet IDs usually start from 0, it located at the end of URL on each tab
$sourceSpreadsheet = $service->spreadsheets->get($sourceSpreadsheetId);

foreach ($sourceSpreadsheet->getSheets() as $sheet) {
    if ($sheet->getProperties()->getSheetId() == $sourceSheetId) {
        $sourceSheetTitle = $sheet->getProperties()->getTitle();
        break;
    }
}

// The ID of the target spreadsheet where you want to copy the sheet
$destinationSpreadsheetId = '1fzmCTeWc3Ky5DnFyus7ZV6JzsKtOMYFbwh6DYHVo2VA';

// Perform the sheet copy operation
$copySheetToAnotherSpreadsheetRequest = new Google_Service_Sheets_CopySheetToAnotherSpreadsheetRequest([
    'destinationSpreadsheetId' => $destinationSpreadsheetId
]);


$response = $service->spreadsheets_sheets->copyTo($sourceSpreadsheetId, $sourceSheetId, $copySheetToAnotherSpreadsheetRequest);
$newSheetId = $response->getSheetId();

// Update the title of the new sheet
$updateRequest = new Google_Service_Sheets_BatchUpdateSpreadsheetRequest([
    'requests' => [
        'updateSheetProperties' => [
            'properties' => [
                'sheetId' => $newSheetId,
                'title' => $sourceSheetTitle
            ],
            'fields' => 'title'
        ]
    ]
]);

$service->spreadsheets->batchUpdate($destinationSpreadsheetId, $updateRequest);

// Print response or perform further operations here
print_r($response);

