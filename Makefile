.PHONY: coverage

up: 
	docker-compose up

down:
	docker-compose down

bash:
	docker exec -i -t app.php-fpm sh

clear-cache:
	docker exec -i -t app.php-fpm bin/console cache:clear

unit:
	docker exec -i -t app.php-fpm bin/phpunit

cs-fixer:
	docker exec -i -t app.php-fpm vendor/bin/php-cs-fixer fix src
	docker exec -i -t app.php-fpm vendor/bin/php-cs-fixer fix tests

coverage:
	docker exec -i -t app.php-fpm bin/phpunit --coverage-html coverage

bash-mysql:
	mysql -h 127.0.0.1 -P 3306 -u root -ptoor

db:
	docker exec -i -t app.php-fpm bin/console doctrine:database:drop --force --if-exists
	docker exec -i -t app.php-fpm bin/console doctrine:cache:clear-query --flush
	docker exec -i -t app.php-fpm bin/console doctrine:cache:clear-metadata --flush
	docker exec -i -t app.php-fpm bin/console doctrine:cache:clear-result --flush
	docker exec -i -t app.php-fpm bin/console doctrine:database:create
	docker exec -i -t app.php-fpm bin/console doctrine:schema:create
	docker exec -i -t app.php-fpm bin/console doctrine:cache:clear-query --flush
	docker exec -i -t app.php-fpm bin/console doctrine:cache:clear-metadata --flush
	docker exec -i -t app.php-fpm bin/console doctrine:cache:clear-result --flush