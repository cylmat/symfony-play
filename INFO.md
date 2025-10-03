# DataBundle
============


### Install
- npm install
- npm run build
- bin/console assets:install

### Project:
- docker exec symplay-phpfpm --rm composer install
- docker exec symplay-phpfpm --rm npm install 

### Run
- docker compose up --build -d
- docker exec -it phpfpm bash
- docker compose down --remove-orphans

### Front
- docker exec -it phpfpm npm run dev

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

