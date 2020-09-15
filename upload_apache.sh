#!/usr/bin/env bash
#We upload the webapp image as we learned in the course
# we using $appver environment variable to tag the image with the branch's SHA, got from the makefile
#tag and login
dockerpath=rcdotnet/cameleon:$appver
docker login --username=rcdotnet 
docker tag cameleon:$appver $dockerpath
echo "Docker ID and Image: $dockerpath"
# Push the image to a docker repository
docker push $dockerpath