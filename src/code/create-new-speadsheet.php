<?php

require __DIR__ . './../vendor/autoload.php';

// Initialize Google Client
$client = new Google_Client();
$client->setAuthConfig('./credentials.json');
$client->addScope([
    Google_Service_Sheets::SPREADSHEETS,
    Google_Service_Drive::DRIVE_FILE // <--- Adding Google Drive file scope
]);
$client->addScope(Google_Service_Sheets::SPREADSHEETS);
$client->setAccessType('offline');

// Get Access Token
if (file_exists('token.json')) {
    $accessToken = json_decode(file_get_contents('token.json'), true);
    $client->setAccessToken($accessToken);
}

// Initialize Google Sheet Service
$service = new Google_Service_Sheets($client);

// Create New Google Sheet
$spreadsheet = new Google_Service_Sheets_Spreadsheet([
    'properties' => [
        'title' => 'My New Google Sheet'
    ]
]);

$spreadsheet = $service->spreadsheets->create($spreadsheet);
$spreadsheetId = $spreadsheet->spreadsheetId;

echo "Spreadsheet ID: " . $spreadsheetId . "\n";

// Give Read Permission
$batchPermission = new Google_Service_Drive_Permission([
    'type' => 'domain', // group,user,domain or anyone
    'role' => 'reader',
    'domain' => 'lingble.com'

]);

$driveService = new Google_Service_Drive($client);
$driveService->permissions->create($spreadsheetId, $batchPermission);
echo "Read permission granted.\n";
