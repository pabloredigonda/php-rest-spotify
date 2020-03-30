.PHONY: up down log

MAKEPATH := $(abspath $(lastword $(MAKEFILE_LIST)))
PWD := $(dir $(MAKEPATH))

up:
	docker-compose up -d

down:
	docker-compose down

stop:
	docker-compose stop

php:
	docker exec -it php-rest-spotify-php-container bash

	
install:
	docker exec -it php-rest-spotify-php-container composer install
   
test:
	docker exec -it php-rest-spotify-php-container /var/www/html/vendor/bin/phpunit test/
   
unittest:
	docker exec -it php-rest-spotify-php-container /var/www/html/vendor/bin/phpunit test/unit/
	
e2etest:
	docker exec -it php-rest-spotify-php-container /var/www/html/vendor/bin/phpunit test/endToEnd
	'
