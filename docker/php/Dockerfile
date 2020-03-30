FROM php:7.4-fpm

RUN apt-get update \
    && apt-get -y install libssl-dev libc-client2007e-dev libkrb5-dev curl git zip unzip \
    && curl -L -C - --progress-bar -o /usr/local/bin/composer https://getcomposer.org/composer.phar \
    && chmod 755 /usr/local/bin/composer \
    && docker-php-ext-install -j$(nproc) bcmath pdo pdo_mysql \
    && pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini
