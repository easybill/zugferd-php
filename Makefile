current_dir = $(shell pwd)

make:
	composer install
	composer dump-autoload

test:
	./vendor/bin/phpunit

test73:
	docker run --rm -v $(current_dir):/app -w /app php:7.3 vendor/bin/phpunit