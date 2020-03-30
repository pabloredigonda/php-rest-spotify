# PHP Spotify API

This is a Restful API written in PHP 7.4(Slim3).

## Usage

A Make File is provided for convenienve:

 - **make up** - creates and set up the containers
 - **make down** - stop containers
 - **make install** - install composer dependencies
 - **make tests** - run tests (all)
 - **make unittest** - run tests (unit)
 - **make e2etest** - run tests (end to end)

Or you can run the docker commands:

 - **docker-compose up -d** - creates and set up the containers
 - **docker exec -it php-rest-spotify-php-container composer install** - install composer dependencies
- **docker exec -it php-rest-spotify-php-container /var/www/html/vendor/bin/phpunit test/** - run tests

## Endpoints
**Search Albums** (GET) 

http://localhost:8008/api/v1/albums?**q**=cerati


Response body:

```json
{
    [{
          "name": "Bocanada",
          "tracks": 15,
          "released": "01-06-1999",
          "cover": {
              "url": "https:\/\/i.scdn.co\/image\/ab67616d0000b2731152471596980e1bba03b6ab",
              "width": 640,
              "height": 640
          }
      }, {
          "name": "Ah\u00ed Vamos",
          "tracks": 13,
          "released": "04-04-2006",
          "cover": {
              "url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273d543f7c7de880da5370922c0",
              "width": 640,
              "height": 640
          }
      }]
}
```

