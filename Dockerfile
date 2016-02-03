FROM php:7-apache
WORKDIR /usr/src/myapp
CMD [ "php", "bin/console server:start" ]