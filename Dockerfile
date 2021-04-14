FROM php:8

WORKDIR /var/www/html

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y \
    git zip
RUN docker-php-ext-install pdo_mysql

RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
USER www

EXPOSE 80
CMD ["php", "-S", "0.0.0.0:80", "-t", "public"]
