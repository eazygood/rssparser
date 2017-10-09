# ERR News parser
## How to initialize

1. Clone :point_right:repo
2. Write composer update in terminal
3. Copy/paste .env.example to .env and edit it
````
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rssparser
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=redis :fire:
````
4. Write in terminal php artisan key:generate
5. Install redis and start (redis-server && redis-cli)
6. Finally write in terminal php artisan serve (to turn on server (127.0.0.1:8000)

That's all :boom: 
