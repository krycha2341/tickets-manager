# Ticket app
PHP 8.2.13 <br>
Laravel 10 <br>
Postgres latest <br>

### Info
```bash
composer install
cp -n .env.example .env
docker-compose up --build --remove-orphans -d
php artisan key:generate
```

Complete .env variable for https://dummyapi.io/docs:
```.dotenv
DUMMY_API_APP_KEY=
```

Postman collection: [tasks manager.postman_collection.json](tasks%20manager.postman_collection.json)
Postman env: [tasks manager.postman_environment.json](tasks%20manager.postman_environment.json)