FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2 \
    zip \
    unzip \
    && docker-php-ext-install pdo pdo_mysql mbstring gd exif pcntl bcmath

RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs && \
    npm install -g npm

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

COPY ./docker/php.ini /usr/local/etc/php/conf.d/

EXPOSE 9000

CMD php artisan migrate -f && php artisan config:cache && php-fpm