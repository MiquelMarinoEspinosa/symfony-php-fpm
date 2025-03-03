.PHONY: coverage

SH_PHP=docker compose exec -i -t php-fpm

build:
	docker compose build

up: 
	docker compose up

down:
	docker compose down
	docker compose rm

config: install clear-cache db

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
	$(SH_PHP) bin/console doctrine:cache:clear-query
	$(SH_PHP) bin/console doctrine:cache:clear-metadata
	$(SH_PHP) bin/console doctrine:cache:clear-result
	$(SH_PHP) bin/console doctrine:database:create
	$(SH_PHP) bin/console doctrine:schema:create
	$(SH_PHP) bin/console doctrine:cache:clear-query
	$(SH_PHP) bin/console doctrine:cache:clear-metadata
	$(SH_PHP) bin/console doctrine:cache:clear-result

db-test:
	$(SH_PHP) bin/console doctrine:database:drop --force --if-exists --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-query --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-metadata --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-result --env=test
	$(SH_PHP) bin/console doctrine:database:create --env=test
	$(SH_PHP) bin/console doctrine:schema:create --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-query --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-metadata --env=test
	$(SH_PHP) bin/console doctrine:cache:clear-result --env=test

install:
	$(SH_PHP) composer install

behat:
	$(SH_PHP) vendor/bin/behat --config config/packages/test/behat.yml
