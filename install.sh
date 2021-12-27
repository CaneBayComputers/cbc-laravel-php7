#!/bin/bash

set -e

ENV=local

if [ ! -z "$1" ]; then

	ENV=$1

fi

find storage/framework -maxdepth 1 -type d -exec chmod 777 {} +

chmod 777 storage/logs

chmod 777 bootstrap/cache

cp -f .env.$ENV .env

if [ "$ENV" = "local" ]; then

	composer --ignore-platform-reqs install

	cd public

	if [ ! -f ocp.php ]; then

		wget -O ocp.php https://gist.githubusercontent.com/ck-on/4959032/raw/ad6362bff017f3c59c96ab395e3308ed52650cab/ocp.php

	fi

	if [ ! -f adminer.php ]; then

		wget -O adminer.php https://github.com/vrana/adminer/releases/download/v4.8.1/adminer-4.8.1-en.php

	fi

	cd ..

else

	composer install

fi