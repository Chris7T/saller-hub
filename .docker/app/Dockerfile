FROM php:8.1.0-fpm

WORKDIR /var/www

RUN apt-get update && \
    apt-get install -y \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath sockets

RUN apt-get install -y libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd

RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - && \
    apt-get install -y nodejs

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN pecl install -o -f redis \
    &&  rm -rf /tmp/pear \
    &&  docker-php-ext-enable redis

RUN chown -R www-data:www-data /var/www
RUN chmod -R 775 /var/www

EXPOSE 9000

CMD mkdir -p /var/www/storage/logs && chown -R www-data:www-data /var/www/storage && chmod -R 775 /var/www/storage && php-fpm
