FROM mcr.microsoft.com/devcontainers/php:1-8.2-bullseye
COPY . /var/www/toy-robot-app
WORKDIR /var/www/toy-robot-app
# RUN apt-get -y update
# RUN apt-get -y install git zip unzip
# COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
CMD bash -c "composer install"
