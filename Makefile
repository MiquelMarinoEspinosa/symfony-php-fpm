.PHONY: coverage

SH_PHP=docker exec -i -t app.php-fpm

up: 
	docker-compose up

down:
	docker-compose down

build: install clear-cache db

bash:
	$(SH_PHP) sh

clear-cache:
	$(SH_PHP) bin/console cache:clear
	$(SH_PHP) bin/console cache:clear --env=test

unit:
	$(SH_PHP) vendor/bin/phpunit --testsuite Unit

acceptance:
	$(SH_PHP) vendor/bin/phpunit --testsuite Acceptance

cs-fixer:
	$(SH_PHP) vendor/bin/php-cs-fixer fix src
	$(SH_PHP) vendor/bin/php-cs-fixer fix tests

coverage:
	$(SH_PHP) vendor/bin/phpunit --testsuite Unit --coverage-html coverage

db-client:
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

db-test:
	$(SH_PHP) bin/console doctrine:database:drop --force --if-exists --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-query --flush --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-metadata --flush --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-result --flush --env=test
	$(SH_PHP) bin/console doctrine:database:create --env=test
	$(SH_PHP) bin/console doctrine:schema:create --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-query --flush --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-metadata --flush --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-result --flush --env=test

install:
	$(SH_PHP) composer install

behat:
	$(SH_PHP) vendor/bin/behat --config config/packages/test/behat.yml
