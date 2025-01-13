# Laravel 11 Role Base Access Control Using spatie 

# To Run this project Setup database credentials as .env.example file



# Run Migration
php artisan migrate

# Run Seeder file For roles and permissions and some test users

php artisan db:seed --class="UserRolePermissionSeeder"

# Now Run
php artisan serve
