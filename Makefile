current_dir = $(shell pwd)

make:
	composer install
	composer dump-autoload

test:
	./vendor/bin/phpunit

test81:
	docker run --rm -v $(current_dir):/app -w /app php:8.1 vendor/bin/phpunit

test82:
	docker run --rm -v $(current_dir):/app -w /app php:8.2 vendor/bin/phpunit

test83:
	docker run --rm -v $(current_dir):/app -w /app php:8.3 vendor/bin/phpunit

cs-fix:
	./vendor/bin/php-cs-fixer fix --config .php-cs-fixer.dist.php

cs-fix-debug:
	./vendor/bin/php-cs-fixer fix --verbose --dry-run --config .php-cs-fixer.dist.php

phpstan:
	./vendor/bin/phpstan analyse

rector:
	./vendor/bin/rector process

rector-dry-run:
	./vendor/bin/rector process --dry-run
