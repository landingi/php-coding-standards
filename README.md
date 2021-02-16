# Landingi Static Code Analyze Bundle

This repository aggregates configuration files from libraries we are using in code testing

## phpstan

### Config
```neon
includes:
	- vendor/landingi/php-coding-standards/phpstan.neon

parameters:
    #Your custom config
```

`vendor/bin/phpstan analyze -c phpstan.neon`

### packages
* phpstan/phpstan
* phpstan/phpstan-phpunit
* phpstan/phpstan-symfony

#### Optional
* Jan0707/phpstan-prophecy - for Prophecy mocking tool
* phpstan/phpstan-mockery

## ecs

### Config

`vendor/bin/ecs check --config vendor/landingi/php-coding-standards/ecs.php`

### packages
* symplify/easy-coding-standard

## phpunit

### packages
* phpunit/phpunit
* symfony/phpunit-bridge

# Example Makefile

```makefile
ci:
	bin/phpunit
	vendor/bin/phpstan analyze -c phpstan.neon --memory-limit=256M
	vendor/bin/ecs check src tests
```
