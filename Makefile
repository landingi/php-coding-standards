ci:
	composer validate
	vendor/bin/ecs check --debug src
	vendor/bin/ecs list --ansi --debug
	vendor/bin/phpunit
