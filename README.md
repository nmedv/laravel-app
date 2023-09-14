## How to run app

Create Docker container:
```bash
docker compose create
```

Create .env file by copying the template:
```bash
cp .env.example .env
```

Launch the container:
```bash
docker compose up -d
```

Install composer dependencies:
```bash
docker exec app composer install
```

Install composer dependencies:
```bash
docker exec app composer install
```

If the error "exceeded the timeout of 300 seconds" appears, then try:
```bash
docker exec app composer install -o -vvv
```

Then generate the application key:
```bash
docker exec app php artisan key:generate
```