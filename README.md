## Postman API Link (public)
https://www.postman.com/designplanet/workspace/chc/collection/12768207-f0028219-f072-4c0d-b5ab-592711fbee7e?action=share&creator=12768207

## Installation Instructions
1) git clone https://github.com/ozadorozhnyi/chc.git chc
2) composer install
3) cp .env.example .env
4) php artisan key:generate
5) database:
    5.1) create a new db
    5.2) create a new db user (and password, optionally)
6) php artisan migrate --seed

## Testing
1) touch database/database.sqlite
2) php artisan test
