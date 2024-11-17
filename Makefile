.PHONY: start setup stop install migrate

all: start

start:
	docker compose up -d

setup: install start migrate stop

stop:
	docker compose down

install:
	docker compose run api composer install
	docker compose run frontend yarn

migrate:
	docker compose exec api php artisan migrate --seed
