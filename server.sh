#!/bin/env bash


export XDEBUG_MODE="debug, develop"
export XDEBUG_CONFIG="client_host=127.0.0.1 client_port=9003"
export PHPRC="$(pwd)"


php -c ./custom.ini -S 10.0.3.65:8000 -t public route_resource.php
