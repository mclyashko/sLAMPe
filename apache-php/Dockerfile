FROM php:8.0.24-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod dbd && a2enmod authn_dbd && apt-get update && apt-get install -y apache2-utils libaprutil1-dbd-mysql
RUN service apache2 restart