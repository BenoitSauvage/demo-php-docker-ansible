### Setup
- Build container image
```bash
docker-compose build
```

- Install dependencies
```bash
docker-compose run --rm demo-php composer install
```

### Run tests with PHPUnit
```bash
docker-compose run --rm demo-php ./vendor/bin/phpunit test
```