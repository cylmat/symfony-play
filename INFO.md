# Symfony playground

## Run

Build
```shell
# uncomment databases if needed (for module DATA)
docker compose up --build -d

# Use to try your own installation:
# docker run --rm -it php:8.3-fpm bash

docker exec -it symplay bash
docker compose down --remove-orphans
```

### Frontend

```shell
docker exec -it -u root bin/install npm 
docker exec bin/run npm
- npm install
- npm run build
- bin/console assets:install
- docker exec -it phpfpm npm run dev
```

### Install

```shell
docker exec symplay bin/composer install
docker exec symplay npm install 
```

```shell
docker exec -it -u root symplay bin/install deptrac
docker exec symplay bin/run deptrac
```

Tests
```shell
docker exec -it -u root symplay bin/install phpunit
docker exec symplay bin/run funit
```

### Assets

```shell
docker exec symplay bin/console assets:install
docker exec symplay npm run watch
```


Db
---
https://customer.cloudamqp.com/instance/
https://woodpecker.rmq.cloudamqp.com/#/connections  
https://customer.elephantsql.com/instance
