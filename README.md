# Project in Laravel 12.47.0, php 8.3.26

## [thksTo](https://www.youtube.com/watch?v=TzAJfjCn7Ks)
## [thksTo2](https://www.youtube.com/watch?v=uyPvYnlzmhE)

- laravel new project (creo cartella con progetto)
- composer require laravel/sanctum (istallo sanctum)
- php artisan vendor:publish --provider="Laravel\Sanctum\SanctumServiceProvider" (copiare migration in database e file sanctum.php in config)
- php artisan config:publish cors (file in config cors.php)
- php artisan install:api (file in routes api.php)
- mysql -u username -p e create database nome_database; (entro in mysql e creo il db)
- php artisan migrate (lancio le migration)
- php artisan tinker e User::factory()->times(25)->create(); (creo 25 utenti tramite factory)
- sudo apt install php8.3-xdebug e sudo nano /etc/php/8.3/cli/conf.d/20-xdebug.ini e sudo nano /etc/php/8.3/apache2/conf.d/20-xdebug.ini (istallo xdebug)
- sudo systemctl restart apache2 (riavvio apache)
- php artisan make:factory TaskFactory (creo factory)
- php artisan make:resource TasksResource (creo resource)
- php artisan --version (versione di laravel)
- php artisan make:request StoreUserRequest (creo la request per la validate)
- php artisan route:list (vedo le rotte)

