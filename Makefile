ci:
	composer validate
	vendor/bin/ecs check --debug --config ecs.php
	vendor/bin/ecs list --ansi --debug
	vendor/bin/phpunit
