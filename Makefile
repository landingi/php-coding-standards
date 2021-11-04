ci:
	composer validate
	vendor/bin/ecs show --config ecs.php
	vendor/bin/ecs list --config ecs.php --ansi --debug
	vendor/bin/phpunit
