FROM php:8.0.24-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod authn_dbd && a2enmod authn_socache && apt-get update && apt-get install -y libaprutil1-dbd-mysql