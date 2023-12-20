##############
# DOCKER PHP #
# @see https://hub.docker.com/_/php
#
# Use this Dockerfile as a base template,
# (Un)comment extensions for your need on your own application.
#
# Use "docker run --rm -it php:8.1-fpm bash" to try your own installation
##############

### Debian GNU/Linux 11 (bullseye) ###

FROM php:8.2-fpm AS core

RUN apt update && apt install -y curl git zip
WORKDIR /var/www/application

FROM core AS simple

ARG DEBIAN_FRONTEND=noninteractive
RUN apt update

### Common and build (https://packages.debian.org) ###

RUN apt install -y \
    bzip2 \
    curl \
    git \
    gnupg \
    sqlite3 \
    wget \
    vim \
    zip

RUN apt install -y \
    apt-utils \
    autoconf \
    gcc \
    libc6-dev \
    make \
    pkg-config \
    software-properties-common

##################
# PHP extensions #
##################

FROM core AS ext

RUN apt update

##################
# Already installed extensions "php -m" :
# ctype curl date dom fileinfo filter ftp hash iconv json libxml mbstring mysqlnd openssl pcre pdo pdo_sqlite Phar
# posix readline Reflection session SimpleXML sodium spl sqlite3 standard tokenizer xml xmlreader xmlwriter zlib
# 
# Available extensions with "docker-php-ext-install" :
# bcmath bz2 calendar ctype curl dba dl_test dom enchant exif ffi fileinfo filter ftp gd gettext gmp hash iconv
# imap intl json ldap mbstring mysqli oci8 odbc opcache pcntl pdo pdo_dblib pdo_firebird pdo_mysql pdo_oci pdo_odbc
# pdo_pgsql pdo_sqlite pgsql phar posix pspell readline reflection session shmop simplexml snmp soap sockets sodium
# spl standard sysvmsg sysvsem sysvshm tidy tokenizer xml xmlreader xmlwriter xsl zend_test zip
#
# Extensions installed with docker-php-ext automatically created
# /usr/local/etc/php/conf.d/docker-php-ext-***.ini 
##################

# @see https://www.php.net/manual/en/refs.basic.other.php

RUN apt install -y \
    libxslt1-dev \
    libzip-dev
RUN docker-php-ext-install -j$(nproc) bcmath 
RUN docker-php-ext-install -j$(nproc) ctype 
RUN docker-php-ext-install -j$(nproc) fileinfo 
RUN docker-php-ext-install -j$(nproc) gettext 
RUN docker-php-ext-install -j$(nproc) intl 
# RUN docker-php-ext-install -j$(nproc) json 
# RUN docker-php-ext-install -j$(nproc) ldap 
# RUN docker-php-ext-install -j$(nproc) mbstring 
# RUN docker-php-ext-configure odbc && docker-php-ext-install -j$(nproc) odbc 
RUN docker-php-ext-install -j$(nproc) opcache 
RUN docker-php-ext-install -j$(nproc) pcntl 
# RUN docker-php-ext-install -j$(nproc) phar 
RUN docker-php-ext-install -j$(nproc) posix 
# RUN docker-php-ext-install -j$(nproc) reflection 
RUN docker-php-ext-install -j$(nproc) session 
RUN docker-php-ext-install -j$(nproc) sockets 
# RUN docker-php-ext-install -j$(nproc) sodium 
# RUN docker-php-ext-install -j$(nproc) spl 
# RUN docker-php-ext-configure standard && docker-php-ext-install -j$(nproc) standard 
# RUN docker-php-ext-install -j$(nproc) tokenizer 
RUN docker-php-ext-install -j$(nproc) xml 
RUN docker-php-ext-install -j$(nproc) xsl 
RUN docker-php-ext-install -j$(nproc) zip

#bz2 #gd #hash

### GD ###

RUN apt install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && php -r "var_dump(gd_info());"

### PECL extensions ###

RUN pecl channel-update pecl.php.net

### (http://pecl.php.net/packages.php)
### Use "pecl list-all" for all supported modules.
### Add extension=*** in php.ini for each pecl's extensions
RUN apt install -y libmcrypt-dev libpcre3-dev
RUN pecl channel-update pecl.php.net && echo "\n" | pecl install apcu
RUN pecl channel-update pecl.php.net && echo "\n" | pecl install ast
RUN pecl channel-update pecl.php.net && echo "\n" | pecl install ds
RUN pecl channel-update pecl.php.net && echo "\n" | pecl install mcrypt
RUN pecl channel-update pecl.php.net && echo "\n" | pecl install oauth
RUN pecl channel-update pecl.php.net && echo "\n" | pecl install psr

#crypto #env #handlebars #http_message #imagick #imap #ingres #mustache #lua #v8js
    
#####################
### DB extensions ###
#####################

FROM ext AS db_ext

RUN apt update

RUN apt install -y \
    libsqlite3-dev \
    libpq-dev

RUN docker-php-ext-install -j$(nproc) dba
RUN docker-php-ext-install -j$(nproc) pdo
RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-install -j$(nproc) pdo_pgsql
RUN docker-php-ext-install -j$(nproc) pdo_sqlite

# RUN docker-php-ext-install -j$(nproc) pdo_odbc

RUN pecl channel-update pecl.php.net && echo "\yes" | pecl install mongodb

############################
### Coverage & Profiling ###
############################

FROM db_ext AS full

RUN apt update

### @see https://xdebug.org ###

RUN pecl install \
    pcov \
    xdebug \
    xhprof

### Ssh ###

# Use following to send an ssh key on remote host
# ssh-copy-id -i ~/.ssh/id_ed25519.pub user@remote-host.com
RUN rm -f ~/.ssh/id_ed25519*
RUN apt install -y ssh && \
    ssh-keygen -t ed25519 -C "your_email@example.com" -f ~/.ssh/id_ed25519 -N "" && \
    eval "$(ssh-agent -s)" && \
    ssh-add ~/.ssh/id_ed25519

#############
### Clean ###
#############
RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*
