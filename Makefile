install:
	composer install

lint:
	composer run-script phpcs -- --standard=PSR2 app database resources routes storage tests

fix:
	composer run-script phpcbf -- --standard=PSR2 app database resources routes storage tests

test:
	composer run-script phpunit tests

s:
	php -S localhost:80 -t public
