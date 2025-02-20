FROM php:8.2.11-fpm

# Install composer
RUN cd /tmp \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Install pdo mysql
RUN docker-php-ext-install pdo pdo_mysql

RUN apt-get update

# Install tools
RUN apt-get -y install apt-utils nano wget dialog vim

# Install libs
RUN apt-get -y install --fix-missing \
    libicu-dev \
    libmariadb-dev \
    git \
    curl \
    libcurl4 \
    zlib1g-dev \
    libzip-dev \
    unzip zip \
    libxml2-dev

# Install nodejs 20.x
RUN curl -sL https://deb.nodesource.com/setup_20.x| bash -
RUN apt-get install -y nodejs

