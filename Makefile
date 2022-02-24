.PHONY: coverage

up: 
	docker-compose up

down:
	docker-compose down

bash:
	docker exec -i -t  app.php-fpm sh

cache-clear:
	docker exec -i -t  app.php-fpm bin/console cache:clear

unit:
	docker exec -i -t app.php-fpm bin/phpunit

fix:
	docker exec -i -t app.php-fpm vendor/bin/php-cs-fixer fix src
	docker exec -i -t app.php-fpm vendor/bin/php-cs-fixer fix tests

coverage:
	docker exec -i -t app.php-fpm bin/phpunit --coverage-html coverage

mysql:
	mysql -h 127.0.0.1 -P 3306 -u root -ptoor