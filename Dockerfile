FROM php:8.0-cli

#
# Install dependencies
#

RUN set -xe; \
    apt-get update && \
    apt-get install -y \
        curl \
        git \
        zip \
        zlib1g-dev \
        libzip-dev \
        libicu-dev && \
    docker-php-ext-install \
        zip \
        pdo \
        pdo_mysql \
        intl && \
    pecl install \
            xdebug-3.1.2 && \
    docker-php-ext-enable xdebug && \
    echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.start_with_request=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* \
           /tmp/* \
           /var/tmp/* \
           /var/log/lastlog \
           /var/log/faillog

#
# Workspace User
#

ARG APP_USER_ID=1000
ARG APP_GROUP_ID=1000

RUN set -xe; \
    groupadd -f workspace && \
    groupmod -g ${APP_GROUP_ID} workspace && \
    useradd workspace -g workspace && \
    mkdir -p /home/workspace && chmod 755 /home/workspace && chown workspace:workspace /home/workspace && \
    usermod -u ${APP_USER_ID} -m -d /home/workspace workspace -s $(which bash) && \
    chown -R workspace:workspace /var/www/html

#
# Set Timezone
#

ARG TIME_ZONE='Asia/Seoul'

RUN ln -snf /usr/share/zoneinfo/${TIME_ZONE} /etc/localtime && echo ${TIME_ZONE} > /etc/timezone

#
# Composer Setup
#

ARG COMPOSER_VERSION=2.0.12
ARG COMPOSER_REPO_PACKAGIST='https://packagist.jp'

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer --version=${COMPOSER_VERSION} && \
    composer config -g repos.packagist composer ${COMPOSER_REPO_PACKAGIST}

WORKDIR /var/www/html
EXPOSE 8000
