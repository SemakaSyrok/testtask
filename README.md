./vendor/bin/sail up -d --build <br>
./vendor/bin/sail composer install <br>
./vendor/bin/sail artisan migrate <br>
./vendor/bin/sail artisan db:seed <br>
./vendor/bin/npm install <br>
./vendor/bin/npm run prod <br>

Для запуска демонов
docker exec testtask_laravel.test_1 /usr/bin/php8.0 artisan daemon:start

Для остановки демонов 
docker exec testtask_laravel.test_1 /usr/bin/php8.0 artisan daemon:stop

Демоны нужны для инкрементации просмотров/лайков

Приложение на http://localhost

Вроде все)
