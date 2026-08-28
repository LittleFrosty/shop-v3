up:
	docker compose up -d

down:
	docker compose down

shell:
	docker compose exec php bash

migrate:
	docker compose exec php php artisan migrate

migrate-seed:
	docker compose exec php php artisan migrate --seed

tinker:
	docker compose exec php php artisan tinker

nginx-logs:
	docker compose logs -f nginx

nginx-access:
	docker compose exec nginx tail -f /var/log/nginx/access.log

nginx-error:
	docker compose exec nginx tail -f /var/log/nginx/error.log

php-logs:
	docker compose logs -f php

laravel-logs:
	tail -f api/storage/logs/laravel.log