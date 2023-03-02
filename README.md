# Laravel JWT authentication

## Preparation

Once you clone the repository, execute ```composer install``` or ```composer update```.

1. ```php artisan passport:install --uuid``` 
2. ```php artisan passport:keys```

After this, configure .env file with these variables (```PASSPORT_CLIENT_ID``` and ```PASSPORT_CLIENT_SECRET```), and run the project.

*If you forget to copy these values when execute ```php artisan passport:keys``` you can find them into database, in oauth_clients' table*

## Routes

1. **/login** - POST
    - email
    - password
    
2. **/user** - GET - need bearer token token
