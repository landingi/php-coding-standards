ci:
	composer validate
	vendor/bin/ecs show --config ecs.php
	vendor/bin/phpunit
