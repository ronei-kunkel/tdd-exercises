FROM composer:latest@sha256:23beecbb2cf15f2bddeb8115f877896ade09e47cf44ccf341204ed1d947a0f38 AS composer
WORKDIR /app
COPY ./ /app
RUN composer install

FROM php:8.2-cli-alpine@sha256:0732d9969e6c2994684aac53051dd115799ce20a92c4db8f12b7013b7c0caeff
WORKDIR /app
COPY --from=composer /usr/bin/composer /usr/bin/composer
COPY --from=composer /app /app
CMD ["/app/vendor/bin/pest"]
