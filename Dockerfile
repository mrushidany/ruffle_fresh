FROM php:8.0-fpm

RUN apt-get update

RUN apt-get install -y libmcrypt-dev libonig-dev libzip-dev libpng-dev

RUN docker-php-ext-install pdo_mysql exif mbstring zip gd

RUN apt-get install -y curl

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

RUN composer install

CMD php artisan config:cache && php artisan serve --host=0.0.0.0 --port=8000

EXPOSE 8000