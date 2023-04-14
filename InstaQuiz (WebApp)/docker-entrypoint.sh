#!/bin/bash
set -e

if [ -z "$MYSQL_ROOT_PASSWORD" ]; then
  echo "MYSQL_ROOT_PASSWORD not set!"
  exit 1
fi

if [ -z "$MYSQL_USER" ]; then
  echo "MYSQL_USER not set!"
  exit 1
fi

if [ -z "$MYSQL_PASSWORD" ]; then
  echo "MYSQL_PASSWORD not set!"
  exit 1
fi

if [ -z "$MYSQL_DATABASE" ]; then
  echo "MYSQL_DATABASE not set!"
  exit 1
fi

# Delete all files in the data directory
rm -rf /var/lib/mysql/*

# Initialize MySQL data directory
mysqld --initialize-insecure --datadir=/var/lib/mysql

# Start MySQL server
mysqld --skip-networking &

# Wait for MySQL to start up
until mysqladmin ping &>/dev/null; do
  sleep 1
done

# Set root password
mysql --user=root --execute="ALTER USER 'root'@'localhost' IDENTIFIED BY '${MYSQL_ROOT_PASSWORD}'; GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO 'root'@'localhost'; FLUSH PRIVILEGES"

echo "Finished setting up root"

# Create user and grant privileges
mysql --user=root --password="${MYSQL_ROOT_PASSWORD}" --execute="CREATE USER '${MYSQL_USER}'@'%' IDENTIFIED BY '${MYSQL_PASSWORD}'; GRANT ALL PRIVILEGES ON $MYSQL_DATABASE.* TO '${MYSQL_USER}'@'%'; FLUSH PRIVILEGES"

echo "Finished setting up user: $MYSQL_USER"

#mysql --user=root --password="${MYSQL_ROOT_PASSWORD}" --execute="GRANT ALL PRIVILEGES ON *.* TO 'user'@'%' IDENTIFIED BY 'password' WITH GRANT OPTION;"

#echo "Finished setting up phpmyadmin connections"

# Run DDL script as root
if [ -n "$MYSQL_DATABASE" ]; then
  echo "Creating database: $MYSQL_DATABASE"
  echo "Importing /docker-entrypoint-initdb.d/instaquiz.ddl"
  mysql --user=root --password="$MYSQL_ROOT_PASSWORD" -e "CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE;"
  mysql --user=root --password="$MYSQL_ROOT_PASSWORD" "$MYSQL_DATABASE" < /docker-entrypoint-initdb.d/ddl/instaquiz.ddl
  echo "Database created!"
fi

#mysqld --datadir=/var/lib/mysql

# Stop MySQL server
mysqladmin --user=root --password="$MYSQL_ROOT_PASSWORD" shutdown

# Wait for MySQL to stop
while pgrep mysqld >/dev/null; do
  sleep 1
done

exec "$@"