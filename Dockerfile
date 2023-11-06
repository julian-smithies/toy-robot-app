FROM mcr.microsoft.com/devcontainers/php:1-8.2-bullseye
COPY . /var/www/toy-robot-app
WORKDIR /var/www/toy-robot-app
# # Install composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
