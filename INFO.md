# Symfony playground

## Install

Build
```shell
# uncomment databases if needed (for module DATA)
docker compose up --build -d

# Use to try your own installation:
# docker run --rm -it php:8.3-fpm bash
#
# docker build --pull --rm -f ".docker\Dockerfile" -t symplay:latest ".docker" 

docker exec -it phpfpm bash
docker compose down --remove-orphans
```


### Frontend
- npm install
- npm run build
- bin/console assets:install
- docker exec -it phpfpm npm run dev

### Project
- docker exec symplay-phpfpm --rm composer install
- docker exec symplay-phpfpm --rm npm install 

### Assets
- docker exec phpfpm bin/console assets:install
- docker exec phpfpm npm run watch


@todo
-----
- install composer in phpfpm
- check atal: detected dubious ownership in repository at '/var/www/application'
        git config --global --add safe.directory /var/www/application
- lib/php/extensions/no-debug
- Environment variable not found: "DEV_SQLITE_URL
- export APP_ENV=dev
- desactivate grumphp on host (no php)

