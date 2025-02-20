setup:
	@make build
	@make up
	@make data
build:
	docker compose build
up:
	docker compose up -d
stop:
	docker compose stop
down:
	docker compose down
composer-update:
	docker exec laravel bash -c "composer update"
data:
	docker exec laravel bash -c "php artisan migrate:fresh"
	docker exec laravel bash -c "php artisan db:seed"
