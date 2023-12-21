FROM php:8.1.0-apache
ARG NODE_VERSION=19
ARG NPM_VERSION=9.5.1
# Composer
#COPY --from=composer:latest /usr/bin/composer /usr/local/composer
COPY . /var/www/html/
RUN curl -sL https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm@${NPM_VERSION} \
    && apt-get install -y git \
    && apt-get install -y zip \
    && apt-get install -y unzip \
    && apt-get install -y nano \
    && docker-php-ext-install pdo pdo_mysql
