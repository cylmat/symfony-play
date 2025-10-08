##############
# DOCKER PHP #
# @see https://hub.docker.com/_/php
#
# Use this Dockerfile as a base template,
# (Un)comment extensions for own application.
#
# docker build --pull --rm -f ".docker\Dockerfile" -t symplay:latest ".docker" 
##############

### Debian GNU/Linux 11 (bullseye) ###

FROM php:8.3-apache AS core


ENV UID=1000
ENV GID=1000
ENV NODE_VERSION=20
ARG DEBIAN_FRONTEND=noninteractive

RUN apt update && apt install -y curl git vim zip
RUN apt install -y ca-certificates


### Common and build (https://packages.debian.org) ###

RUN apt install -y \
    bzip2 \
    gnupg \
    sqlite3 \
    wget

RUN apt install -y apt-utils
RUN apt install -y autoconf 
RUN apt install -y gcc 
RUN apt install -y libc6-dev 
RUN apt install -y make 
RUN apt install -y pkg-config 




##################
# PHP extensions #
##################


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
RUN docker-php-ext-install -j$(nproc) opcache 
RUN docker-php-ext-install -j$(nproc) posix 
RUN docker-php-ext-install -j$(nproc) session 
RUN docker-php-ext-install -j$(nproc) xml 
RUN docker-php-ext-install -j$(nproc) xsl 
RUN docker-php-ext-install -j$(nproc) zip

# RUN docker-php-ext-install -j$(nproc) intl
# RUN docker-php-ext-install -j$(nproc) ldap 
# RUN docker-php-ext-configure odbc && docker-php-ext-install -j$(nproc) odbc 
# RUN docker-php-ext-install -j$(nproc) pcntl 
# RUN docker-php-ext-install -j$(nproc) phar 
# RUN docker-php-ext-install -j$(nproc) sockets 
# RUN docker-php-ext-install -j$(nproc) sodium 
# RUN docker-php-ext-install -j$(nproc) spl 
# RUN docker-php-ext-configure standard && docker-php-ext-install -j$(nproc) standard 
# RUN docker-php-ext-install -j$(nproc) tokenizer 

#bz2 #gd #hash


### PECL extensions ###

RUN pecl channel-update pecl.php.net


### (http://pecl.php.net/packages.php)
### Use "pecl list-all" for all supported modules.
### Add extension=*** in php.ini for each pecl's extensions
# RUN apt install -y libmcrypt-dev libpcre3-dev


RUN echo "\n" | pecl install apcu
RUN echo "\n" | pecl install ast
RUN echo "\n" | pecl install ds
RUN echo "\n" | pecl install psr

# RUN echo "\n" | pecl install mcrypt
# RUN echo "\n" | pecl install oauth

#crypto #env #http_message #imagick #imap #ingres #lua #v8js
    



#####################
### DB extensions ###
#####################


RUN apt install -y \
    libsqlite3-dev \
    libpq-dev

RUN docker-php-ext-install -j$(nproc) dba
RUN docker-php-ext-install -j$(nproc) pdo
RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-install -j$(nproc) pdo_pgsql
RUN docker-php-ext-install -j$(nproc) pdo_sqlite

# RUN docker-php-ext-install -j$(nproc) pdo_odbc
# RUN echo "\yes" | pecl install mongodb



###########
### NVM ###
###########

SHELL ["/bin/bash", "-c"]
ENV NVM_DIR="/usr/local/nvm"
ENV NODE_VERSION=lts/*
RUN mkdir -p "$NVM_DIR"
RUN curl --silent -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash

# Install NVM and Node in one layer
# RUN curl -fsSL https://raw.githubusercontent.com/nvm-sh/nvm/v0.40.3/install.sh | bash && \
RUN . "$NVM_DIR/nvm.sh" && [ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh" && \
    nvm install --lts && \
    nvm use --lts && \
    nvm alias default 'lts/*' && \
    nvm use default && \
    # Make node/npm accessible to all users
    ln -sf "$NVM_DIR/versions/node/$(nvm version)/bin/node" /usr/local/bin/node && \
    ln -sf "$NVM_DIR/versions/node/$(nvm version)/bin/npm" /usr/local/bin/npm && \
    ln -sf "$NVM_DIR/versions/node/$(nvm version)/bin/npx" /usr/local/bin/npx && \
    chmod a+x /usr/local/bin/node /usr/local/bin/npm /usr/local/bin/npx

# Add NVM sourcing for all interactive shells
RUN echo 'export NVM_DIR="/usr/local/nvm"' >> /etc/bash.bashrc && \
    echo '[ -s "$NVM_DIR/nvm.sh" ] && \. "$NVM_DIR/nvm.sh"' >> /etc/bash.bashrc

# Verify acces from another shell instance
# RUN nvm --version && node -v && npm -v
RUN bash -ic "nvm --version && node -v && npm -v"



##############
### APACHE ###
##############

RUN a2enmod rewrite



### USER ###

RUN echo 'root:root' | chgpasswd
RUN addgroup user -gid ${GID}
RUN adduser user --uid ${UID} --gid ${GID} --gecos GECOS --disabled-password
USER user:user


WORKDIR /var/www/application




############################
### Coverage & Profiling ###
############################


### @see https://xdebug.org ###

# RUN pecl install \
# #     pcov \
#     xdebug
# #     xhprof


### Ssh ###

# Use following to send an ssh key on remote host
# ssh-copy-id -i ~/.ssh/id_ed25519.pub user@remote-host.com
# RUN rm -f ~/.ssh/id_ed25519*
# RUN apt install -y ssh && \
#     ssh-keygen -t ed25519 -C "your_email@example.com" -f ~/.ssh/id_ed25519 -N "" && \
#     eval "$(ssh-agent -s)" && \
#     ssh-add ~/.ssh/id_ed25519

#############
### Clean ###
#############
# RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*





### NODE ###

# SHELL ["/bin/bash", "-c"]
# # tell bash to load .bashrc manually
# ENV BASH_ENV ~/.bashrc
# # needed by volta() function
# ENV VOLTA_HOME /home/user/.volta
# # make sure packages managed by volta will be in PATH
# ENV PATH /home/user/.volta/bin:$PATH

# RUN curl https://get.volta.sh | bash

# RUN volta install node@${NODE_VERSION}



### GD ###

# RUN apt install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev \
#     && docker-php-ext-configure gd --with-freetype --with-jpeg \
#     && docker-php-ext-install -j$(nproc) gd \
#     && php -r "var_dump(gd_info());"

