#clone laravel
composer install
composer install --ignore-platform-reqs
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
Vite:
npm install
npm run dev

php artisan make:seeder AdminSeeder
php artisan make:seeder RoleSeeder
php artisan migrate:refresh --seed
php artisan make:migration create_table_name

#db seeder
-php artisan migrate --seed  
-php artisan db:seed --class=UserTypeSeeder
-php artisan db:seed --class=UserCategorySeeder
-php artisan db:seed --class=UsersSeeder

#setup email
php artisan make:notification VerifyEmail
grep -R mailpit*
egrep -v storage
php artisan config:cache

