FROM php:8.2-apache

COPY apache/000-default.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y \
    libssl-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install mysqli gd zip \
    && pecl install redis \
    && docker-php-ext-enable mysqli redis gd

RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN apt-get update && apt-get install -y locales && \
    echo "ru_RU.UTF-8 UTF-8" > /etc/locale.gen && \
    locale-gen
ENV LANG ru_RU.UTF-8
ENV LC_ALL ru_RU.UTF-8

RUN echo "session.save_handler = redis" >> /usr/local/etc/php/conf.d/docker-php-ext-redis.ini \
    && echo "session.save_path = 'tcp://redis:6379'" >> /usr/local/etc/php/conf.d/docker-php-ext-redis.ini

WORKDIR /app
COPY src/ /app/
RUN composer install --no-interaction --no-dev --optimize-autoloader
RUN mkdir -p /app/uploads && chown -R www-data:www-data /app
