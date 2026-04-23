FROM php:8.2-apache

# Системные зависимости
RUN apt-get update && apt-get install -y \
    libssl-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Расширения PHP (GD для графиков, pdo_mysql для Laravel)
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install mysqli pdo_mysql gd \
    && pecl install redis \
    && docker-php-ext-enable mysqli pdo_mysql redis gd

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Локаль и конфигурация Apache
RUN apt-get update && apt-get install -y locales && \
    echo "ru_RU.UTF-8 UTF-8" > /etc/locale.gen && locale-gen

ENV LANG ru_RU.UTF-8
ENV LC_ALL ru_RU.UTF-8

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN a2enmod rewrite

# Redis Session
RUN echo "session.save_handler = redis" >> /usr/local/etc/php/conf.d/docker-php-ext-redis.ini \
    && echo "session.save_path = 'tcp://redis:6379'" >> /usr/local/etc/php/conf.d/docker-php-ext-redis.ini

WORKDIR /app
