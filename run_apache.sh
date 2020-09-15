#!/usr/bin/env bash
echo $appver
docker run --name mywebapp --network mynetwork  -d -p $1:$2 cameleon:$appver