#!/usr/bin/env bash

## Complete the following steps to get Apache2 run locally on docker 
cd Apache/app
echo "<?php \$repoversion='"$appver"';?>" > version.php
zip  -r Cameleon2 .
cd ..
# Step 1:
# Build image and add a descriptive tag
echo $appver
docker build --rm --tag cameleon:$appver .
# Step 2: 
# List docker images
docker image ls
# Step 3: 
# Start the container


cd ..