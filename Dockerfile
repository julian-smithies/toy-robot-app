FROM php:cli
COPY . /var/www/toy-robot-app
WORKDIR /var/www/toy-robot-app
RUN apt-get -y update
RUN apt-get -y install git
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
CMD bash -c "composer install"
