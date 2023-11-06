FROM mcr.microsoft.com/devcontainers/php:1-8.2-bullseye
COPY . /var/www/toy-robot-app
WORKDIR /var/www/toy-robot-app
EXPOSE 8000
CMD bash -c "composer install && php -S localhost:8000 ./router.php"
