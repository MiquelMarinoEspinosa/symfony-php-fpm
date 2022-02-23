up: 
	docker-compose up

down:
	docker-compose down

bash:
	docker exec -i -t  app.php-fpm sh

cache-clear:
	docker exec -i -t  app.php-fpm bin/console cache:clear