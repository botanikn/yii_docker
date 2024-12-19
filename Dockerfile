# Используем базовый образ PHP
FROM php:7.4-fpm

# Устанавливаем необходимые пакеты и расширения
RUN apt-get update \
    && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \