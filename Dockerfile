FROM nginx/unit:1.28.0-php8.1

# Install PHP extensions
RUN set -ex \
    && apt-get update \
    && apt-get install --no-install-recommends -y git libfreetype6 libfreetype6-dev libjpeg62-turbo libjpeg62-turbo-dev libpng16-16 libpng-dev libwebp6 libwebp-dev unzip \
    && docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
    && docker-php-ext-install gd pdo_mysql \
    && pecl install redis-5.3.7 \
    && docker-php-ext-enable redis \
    && apt-get purge -y --auto-remove git libfreetype6-dev libjpeg62-turbo-dev libpng-dev libwebp-dev \
    && rm -rf /tmp/pear /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Configure PHP & Unit
COPY docker_files/php.ini /etc/php8/conf.d/50-setting.ini
COPY docker_files/bootstrap-laravel.sh /docker-entrypoint.d/
COPY unit.json /docker-entrypoint.d/

# Copy application files
WORKDIR /var/www/app
COPY --chown=unit:unit . /var/www/app

# Install Composer dependencies
RUN set -ex \
    && composer install --no-dev --optimize-autoloader \
    && rm -rf /root/.composer \
    && chown -R unit:unit bootstrap/cache vendor

# CMD and ENTRYPOINT are inherited from the Unit image