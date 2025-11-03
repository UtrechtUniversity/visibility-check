This folder is for database initialization.

When a container is started for the first time, a new database with the specified name will be created and initialized Mariadb will execute files with extensions .sh, .sql, .sql.gz, .sql.xz and .sql.zst that are found in /docker-entrypoint-initdb.d. Files will be executed in alphabetical order. 