# Shop API

## Note

This is a test project all of it is a mockup and not a real project, do not use it for production due to the lack of security and other features.

A feature-oriented e-commerce backend built with Laravel, with a Next.js frontend scaffold.

The API currently provides admin CRUD endpoints for categories, brands, products, users, information pages, and carts. Product, category, and cart writes are transactional so their related records remain consistent.

## Features

- Category trees with descriptions and nested children
- Brands with filtering and pagination
- Products with descriptions, categories, pricing, inventory, and status
- Customer administration with secure password hashing and redacted credentials
- Information and policy page management
- Cart and order management with nested line-item snapshots
- Request validation, typed DTOs, actions, queries, and API resources
- Feature tests for all implemented admin CRUD operations
- Custom `make:feature` Artisan generator

## Technology

- PHP 8.3+
- Laravel 13
- MySQL
- Laravel Sanctum
- PHPUnit 12
- Next.js 16, React 19, TypeScript, and Material UI

## Project structure

```text
.
├── api/                         Laravel API
│   ├── app/Features/            Feature-oriented application code
│   │   └── {Feature}/
│   │       ├── Admin/
│   │       │   ├── Actions/
│   │       │   ├── Controllers/
│   │       │   ├── DTOs/
│   │       │   ├── Queries/
│   │       │   ├── Requests/
│   │       │   └── Resources/
│   │       └── Models/
│   ├── database/migrations/
│   ├── routes/
│   └── tests/Feature/
├── frontend/                    Next.js frontend scaffold
├── compose.yml                  Local service orchestration
├── Dockerfile                   PHP-FPM development image
├── Makefile                     Docker and Laravel shortcuts
└── nginx.conf                   Local API web server
```

## WSL2 setup

Windows users can run the project inside Ubuntu on WSL2. Open PowerShell as Administrator:

```powershell
wsl --install -d Ubuntu
wsl --update
```

Restart Windows if requested, launch Ubuntu, create your Linux user, and install the basic development tools:

```bash
sudo apt update
sudo apt upgrade -y
sudo apt install -y git curl unzip
```

Keep the repository in the Linux filesystem for better performance:

```bash
mkdir -p ~/projects
cd ~/projects
git clone <repository-url> laravel-api
cd laravel-api
```

Avoid placing active projects under `/mnt/c` when using Docker or running large Composer and npm installs.

### Docker Desktop integration

1. Install Docker Desktop for Windows.
2. Open **Settings → General** and enable the WSL2-based engine.
3. Open **Settings → Resources → WSL Integration** and enable your Ubuntu distribution.
4. Restart Docker Desktop.
5. Verify Docker from the Ubuntu terminal:

```bash
docker --version
docker run --rm hello-world
```

If you prefer running the API without Docker, install PHP 8.3+, Composer, MySQL, and the required PHP extensions directly inside Ubuntu.

## API setup

### Requirements

- PHP 8.3 or newer
- Composer
- MySQL
- Required PHP extensions, including PDO MySQL

### Installation

```bash
cd api
composer install
cp .env.example .env
php artisan key:generate
```

Configure the database connection in `api/.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=
```

Create the schema and start the API:

```bash
php artisan migrate
php artisan serve
```

By default, the local API is available at `http://127.0.0.1:8000`.

## Frontend setup

The `frontend` directory currently contains the Next.js project scaffold.

```bash
cd frontend
npm install
npm run dev
```

## Docker setup

The project includes a Docker Compose stack with PHP-FPM, Nginx, MySQL 8.4, and phpMyAdmin. The `Makefile` provides shortcuts for the most common commands.

### 1. Configure Docker and Laravel

Create a root `.env` file for Docker Compose:

```bash
cat > .env <<'EOF'
MYSQL_ROOT_PASSWORD=secret
MYSQL_DATABASE=app
MYSQL_PORT=3306
EOF
```

Create the Laravel environment file:

```bash
cp api/.env.example api/.env
```

Set the following database values in `api/.env`:

```dotenv
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=app
DB_USERNAME=root
DB_PASSWORD=secret
```

### 2. Start the containers

Run this from the repository root:

```bash
make up
```

Docker Compose waits for MySQL to become healthy before starting PHP.

### 3. Install and initialize Laravel

```bash
make shell
composer install
php artisan key:generate
php artisan migrate
exit
```

The services are available at:

- API: `http://localhost`
- phpMyAdmin: `http://localhost:8081`

To use the configured local domain, add this entry to your Windows hosts file at `C:\Windows\System32\drivers\etc\hosts`:

```text
127.0.0.1 api.shop-v2.test
```

The API will then be available at `http://api.shop-v2.test`.

### Make commands

Run these commands from the repository root:

- `make up` — build and start all Docker services in the background.
- `make down` — stop and remove the running containers.
- `make shell` — open a Bash shell in the PHP container.
- `make migrate` — run pending Laravel migrations.
- `make migrate-seed` — run migrations and database seeders.
- `make tinker` — open Laravel Tinker.
- `make nginx-logs` — follow all Nginx container logs.
- `make nginx-access` — follow the Nginx access log.
- `make nginx-error` — follow the Nginx error log.
- `make php-logs` — follow PHP-FPM container logs.
- `make laravel-logs` — follow `api/storage/logs/laravel.log`.

For example:

```bash
make up
make migrate
make nginx-logs
```

## Admin endpoints

Admin routes use the `/admin` prefix. Each implemented resource follows the same pattern:

```text
GET     /admin/{resource}/list
POST    /admin/{resource}/store
GET     /admin/{resource}/{id}
PATCH   /admin/{resource}/{id}/update
DELETE  /admin/{resource}/{id}/delete
```

Available resource names:

- `category`
- `brand`
- `product`
- `user`
- `information`
- `cart`

List endpoints return paginated data:

```json
{
  "data": [],
  "meta": {
    "current_page": 1,
    "last_page": 1,
    "per_page": 50,
    "total": 0
  }
}
```

## Testing

The PHPUnit configuration uses MySQL by default:

```bash
cd api
php artisan test
```

To run the suite with an isolated in-memory SQLite database:

```bash
DB_CONNECTION=sqlite DB_DATABASE=:memory: php artisan test
```

## Creating a feature

The project includes an Artisan command that generates the feature-oriented CRUD structure:

```bash
php artisan make:feature FeatureName
```

Generate the extended structure with services, events, listeners, exceptions, and enums:

```bash
php artisan make:feature FeatureName --full-feature
```

