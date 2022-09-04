FROM php:7.2-apache
WORKDIR /var/www/html/
COPY . .
RUN docker-php-ext-install mysqli
EXPOSE 80