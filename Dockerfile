FROM dunglas/frankenphp

ARG UID=1000
ARG GID=1000

RUN install-php-extensions \
    zip \
    pdo_pgsql \
    pcntl

RUN mkdir -p /.cache/ /.config/psysh/ && \
    chown -R $UID:$GID /.cache && \
    chown -R $UID:$GID /.config/psysh

COPY --from=composer /usr/bin/composer /usr/bin/composer
