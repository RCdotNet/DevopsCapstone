#!/usr/bin/env bash

# Generating mysql image with the demo data
# Build the image image tag it, we tag it v1 as we don't change the test data set, and we dont deploy it onnly initially
#   
cd mysql
docker build --rm --tag mysqldemo:v1 .
# List docker images
docker image ls
# Push it to dockerhub
cd ..

