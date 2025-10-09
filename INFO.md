# Symfony playground

## Run

Up & run
```shell
# uncomment databases if needed (for module DATA)
docker compose up --build -d
docker exec -it symplay npm run serve -d

# Use to try your own installation:
# docker run --rm -it php:8.3-fpm bash

docker exec -it symplay bash
docker compose down --remove-orphans
```

### Install

```shell
docker exec symplay bin/composer install
docker exec symplay npm install
docker exec symplay bin/console assets:install

# e.g. for deptrac 
docker exec -it -u root symplay bin/install deptrac
docker exec -it -u root symplay bin/install phpunit
```

### Tests

```shell
docker exec symplay bin/run deptrac
docker exec symplay bin/run funit
```

### Frontend

```shell
docker exec bin/run npm
- npm install
- npm run build
- docker exec -it phpfpm npm run dev
```


Db
---
https://customer.cloudamqp.com/instance/
https://woodpecker.rmq.cloudamqp.com/#/connections  
https://customer.elephantsql.com/instance
