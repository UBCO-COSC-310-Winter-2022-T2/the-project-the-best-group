FROM mysql:latest

# create a new user and set root privileges
RUN useradd -r -u 1001 -g mysql newuser \
    && mkdir /home/newuser \
    && chown -R newuser:mysql /home/newuser \
    && chmod -R 770 /home/newuser \
    && echo "newuser ALL=(ALL) NOPASSWD: ALL" >> /etc/sudoers

# copy the init SQL file to the container
COPY ./db/ddl/01-ddl.ddl /docker-entrypoint-initdb.d/

# set the entrypoint to run as the custom user
ENTRYPOINT ["sudo", "-u", "newuser", "/entrypoint.sh"]

FROM php:7.4-apache as webserver
RUN docker-php-ext-install mysqli
RUN docker-php-ext-enable mysqli