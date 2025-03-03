# php8
PHP 8 symfony project

Using php version 8 with a DDD approach to build a simple API REST Users creation
The application use Symfony as framework as well as doctrine as ORM 
Using docker to configure the devel environment 

### setup

* make up
* make build

### tests
* make unit
* make acceptance
* make coverage

### swagger
* http://localhost:8080

### configuration
* create `.env` and `.env.test`
* add to `.env` file the following line
    * `mysql://root:toor@app.mariadb:3306/app?serverVersion=11.7.2-MariaDB-ubu2404&charset=utf8`