FROM php:8.0.24-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN a2enmod authn_dbd && apt-get update && apt-get install -y libaprutil1-dbd-mysql
RUN pecl install redis && docker-php-ext-enable redis
RUN pecl install mongodb && docker-php-ext-enable mongodb
RUN apt-get install unzip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
WORKDIR /var/www
RUN composer require mongodb/mongodb
RUN apt-get install -y libpng-dev &&  \
    docker-php-ext-install gd &&  \
    composer require fakerphp/faker &&  \
    composer require amenadiel/jpgraph
RUN a2enmod rewrite