## Migrations

Publish the migrations

`php artisan vendor:publish --tag=theme-store-migrations --force`

Apply migrations

`php artisan migrate --path=/database/migrations/laravel-ready/theme-store`

Rollback migrations

`php artisan migrate:rollback --path=/database/migrations/laravel-ready/theme-store`


`php artisan migrate:refresh`
