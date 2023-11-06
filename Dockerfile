FROM php:8.2-cli
COPY . /var/www/toy-robot-app
WORKDIR /var/www/toy-robot-app
# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer
