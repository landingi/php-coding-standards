ci:
	composer validate
	vendor/bin/ecs show --config ecs.php
	vendor/bin/ecs list --ansi --debug
	vendor/bin/phpunit
