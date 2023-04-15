# build image for mysql with ddl script
FROM mysql:latest as db

# copy the init SQL file to the container
COPY ./db/ddl/instaquiz.ddl /docker-entrypoint-initdb.d

# use custom docker-entrypoint.sh file to load mysql image with root permissions when importing ddl
COPY docker-entrypoint.sh /usr/local/bin
RUN chmod +x /usr/local/bin/docker-entrypoint.sh
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["mysqld"]

# build image for apache that auto installs mysqli
FROM php:7.4-apache as webserver

# install mysqli and enable it
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli

# installing composer to manage dependencies of phpunit
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

#installing dependencies to install phpunit
RUN apt-get update && apt-get install -y zlib1g-dev libzip-dev unzip
RUN docker-php-ext-install zip