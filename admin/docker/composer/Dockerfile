FROM php:8.4-cli

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions grpc
RUN install-php-extensions opentelemetry

RUN apt-get update && apt-get install -y git unzip && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENTRYPOINT ["composer"]
CMD ["--help"]