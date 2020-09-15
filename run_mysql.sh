#!/usr/bin/env bash
docker run --name sql --network mynetwork  -e MYSQL_ROOT_PASSWORD=Uda -d -p 3307:3306 mysqldemo:$1