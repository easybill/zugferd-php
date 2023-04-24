current_dir = $(shell pwd)

make:
	composer install
	composer dump-autoload

test:
	./vendor/bin/phpunit

test74:
	docker run --rm -v $(current_dir):/app -w /app php:7.4 vendor/bin/phpunit

test8:
	docker run --rm -v $(current_dir):/app -w /app php:8.0 vendor/bin/phpunit

test81:
	docker run --rm -v $(current_dir):/app -w /app php:8.1 vendor/bin/phpunit

test82:
	docker run --rm -v $(current_dir):/app -w /app php:8.2 vendor/bin/phpunit

cs-fix:
	./vendor/bin/php-cs-fixer fix --config .php-cs-fixer.dist.php