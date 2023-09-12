# google-sheet-api-php

How to use:
```php
# Install composer dependencies
docker-compose exec workspace composer install 

# Create new spreadSheet
docker-compose  exec -w /app/code workspace php create-new-spreadsheet.php

# Fetch all rows of specific sheet
docker-compose  exec -w /app/code workspace php fetch-all-row.php

# Copy 1 tab to another tab on different sheet
docker-compose  exec -w /app/code workspace php copy-tab.php
```
Reference:
- Docker (https://docs.docker.com/get-docker/)
- Docker Compose (https://docs.docker.com/compose/install/)
- Google Sheet API PHP Client (https://developers.google.com/sheets/api/quickstart/php)
- Google Sheet ID (https://developers.google.com/sheets/api/guides/concepts#spreadsheet_id)
- Google copyTo method (https://developers.google.com/sheets/api/reference/rest/v4/spreadsheets.sheets/copyTo)
- Google Sheet Range (https://developers.google.com/sheets/api/guides/concepts#ranges)
