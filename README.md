./vendor/bin/sail up -d --build
./vendor/bin/sail composer install
./vendor/bin/sail artisan migrate
./vendor/bin/sail artisan db:seed
./vendor/bin/npm install
./vendor/bin/npm run prod

Для запуска демонов
docker exec testtask_laravel.test_1 /usr/bin/php8.0 artisan daemon:start

Для остановки демонов 
docker exec testtask_laravel.test_1 /usr/bin/php8.0 artisan daemon:stop

Демоны нужны для инкрементации просмотров/лайков

Приложение на http://

Вроде все)
