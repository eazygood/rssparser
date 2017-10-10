# ERR News parser 
## How to lunch it

1. Clone :point_right:repo
2. Write "composer update" in terminal
3. Create database rssparser (MySQL)
4. Copy/paste .env.example and rename it to .env and then edit some constant like:point_down:
````
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rssparser
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=redis
````
5. Write in terminal "php artisan key:generate"
6. Install redis and start (redis-server && redis-cli)
7. Write in terminal "php artisan serve" (to run server)
8. Finally visit 127.0.0.1:8000

That's all :boom: 

## Technologies used

*Laravel framework
jQuery library
