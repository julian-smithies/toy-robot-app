FROM php:cli
COPY . /var/www/toy-robot-app
WORKDIR /var/www/toy-robot-app
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
CMD bash -c "composer install"
