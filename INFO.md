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
- npm install
- npm run build
- bin/console assets:install
- docker exec -it phpfpm npm run dev

### Install

```shell
docker exec symplay bin/composer install
docker exec symplay npm install 
```

### Assets

```shell
- docker exec phpfpm bin/console assets:install
- docker exec phpfpm npm run watch
```


Db
---
https://customer.cloudamqp.com/instance/  
https://woodpecker.rmq.cloudamqp.com/#/connections  
https://customer.elephantsql.com/instance/
