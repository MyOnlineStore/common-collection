MAKEFLAGS += --silent

UID := $(shell id -u)
GID := $(shell id -g)
PWD := $(shell pwd)

phpunit:
	docker run --rm --user="${UID}:${GID}" -v ${PWD}:/app -w /app php:7.2-cli php vendor/bin/phpunit
	docker run --rm --user="${UID}:${GID}" -v ${PWD}:/app -w /app php:7.3-cli php vendor/bin/phpunit
	docker run --rm --user="${UID}:${GID}" -v ${PWD}:/app -w /app php:7.4-cli php vendor/bin/phpunit
