ARG PHP_VERSION
FROM php:${PHP_VERSION}-cli-alpine
ENV PHP_VERSION "$PHP_VERSION"

ENV LANG=en_US.UTF-8 \
    LANGUAGE=en_US.UTF-8 \
    LC_ALL=en_US.UTF-8

ENV COMMON_PACKAGES="git bash bash-completion nano vim curl coreutils sudo"
RUN apk add --no-cache ${COMMON_PACKAGES}

ENV PHP_INI_TIMEZONE=UTC
RUN ln -fs /usr/share/zoneinfo/${PHP_INI_TIMEZONE} /etc/localtime

ENV PHP_RUNDEPS="util-linux-dev pcre-dev zlib-dev libzip-dev libgd libpng-dev libpq icu-libs libmcrypt autoconf libevent"
RUN apk add --no-cache ${PHP_RUNDEPS}

ENV PHP_EXTENSIONS="json simplexml session xml" \
    PHP_BUILDDEPS="libxml2-dev gcc g++ libtool make binutils"
RUN apk add --no-cache --virtual .php_builddeps ${PHP_BUILDDEPS} ${PHPIZE_DEPS} \
    && docker-php-ext-install ${PHP_EXTENSIONS} \
    && docker-php-ext-enable ${PHP_EXTENSIONS} \
    && apk del .php_builddeps

ENV COMPOSER_ALLOW_SUPERUSER=1 \
    COMPOSER_NO_INTERACTION=1 \
    COMPOSER_HOME=/opt/composer
COPY --from=composer:1.9 /usr/bin/composer /usr/bin/composer

ARG USER_GID=1000
ARG USER_UID=1000
RUN addgroup -g ${USER_GID} app \
  && adduser -D -s /bin/bash -G app -u ${USER_UID} app \
  && echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers \
  && composer global require bamarni/symfony-console-autocomplete \
  && symfony-autocomplete composer | tee /usr/share/bash-completion/completions/composer \
  && chown -R app:app /opt

# @fixme docker changes PHP_VERSION to '7.4.3' here
#ENV PHP_VERSION=7.4
#COPY php-${PHP_VERSION}.ini     /usr/local/etc/php/php.ini
#COPY conf.d/                    /usr/local/etc/php/conf.d

RUN composer global require hirak/prestissimo

WORKDIR /srv
RUN chown -R app:app /srv
USER app

ENTRYPOINT ["tail", "-f", "/dev/null"]
