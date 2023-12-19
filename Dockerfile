FROM dunglas/frankenphp

RUN apt-get update \
    && apt-get install -y --no-install-recommends git libicu-dev libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev zip \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo pdo_mysql gd opcache intl zip calendar dom mbstring xsl \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app

COPY . /app

EXPOSE 80 443