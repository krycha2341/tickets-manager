FROM php:8.2.13-fpm-alpine

ENV BUILD_FLAG=""

RUN curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY ./ /app
WORKDIR /app

RUN apk --update add wget \
      curl \
      grep \
      build-base \
      libtool \
      make \
      autoconf \
      g++ \
      php-gmp \
      gmp-dev \
      postgresql-dev

# php config
COPY ./build/docker-php.ini /usr/local/etc/php/conf.d/docker-php.ini

RUN docker-php-ext-install gmp && docker-php-ext-enable gmp
RUN docker-php-ext-install pgsql pdo_pgsql pdo && docker-php-ext-enable pgsql pdo_pgsql pdo
RUN composer config --global repo.packagist composer https://packagist.org
RUN composer install --prefer-dist --no-interaction --no-suggest

EXPOSE 8000

ENTRYPOINT php artisan serve --host=0.0.0.0 $BUILD_FLAG