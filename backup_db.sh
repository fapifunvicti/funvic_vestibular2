#!/bin/bash

data=$(date '+%Y-%m-%d-%H-%M-%S')

docker compose exec mariadb mysqldump -u root -p \
    --routines \
    --triggers \
    --events \
    --databases vestibular2 > "sql/dump-$data.sql"