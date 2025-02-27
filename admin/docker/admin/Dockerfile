FROM composer:2.2.25 AS vendor

WORKDIR /var/www/admin_app

COPY application/composer.json application/composer.lock ./

RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

FROM php:8.3-fpm AS admin_final

EXPOSE 9000

WORKDIR /var/www/admin_app

COPY --from=vendor /var/www/admin_app/vendor /var/www/admin_app/vendor

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions grpc
RUN install-php-extensions opentelemetry

COPY --chown=www-data:www-data application/ .

COPY --chmod=555 ./docker /

ENTRYPOINT ["/admin_app_boot.sh"]
CMD ["php-fpm"]
