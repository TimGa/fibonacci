FROM php:8.2-fpm-alpine3.17

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
  && pecl install redis \
  && docker-php-ext-enable redis \
  && apk del pcre-dev ${PHPIZE_DEPS} \
  && rm -rf /tmp/pear

COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer
