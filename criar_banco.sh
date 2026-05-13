#!/bin/env bash

arquivo_db="vestibular.db"
folder="db"
db_path="$folder/$arquivo_db"
sql_dump="sql/vestibular.db.sql"

if [ ! -d "$folder" ]; then
    echo "pasta db nao existe criando.."
    mkdir -p $folder
    chown $USER:$USER 
    chmod 0744 $folder
else
    echo "pasta db ja existe.. ignorando"
fi

if [ -f "$db_path" ]; then
    echo "arquivo $db_path ja existe. saindo"
    exit;
fi

sqlite3  $db_path < $sql_dump



