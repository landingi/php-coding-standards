ci:
	composer validate
	vendor/bin/ecs show --config ecs.php --clear-cache
	vendor/bin/phpunit
example:
	vendor/bin/ecs check --config ecs-local.php --clear-cache
