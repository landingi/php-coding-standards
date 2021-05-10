ci:
	composer validate
	vendor/bin/ecs check --config ecs.php
