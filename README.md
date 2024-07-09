1. docker-compose up -d --build
2. docker exec laravel-app composer install
3. docker exec laravel-app php artisan migrate
4. docker exec laravel-app php artisan test



Tests:    5 passed (14 assertions)
Duration: 1.40s
