# Landingi Static Code Analyze Bundle

This repository aggregates configuration files from libraries we are using in code testing

## Installation

`composer require --dev landingi/php-coding-standards`

## Components

### phpstan

#### Config
```neon
includes:
	- vendor/landingi/php-coding-standards/phpstan.neon

parameters:
    #Your custom config
```

`vendor/bin/phpstan analyze -c phpstan.neon`

#### Packages
* phpstan/phpstan
* phpstan/phpstan-phpunit
* phpstan/phpstan-symfony
* phpstan/phpstan-doctrine

#### Optional packages
* Jan0707/phpstan-prophecy - for Prophecy mocking tool
* phpstan/phpstan-mockery

### ecs

#### Config

`vendor/bin/ecs check --config vendor/landingi/php-coding-standards/ecs.php`

#### Packages
* symplify/easy-coding-standard
