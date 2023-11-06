FROM php:8.2-cli
COPY . /var/www/toy-robot-app
WORKDIR /var/www/toy-robot-app
# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
