#!/usr/bin/env bash
#We upload the mysql image as we learned in the course
#tag and login
dockerpath=rcdotnet/mysqldemo:v1
docker login --username=rcdotnet 
docker tag mysqldemo:v1 $dockerpath
echo "Docker ID and Image: $dockerpath"
# Push the image to a docker repository
docker push $dockerpath