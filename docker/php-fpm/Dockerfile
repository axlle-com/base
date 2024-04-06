FROM php:8.2-fpm

# Install php extentions and composer
RUN apt-get update && apt-get install -y git zip libzip-dev unzip mc nano
RUN pecl install xdebug
RUN pecl install redis
RUN docker-php-ext-enable xdebug && docker-php-ext-enable redis
RUN docker-php-ext-install pdo_mysql exif pcntl bcmath zip
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Add user
RUN getent group www || groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www
RUN mkdir /var/log/xdebug
RUN chown -R www:www /var/log/xdebug

# Add fpm socket
RUN rm /usr/local/etc/php-fpm.d/zz-docker.conf; \
    addgroup --gid 1001 --system nginx; \
    adduser --uid 1001 --system --ingroup nginx nginx;

COPY www.conf /usr/local/etc/php-fpm.d/www.conf

USER www

WORKDIR /var/www

VOLUME ["/var/www", "/var/run/php-fpm", "/var/log/php"]

CMD ["php-fpm",  "--allow-to-run-as-root", "--nodaemonize"]
