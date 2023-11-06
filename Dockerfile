FROM php:8.2-cli
COPY . /var/www/toy-robot-app
WORKDIR /var/www/toy-robot-app
CMD [ "composer", "install" ]
