#!/usr/bin/env bash

mysql --user=root --password="$MYSQL_ROOT_PASSWORD" <<-EOSQL
    CREATE DATABASE IF NOT EXISTS $MYSQL_DATABASE;
    CREATE DATABASE IF NOT EXISTS testing;
EOSQL

    # GRANT ALL ON $MYSQL_DATABASE.* TO '$MYSQL_USER'@'localhost';
    # GRANT ALL ON testing.* TO '$MYSQL_USER'@'localhost';