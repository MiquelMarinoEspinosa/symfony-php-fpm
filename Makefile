.PHONY: coverage

SH_PHP=docker exec -i -t app.php-fpm

up: 
	docker-compose up

down:
	docker-compose down

bash:
	$(SH_PHP) sh

ENV=dev
clear-cache:
	$(SH_PHP) bin/console cache:clear --env=$(ENV)

unit:
	$(SH_PHP) bin/phpunit

cs-fixer:
	$(SH_PHP) vendor/bin/php-cs-fixer fix src
	$(SH_PHP) vendor/bin/php-cs-fixer fix tests

coverage:
	$(SH_PHP) bin/phpunit --coverage-html coverage

mysql:
	mysql -h 127.0.0.1 -P 3306 -u root -ptoor

db:
	$(SH_PHP) bin/console doctrine:database:drop --force --if-exists
	$(SH_PHP) bin/console doctrine:cache:clear-query --flush
	$(SH_PHP) bin/console doctrine:cache:clear-metadata --flush
	$(SH_PHP) bin/console doctrine:cache:clear-result --flush
	$(SH_PHP) bin/console doctrine:database:create
	$(SH_PHP) bin/console doctrine:schema:create
	$(SH_PHP) bin/console doctrine:cache:clear-query --flush
	$(SH_PHP) bin/console doctrine:cache:clear-metadata --flush
	$(SH_PHP) bin/console doctrine:cache:clear-result --flush

install:
	$(SH_PHP) composer install

acceptance:
	$(SH_PHP) vendor/bin/behat --config config/packages/test/behat.yml